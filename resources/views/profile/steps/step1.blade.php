@extends('layouts.custapp')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="col-md-6 col-lg-5">

            <h4 class="mb-4 text-center">1. Personal Information</h4>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('wizard.step1.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label>City</label>
                            <select name="city" id="city" class="form-control" required>
                                <option value="">--@lang('messages.select_city')--</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->city_name }}" data-id="{{ $city->id }}">
                                        {{ $city->city_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>District</label>
                            <select name="district" id="district" class="form-control" required>
                                <option value="">--@lang('messages.select_district')--</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Ward</label>
                            <select name="ward" id="ward" class="form-control" required>
                                <option value="">--@lang('messages.select_ward')--</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Street</label>
                            <input type="text" name="street" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="">-- Select Gender --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Date of Birth</label>
                            <input type="date" name="birth_date" class="form-control" required>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Next</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>



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

@endsection
