<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\User;
use App\Models\User_Profile;
use App\Models\Ward;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Pest\Plugins\Parallel\Support\CompactPrinter;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $cities =  City::all();
        $districts = District::all();
        $wards = Ward::all();

        return view('auth.register', Compact('cities', 'districts', 'wards'));
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
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                'string',
                'max:255',
                'unique:users,phone',
                'regex:/^0(7|6)\d{8}$/',
            ],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(),
            ],

            'id_attachment' => 'nullable',
        ]);

        $userId = $this->generateUniqueUserId();

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'branch' => $request->branch,
            'userType' => $request->userType,
            'status' => $request->status,
            'email' => $request->email,
            'userId' => $userId,
            'password' => Hash::make($request->password),
        ]);

        $id_attach = null;

        if ($request->hasFile('id_attachment')) {
            $attachment = $request->file('id_attachment');
            $attachmentName = time() . '_' . $attachment->getClientOriginalName();
            $attachment->move(public_path('attachments'), $attachmentName);
            $id_attach = 'attachments/' . $attachmentName;
        }

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
            'id_attachment' => $id_attach,
            'employment_status' => $request->employment_status,
            'occupation' => $request->occupation,
            'organization' => $request->organization,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Your Registration sent successfully, Wait for verification');
    }
    private function generateUniqueUserId()
    {
        do {
            $userId = random_int(10000000, 99999999);
        } while (User::where('userId', $userId)->exists()); // Check for uniqueness

        return $userId;
    }
}
