<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('address.index') }}"
                                    >Banks</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-sm">
                            <i class="fe fe-16 fe-printer text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-sm">
                            <i class="fe fe-16 fe-file text-muted"></i>
                        </button>
                        <button type="button" class="btn btn-sm" onclick="reloadPage()">
                            <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                        </button>

                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="mb-0 page-title">Bank Account</h4>
                    </div>

                    <div class="col-auto">
                        <div class="form-group">
                            @if(Auth::user()->userType == 1 || Auth::user()->userType == 2)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCityModal">
                                Add Account<span
                                class="fe fe-plus fe-16 ml-2"></span>
                            </button>
                                @else
                                    <button  class="btn mb-2 btn-primary permission-alert" > Add Account <span
                                        class="fe fe-plus fe-16 ml-2"></span></button>
                                @endif
                        </div>

                    </div>
                </div>

                @include('elements.spinner')

                <div class="row my-2">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Account Number</th>
                                            <th>Account Name</th>
                                            <th>Bank</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($banks->count() > 0)
                                            @foreach ($banks as $index => $bank)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $bank->account_no }}</td>
                                                    <td>{{ $bank->account_name }}</td>
                                                    <td>{{ $bank->bank_name }}</td>
                                                    <td> @if ($bank->status == 'Active')
                                                        <span class="badge badge-success">{{ $bank->status }}</span>
                                                        @else
                                                        <span class="badge badge-secondary">{{ $bank->status }}</span>
                                                    @endif </td>
                                                    <td>
                                                        <div style="display: flex; gap: 2px;">
                                                            @if ($bank->status == 'Active')
                                                            <form id="deleteForm-{{ $bank->id }}"
                                                            action="{{ route('bank.disable', $bank->id) }}"
                                                                method="POST"
                                                                >
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" onclick="showSweetAlert(event, '{{ $bank->id }}')"
                                                                    class="btn btn-sm btn-danger">
                                                                    <span class="fe fe-trash-2 fe-16"></span> Disable
                                                                </button>
                                                            </form>
                                                            @else
                                                            <button type="submit" onclick="showSweetAlert(event, '{{ $bank->id }}')"
                                                                class="btn btn-sm btn-danger" disabled>
                                                                <span class="fe fe-trash-2 fe-16"></span> Disable
                                                            </button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9" class="text-center">No Account found</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->

                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div>

    <div class="modal fade" id="addCityModal" tabindex="-1" role="dialog" aria-labelledby="addCityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCityModalLabel">Add New City</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{ url('/bank_store') }}" enctype="multipart/form-data" novalidate>
                        @csrf

                        <!-- Bank Name Dropdown -->
                        <div class="form-group">
                            <label for="bankName">Bank Name</label>
                            <select class="form-control" id="bankName" name="bank_name" required>
                                <option value="">Select Bank</option>
                                <option value="CRDB">CRDB</option>
                                <option value="NMB">NMB</option>
                                <option value="NBC">NBC</option>
                                <option value="ABSA">ABSA</option>
                            </select>
                            <div class="invalid-feedback">Please select a bank name.</div>
                        </div>

                        <!-- Account Number Input -->
                        <div class="form-group">
                            <label for="accountNo">Account Number</label>
                            <input type="text" class="form-control" id="accountNo" name="account_no" required>
                            <div class="invalid-feedback">Please provide a valid account number.</div>
                        </div>

                        <!-- Account Name Input -->
                        <div class="form-group">
                            <label for="accountName">Account Name</label>
                            <input type="text" class="form-control" id="accountName" name="account_name" required>
                            <div class="invalid-feedback">Please provide a valid account name.</div>
                        </div>



                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
