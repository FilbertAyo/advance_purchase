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
    <div class="modal-dialog modal-dialog-scrollable modal-bottom-half">
        <div class="modal-content" id="termsModalContent">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('elements.terms')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styles for bottom-half modal */
    .modal-bottom-half .modal-content {
        height: 50vh;
        width: 100%; /* Already set, but good to keep */
        transition: height 0.3s ease;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        margin-top: auto;
        overflow: hidden;
    }

    .modal-bottom-half {
        display: flex;
        align-items: flex-end; /* Aligns content to the bottom */
        justify-content: center;
        height: 100%;
        margin: 0;
        /* --- ADDED FOR FULL WIDTH --- */
        max-width: 100vw !important; /* Forces full viewport width */
        margin: 0 !important; /* Removes any default horizontal margins */
        padding: 0 !important; /* Removes any default horizontal padding */
    }

    /* Styles for fullscreen behavior */
    .modal-bottom-half.fullscreen {
        /* Ensure the dialog itself also takes full height for fullscreen content */
        align-items: stretch; /* Stretch to fill full height when fullscreen */
        height: 100vh; /* Ensure dialog takes full viewport height */
    }

    .modal-bottom-half.fullscreen .modal-content {
        height: 100vh !important;
        border-radius: 0;
    }

    /* Adjust modal-body to scroll within the new height constraints */
    .modal-bottom-half .modal-body {
        flex-grow: 1; /* Allow modal body to take up available space */
        overflow-y: auto; /* Ensure scrolling */
    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('termsModal');
        const modalDialog = modal.querySelector('.modal-dialog');
        const modalContent = modal.querySelector('.modal-content');
        const modalBody = modal.querySelector('.modal-body');

        modal.addEventListener('shown.bs.modal', function () {
            modalBody.scrollTop = 0; // reset scroll

            modalBody.addEventListener('scroll', function () {
                // You might want to adjust the scroll threshold for full screen
                // Or consider using Intersection Observer for a more robust detection
                if (modalBody.scrollTop > 20) {
                    modalDialog.classList.add('fullscreen');
                } else {
                    modalDialog.classList.remove('fullscreen');
                }
            });
        });
    });
</script>


</x-guest-layout>
