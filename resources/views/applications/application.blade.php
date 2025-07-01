
<x-app-layout>


            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">

                        <div class="row align-items-center mb-3 border-bottom no-gutters">
                            <div class="col">
                                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Active Application</a>
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
                                <button type="button" class="btn btn-sm"  onclick="reloadPage()">
                                    <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                                </button>

                            </div>
                        </div>


                        @include('elements.spinner')
                        <div class="row my-2">
                            <!-- Small table -->
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="card-body">

                                        <form method="GET" action="{{ route('application.list') }}" class="row card-header mb-3">
                                            <div class="col-md-6 d-flex">
                                                <label class="mr-2 align-self-center">Per page:</label>
                                                <select name="perPage" class="form-control w-auto me-2" onchange="this.form.submit()">
                                                    @foreach ([10, 20, 50, 100] as $size)
                                                        <option value="{{ $size }}" {{ request('perPage', 10) == $size ? 'selected' : '' }}>{{ $size }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 d-flex">
                                                <input type="text" name="search" class="form-control w-100 mr-2" placeholder="Search name or ID..." value="{{ request('search') }}">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </form>

                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Paid</th>
                                                    <th>Outstanding</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($applications->count() > 0)
                                                    @foreach ($applications as $index => $application)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $application->user->userId }}</td>
                                                            <td>{{ $application->user->first_name }} {{ $application->user->middle_name }} {{ $application->user->last_name }}</td>
                                                            <td>{{ $application->item->item_name }}</td>
                                                            <td>{{ number_format($application->price) }}</td>
                                                            <td><span class="text-success">{{ number_format($application->paid_amount) }}</span></td>
                                                            <td><span class="text-danger">{{ number_format($application->outstanding) }}</span></td>
                                                            <td>{{ $application->created_at }}</td>
                                                            <td>
                                                                @if ($application->status == 'inactive')
                                                                <strong class="badge badge-danger p-1">Inactive</strong>
                                                            @elseif ($application->status == 'refunded')
                                                                <strong class="badge badge-secondary p-1">Refunded</strong>
                                                            @else
                                                                @if ($application->outstanding == 0)
                                                                    <strong class="badge badge-success p-1 text-white">Complete</strong>
                                                                @else
                                                                    <strong class="badge badge-info p-1">Ongoing</strong>
                                                                @endif
                                                            @endif
                                                            </td>
                                                            <td>
                                                                <div style="display: flex; gap: 2px;">
                                                                    <a href="{{ route('application.show', $application->id) }}"
                                                                        class="btn btn-sm btn-secondary text-white">
                                                                        <span
                                                                            class="fe fe-eye fe-16"></span>
                                                                        </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="9" class="text-center">No Application found</td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>

                                        <div class="d-flex justify-content-between">
                                            <div class="align-self-center">
                                                <p>Showing {{ $applications->firstItem() }} to {{ $applications->lastItem() }} of {{ $applications->total() }} Applications</p>
                                            </div>
                                            <div class="align-self-center">
                                                {{ $applications->appends(['search' => request('search'), 'perPage' => request('perPage')])->links('vendor.pagination.bootstrap-4') }}
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>





        </x-app-layout>
