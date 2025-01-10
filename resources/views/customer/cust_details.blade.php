
@extends('layouts.custapp')

@section('content')

        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row align-items-center mb-2">
                <div class="col">
                  <h2 class="h5 page-title">TV Details</h2>
                </div>
                <div class="col-auto">
                  <form class="form-inline">

                    <div class="form-group">

                      <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                  </form>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">{{ $application->item_name }}</strong>
                            <span class="float-right badge badge-pill badge-success text-white"
                                    >{{ $application->item_type }}</span>
                        </div>
                        <div class="card-body">

                            <dl class="row mb-0">
                                <dt class="col-sm-2 mb-3 text-muted">Serial Number</dt>
                                <dd class="col-sm-4 mb-3">{{ $application->serial_number }}</dd>

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


          @endsection
