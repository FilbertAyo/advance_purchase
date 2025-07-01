<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">All Items</a>
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
                        <h4 class="mb-0 page-title"> Products List</h4>
                    </div>

                    <div class="col-auto">
                        <div class="form-group">
                            @if(auth()->check() && auth()->user()->hasAnyRole(['superuser', 'admin']))
                            <button type="button" class="btn mb-2 btn-primary" data-toggle="modal"
                                data-target=".modal-full">New Product<span
                                    class="fe fe-plus fe-16 ml-2"></span></button>
                                    @else
                                    <button  class="btn mb-2 btn-primary permission-alert" >New Product<span
                                        class="fe fe-plus fe-16 ml-2"></span></button>
                                    @endif
                        </div>

                    </div>
                </div>

                @include('elements.spinner')

                <div class="row my-2">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-body">

                                <form method="GET" action="{{ route('items.index') }}" class="row card-header">
                                    <div class="col-md-6 d-flex">
                                        <label class="mr-2 align-self-center">Per page:</label>
                                        <select name="per_page" class="form-control w-auto me-2" onchange="this.form.submit()">
                                            <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                                            <option value="20" {{ request('per_page') == '20' ? 'selected' : '' }}>20</option>
                                            <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                                            <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 d-flex">
                                        <input type="text" name="search" class="form-control w-100 mr-2" placeholder="Search items..." value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>

                                <table id="printTable" class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Model No.</th>
                                            <th>Selling Price</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th class="text-danger">Bank Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($items->count() > 0)
                                            @foreach ($items as $index => $item)
                                                <tr>
                                                    <td>{{ ($items->currentPage() - 1) * $items->perPage() + $index + 1 }}</td>
                                                    <td>{{ $item->item_name }}</td>
                                                    <td>{{ $item->code }}</td>
                                                    <td>{{ $item->sales }}</td>
                                                    <td>{{ $item->category }}</td>
                                                    <td>{{ $item->brand }}</td>
                                                      <td>{{ $item->credit_price ?? '-'}}</td>
                                                    <td>
                                                        <div style="display: flex; gap: 2px;">
                                                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                                <span class="fe fe-edit fe-16"></span>
                                                            </a>

                                                            <a href="{{ route('items.show', $item->id) }}" class="btn btn-sm btn-secondary text-white">
                                                                <span class="fe fe-eye fe-16"></span>
                                                            </a>

                                                            <form id="deleteForm-{{ $item->id }}" action="{{ route('items.destroy', $item->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="showSweetAlert(event, '{{ $item->id }}')" class="btn btn-sm btn-danger">
                                                                    <span class="fe fe-trash-2 fe-16"></span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">No Product found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-between">
                                    <div class="align-self-center">
                                        <p>Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} Items</p>
                                    </div>
                                    <div class="align-self-center">
                                        {{ $items->appends(['search' => request('search')])->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade modal-full" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        data-backdrop="static" aria-hidden="true">
        <button aria-label="" type="button" class="close p-5" data-dismiss="modal" aria-hidden="true"
            style="position: absolute; right: 20px; top: 20px;">
            <span aria-hidden="true" style="font-size: 3rem;" class="text-danger">×</span>
        </button>

        <div class="modal-dialog modal-xl bg-white" role="document" style="width: 100%;">
            <div class="modal-content">
                <div class="modal-body">

                    <form method="POST" action="{{ route('items.store') }}" validate
                        style="height: 100%; display: flex; flex-direction: column; justify-content: center;"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="form-row text-center">
                            <div class="col-md-12 mb-3">
                                <h3> Product Registration</h3>
                            </div>
                        </div>

                        <input type="text" class="form-control"
                            value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" name="created_by"
                            style="display: none;">

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom3">Item Name</label>
                                <input type="text" class="form-control" id="validationCustom3" name="item_name"
                                    required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom3">Bar Code</label>
                                <input type="text" class="form-control" id="validationCustom3" name="code"
                                    required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom3">credit price</label>
                                <input type="number" class="form-control" id="validationCustom3" name="credit_price">
                                <div class="valid-feedback"> Looks good! </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom3">Sales Price</label>
                                <input type="number" class="form-control" id="validationCustom3" name="sales"
                                    required>
                                <div class="valid-feedback"> Looks good! </div>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="openingStock">Category</label>
                                <select class="form-control select2" id="validationSelect0" name="category" required>
                                    <optgroup label="Select Item">
                                        <option value="Television">Television </option>
                                        <option value="Air Conditioner"> Air Conditioner </option>
                                        <option value="Fridge">Fridge </option>
                                        <option value="Chest Freezer">Chest Freezer</option>
                                        <option value="Sound Bar">Sound Bar</option>
                                        <option value="Small Home Appliances">Small Home Appliances</option>
                                        <option value="Washing Machine">Washing Machine</option>
                                        <option value="Cooker">Cooker</option>
                                        <option value="W/Dispenser">W/Dispenser</option>
                                        <option value="V/Cleaner">V/Cleaner</option>
                                    </optgroup>
                                </select>

                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="arrivalStock">Brand</label>
                                <select class="form-control select2" id="validationSelect0" name="brand" required>
                                    <optgroup label="Select Item">
                                        <option value="HISENSE">HISENSE </option>
                                        <option value="SAMSUNG"> SAMSUNG </option>
                                        <option value="LG">LG </option>
                                        <option value="TOSHIBA">TOSHIBA</option>
                                    </optgroup>
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                        </div>


                        <div class="form-group mb-3">
                            <label for="validationTextarea1">Item description</label>
                            <textarea class="form-control" id="validationTextarea1" placeholder="Description" rows="10" cols="50"
                                name="description"></textarea>
                            <div class="invalid-feedback"> Please enter a description in the textarea.
                            </div>
                        </div>


                        <x-primary-button label="Save" class="w-100 mt-3" />
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
