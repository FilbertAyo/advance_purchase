<?php

namespace App\Http\Controllers;

use App\Mail\LoanApplicationNotification;
use App\Models\Advance;
use App\Models\Application;
use App\Models\Bank;
use App\Models\Item;
use App\Models\Screenshot;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Application::with('user') // eager load user to prevent N+1
            ->where('status', '!=', 'inactive')
            ->orderBy('id', 'desc');

        // Apply search if present
        if ($search = $request->input('search')) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('userId', 'like', "%{$search}%");
            });
        }

        // Pagination size
        $perPage = $request->input('perPage', 10);
        $applications = $query->paginate($perPage);

        $user = User::whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->get();
        $items = Item::all();

        return view('applications.application', compact('items', 'user', 'applications'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => ['required', 'string', 'max:255'],
            'customer_id' => ['required', 'string', 'max:255'],
        ]);

        // Get the last application for this customer
        $lastApplication = Application::where('customer_id', $request->customer_id)
            ->latest()
            ->first();

        // Fetch item and its price
        $item = Item::find($request->item_id);

        if (!$item) {
            return redirect()->back()->with('error', 'Selected item not found.');
        }

        // Block if there's an outstanding balance
        if ($lastApplication && $lastApplication->outstanding > 0) {
            return redirect()->back()->with('error', 'You have an outstanding balance. Please settle it before applying for a new product.');
        }

        // Calculate discount (if any) and outstanding
        $discountAmount = $lastApplication ? ($lastApplication->price * 0.07) : 0;
        $outstanding = max($item->sales - $discountAmount, 0);

        DB::beginTransaction();

        try {
            $application = Application::create([
                'customer_id' => $request->customer_id,
                'item_id' => $item->id,
                'price' => $item->sales,
                'paid_amount' => $discountAmount,
                'outstanding' => $outstanding,
            ]);

            // Record discount as advance if any
            if ($discountAmount > 0) {
                Advance::create([
                    'application_id' => $application->id,
                    'added_amount' => $discountAmount,
                    'outstanding' => $outstanding,
                    'updated_by' => 'Discount',
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Transaction failed: ' . $e->getMessage());
        }

        // Send mail to admins
        $customer = Auth::user();
        $admins = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['admin', 'superuser']);
        })->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new LoanApplicationNotification($customer));
        }

        return redirect()->back()->with('success', 'Application sent successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $application = Application::with('user.profile')->findOrFail($id);

        //retrive the records of advance from the database
        $advances = Advance::where('application_id', $application->id)->get();
        $screenshots = Screenshot::where('application_id', $id)->get();

        return view('applications.app_view', compact('application', 'advances', 'screenshots'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $application = Application::findOrFail($id);

        return view('applications.app_edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'paid_amount' => 'required|numeric',
        ]);

        $application = Application::findOrFail($id);

        // Update the paid amount
        $application->paid_amount = $request->input('paid_amount') + $request->input('added_amount');
        $application->outstanding = max(0, $application->price - $application->paid_amount);

        if ($application->outstanding < 0) {
            return redirect()->back()->withErrors(['error' => 'This application is completely paid.']);
        }

        $application->save();

        Advance::create([
            'application_id' => $application->id,
            'added_amount' => $request->added_amount,
            'outstanding' => $application->outstanding,
            'updated_by' => $request->updated_by,
        ]);

        return redirect()->route('application.show', $id)->with('success', 'Application updated successfully.');
    }

    public function updateSerialNo(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'serial_number' => 'required|string|max:255',
        ]);

        // Find the application by ID
        $application = Application::findOrFail($id);

        // Update the serial number
        $application->serial_number = $request->serial_number;
        $application->save();

        return redirect()->route('application.show', $id)->with('success', 'Application Serial Number of the product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $application = Application::find($id);

        if ($application) {
            $application->delete();
            return redirect()->back()->with('success', 'Application deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Application not found');
        }
    }

    public function advanceDestroy($id)
    {
        $advance = Advance::findOrFail($id);
        $application = $advance->application;

        if ($advance->updated_by == 'Discount' || $application->refund_amount != null) {
            return redirect()->back()->with('error', 'You cannot delete Discount and advance amount for the application where customer has requested for refund.');
        }

        if ($application) {
            $application->paid_amount -= $advance->added_amount;
            $application->outstanding += $advance->added_amount;

            if ($application->paid_amount < 0) {
                $application->paid_amount = 0;
            }
            $application->save();
        }

        $advance->delete();

        return back()->with('success', 'Advance deleted and amount deducted successfully!');
    }

    public function view($id)
    {
        $application = Application::findOrFail($id);
        $banks = Bank::where('status', 'Active')->get();
        $statements = Advance::where('application_id', $id)->where('added_amount', '>', 0)->get();
        $screenshots = Screenshot::where('application_id', $id)->get();

        return view('customer.cust_details', compact('application', 'banks', 'statements', 'screenshots'));
    }

    public function inactive()
    {
        $applications = Application::orderBy('id', 'desc')->where('status', 'inactive')->get();

        $user = User::whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->get();
        $items = Item::all();
        return view('applications.pending', compact('items', 'user', 'applications'));
    }

    public function activate(Request $request, string $id)
    {
        try {
            $application = Application::findOrFail($id);
            $application->status = 'active';
            $application->save();

            return redirect()->route('application.show', $id)->with('success', 'Application activated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Application not found.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while activating the application.');
        }
    }

    public function screenshot(Request $request)
    {
        $request->validate([
            'screenshot' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'application_id' => 'required|exists:applications,id',
        ]);

        // Store the screenshot
        if ($request->hasFile('screenshot')) {
            $image = $request->file('screenshot'); // Get the uploaded file
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('screenshots'), $imageName);

            // Save to database
            Screenshot::create([
                'application_id' => $request->application_id,
                'screenshot' => 'screenshots/' . $imageName,
            ]);

            return back()->with('success', 'Screenshot uploaded successfully!');
        }

        return back()->with('error', 'Failed to upload screenshot.');
    }
    public function screenshotDestroy($id)
    {
        $screenshot = Screenshot::findOrFail($id);

        // Delete the file from storage
        $filePath = public_path($screenshot->screenshot);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete the record from the database
        $screenshot->delete();

        return back()->with('success', 'Screenshot deleted successfully!');
    }


    // refund request
    public function refundRequest(String $id)
    {
        $application = Application::find($id);

        if ($application->paid_amount > 0) {
            $application->refund_amount = $application->paid_amount * 0.7; // 70% of the paid amount = refund amount(Important)
            $application->withheld_amount = $application->paid_amount - $application->refund_amount; // remaining amount after refund - for company
            $application->reason = $application->reason ?? 'No reason';
            $application->save();

            return redirect()->back()->with('success', 'Refund request sent successfully');
        } else {
            return redirect()->back()->with('error', 'This Refund request for this application cannot be sent.');
        }
    }

    public function refundCancel(String $id)
    {
        $application = Application::find($id);

        if ($application->refund_amount > 0) {
            $application->refund_amount = null;
            $application->withheld_amount = null;
            $application->reason = null;
            $application->save();

            return redirect()->back()->with('success', 'Refund request cancelled successfully');
        } else {
            return redirect()->back()->with('error', 'This Refund request for this application cannot be cancelled.');
        }
    }
    public function refundApprove(String $id)
    {
        $application = Application::find($id);

        if ($application->refund_amount > 0) {
            $application->status = 'refunded';
            $application->outstanding = 0;
            $application->save();

            return redirect()->back()->with('success', 'Refund request approved successfully');
        } else {
            return redirect()->back()->with('error', 'This Refund request for this application cannot be approved.');
        }
    }
}
