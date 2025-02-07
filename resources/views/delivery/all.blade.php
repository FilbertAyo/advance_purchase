<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('address.index') }}"
                                    >All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ url('/pending_delivery') }}"
                                  >Pending</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ url('/delivered') }}"
                                  >Delivered</a>
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
                        <h4 class="mb-1 page-title"> All Delivery</h4>
                    </div>
                </div>

                @include('elements.spinner')

                <div class="row my-2">

                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-bordered table-hover" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Product</th>
                                            <th>Date completed</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($application->count() > 0)
                                            @foreach ($application as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->customer_name }}</td>
                                                    <td>{{ $item->item_name }}</td>
                                                    <td>{{ $item->updated_at }}</td>
                                                    <td>
                                                        @if ($item->delivery_status == 'delivered')
                                                        <span class="badge badge-success text-white">{{ $item->delivery_status }}</span>

                                                        @else
                                                        <span class="badge badge-danger">{{ $item->delivery_status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div style="display: flex; gap: 2px;">

                                                            <a href="{{ route('application.show', $item->id) }}"
                                                                class="btn btn-sm  btn-warning text-white"><span
                                                                    class="fe fe-eye fe-16"></span>
                                                                </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9" class="text-center">No Delivery found</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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
                    <form method="POST" action="{{ route('address.store') }}" enctype="multipart/form-data" novalidate>
                        @csrf

                        <!-- City Input -->
                        <div class="form-group">
                            <label for="cityName">City</label>
                            <input type="text" class="form-control" id="cityName" name="city_name" required>
                            <div class="invalid-feedback">Please provide a valid city name.</div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Add City</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
