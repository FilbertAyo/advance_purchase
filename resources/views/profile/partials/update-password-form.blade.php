<section>
   
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password"
                    class="form-control" autocomplete="current-password">
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div class="form-group col-md-6">
                <label for="password">New Password</label>
                <input type="password" id="update_password_password"  name="password"
                    class="form-control" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />

            </div>

            <div class="form-group col-md-6">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="update_password_password"
                    name="password_confirmation" class="form-control"
                    autocomplete="new-password">
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
            <div class="col-md-6">
                <p class="mb-2">Password requirements</p>
                <p class="small text-muted mb-2"> To create a new password, you have to
                    meet all of the following requirements: </p>
                <ul class="small text-muted pl-4 mb-0">
                    <li> Minimum 8 character </li>
                    <li>At least one special character</li>
                    <li>At least one number</li>
                    <li>Can’t be the same as a previous password </li>
                </ul>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Password</button>

    </form>
</section>

