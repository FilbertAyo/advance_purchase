<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Unverified Customers</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-sm" onclick="reloadPage()">
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
                                <!-- table -->
                                <table class="table datatables table-bordered table-sm" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Reference No.</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @if ($user->count() > 0) --}}
                                        @foreach ($user as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->first_name }} {{ $user->middle_name ?? '' }}
                                                    {{ $user->last_name }}</td>
                                                <td>{{ $user->userId }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->profile->street ?? '' }},{{ $user->profile->ward ?? '' }},{{ $user->profile->district ?? '' }},{{ $user->profile->city ?? '' }}
                                                </td>
                                                <td>
                                                    <div style="display: flex; gap: 2px;">
                                                        @if (auth()->check() && auth()->user()->hasAnyRole(['superuser', 'admin']))
                                                            <a href="{{ route('customer.show', $user->id) }}"
                                                                class="btn btn-sm btn-secondary text-white"><span
                                                                    class="fe fe-eye fe-16"></span></a>
                                                        @else
                                                            <a href="{{ route('customer.show', $user->id) }}"
                                                                class="btn btn-sm btn-secondary text-white"
                                                                style="pointer-events: none; opacity: 0.6;">
                                                                <span class="fe fe-eye fe-16"></span>
                                                            </a>
                                                        @endif
                                                            <button class="btn btn-sm btn-danger permission-alert"><span
                                                                    class="fe fe-trash-2 fe-16 permission-alert"></span></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div>
            </div>





</x-app-layout>
