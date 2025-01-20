<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('address.index') }}"
                                    >Cities</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active"  href="{{ url('/regions') }}"
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
                        <h4 class="mb-0 page-title"> List of Regions</h4>

                    </div>

                    <div class="col-auto">
                        <div class="form-group">
                            @if(Auth::user()->userType == 1 || Auth::user()->userType == 2)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addregionModal">
                                New region<span
                                class="fe fe-plus fe-16 ml-2"></span>
                            </button>

                                    @else
                                    <button  class="btn mb-2 btn-primary permission-alert" > New region <span
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
                                            <th>region</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($regions->count() > 0)
                                            @foreach ($regions as $index => $region)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $region->region_name }}</td>

                                                    <td>
                                                        <div style="display: flex; gap: 2px;">

                                                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modifyLocationModal_{{ $region->id }}">
                                                                <span class="fe fe-edit fe-16"></span>
                                                            </a>

                                                            <form id="deleteForm-{{ $region->id }}"
                                                            action="{{ route('region.destroy', $region->id) }}"
                                                                method="POST"
                                                                >
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="showSweetAlert(event, '{{ $region->id }}')"
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




    <div class="modal fade" id="addregionModal" tabindex="-1" role="dialog" aria-labelledby="addregionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addregionModalLabel">Add New region</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/region_store') }}" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="form-group">
                            <label for="regionName">City</label>

                            <select type="text" class="form-control" id="regionName" name="city_id" required>
                                @foreach($city as $city)
                                <option value="{{$city->id }}">{{ $city->city_name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="regionName">region</label>
                            <input type="text" class="form-control" id="regionName" name="region_name" required>
                            <div class="invalid-feedback">Please provide a valid region name.</div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Add region</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
