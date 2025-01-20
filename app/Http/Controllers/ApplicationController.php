<?php

namespace App\Http\Controllers;

use App\Models\Advance;
use App\Models\Application;
use App\Models\Bank;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $application = Application::orderBy('id', 'desc')->where('status','active')->get();

        $user = User::where('userType', 0)->get();
        $items = Item::all();
        return view('application.application', compact('items', 'user', 'application'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'customer_name' => ['required', 'string', 'max:255'],
        ]);

        // Extract customer ID from customer_name field (e.g., "1 John Doe")
        $customerName = $request->customer_name;
        $itemDetail = $request->item_name;

        // Separate the concatenated string
        $customerNameParts = explode(' ', $customerName);
        $itemNameParts = explode(' ', $itemDetail);

        $customerId = $customerNameParts[0];
        $firstName = $customerNameParts[1];
        $lastName = $customerNameParts[2];

        // Extract the first part as the price
        $itemPrice = array_shift($itemNameParts);
        // Join the remaining parts as the item name
        $itemName = implode(' ', $itemNameParts);

        // Check the last application for this customer
        $lastApplication = Application::where('customer_id', $customerId)
            ->latest()
            ->first();

        if ($lastApplication && $lastApplication->outstanding > 0) {
            // If the outstanding is greater than zero, reject the application
            return redirect()->back()->with('error', 'You have an outstanding balance. Please settle it before applying for a new Product.');
        }

        // Calculate the outstanding amount for the new application
        $outstanding = $itemPrice - $request->paid_amount;

        DB::beginTransaction();

        try {
            $application = Application::create([
                'customer_id' => $customerId,
                'price' => $itemPrice,
                'item_name' => $itemName,
                'customer_name' => $firstName . ' ' . $lastName,
                'paid_amount' => $request->paid_amount,
                'outstanding' => $outstanding,
                'created_by' => $request->created_by,
            ]);

            Advance::create([
                'application_id' => $application->id,
                'added_amount' => $request->paid_amount,
                'outstanding' => $outstanding,
                'updated_by' => $request->created_by,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Transaction failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Application sent successfully');

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $application = Application::findOrFail($id);

        //retrive the records of advance from the database
        $advances = Advance::where('application_id', $application->id)->get();

        return view('application.app_view', compact('application', 'advances'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $application = Application::findOrFail($id);

        return view('application.app_edit', compact('application'));
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


    public function view($id)
    {

        $application = Application::findOrFail($id);
        $banks = Bank::where('status', 'Active')->get();

        return view('customer.cust_details', compact('application','banks'));
    }

    public function inactive()
    {
        $application = Application::orderBy('id', 'desc')->where('status','inactive')->get();

        $user = User::where('userType', 0)->get();
        $items = Item::all();
        return view('application.pending', compact('items', 'user', 'application'));
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


}
