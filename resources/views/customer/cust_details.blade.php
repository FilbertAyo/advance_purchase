@extends('layouts.custapp')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">Installment Details</h2>
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

                        @if ($application->refund_amount != null && $application->status == 'active')
                            <div class="alert alert-danger d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="spinner-border mr-3 text-danger" role="status">
                                    </div>
                                    Refund Amount: TZS {{ number_format($application->refund_amount) }} — Request is waiting for
                                    verification...
                                </div>
                                <form action="{{ route('refund.cancel', $application->id) }}" method="POST" style="margin: 0;" onsubmit="return confirmCancel();">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                </form>

                                <script>
                                    function confirmCancel() {
                                        return confirm("Are you sure you want to cancel the refund request?");
                                    }
                                </script>

                            </div>

                            @elseif ($application->refund_amount != null && $application->status == 'refunded')
                            <div class="alert alert-success d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><i class="fe fe-check-circle"></i> Completed:</strong>
                                    This refund of <strong>TZS {{ number_format($application->refund_amount) }}</strong> has already been approved and the application is considered Refunded.
                                </div>
                            </div>

                        @endif


                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title mr-2">{{ $application->item_name }}</strong>
                                @if ($application->status == 'inactive')
                                <strong class="badge badge-danger p-1">Pending</strong>
                            @elseif ($application->status == 'refunded')
                                <strong class="badge badge-secondary p-1">Refunded</strong>
                            @else
                                @if ($application->outstanding == 0)
                                    <strong class="badge badge-success p-1 text-white">Complete</strong>
                                @else
                                    <strong class="badge badge-info p-1">Ongoing</strong>
                                @endif

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
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <h2 class="h5 page-title">Paid Statements</h2>
                            </div>
                            @if ($application->refund_amount == null && $application->paid_amount > 0)
                                <div class="col-auto">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#refundModal">Refund</a>
                                        </div>
                                    </form>
                                </div>
                            @endif

                        </div>

                        <div class="card  mb-4 p-3">
                            <table class="table table-bordered table-hover mb-0 table-sm">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Amount (TZS)</th>
                                        <th>Date Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($statements->count())
                                        @php $no = 1; @endphp
                                        @foreach ($statements as $statement)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $statement->added_amount }}</td>
                                                <td>{{ optional($statement->application)->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="alert alert-danger">
                                            <td colspan="3" class="text-center">No statements found</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <h2 class="h5 page-title">Payment Screenshot</h2>
                            </div>
                            <div class="col-auto">
                                <form class="form-inline">

                                    <div class="form-group">
                                        <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#screenshot">Screenshot</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <strong>Note:</strong> Please ensure that you have made the payment before uploading the
                            screenshot.
                        </div>

                        <div class="card shadow mb-4 p-3">
                            <table class="table table-bordered table-hover mb-0 table-sm bg" id="statementsTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Date Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($screenshots->count())
                                        @php $no = 1; @endphp
                                        @foreach ($screenshots as $screen)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td><img src="{{ asset($screen->screenshot) }}" alt=""
                                                        style="height: 30px;"></td>
                                                <td>{{ $screen->created_at }}</td>
                                                <td>
                                                    <a href="{{ asset($screen->screenshot) }}" target="_blank"
                                                        class="btn btn-sm btn-primary">
                                                        <span class="fe fe-eye fe-16"></span></a>
                                                    <form action="{{ route('screenshot.destroy', $screen->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this screenshot?');">
                                                            <span class="fe fe-trash-2 fe-16"></span>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="alert alert-danger">
                                            <td colspan="4" class="text-center">No Screenshot found</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

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

    <div class="modal fade" id="screenshot" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content px-3">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Screenshot</h5>
                </div>

                <!-- Form Start -->
                <form action="{{ route('screenshot.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $application->id }}" name="application_id">

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <input type="file" class="form-control" id="arrivalStock" name="screenshot" required>
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="refundModal" tabindex="-1" aria-labelledby="refundModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('refund.request', $application->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><strong class="text-danger">Refund Amount: </strong> TZS {{ number_format($application->paid_amount *0.7) }}</h5>
                    </div>
                    <div class="modal-body">

                        <p>Are you sure you want to request a refund for these payments?</p>
                        <div id="reasonInput" style="display: none;">
                            <label for="refundReason" class="form-label">Reason for refund</label>
                            <textarea id="refundReason" name="reason" class="form-control" rows="3" placeholder="*Optional"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" id="yesRefundBtn">Yes</button>
                        <button type="submit" class="btn btn-success" id="RefundBtn"
                            style="display: none;">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('yesRefundBtn').addEventListener('click', function() {
            document.getElementById('reasonInput').style.display = 'block';
            document.getElementById('RefundBtn').style.display = 'inline-block';
            this.style.display = 'none';
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
