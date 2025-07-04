@extends('layouts.custapp')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="col-md-6 col-lg-5">

            <h4 class="mb-4 text-center">2. Identification and Employment</h4>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('wizard.step2.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>ID Type</label>
                                    <select name="id_type" class="form-control" required>
                                        <option value="">-- Select ID Type --</option>
                                        <option value="driver_license">Driver's License</option>
                                        <option value="national_id">National ID</option>
                                        <option value="passport">Passport</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>ID Number</label>
                                    <input type="text" name="id_number" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>ID Attachment (optional)</label>
                                    <input type="file" name="id_attachment" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Employment Status</label>
                                    <select name="employment_status" class="form-control">
                                        <option value="">-- Select Employment --</option>
                                        <option value="Employed">Employed</option>
                                        <option value="Self-Employed">Self-Employed</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Occupation</label>
                                    <input type="text" name="occupation" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Organization</label>
                                    <input type="text" name="organization" class="form-control">
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Next</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
