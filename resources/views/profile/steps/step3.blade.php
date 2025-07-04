@extends('layouts.custapp')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="col-md-6 col-lg-5">

            <h4 class="mb-4 text-center">3. Next of Kin (Relatives)</h4>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('wizard.step3.store') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Full Name</label>
                                    <input type="text" name="relative_name" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Relationship</label>
                                    <select name="relationship" class="form-control" required>
                                        <option value="">-- Select Relationship --</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Spouse">Spouse</option>
                                        <option value="Guardian">Guardian</option>
                                        <option value="Friend">Friend</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Email (optional)</label>
                                    <input type="email" name="email" class="form-control">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Address (optional)</label>
                                    <input type="text" name="address" class="form-control">
                                </div>

                                <div class="col-12 text-end">
                                    <x-primary-button label="Finish & Submit" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
