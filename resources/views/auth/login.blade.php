<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


<div  class="col-lg-3 col-md-4 col-10 mx-auto text-center card px-5 py-3" style="">
    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h1 class="h4 mb-4" style="margin-left: 30%;"> <img src="{{ asset('images/marslogo.png') }}" class="" alt="Partner Logo" style="height: 50px"></h1>

        <!-- Email or Phone Number -->
        <div class="form-group">
            <x-text-input id="login" type="text" class="block mt-1 w-full @error('login') is-invalid @enderror"
                          name="login" value="{{ old('login') }}" placeholder="Email or Phone Number" required
                          autocomplete="login" autofocus />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                          placeholder="Password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

         <!-- Submit Button -->
         <div class="flex items-center justify-end mt-4">
            <x-primary-button label="Login" class="w-100" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif

        </div>
    </form>

</div>

    <!-- Partnering with Section -->
    <div class="footer-partner" style="position: absolute; bottom: 0; width: 100%; text-align: center; padding: 10px;">
        <p><strong>Advanced Purchase Agreement</strong></p>
    </div>
</x-guest-layout>
