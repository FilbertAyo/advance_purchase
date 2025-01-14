
<x-guest-layout>

<div  class="col-lg-3 col-md-4 col-10 mx-auto text-center card px-5 py-3" style="">
    <!-- Login Form -->
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <h1 class="h4 mb-4" style="margin-left: 30%;"> <img src="{{ asset('images/marslogo.png') }}" class="" alt="Partner Logo" style="height: 50px"></h1>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Email or Phone Number -->
        <div class="form-group">
            <x-text-input id="login" type="email" class="block mt-1 w-full @error('email') is-invalid @enderror"
                          name="email" :value="old('email')" placeholder="Email" required
                          autocomplete="email" autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" class="mt-2" />

         <!-- Submit Button -->
         <div class="flex items-center justify-end mt-4">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Email Password Reset Link</button>
        </div>


    </form>

</div>

    <!-- Partnering with Section -->
    <div class="footer-partner" style="position: absolute; bottom: 0; width: 100%; text-align: center; padding: 10px;">
        <p><strong>Advanced Purchase Agreement</strong></p>
    </div>
</x-guest-layout>
