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
                            <input type="text" name="city" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>District</label>
                            <input type="text" name="district" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Ward</label>
                            <input type="text" name="ward" class="form-control" required>
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
@endsection
