<x-guest-layout>


    <section class="section pricing__v2" id="pricing">
        <div class="container mt-5">
            <h4 class="text-center mb-4">Sign Up</h4>

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
                <form method="POST" action="{{ route('registration.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="mb-2" for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control"
                                value="{{ old('first_name', $formData['first_name'] ?? '') }}" required>
                            @error('first_name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="mb-2" for="middle_name">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control"
                                value="{{ old('middle_name', $formData['middle_name'] ?? '') }}">
                            @error('middle_name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="mb-2" for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                value="{{ old('last_name', $formData['last_name'] ?? '') }}" required>
                            @error('last_name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="mb-2" for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                                required placeholder="e.g. 07XXXXXXXX">
                            @error('phone')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="mb-2" for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                required>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="mb-2" for="password">Password</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="mb-2" for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="col-12 mb-3">
                            <x-primary-button label="Register" class="w-100" />
                        </div>

                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" id="termsCheckbox" name="terms"
                                {{ old('terms') ? 'checked' : '' }} required>
                            <label class="form-check-label" for="termsCheckbox">
                                By checking this box, you confirm that you have read, understood, and agreed to
                                our
                                <a href="#" class="text-dark text-decoration-underline" data-bs-toggle="modal"
                                    data-bs-target="#termsModal">
                                    Terms & Conditions
                                </a>. You acknowledge that compliance with our guidelines ensures a smooth and
                                secure experience for all users.
                            </label>
                        </div>

                        <div class="col-12 text-center mt-3">
                            <p class="mb-0">Already registered?
                                <a href="{{ route('login') }}" class="text-primary">Login here</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @include('elements.terms')
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
