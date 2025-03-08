
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
                                                name="cost" value="{{ $item->cost }}" >
                                            <div class="valid-feedback"> Looks good! </div>
                                        </div>


                                    </div>


                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="openingStock">Category</label>
                                            <select class="form-control select2" id="validationSelect0" name="category" required>
                                                <optgroup label="Select Item">
                                                    <option value="Television" {{ $item->category == 'Television' ? 'selected' : '' }}>Television</option>
                                                    <option value="Air Conditioner" {{ $item->category == 'Air Conditioner' ? 'selected' : '' }}>Air Conditioner</option>
                                                    <option value="Fridge" {{ $item->category == 'Fridge' ? 'selected' : '' }}>Fridge</option>
                                                    <option value="Chest Freezer" {{ $item->category == 'Chest Freezer' ? 'selected' : '' }}>Chest Freezer</option>
                                                    <option value="Sound Bar" {{ $item->category == 'Sound Bar' ? 'selected' : '' }}>Sound Bar</option>
                                                    <option value="Small Home Appliances" {{ $item->category == 'Small Home Appliances' ? 'selected' : '' }}>Small Home Appliances</option>
                                                    <option value="Washing Machine" {{ $item->category == 'Washing Machine' ? 'selected' : '' }}>Washing Machine</option>
                                                    <option value="Cooker" {{ $item->category == 'Cooker' ? 'selected' : '' }}>Cooker</option>
                                                    <option value="W/Dispenser" {{ $item->category == 'W/Dispenser' ? 'selected' : '' }}>W/Dispenser</option>
                                                    <option value="V/Cleaner" {{ $item->category == 'V/Cleaner' ? 'selected' : '' }}>V/Cleaner</option>
                                                </optgroup>
                                            </select>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="arrivalStock">Brand</label>
                                            <select class="form-control select2" id="validationSelect0" name="brand" required>
                                                <optgroup label="Select Item">
                                                    <option value="HISENSE" {{ $item->brand == 'HISENSE' ? 'selected' : '' }}>HISENSE</option>
                                                    <option value="SAMSUNG" {{ $item->brand == 'SAMSUNG' ? 'selected' : '' }}>SAMSUNG</option>
                                                    <option value="LG" {{ $item->brand == 'LG' ? 'selected' : '' }}>LG</option>
                                                    <option value="TOSHIBA" {{ $item->brand == 'TOSHIBA' ? 'selected' : '' }}>TOSHIBA</option>
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
