<x-app-layout>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">All</a>
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
                            @if(Auth::user()->userType == 1 || Auth::user()->userType == 2)
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
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table table-bordered" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Cost</th>
                                            <th>Seling Price</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($item->count() > 0)
                                            @foreach ($item as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->item_name }}</td>
                                                    <td>{{ $item->cost }}</td>
                                                    <td>{{ $item->sales }}</td>
                                                    <td>{{ $item->category }}</td>
                                                    <td>{{ $item->brand }}</td>
                                                    <td>

                                                        <div style="display: flex; gap: 2px;">
                                                            <!-- Adjust spacing between buttons as needed -->
                                                            <a href="{{ route('item.edit', $item->id) }}"
                                                                class="btn btn-sm btn-primary">
                                                                <span class="fe fe-edit fe-16"></span></a>

                                                            <a href="{{ route('item.show', $item->id) }}"
                                                                class="btn btn-sm  btn-warning text-white"><span
                                                                    class="fe fe-eye fe-16"></span></a>

                                                            <form id="deleteForm-{{ $item->id }}"
                                                            action="{{ route('item.destroy', $item->id) }}"
                                                                method="POST"
                                                                >
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="showSweetAlert(event, '{{ $item->id }}')"
                                                                    class="btn btn-sm btn-danger"><span
                                                                        class="fe fe-trash-2 fe-16"></span></button>
                                                            </form>


                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9" class="text-center">No Product found</td>
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


    <div class="modal fade modal-full" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        data-backdrop="static" aria-hidden="true">
        <button aria-label="" type="button" class="close p-5" data-dismiss="modal" aria-hidden="true"
            style="position: absolute; right: 20px; top: 20px;">
            <span aria-hidden="true" style="font-size: 3rem;" class="text-danger">×</span>
        </button>

        <div class="modal-dialog modal-xl bg-white" role="document" style="width: 100%;">
            <div class="modal-content">
                <div class="modal-body">

                    <form method="POST" action="{{ route('item.store') }}" validate
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
                                <label for="validationCustom3">Cost (Per Smallest Item Unit)</label>
                                <input type="text" class="form-control" id="validationCustom3" name="cost">
                                <div class="valid-feedback"> Looks good! </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom3">Sales Price (Per Smallest Item Unit)</label>
                                <input type="text" class="form-control" id="validationCustom3" name="sales"
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
                                        <option value="Fridges">Fridges </option>
                                        <option value="Chest Freezer">Chest Freezer</option>
                                        <option value="Sound Bar">Sound Bar</option>
                                        <option value="Small Home Appliances">Small Home Appliances</option>

                                        <option value="Washing Machine">Washing Machine</option>
                                        <option value="Cookers">Cookers</option>
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

{{--                    <div class="form-row mb-3">

                            <div class="col-md-6 mb-3">
                                <label for="date-input1">Expire date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control drgpicker" id="date-input1"
                                        aria-describedby="button-addon2" name="expire_date">
                                    <div class="input-group-append">
                                        <div class="input-group-text" id="button-addon-date"><span
                                                class="fe fe-calendar fe-16 mx-2"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group mb-3">
                            <label for="validationTextarea1">Item description</label>
                            <textarea class="form-control" id="validationTextarea1" placeholder="Description" required="" rows="3"
                                name="description"></textarea>
                            <div class="invalid-feedback"> Please enter a description in the textarea.
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary mt-3">Add Item</button>
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
