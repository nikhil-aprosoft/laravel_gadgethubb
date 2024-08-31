<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Daily-Deals Show</title>

    <x-admin.head />
</head>

<body>

    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -->
            <x-admin.aside-menu />
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                <x-admin.navbar />

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="app-ecommerce">
                            <!-- Notification Section -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <form id="product-form" action="{{ route('daily-deals.update', $dailyDeal->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 gap-4 gap-md-0">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h4 class="mb-1">Edit Daily Deal</h4>
                                    </div>
                                    <div class="d-flex align-content-center flex-wrap gap-4">
                                        <a href="{{ route('daily-deals.index') }}" class="btn btn-outline-primary">Back</a>
                                        <button type="submit" class="btn btn-primary">Update Deal</button>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <!-- Left column -->
                                    <div class="col-12 col-lg-8">
                                        <div class="card mb-6">
                                            <div class="card-body">
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <select id="product_id" name="product_id" class="form-select form-select-sm" data-placeholder="Select Product" required>
                                                        <option value="">Select Product</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->product_id }}" {{ $product->product_id == $dailyDeal->product_id ? 'selected' : '' }}>
                                                                {{ $product->product_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="product_id">Product</label>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="card mb-6">
                                            <div class="card-body">
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="text" class="form-control" id="text" placeholder="Deal Description" name="text" aria-label="Deal Description" value="{{ old('text', $dailyDeal->text) }}">
                                                    <label for="text">Description</label>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="card mb-6">
                                            <div class="card-body">
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="number" class="form-control" id="discount_amount" placeholder="Discount Amount" name="discount_amount" aria-label="Discount Amount" step="0.01" value="{{ old('discount_amount', $dailyDeal->discount_amount) }}" required>
                                                    <label for="discount_amount">Discount Amount</label>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="card mb-6">
                                            <div class="card-body">
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <select id="discount_type" name="discount_type" class="form-select form-select-sm" required>
                                                        <option value="fixed" {{ $dailyDeal->discount_type == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                                        <option value="percentage" {{ $dailyDeal->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                                    </select>
                                                    <label for="discount_type">Discount Type</label>
                                                </div>
                                            </div>
                                        </div>
                            
                                        
                                    </div>
                            
                                    <!-- Right column -->
                                    <div class="col-12 col-lg-4">                                      
                                        <div class="card mb-6">
                                            <div class="card-body">
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <select id="status" name="status" class="form-select form-select-sm" required>
                                                        <option value="active" {{ $dailyDeal->status == 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="inactive" {{ $dailyDeal->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                        <option value="expired" {{ $dailyDeal->status == 'expired' ? 'selected' : '' }}>Expired</option>
                                                    </select>
                                                    <label for="status">Status</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-6">
                                            <div class="card-body">
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" aria-label="Start Date" value="{{ old('start_date', $dailyDeal->start_date) }}" required>
                                                    <label for="start_date">Start Date</label>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="card mb-6">
                                            <div class="card-body">
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" aria-label="End Date" value="{{ old('end_date', $dailyDeal->end_date) }}">
                                                    <label for="end_date">End Date</label>
                                                </div>
                                            </div>
                                        </div>                                
                                    </div>
                                </div>
                            </form>                                                                                   
                            <script>
                                let selectedImages = [];

                                function previewImages(event) {
                                    const previewDiv = document.getElementById("image-preview");
                                    previewDiv.innerHTML = ""; // Clear previous previews
                                    selectedImages = Array.from(event.target.files); // Update selected images list

                                    selectedImages.forEach((file, index) => {
                                        const reader = new FileReader();

                                        reader.onload = function(e) {
                                            const imgContainer = document.createElement("div");
                                            imgContainer.style.position = "relative";
                                            imgContainer.style.display = "inline-block";

                                            const img = document.createElement("img");
                                            img.src = e.target.result;
                                            img.style.maxWidth = "100px";
                                            img.style.maxHeight = "100px";
                                            img.style.objectFit = "cover";
                                            img.style.border = "1px solid #ddd";
                                            img.style.borderRadius = "4px";

                                            const removeBtn = document.createElement("button");
                                            removeBtn.textContent = "Remove";
                                            removeBtn.style.position = "absolute";
                                            removeBtn.style.bottom = "5px";
                                            removeBtn.style.right = "5px";
                                            removeBtn.style.backgroundColor = "#ff4d4d";
                                            removeBtn.style.color = "#fff";
                                            removeBtn.style.border = "none";
                                            removeBtn.style.padding = "5px";
                                            removeBtn.style.borderRadius = "4px";
                                            removeBtn.style.cursor = "pointer";

                                            removeBtn.addEventListener('click', function() {
                                                removeImage(index);
                                            });

                                            imgContainer.appendChild(img);
                                            imgContainer.appendChild(removeBtn);

                                            previewDiv.appendChild(imgContainer);
                                        };

                                        reader.readAsDataURL(file);
                                    });
                                }

                                function removeImage(index) {
                                    selectedImages.splice(index, 1); // Remove the image from the selectedImages array

                                    const imageInput = document.getElementById("image-upload");
                                    const dataTransfer = new DataTransfer();
                                    selectedImages.forEach(file => dataTransfer.items.add(file));
                                    imageInput.files = dataTransfer.files; // Update the input value

                                    previewImages({
                                        target: {
                                            files: selectedImages
                                        }
                                    }); // Refresh the preview
                                }

                                document.addEventListener('DOMContentLoaded', function() {
                                    const discardButton = document.getElementById('discard-button');
                                    const form = document.getElementById('product-form');

                                    discardButton.addEventListener('click', function() {
                                        form.reset();
                                        document.getElementById("image-preview").innerHTML = "";
                                        selectedImages = []; // Clear the selected images list
                                        document.getElementById("image-upload").files = new DataTransfer()
                                            .files; // Clear the file input
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <!-- /Options -->
                </div>


            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('admin_asset/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/menu.js') }}"></script>



    <!-- Main JS -->
    <script src="{{ asset('admin_asset/js/main.js') }}"></script>

    <!-- Page JS -->
    {{-- <script src="{{ asset('admin_asset/js/app-ecommerce-product-add.js') }}"></script> --}}


</body>

</html>
