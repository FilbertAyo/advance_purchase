<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\City;
use App\Models\District;
use App\Models\User;
use App\Models\User_Profile;
use App\Models\User_Relative;
use App\Models\Ward;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $customerId = Auth::id();
        $relatives = User_Relative::where('user_id', $customerId)->get()->groupBy('relationship');

        return view('profile.edit', [
            'user' => $request->user(),
            'relatives' => $relatives,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Toggle status (assuming 'enabled' and 'disabled' as statuses)
        $user->status = $user->status === 'active' ? 'deactivated' : 'active';
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }


    public function showStep1(): View
    {
        $cities =  City::all();
        $districts = District::all();
        $wards = Ward::all();
        return view('profile.steps.step1', Compact('cities', 'districts', 'wards'));
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'gender' => 'required|string',
            'birth_date' => 'required|date',
        ]);

        session(['step1' => $validated]);
        return redirect()->route('wizard.step2');
    }


    public function showStep2(): View
    {
        return view('profile.steps.step2');
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'id_type' => 'required|string|max:50',
            'id_number' => 'required|string|max:50',
            'id_attachment' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
            'employment_status' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:100',
            'organization' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('id_attachment')) {
            $file = $request->file('id_attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $filePath = $file->storeAs('attachments', $fileName, 'public');

            $validated['id_attachment'] = 'storage/' . $filePath;
        }

        session(['step2' => $validated]);
        return redirect()->route('wizard.step3');
    }


    public function showStep3(): View
    {
        return view('profile.steps.step3');
    }

    public function submitFinal(Request $request)
    {
        if (!session()->has('step1') || !session()->has('step2')) {
            return redirect()->route('wizard.step1')->withErrors('Please complete all steps first.');
        }

        $validated = $request->validate([
            'relative_name' => 'required|string|max:255',
            'relationship' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        session(['step3' => $validated]);
        $userId = auth()->id();

        // Save profile data
        $profile = User_Profile::firstOrNew(['user_id' => $userId]);
        $profile->fill(array_merge(session('step1'), session('step2')));
        $profile->user_id = $userId;
        $profile->save();

        // Save next of kin
        User_Relative::create(array_merge(session('step3'), ['user_id' => $userId]));

        session()->forget(['step1', 'step2', 'step3']);

        return redirect()->route('dashboard')->with('success', 'Profile completed successfully!');
    }


    public function destroyRelative($id)
    {
        $relative = User_Relative::find($id);

        if (!$relative) {
            return redirect()->back()->with('error', 'Relative not found');
        }

        $relative->delete();

        return redirect()->back()->with('success', 'Relative deleted successfully');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $profile = User_Profile::where('user_id', $user->id)->first();

        if (!$profile) {
            $profile = new User_Profile();
            $profile->user_id = $user->id;
        }

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('profile'), $imageName);

            // Save the image path in the database
            $profile->profile_image = 'profile/' . $imageName;
        }

        $profile->save();

        return redirect()->back()->with('success', 'Your profile updated successfully.');
    }
}
