<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advance;
use App\Models\Application;
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

            $adminNo = User::where('userType', 0)->count();
            $customerNo = User::whereIn('userType', [1, 2, 3])->count();

            return view('dashboard', compact('adminNo', 'customerNo','collection'));
        }else {
            redirect()->back()->with('status', "You're not authorized");
        }
    }

    public function user()
    {
        $user = User::whereIn('userType', [1, 2, 3])->get();

        return view('users.user',compact('user'));
    }

    public function register(Request $request){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
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
            'street'=>$request->street,
            'ward'=>$request->ward,
            'district'=>$request->district,
            'city'=>$request->city,
            'occupation'=>$request->occupation,
            'nida'=>$request->nida,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->back()->with('success','New user added successfully');
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
}
