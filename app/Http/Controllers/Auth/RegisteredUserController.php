<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Region;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Pest\Plugins\Parallel\Support\CompactPrinter;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $cities =  City::all();
        $districts = Region::all();
        $wards = Ward::all();

        return view('auth.register',Compact('cities','districts','wards'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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
        Auth::login($user);

        return redirect()->route('dashboard')->with('success','Your Registration sent successfully, Wait for verification');
    }
}
