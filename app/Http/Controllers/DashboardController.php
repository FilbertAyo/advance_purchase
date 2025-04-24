<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advance;
use App\Models\Application;
use App\Models\Bank;
use App\Models\Item;
use App\Models\User;
use App\Models\User_Profile;
use App\Models\User_Relative;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function welcome(){
        $products = Cache::remember('random_products', 3600, function () {
            return Item::with(['productImages' => function ($query) {
                $query->orderBy('id')->limit(1); // Get only the first image
            }])
            ->inRandomOrder()
            ->limit(10)
            ->get();
        });

        return view('welcome', compact('products'));
    }


    public function home()
    {

        $userType = Auth::user()->userType;

        if ($userType == '0') {

            $customerId = Auth::id();
            $applications = Application::where('customer_id', $customerId)->get();
            $relative = User_Relative::where('user_id', $customerId)->get();
            return view('customer.customer', compact('applications','relative'));


        } elseif ($userType == '1' || $userType == '2' || $userType == '3' || $userType == '4') {

            $collection = Advance::all()->sum('added_amount');
            $customerNo = User::where('userType', 0)->count();
            $activeCustomer = User::where('userType', 0)->where('status', 'active')->count();
            $adminNo = User::whereIn('userType', [1, 2, 3])->count();

            $totalApplication = Application::all()->count();
            $newApplicationNo = Application::where('status','inactive')->count();
            $activeApplicationNo = Application::where('status','active')->count();
            $fullPaidNo = Application::where('outstanding',0)->count();

            return view('dashboard', compact('adminNo', 'customerNo', 'collection','activeCustomer','newApplicationNo', 'totalApplication','activeApplicationNo','fullPaidNo'));

        } else {

            redirect()->back()->with('status', "You're not authorized");

        }
    }

    public function user()
    {
        $user = User::whereIn('userType', [1, 2, 3,4])->get();

        return view('users.user', compact('user'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::min(6)],
        ]);

        $userId = $this->generateUniqueUserId();

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'userType' => $request->userType,
            'userId' => $userId,
            'status' => $request->status,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        User_Profile::create([
            'user_id' => $user->id,
            'city' => $request->city,
            'district' => $request->district,
            'ward' => $request->ward,
            'street' => $request->street,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'id_type' => $request->id_type,
            'id_number' => $request->id_number,
            'employment_status' => $request->employment_status,
            'occupation' => $request->occupation,
            'organization' => $request->organization,
        ]);

        event(new Registered($user));

        return redirect()->back()->with('success', 'New Customer registered successfully');
    }
    private function generateUniqueUserId()
    {
        do {
            $userId = random_int(10000000, 99999999);
        } while (User::where('userId', $userId)->exists()); // Check for uniqueness

        return $userId;
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
