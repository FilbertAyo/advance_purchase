<x-guest-layout>

    <div  class="col-lg-3 col-md-4 col-10 mx-auto card px-5 py-3">

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <h1 class="h4 mb-4" style="margin-left: 30%;"> <img src="{{ asset('images/marslogo.png') }}" class="" alt="Partner Logo" style="height: 50px"></h1>
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
        </div>
    </form>

</div>

      <!-- Partnering with Section -->
      <div class="footer-partner" style="position: absolute; bottom: 0; width: 100%; text-align: center; padding: 10px;">
        <p><strong>Advanced Purchase Agreement</strong></p>
    </div>
    
</x-guest-layout>


