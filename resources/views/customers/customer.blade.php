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


               @include('elements.check')

                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">My Products</strong>
                        <a class="float-right small text-muted" href="#!">View all</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive w-100">
                            <table class="table table-hover table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($applications->count() > 0)
                                        @foreach ($applications as $index => $application)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $application->item->item_name }}<br /><span
                                                        class="small text-muted">{{ $application->price }}</span>
                                                    <br>
                                                    @if ($application->status == 'inactive')
                                                        <strong class="badge badge-danger p-1">Pending</strong>
                                                    @elseif ($application->status == 'refunded')
                                                        <strong class="badge badge-secondary p-1">Refunded</strong>
                                                    @else
                                                        @if ($application->outstanding == 0)
                                                            <strong
                                                                class="badge badge-success p-1 text-white">Complete</strong>
                                                        @else
                                                            <strong class="badge badge-info p-1">Ongoing</strong>
                                                        @endif
                                                    @endif
                                                </td>

                                                <td><a href="{{ route('application.details', $application->id) }}"
                                                        class="btn btn-secondary mr-2 btn-sm">
                                                        <i class="fe fe-eye fe-16"></i>
                                                    </a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">No Application found</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
