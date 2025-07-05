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
                                    {{-- ADDED ID HERE --}}
                                    <select name="id_type" class="form-control" id="idTypeSelect">
                                        <option value="" {{ old('id_type') == '' ? 'selected' : '' }}>
                                            --@lang('messages.select_id_type')--
                                        </option>
                                        <option value="driver_license"
                                            {{ old('id_type') == 'driver_license' ? 'selected' : '' }}>
                                            @lang('messages.driver')
                                        </option>
                                        <option value="national_id" {{ old('id_type') == 'national_id' ? 'selected' : '' }}>
                                            @lang('messages.national_id')
                                        </option>
                                        <option value="passport" {{ old('id_type') == 'passport' ? 'selected' : '' }}>
                                            @lang('messages.passport')
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6" id="idNumberField" style="display: none;">
                                    <label>ID Number</label>
                                    <input type="text" name="id_number" class="form-control"
                                        placeholder="@lang('messages.id_number')" value="{{ old('id_number') }}">
                                </div>

                                <div class="col-md-6" id="idAttachmentField" style="display: none;">
                                    <label>ID Attachment (optional)</label>
                                    <input type="file" name="id_attachment" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Employment Status</label>
                                    {{-- This ID was already correct --}}
                                    <select name="employment_status" class="form-control" id="employmentStatusSelect">
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

                                <div class="col-md-6" id="occupationField" style="display: none;">
                                    <label>Occupation</label>
                                    <input type="text" name="occupation" class="form-control"
                                        placeholder="@lang('messages.occupation')" value="{{ old('occupation') }}">
                                </div>


                                <div class="col-md-6" id="organizationField" style="display: none;">
                                    <label>Organization</label>
                                    <input type="text" name="organization" class="form-control"
                                        placeholder="@lang('messages.organization')" value="{{ old('organization') }}">
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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const idTypeSelect = document.getElementById('idTypeSelect');
            const idNumberField = document.getElementById('idNumberField');
            const idAttachmentField = document.getElementById('idAttachmentField');

            const employmentStatusSelect = document.getElementById('employmentStatusSelect');
            const occupationField = document.getElementById('occupationField');
            const organizationField = document.getElementById('organizationField');

            function toggleIdFields() {
                // Ensure idTypeSelect is not null before accessing its value
                if (idTypeSelect) {
                    const selectedValue = idTypeSelect.value;
                    if (selectedValue) { // Checks if a value is selected (not the empty option)
                        idNumberField.style.display = 'block';
                        idAttachmentField.style.display = 'block';
                    } else {
                        idNumberField.style.display = 'none';
                        idAttachmentField.style.display = 'none';
                    }
                }
            }

            function toggleEmploymentFields() {
                // Ensure employmentStatusSelect is not null before accessing its value
                if (employmentStatusSelect) {
                    const selectedValue = employmentStatusSelect.value;
                    if (selectedValue === 'Self-Employed') {
                        occupationField.style.display = 'block';
                        organizationField.style.display = 'none';
                    } else if (selectedValue === 'Employed') {
                        occupationField.style.display = 'block';
                        organizationField.style.display = 'block';
                    } else { // Handles the default empty option and any other unhandled values
                        occupationField.style.display = 'none';
                        organizationField.style.display = 'none';
                    }
                }
            }

            // Run once on page load to handle initial state (e.g., if old() values are present)
            // Only attach event listeners if the elements are found
            if (idTypeSelect) {
                toggleIdFields(); // Initial run for ID fields
                idTypeSelect.addEventListener('change', toggleIdFields);
            }

            if (employmentStatusSelect) {
                toggleEmploymentFields(); // Initial run for Employment fields
                employmentStatusSelect.addEventListener('change', toggleEmploymentFields);
            }
        });
    </script>

@endsection
