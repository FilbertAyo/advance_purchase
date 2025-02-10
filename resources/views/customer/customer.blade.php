@extends('layouts.custapp')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">Welcome {{ Auth::user()->first_name }}!</h2>
                    </div>
                    <div class="col-auto">
                        <form class="form-inline">

                            <div class="form-group">
                                <button type="button" class="btn btn-sm" onclick="reloadPage()">
                                    <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


                @if ($relative->isEmpty())

                    <div id="relativeModal" class="modal" tabindex="-1" role="dialog"
                        aria-labelledby="relativeModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="relativeModalLabel">Complete Your Profile</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>You haven't filled in your relative details yet. Complete them to continue?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Finish Now</a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Delay the modal opening for 5 seconds
                        setTimeout(function() {
                            $('#relativeModal').modal('show');
                        }, 5000);

                    </script>
                @endif


                <div class="row">
                    <!-- Recent orders -->
                    <div class="col-12">
                        <div class="card shadow eq-card">
                            <div class="card-header">
                                <strong class="card-title">My Products</strong>
                                <a class="float-right small text-muted" href="#!">View all</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-bordered table-striped mt-n3 mb-n1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Product</th>
                                            <th>Paid</th>
                                            <th>Outstanding</th>
                                            <th>Date issued</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($applications->count() > 0)
                                            @foreach ($applications as $index => $application)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $application->item_name }}<br /><span
                                                            class="small text-muted">{{ $application->price }}</span></td>
                                                    <td><span class="text-success">{{ $application->paid_amount }}</span>
                                                    </td>
                                                    <td><span class="text-danger">{{ $application->outstanding }}</span>
                                                    </td>
                                                    <td>{{ $application->created_at }}</td>
                                                    <td>

                                                        @if ($application->outstanding > 0)
                                                            <span class="dot dot-lg bg-danger mr-2"></span>Pending
                                                        @else
                                                            <span class="dot dot-lg bg-success mr-2"></span>Complete
                                                        @endif
                                                    </td>
                                                    <td><a href="{{ url('/details', $application->id) }}"
                                                            class="btn btn-primary mr-2 btn-sm">View</a></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9" class="text-center">No Application found</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div> <!-- .card-body -->
                        </div> <!-- .card -->
                    </div> <!-- / .col-md-8 -->
                    <!-- Recent Activity -->

                </div> <!-- end section -->


            </div> <!-- .row-->
        </div> <!-- .col-12 -->
    </div> <!-- .row -->


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
