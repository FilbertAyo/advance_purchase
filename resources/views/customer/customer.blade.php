
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
                        <button type="button" class="btn btn-sm"  onclick="reloadPage()">
                            <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                        </button>
                    </div>
                  </form>
                </div>
              </div>


              <div class="row">
                <!-- Recent orders -->
                <div class="col-12">
                  <div class="card shadow eq-card">
                    <div class="card-header">
                      <strong class="card-title">My  Products</strong>
                      <a class="float-right small text-muted" href="#!">View all</a>
                    </div>
                    <div class="card-body">
                      <table class="table table-hover table-borderless table-striped mt-n3 mb-n1">
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
                            <td>{{ $application->item_name }}<br /><span class="small text-muted">{{ $application->price }}</span></td>
                            <td><span class="text-success">{{ $application->paid_amount }}</span></td>
                            <td><span class="text-danger">{{ $application->outstanding }}</span></td>
                            <td>{{ $application->created_at }}</td>
                            <td>

                                @if($application->outstanding > 0)
                                <span class="dot dot-lg bg-danger mr-2"></span>Pending
                                @else
                                <span class="dot dot-lg bg-success mr-2"></span>Complete
                                @endif
                            </td>
                            <td><a href="{{ url('/details', $application->id) }}" class="btn btn-primary mr-2 btn-sm">View</a></td>
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
          @endsection
