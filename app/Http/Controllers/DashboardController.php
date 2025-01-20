<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advance;
use App\Models\Application;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function home()
    {

        $userType = Auth::user()->userType;

        if ($userType == '0') {
            $customerId = Auth::id();
            $applications = Application::where('customer_id', $customerId)->get();

            return view('customer.customer', compact('applications'));
        } elseif ($userType == '1' || $userType == '2' || $userType == '3') {
            $collection = Advance::all()->sum('added_amount');

            $customerNo = User::where('userType', 0)->count();
            $activeCustomer = User::where('userType', 0)
                ->where('status', 'active')
                ->count();

            $adminNo = User::whereIn('userType', [1, 2, 3])->count();

            return view('dashboard', compact('adminNo', 'customerNo', 'collection','activeCustomer'));
        } else {
            redirect()->back()->with('status', "You're not authorized");
        }
    }

    public function user()
    {
        $user = User::whereIn('userType', [1, 2, 3])->get();

        return view('users.user', compact('user'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::min(6)],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'branch' => $request->branch,
            'userType' => $request->userType,
            'store' => $request->store,
            'status' => $request->status,
            'email' => $request->email,
            'street' => $request->street,
            'ward' => $request->ward,
            'district' => $request->district,
            'city' => $request->city,
            'occupation' => $request->occupation,
            'nida' => $request->nida,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->back()->with('success', 'New user added successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }

    public function bank(){

        $banks = Bank::all();
        return view('settings.bank',compact('banks'));
    }
    public function bank_store(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string',
            'account_no' => 'required|string',
            'account_name' => 'required|string',
        ]);

        // Create the record
        Bank::create([
            'bank_name' => $request->bank_name,
            'account_no' => $request->account_no,
            'account_name' => $request->account_name,
           'status' => 'Active',
        ]);

        return redirect()->back()->with('success', 'Record added successfully.');
    }

    public function disable($id)
    {
        // Find the bank record by ID
        $bank = Bank::findOrFail($id);

        // Update the status to 'disabled'
        $bank->update(['status' => 'disabled']);

        return redirect()->back()->with('success', 'Bank has been disabled.');
    }
}
