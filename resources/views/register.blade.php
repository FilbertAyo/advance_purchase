<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mars - Application form</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="front-end/images/favicon.ico" rel="icon">

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

    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(images/carousel-bg-2.jpg);">
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
            <div class="bg-light col-lg-12">
                @include('elements.spinner')
                <div class="d-flex flex-column  p-3 wow">
                    <h1 class="text-primary mb-4 text-center">@lang('messages.enter_details')</h1>

                    <form method="POST" action="{{ route('registration.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">


                            <!-- Address Details -->
                            <div class="col-12">
                                <h4>@lang('messages.address_details')</h4>
                            </div>
                            <!-- City -->
                            <!-- City -->
                            <div class="col-12 col-sm-6">
                                <select name="city" id="city" class="form-select border-0" style="height: 55px;"
                                    required>
                                    <option value="">--@lang('messages.select_city')--</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->city_name }}" data-id="{{ $city->id }}">
                                            {{ $city->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- District -->
                            <div class="col-12 col-sm-6">
                                <select name="district" id="district" class="form-select border-0"
                                    style="height: 55px;" required>
                                    <option value="">--@lang('messages.select_district')--</option>
                                </select>
                            </div>

                            <!-- Ward -->
                            <div class="col-12 col-sm-6">
                                <select name="ward" id="ward" class="form-select border-0"
                                    style="height: 55px;" required>
                                    <option value="">--@lang('messages.select_ward')--</option>
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
                            <div class="col-12 col-sm-6">
                                <select name="gender" class="form-select border-0" style="height: 55px;" required>
                                    <option value="" disabled {{ old('gender') == '' ? 'selected' : '' }}>
                                        --@lang('messages.select_gender')--</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                        @lang('messages.male')</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                        @lang('messages.female')</option>
                                </select>
                            </div>

                            <div class="col-12 col-sm-6" id="birth_date">
                                <input type="text" name="birth_date" id="birth_date_input"
                                    class="form-control border-0" style="height: 55px;"
                                    placeholder="@lang('messages.date_of_birth')" value="{{ old('birth_date') }}"
                                    onfocus="this.type='date'" onblur="if(!this.value) this.type='text'">
                            </div>


                            <div class="col-12 col-sm-6">
                                <select name="id_type" class="form-select border-0" id="idTypeSelect"
                                    style="height: 55px;">
                                    <option value="" {{ old('id_type') == '' ? 'selected' : '' }}>
                                        --@lang('messages.select_id_type')--
                                    </option>
                                    <option value="driver_license"
                                        {{ old('id_type') == 'driver_license' ? 'selected' : '' }}>
                                        @lang('messages.driver')
                                    </option>
                                    <option value="national_id"
                                        {{ old('id_type') == 'national_id' ? 'selected' : '' }}>
                                        @lang('messages.national_id')
                                    </option>
                                    <option value="passport" {{ old('id_type') == 'passport' ? 'selected' : '' }}>
                                        @lang('messages.passport')
                                    </option>
                                </select>
                            </div>

                            <!-- Dynamic ID Inputs -->
                            <div class="col-12 col-sm-6" id="idNumberField" style="display: none;">
                                <input type="text" name="id_number" class="form-control border-0"
                                    placeholder="@lang('messages.id_number')" style="height: 55px;"
                                    value="{{ old('id_number') }}">
                            </div>
                            <div class="col-12 col-sm-6" id="idAttachmentField" style="display: none;">
                                <input type="file" name="id_attachment" class="form-control border-0"
                                    style="height: 55px;">
                            </div>

                            <div class="col-12 col-sm-6">
                                <select name="employment_status" class="form-select border-0"
                                    id="employmentStatusSelect" style="height: 55px;">
                                    <option value="" {{ old('employment_status') == '' ? 'selected' : '' }}>
                                        --@lang('messages.select_employment_status')--
                                    </option>
                                    <option value="Employed"
                                        {{ old('employment_status') == 'Employed' ? 'selected' : '' }}>
                                        @lang('messages.employed')
                                    </option>
                                    <option value="Self-Employed"
                                        {{ old('employment_status') == 'Self-Employed' ? 'selected' : '' }}>
                                        @lang('messages.self_employed')
                                    </option>
                                </select>
                            </div>

                            <!-- Dynamic Employment Inputs -->
                            <div class="col-12 col-sm-6" id="occupationField" style="display: none;">
                                <input type="text" name="occupation" class="form-control border-0"
                                    placeholder="@lang('messages.occupation')" style="height: 55px;"
                                    value="{{ old('occupation') }}">
                            </div>
                            <div class="col-12 col-sm-6" id="organizationField" style="display: none;">
                                <input type="text" name="organization" class="form-control border-0"
                                    placeholder="@lang('messages.organization')" style="height: 55px;"
                                    value="{{ old('organization') }}">
                            </div>





                        </div>
                    </form>

                    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                @include('elements.terms')
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('elements.footer')


    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const idTypeSelect = document.getElementById('idTypeSelect');
            const idNumberField = document.getElementById('idNumberField');
            const idAttachmentField = document.getElementById('idAttachmentField');

            // Function to toggle fields based on selected ID type
            function toggleIdFields() {
                const selectedValue = idTypeSelect.value;
                if (selectedValue) {
                    idNumberField.style.display = 'block';
                    idAttachmentField.style.display = 'block';
                } else {
                    idNumberField.style.display = 'none';
                    idAttachmentField.style.display = 'none';
                }
            }

            toggleIdFields();
            idTypeSelect.addEventListener('change', toggleIdFields);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const employmentStatusSelect = document.getElementById('employmentStatusSelect');
            const occupationField = document.getElementById('occupationField');
            const organizationField = document.getElementById('organizationField');

            function toggleEmploymentFields() {
                const selectedValue = employmentStatusSelect.value;
                if (selectedValue === 'Self-Employed') {
                    occupationField.style.display = 'block';
                    organizationField.style.display = 'none';
                } else if (selectedValue === 'Employed') {
                    organizationField.style.display = 'block';
                    occupationField.style.display = 'block';
                } else {
                    occupationField.style.display = 'none';
                    organizationField.style.display = 'none';
                }
            }

            toggleEmploymentFields();
            employmentStatusSelect.addEventListener('change', toggleEmploymentFields);
        });
    </script>



    <script>
        $('#city').on('change', function() {
            var cityId = $('#city option:selected').data('id');
            if (cityId) {
                $.ajax({
                    url: '/get-districts/' + cityId,
                    type: 'GET',
                    success: function(data) {
                        $('#district').empty().append(
                            '<option value="">-- Select District --</option>');
                        $('#ward').empty().append('<option value="">-- Select Ward --</option>');
                        $.each(data, function(key, district) {
                            $('#district').append(
                                '<option value="' + district.district_name + '" data-id="' +
                                district.id + '">' + district.district_name + '</option>'
                            );
                        });
                    }
                });
            }
        });

        $('#district').on('change', function() {
            var districtId = $('#district option:selected').data('id');
            if (districtId) {
                $.ajax({
                    url: '/get-wards/' + districtId,
                    type: 'GET',
                    success: function(data) {
                        $('#ward').empty().append('<option value="">-- Select Ward --</option>');
                        $.each(data, function(key, ward) {
                            $('#ward').append(
                                '<option value="' + ward.ward_name + '" data-id="' + ward
                                .id + '">' + ward.ward_name + '</option>'
                            );
                        });
                    }
                });
            }
        });
    </script>


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
