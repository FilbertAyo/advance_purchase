
<x-app-layout>


            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">

                        <div class="row align-items-center mb-3 border-bottom no-gutters">
                            <div class="col">
                                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">All Applications</a>
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

                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="mb-0 page-title">Application</h4>
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
                                                @if ($application->count() > 0)
                                                    @foreach ($application as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $item->customer_name }}</td>
                                                            <td>{{ $item->item_name }}</td>
                                                            <td>{{ $item->price }}</td>
                                                            <td><span class="text-success">{{ $item->paid_amount}}</span></td>
                                                            <td><span class="text-danger">{{ $item->outstanding }}</span></td>
                                                            <td>{{ $item->created_at }}</td>
                                                            <td>

                                                                @if($item->outstanding == 0)
                                                                <span class="badge badge-success">complete</span>

                                                                @else
                                                                <span class="badge badge-danger">pending</span>
                                                                @endif
                                                            </td>
                                                            <td>

                                                                <div style="display: flex; gap: 2px;">

                                                                
                                                                    <a href="{{ route('application.show', $item->id) }}"
                                                                        class="btn btn-sm  btn-warning text-white"><span
                                                                            class="fe fe-eye fe-16"></span>
                                                                        </a>

                                                                        @if(Auth::user()->userType == 1 || Auth::user()->userType == 3)

                                                                        <form id="deleteForm-{{ $item->id }}"
                                                                            action="{{ route('application.destroy', $item->id) }}"
                                                                            method="POST"
                                                                           >
                                                                          @csrf
                                                                          @method('DELETE')
                                                                            <button type="button" onclick="showSweetAlert(event, '{{ $item->id }}')"
                                                                                class="btn btn-sm btn-danger">
                                                                            <span class="fe fe-trash-2 fe-16"></span>
                                                                        </button>

                                                                      </form>
                                                                      @else
                                                                      <button
                                                                      class="btn btn-sm btn-danger permission-alert" ><span
                                                                          class="fe fe-trash-2 fe-16 permission-alert"></span></button>
                                                                      @endif


                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="9" class="text-center">No Item found</td>
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
            </div> <!-- .container-fluid -->


            {{-- item registration --}}

            <div class="modal fade modal-full" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                data-backdrop="static" aria-hidden="true">
                <button aria-label="" type="button" class="close p-3" data-dismiss="modal" aria-hidden="true"
                    style="position: absolute; right: 20px; top: 20px;">
                    <span aria-hidden="true" style="font-size: 3rem;" class="text-danger">×</span>
                </button>

                <div class="modal-dialog modal-dialog-centered modal-xl bg-white" role="document"
                    style="width: 100%;">
                    <div class="modal-content">
                        <div class="modal-body">

                            <form method="POST" action="{{ route('application.store') }}" validate
                                style="height: 100%; display: flex; flex-direction: column; justify-content: center;">

                                @csrf

                                <div class="form-row text-center">
                                    <div class="col-md-12 mb-3">
                                        <h3>Advanced Payment Application</h3>
                                    </div>
                                </div>

                                <input type="text" class="form-control" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}"
                                name="created_by" style="display: none;">

                                <div class="form-row">

                                    <div class="col-md-6 mb-3">
                                        <label for="validationSelect9">Customer Name</label>
                                        <select class="form-control select2" id="validationSelect9" name="customer_name" required>
                                            <optgroup label="Select customer">

                                                @foreach ($user as $user)
                                                @if($user->status == 'active')
                                                    <option value="{{ $user->id }} {{ $user->first_name }} {{ $user->last_name }}">
                                                        {{ $user->first_name }} {{ $user->last_name }}
                                                    </option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        <div class="invalid-feedback">Please select a valid customer.</div>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="validationSelect0">Item Name</label>
                                        <select class="form-control select2" id="validationSelect0" name="item_name" required>
                                            <optgroup label="Select Item">
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->sales }} {{ $item->item_name }} {{ $item->code }}">
                                                        {{ $item->item_name }}  {{ $item->code }}
                                                    </option>

                                                @endforeach
                                            </optgroup>
                                        </select>

                                        <div class="invalid-feedback">Please select a valid item.</div>
                                    </div>
                                </div>

                                <div class="form-row">
                                        <input type="hidden" class="form-control" id="openingStock"
                                            name="paid_amount" value="0" required>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Submit Application</button>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const openingStockInput = document.getElementById('openingStock');
                        const arrivalStockInput = document.getElementById('arrivalStock');
                        const smallestItemUnitInput = document.getElementById('smallestItemUnit');
                        const reorder = document.getElementById('reorder');

                        function updateSmallestItemUnit() {
                            const openingStock = parseFloat(openingStockInput.value) || 0;
                            const arrivalStock = parseFloat(arrivalStockInput.value) || 0;
                            const smallestItemUnit = openingStock + arrivalStock;
                            smallestItemUnitInput.value = smallestItemUnit.toFixed(0); // Update the readonly field
                            reorder.value = smallestItemUnit.toFixed(0); // Update the new input field
                        }

                        openingStockInput.addEventListener('input', updateSmallestItemUnit);
                        arrivalStockInput.addEventListener('input', updateSmallestItemUnit);
                    });
                </script>
            </div>



        </x-app-layout>
