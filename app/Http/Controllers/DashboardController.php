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
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{

 public function welcome()
{
    $products = Cache::remember('random_products', 3600, function () {
        return Item::select('id', 'item_name', 'description', 'category', 'sales')
            ->with(['productImages' => function ($query) {
                $query->select('id', 'item_id', 'image_url')->orderBy('id')->limit(1);
            }])
            ->inRandomOrder()
            ->limit(12)
            ->get();
    });

    return view('welcome', compact('products'));
}

    public function home()
    {
        $user = auth()->user();

        if ($user->hasRole('customer')) {
            return redirect()->route('products.list');
        } elseif ($user->hasAnyRole(['admin', 'superuser', 'cashier', 'delivery'])) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('status', "You're not authorized");
        }
    }

    public function dashboard()
    {
        $applications = Application::all();
        $collection = $applications->sum('paid_amount') ?? 0;
        $withheldAmount = $applications->sum('withheld_amount') ?? 0;
        $totalRefund = $applications->sum('refund_amount') ?? 0;

        $amount_withheld = $collection - $totalRefund;
        $amount_without_held = $collection - ($withheldAmount + $totalRefund);

        $customerNo = User::whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->count();
        $activeCustomer = User::whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->where('status', 'active')->count();
        $adminNo = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['admin', 'superuser', 'cashier', 'delivery']);
        })->count();

        $totalApplication = $applications->count();
        $newApplicationNo = $applications->where('status', 'inactive')->count();
        $activeApplicationNo = $applications->where('status', 'active')->count();
        $fullPaidNo = $applications->where('outstanding', 0)->where('status', '!=', 'refunded')->count();

        return view('dashboard', compact(
            'adminNo',
            'customerNo',
            'collection',
            'activeCustomer',
            'newApplicationNo',
            'totalApplication',
            'activeApplicationNo',
            'fullPaidNo',
            'withheldAmount',
            'totalRefund',
            'amount_withheld',
            'amount_without_held'
        ));
    }

    public function myDashboard()
    {
         $user = auth()->user();

        if ($user->hasRole('customer')) {
            $customerId = Auth::id();
            $applications = Application::where('customer_id', $customerId)->get();
            $relative = User_Relative::where('user_id', $customerId)->get();
            return view('customers.customer', compact('applications', 'relative'));
        } else {
            return redirect()->back()->with('status', "You're not authorized");
        }
    }

    public function user()
    {

        $roles = Role::where('name', '!=', 'customer')->get();
        $permissions = Permission::all();
        $users = User::role($roles->pluck('name'))->get();
        return view('users.user', compact('users', 'roles', 'permissions'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'role' => ['required', 'string'],
            'password' => ['required', Rules\Password::min(8)],
        ]);

        $userId = $this->generateUniqueUserId();

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'userId' => $userId,
            'status' => $request->status,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

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

        return redirect()->back()->with('success', 'New User registered successfully');
    }


    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        $role->name = $request->name;
        $role->save();

        // Sync permissions
        $role->syncPermissions($request->permissions ?? []);

        return back()->with('success', 'Role updated successfully.');
    }

    private function generateUniqueUserId()
    {
        do {
            $userId = random_int(10000000, 99999999);
        } while (User::where('userId', $userId)->exists()); // Check for uniqueness

        return $userId;
    }


    public function bank()
    {

        $banks = Bank::all();
        return view('settings.bank', compact('banks'));
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
