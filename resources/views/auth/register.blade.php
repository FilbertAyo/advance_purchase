<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mars communications ltd</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="front-end/front-end/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="front-end/lib/animate/animate.min.css" rel="stylesheet">
    <link href="front-end/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="front-end/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="front-end/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="front-end/css/style.css" rel="stylesheet">
</head>

<body>
    @include('layouts.front-nav')

    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(front-end/img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 ">@lang('messages.application_form')</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="#" class="text-danger">@lang('messages.home')</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@lang('messages.application_form')</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('elements.spinner')
                <div class="bg-light d-flex flex-column  p-5 wow">
                    <h1 class="text-primary mb-4 text-center">@lang('messages.enter_details')</h1>

                    <form method="POST" action="{{ url('/registration_form') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <!-- Personal Information -->
                            <div class="col-12">
                                <h4>@lang('messages.personal_information')</h4>
                            </div>
                            <!-- First Name -->
                            <div class="col-12 col-sm-6">
                                <input type="text" name="first_name" class="form-control border-0"
                                    placeholder="@lang('messages.first_name')" value="{{ old('first_name') }}"
                                    style="height: 55px;" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" name="middle_name" class="form-control border-0"
                                    placeholder="@lang('messages.middle_name')" value="{{ old('middle_name') }}"
                                    style="height: 55px;">
                            </div>
                            <!-- Last Name -->
                            <div class="col-12 col-sm-6">
                                <input type="text" name="last_name" class="form-control border-0"
                                    placeholder="@lang('messages.last_name')" value="{{ old('last_name') }}" style="height: 55px;"
                                    required>
                            </div>
                            <!-- Phone -->
                            <div class="col-12 col-sm-6">
                                <input type="tel" name="phone" class="form-control border-0"
                                    placeholder="@lang('messages.phone_number')" value="{{ old('phone') }}" style="height: 55px;"
                                    required>
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                            <!-- Email -->
                            <div class="col-12 col-sm-6">
                                <input type="email" name="email" class="form-control border-0"
                                    placeholder="@lang('messages.email')" value="{{ old('email') }}" style="height: 55px;">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Address Details -->
                            <div class="col-12">
                                <h4>@lang('messages.address_details')</h4>
                            </div>
                            <!-- City -->
                            <div class="col-12 col-sm-6">
                                <select name="city" class="form-select border-0" style="height: 55px;" required>
                                    <option value="">--@lang('messages.select_city')--</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- District -->
                            <div class="col-12 col-sm-6">
                                <select name="district" class="form-select border-0" style="height: 55px;" required>
                                    <option value="">--@lang('messages.select_district')--</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->region_name }}">{{ $district->region_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Ward -->
                            <div class="col-12 col-sm-6">
                                <select name="ward" class="form-select border-0" style="height: 55px;" required>
                                    <option value="">--@lang('messages.select_ward')--</option>
                                    @foreach ($wards as $ward)
                                        <option value="{{ $ward->ward_name }}">{{ $ward->ward_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Street -->
                            <div class="col-12 col-sm-6">
                                <input type="text" name="street" class="form-control border-0"
                                    value="{{ old('street') }}" placeholder="@lang('messages.street')"
                                    style="height: 55px;">
                            </div>

                            <!-- Additional Details -->
                            <div class="col-12">
                                <h4>@lang('messages.additional_details')</h4>
                            </div>
                            <!-- Gender -->
                            <div class="col-12 col-sm-6">
                                <select name="gender" class="form-select border-0" value="{{ old('gender') }}"
                                    style="height: 55px;" required>
                                    <option selected>--@lang('messages.select_gender')--</option>
                                    <option value="male">@lang('messages.male')</option>
                                    <option value="female">@lang('messages.female')</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6" id="birth_date">
                                <input type="text" name="birth_date" id="birth_date_input"
                                    class="form-control border-0" style="height: 55px;"
                                    placeholder="@lang('messages.date_of_birth')" onfocus="this.type='date'"
                                    onblur="if(!this.value) this.type='text'">
                            </div>

                            <!-- ID Selection -->
                            <div class="col-12 col-sm-6">
                                <select name="id_type" class="form-select border-0" id="idTypeSelect"
                                    style="height: 55px;">
                                    <option selected value="">--@lang('messages.select_id_type')--</option>
                                    <option value="driver_license">@lang('messages.driver')</option>
                                    <option value="national_id">@lang('messages.national_id')</option>
                                    <option value="passport">@lang('messages.passport')</option>
                                </select>
                            </div>

                            <!-- Dynamic ID Inputs -->
                            <div class="col-12 col-sm-6" id="idNumberField" style="display: none;">
                                <input type="text" name="id_number" class="form-control border-0"
                                    placeholder="@lang('messages.id_number')" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6" id="idAttachmentField" style="display: none;">
                                <input type="file" name="id_attachment" class="form-control border-0"
                                    style="height: 55px;">
                            </div>

                            <!-- Employment Status -->
                            <div class="col-12 col-sm-6">
                                <select name="employment_status" class="form-select border-0"
                                    id="employmentStatusSelect" style="height: 55px;">
                                    <option selected value="">--@lang('messages.select_employment_status')--</option>
                                    <option value="Employed">@lang('messages.employed')</option>
                                    <option value="Self-Employed">@lang('messages.self_employed')</option>
                                    {{-- <option value="Unemployed">@lang('messages.unemployed')</option> --}}
                                </select>
                            </div>
                            <!-- Dynamic Employment Inputs -->
                            <div class="col-12 col-sm-6" id="occupationField" style="display: none;">
                                <input type="text" name="occupation" class="form-control border-0"
                                    placeholder="@lang('messages.occupation')" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6" id="organizationField" style="display: none;">
                                <input type="text" name="organization" class="form-control border-0"
                                    placeholder="@lang('messages.organization')" style="height: 55px;">
                            </div>

                            <div class="col-12 col-sm-6 position-relative">
                                <input type="password" id="password" name="password" class="form-control border-0"
                                    value="{{ old('password') }}" placeholder="@lang('messages.password')"
                                    style="height: 55px;">
                                <span class="position-absolute top-50 end-0 translate-middle-y pe-3"
                                    style="cursor: pointer;"
                                    onclick="togglePasswordVisibility('password', 'password-toggle')">
                                    <i id="password-toggle" class="fa fa-eye"></i>
                                </span>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="col-12 col-sm-6 position-relative">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control border-0" placeholder="@lang('messages.repeat_your_password')"
                                    style="height: 55px;">
                                <span class="position-absolute top-50 end-0 translate-middle-y pe-3"
                                    style="cursor: pointer;"
                                    onclick="togglePasswordVisibility('password_confirmation', 'password-confirmation-toggle')">
                                    <i id="password-confirmation-toggle" class="fa fa-eye"></i>
                                </span>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                            <div class="form-row" style="display: none;">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="userType" value="0"
                                        required>
                                    <input type="text" class="form-control" name="status" value="inactive"
                                        required>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 mt-4">
                                <button class="btn bg-primary w-100 py-3 text-white"
                                    type="submit">@lang('messages.submit')</button>
                            </div>

                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="termsCheckbox" required>
                                <label class="form-check-label" for="termsCheckbox">
                                    By checking this box, you confirm that you have read, understood, and agreed to our
                                    <a href="#" class="text-dark text-decoration-underline" data-bs-toggle="modal" data-bs-target="#termsModal">
                                        Terms & Conditions
                                    </a>.  You acknowledge that compliance with our guidelines ensures a smooth and secure experience for all users.
                                </label>
                            </div>

                        </div>
                    </form>

                    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Welcome to our platform. By accessing or using our services, you agree to be bound by the following terms:</p>
                                    <ul>
                                        <li><strong>Account Responsibility:</strong> You are responsible for maintaining the confidentiality of your account and password.</li>
                                        <li><strong>Prohibited Activities:</strong> You may not use our services for any illegal or unauthorized purposes.</li>
                                        <li><strong>Service Modifications:</strong> We reserve the right to modify or discontinue any part of our services at any time.</li>
                                        <li><strong>Liability Disclaimer:</strong> We are not liable for any direct, indirect, incidental, or consequential damages resulting from the use of our services.</li>
                                    </ul>
                                    <p>Please ensure you review these terms carefully before proceeding.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.getElementById('idTypeSelect').addEventListener('change', function() {
                            const idNumberField = document.getElementById('idNumberField');
                            const idAttachmentField = document.getElementById('idAttachmentField');
                            if (this.value) {
                                idNumberField.style.display = 'block';
                                idAttachmentField.style.display = 'block';
                            } else {
                                idNumberField.style.display = 'none';
                                idAttachmentField.style.display = 'none';
                            }
                        });

                        document.getElementById('employmentStatusSelect').addEventListener('change', function() {
                            const occupationField = document.getElementById('occupationField');
                            const organizationField = document.getElementById('organizationField');
                            if (this.value === 'Self-Employed') {
                                occupationField.style.display = 'block';
                                organizationField.style.display = 'none';
                            } else if (this.value === 'Employed') {
                                organizationField.style.display = 'block';
                                occupationField.style.display = 'block';
                            } else {
                                occupationField.style.display = 'none';
                                organizationField.style.display = 'none';
                            }
                        });
                    </script>


                </div>
            </div>
        </div>
    </div>

    @include('elements.footer')


    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script>
        function togglePasswordVisibility(inputId, toggleIconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(toggleIconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="front-end/lib/wow/wow.min.js"></script>
    <script src="front-end/lib/easing/easing.min.js"></script>
    <script src="front-end/lib/waypoints/waypoints.min.js"></script>
    <script src="front-end/lib/counterup/counterup.min.js"></script>
    <script src="front-end/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="front-end/lib/tempusdominus/js/moment.min.js"></script>
    <script src="front-end/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="front-end/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="front-end/js/main.js"></script>
</body>

</html>
