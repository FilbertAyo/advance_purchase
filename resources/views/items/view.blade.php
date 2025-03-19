<x-app-layout>

    @include('elements.spinner')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Product Details</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-auto">

                        <button type="button" class="btn btn-sm" onclick="reloadPage()">
                            <i class="fe fe-16 fe-refresh-ccw text-muted"></i>
                        </button>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">{{ $item->item_name }}</strong>
                                <span
                                    class="float-right badge badge-pill badge-success text-white">{{ $item->item_type }}</span>
                            </div>
                            <div class="card-body">

                                <dl class="row mb-0">
                                    <dt class="col-sm-2 mb-3 text-muted">Barcode</dt>
                                    <dd class="col-sm-4 mb-3">{{ $item->code }}</dd>

                                    <dt class="col-sm-2 mb-3 text-muted">Category</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <span class="bg-warning mr-2"></span> {{ $item->category }}
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Brand</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <span class="dot dot-md bg-warning mr-2"></span> {{ $item->brand }}
                                    </dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Price</dt>
                                    <dd class="col-sm-4 mb-3">TZS {{ number_format($item->sales) }}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">As of Date</dt>
                                    <dd class="col-sm-4 mb-3">{{ $item->created_at }}</dd>
                                    <dt class="col-sm-2 mb-3 text-muted">Last Update</dt>
                                    <dd class="col-sm-4 mb-3">{{ $item->updated_at }}</dd>

                                    <dt class="col-sm-2 mb-3 text-muted">Last updated by</dt>
                                    <dd class="col-sm-4 mb-3">
                                        <strong>{{ $item->created_by }}</strong>
                                    </dd>

                                    <dt class="col-sm-12 text-muted">Description</dt>
                                    <dd class="col-sm-12"> {{ $item->description }} </dd>
                                </dl>

                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div> <!-- .col-md -->
                </div>
                <div class="row align-items-center mb-3 border-bottom no-gutters">
                    <div class="col">
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                    role="tab" aria-controls="home" aria-selected="true">Product Images</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="row">



                    @foreach ($item->productImages as $image)
                        <div class="col-md-3">
                            <div class="card shadow mb-4 position-relative">
                                <div class="card-body">

                                    <img src="{{ asset($image->image_url) }}" alt="Product Image"
                                        class="card-img-top img-fluid rounded">

                                    <!-- Delete button (visible on hover) -->
                                    <form action="{{ route('items.delete_image', $image->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2">
                                            <i class="fe fe-trash fe-24 text-white"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <div class="col-md-3">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong>Pictures Upload</strong>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('items.upload_image', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <div class="form-group">
                                        <div id="dropzone-area"
                                            class="border border-dashed rounded p-4 text-center bg-light">
                                            <div class="dz-message needsclick">
                                                <div class="circle circle-lg bg-primary">
                                                    <i class="fe fe-upload fe-24 text-white"></i>
                                                </div>
                                                <h5 class="text-muted mt-4">Drop files here or click to upload</h5>
                                            </div>
                                            <input type="file" name="image_url[]" id="image_url"
                                                class="form-control d-none" multiple required
                                                onchange="displaySelectedFiles(event)">
                                        </div>
                                        <ul id="file-list" class="list-group mt-3"></ul>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-1 w-100">
                                        Upload Files
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

    <style>
        .card {
            position: relative;
            overflow: hidden;
        }

        /* Center the button in the card */
        .delete-form .btn {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 5px;
        }

        /* Show the button when hovering over the card */
        .card:hover .btn {
            display: inline-block;
        }

        /* Add overlay effect when hovering */
        .card:hover img {
            opacity: 0.7;
        }
    </style>



    <script>
        const dropzoneArea = document.getElementById('dropzone-area');
        const fileInput = document.getElementById('image_url');
        const fileList = document.getElementById('file-list');

        // Prevent default browser behavior for drag-and-drop
        dropzoneArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropzoneArea.classList.add('border-primary'); // Add highlight effect
        });

        dropzoneArea.addEventListener('dragleave', () => {
            dropzoneArea.classList.remove('border-primary'); // Remove highlight effect
        });

        dropzoneArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropzoneArea.classList.remove('border-primary');

            // Access dropped files
            const files = event.dataTransfer.files;
            fileInput.files = files; // Assign files to the input element for form submission

            displaySelectedFiles({
                target: fileInput
            }); // Update file list
        });

        // Trigger file input when dropzone is clicked
        dropzoneArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Display selected files
        function displaySelectedFiles(event) {
            const files = event.target.files;
            fileList.innerHTML = ''; // Clear previous list

            Array.from(files).forEach((file, index) => {
                const li = document.createElement('li');
                li.className = 'list-group-item';
                li.textContent = `${index + 1}. ${file.name}`;
                fileList.appendChild(li);
            });
        }
    </script>




</x-app-layout>
