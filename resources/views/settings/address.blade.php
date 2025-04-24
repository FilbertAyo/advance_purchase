<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('address.index') }}"
                                    >Cities</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ url('/regions') }}"
                                  >Districts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ url('/wards') }}"
                                  >Wards</a>
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
                        <h4 class="mb-0 page-title"> List of Cities</h4>

                    </div>

                    <div class="col-auto">
                        <div class="form-group">
                            @if(Auth::user()->userType == 1 || Auth::user()->userType == 2)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCityModal">
                                New City<span
                                class="fe fe-plus fe-16 ml-2"></span>
                            </button>

                                    @else
                                    <button  class="btn mb-2 btn-primary permission-alert" > New City <span
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
                                <table class="table table-bordered table-sm" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>City</th>
                                            <th>No. Districts</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($city->count() > 0)
                                            @foreach ($city as $index => $city)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $city->city_name }}</td>
                                                    <td>{{ $city->districts_count }}</td>

                                                    <td>
                                                        <div style="display: flex; gap: 2px;">


                                                            <form id="deleteForm-{{ $city->id }}"
                                                            action="{{ route('address.destroy', $city->id) }}"
                                                                method="POST"
                                                                >
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="showSweetAlert(event, '{{ $city->id }}')"
                                                                    class="btn btn-sm btn-danger"><span
                                                                        class="fe fe-trash-2 fe-16"></span></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9" class="text-center">No Region found</td>
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
                    <form method="POST" action="{{ route('address.store') }}" enctype="multipart/form-data" novalidate>
                        @csrf

                        <!-- City Input -->
                        <div class="form-group">
                            <label for="cityName">City</label>
                            <input type="text" class="form-control" id="cityName" name="city_name" required>
                            <div class="invalid-feedback">Please provide a valid city name.</div>
                        </div>

                        <x-primary-button label="Save" />
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
