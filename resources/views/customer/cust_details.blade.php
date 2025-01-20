@extends('layouts.custapp')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">Product Details</h2>
                    </div>
                    <div class="col-auto">
                        <form class="form-inline">

                            <div class="form-group">
                                <a href="#" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#paymentModal">Account</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title mr-2">{{ $application->item_name }}</strong>
                                @if($application->outstanding > 0)
                                <span class="badge badge-danger">Pending</span>
                                @else
                                <span class="badge badge-success">Completed</span>
                                @endif
                                <span
                                    class="float-right badge badge-pill badge-success text-white">{{ $application->item_type }}</span>
                            </div>
                            <div class="card-body">

                                <dl class="row mb-0">
                                    <dt class="col-sm-2 mb-3 text-muted">Name</dt>
                                    <dd class="col-sm-4 mb-3">{{ $application->item_name }}</dd>

                                    <dt class="col-sm-2 mb-3 text-muted">Price</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <span class="bg-warning mr-2"></span> {{ $application->price }}
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Paid Amount</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <span class="dot dot-md bg-success mr-2"></span> {{ $application->paid_amount }}
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Total Outstanding</dt>
                                    <dd class="col-sm-4 mb-3 text-danger">{{ $application->outstanding }}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Last Update</dt>
                                    <dd class="col-sm-4 mb-3">{{ $application->updated_at }}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">As of Date</dt>
                                    <dd class="col-sm-4 mb-3">{{ $application->created_at }}</dd>

                                </dl>


                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div> <!-- .col-md -->

                </div> <!-- .col-md -->

            </div> <!-- .row-->
        </div> <!-- .col-12 -->
    </div> <!-- .row -->

    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title text-white" id="paymentModalLabel">Payment Details</h5>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                @foreach ($banks as $bank)
                                <p><strong>Bank Name:</strong>{{ $bank->bank_name }}</p>
                                <p><strong>Account Number:</strong>{{ $bank->account_no }}</p>
                                <p><strong>Account Name:</strong> {{ $bank->account_name }}</p>
                                <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
