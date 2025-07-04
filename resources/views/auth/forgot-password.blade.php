
<x-guest-layout>

<section class="section pricing__v2" id="pricing">
    <div class="container mt-5">
        <h4 class="text-center mb-4">Forgot Password</h4>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="p-5 rounded-4 price-table h-100">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Description Text -->
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <x-text-input id="email" type="email"
                                  class="form-control @error('email') is-invalid @enderror"
                                  name="email" :value="old('email')" required autofocus />
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-12 mb-3">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>

                <!-- Back to Login -->
                <div class="col-12 text-center mt-3">
                    <p class="mb-0">
                        Remember your password? <a href="{{ route('login') }}" class="text-primary">Back to login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>


</x-guest-layout>
