<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="col-lg-3 col-md-4 col-10 mx-auto text-center">
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

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
        </div>
    </form>

    <!-- Partnering with Section -->
    <div class="footer-partner" style="position: absolute; bottom: 0; width: 100%; text-align: center; padding: 10px;">
        <p><strong>Advanced Purchase Agreement</strong></p>


    </div>
</x-guest-layout>
