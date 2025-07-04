<x-guest-layout>

   <section class="section pricing__v2" id="reset-password">
    <div class="container mt-5">
        <h4 class="text-center mb-4">Reset Password</h4>

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

            <div class="card p-4 rounded-4">

                <!-- Form -->
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Hidden Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <x-text-input id="email" type="email"
                                      class="form-control @error('email') is-invalid @enderror"
                                      name="email"
                                      :value="old('email', $request->email)" required autofocus />
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <x-text-input id="password" type="password"
                                      class="form-control @error('password') is-invalid @enderror"
                                      name="password" required autocomplete="new-password" />
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <x-text-input id="password_confirmation" type="password"
                                      class="form-control @error('password_confirmation') is-invalid @enderror"
                                      name="password_confirmation" required autocomplete="new-password" />
                        @error('password_confirmation')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <x-primary-button label="Reset Password"/>

                    </div>

                </form>
            </div>

    </div>
</section>


</x-guest-layout>


