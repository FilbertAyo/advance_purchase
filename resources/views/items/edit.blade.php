
<x-app-layout>

            @include('elements.spinner')
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">

                        <div class="row align-items-center mb-3 border-bottom no-gutters">
                            <div class="col">
                                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Edit Product</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-auto">

                                <button type="button" class="btn btn-sm" onclick="reloadPage()">
                                    <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                                </button>
                            </div>
                        </div>

                            <div class="p-3 bg-white">

                                <form action="{{ route('item.update', $item->id)}}" method="POST" validate
                                    style="height: 100%; display: flex; flex-direction: column; justify-content: center;">

                                    @csrf
                                    @method('PUT')

                                    <input type="text" class="form-control" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}"
                                    name="created_by" style="display: none;">

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom3">Item Name</label>
                                            <input type="text" class="form-control" id="validationCustom3"
                                                name="item_name" value="{{ $item->item_name }}" required>
                                            <div class="valid-feedback"> Looks good! </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom3">Cost (Per Smallest Item Unit)</label>
                                            <input type="text" class="form-control" id="validationCustom3"
                                                name="cost" value="{{ $item->cost }}" required>
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


                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom3">Sales Price (Per Smallest Item Unit)</label>
                                            <input type="text" class="form-control" id="validationCustom3"
                                                name="sales" value="{{ $item->sales }}" required>
                                            <div class="valid-feedback"> Looks good! </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom3">Bar Code</label>
                                            <input type="text" class="form-control" id="validationCustom3"
                                                name="code" value="{{ $item->code }}" required>
                                            <div class="valid-feedback"> Looks good! </div>
                                        </div>

                                    </div>

                                    <div class="form-row">



                                    </div>

                                    <div class="form-row mb-3">



                                        <div class="col-md-6 mb-3">
                                            <label for="date-input1">Expire date</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control drgpicker" id="date-input1"
                                                  aria-describedby="button-addon2"
                                                    value="{{ $item->expire_date }}" name="expire_date">
                                                <div class="input-group-append">
                                                    <div class="input-group-text" id="button-addon-date"><span
                                                            class="fe fe-calendar fe-16 mx-2"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Update Product</button>
                                </form>

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






                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->

        </x-app-layout>
