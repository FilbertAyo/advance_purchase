<x-guest-layout>
   
    <section class="section pricing__v2" id="pricing">
        <div class="container mt-5">
            <h4 class="text-center mb-4">Sign in</h4>

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
                <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <!-- Login Field -->
                        <div class="col-md-12 mb-3">
                            <label for="login" class="form-label">Email or Phone Number</label>
                            <input type="text" name="login" class="form-control" value="{{ old('login') }}">
                            @error('login')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="col-md-12 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Forgot Password -->
                        <div class="col-12 mb-3 text-end">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm text-gray-600 hover:text-gray-900">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 mb-3">
                            <x-primary-button label="Login" class="w-100" />
                        </div>

                        <!-- Register Link -->
                        <div class="col-12 text-center mt-3">
                            <p class="mb-0">Don't have an account?
                                <a href="{{ route('register') }}" class="text-primary">Register here</a>
                            </p>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>



</x-guest-layout>
