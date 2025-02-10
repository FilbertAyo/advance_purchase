<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\User_Profile;
use App\Models\User_Relative;
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



    public function storeRelative(Request $request)
{
    $request->validate([
        'relative_name' => 'required|string|max:255',
        'relationship' => 'required|string',
        'phone_number' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'address' => 'nullable|string|max:255',
    ]);

    User_Relative::create([
        'user_id' => $request->user_id,
        'relative_name' => $request->relative_name,
        'relationship' => $request->relationship,
        'phone_number' => $request->phone_number,
        'email' => $request->email,
        'address' => $request->address,
    ]);

    return redirect()->back()->with('success', 'Relative details saved successfully!');
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
