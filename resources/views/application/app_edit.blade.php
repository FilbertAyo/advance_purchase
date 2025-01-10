
<x-app-layout>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">

                        <div class="row align-items-center mb-3 border-bottom no-gutters">
                            <div class="col">
                                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Update Application</a>
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

                                <form action="{{ route('application.update', $application->id)}}" method="POST" validate
                                    style="height: 100%; display: flex; flex-direction: column; justify-content: center;">

                                    @csrf
                                    @method('PUT')

                                    <input type="text" class="form-control" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}"
                                    name="updated_by" style="display: none;">

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom3">Item Name</label>
                                            <input type="text" class="form-control" id="validationCustom3"
                                                name="item_name" value="{{ $application->item_name }}" readonly>
                                            <div class="valid-feedback"> Looks good! </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom3">Serial Number</label>
                                            <input type="text" class="form-control" id="validationCustom3"
                                                name="serial_number" value="{{ $application->serial_number }}" readonly>
                                            <div class="valid-feedback"> Looks good! </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="openingStock">Price</label>
                                            <input type="number" class="form-control" id="openingStock"
                                                name="price" value="{{ $application->price }}" readonly>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="arrivalStock">Paid Amount</label>
                                            <input type="text" class="form-control" id="arrivalStock"
                                                name="paid_amount" value="{{ $application->paid_amount }}" readonly>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary mt-3">Update Application</button>
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
