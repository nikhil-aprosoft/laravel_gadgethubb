<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Update-Product</title>

    <x-admin.head />
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
            <!-- Menu -->
            <x-admin.aside-menu />
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                <x-admin.navbar />
                <!-- / Navbar -->

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

                            <form id="product-form" action="{{ route('products.update', $product->product_id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 gap-4 gap-md-0">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h4 class="mb-1">Update Product</h4>
                                    </div>
                                    <div class="d-flex align-content-center flex-wrap gap-4">
                                        {{-- <button type="button" id="discard-button"
                                            class="btn btn-outline-primary">Discard</button> --}}
                                        <button type="submit" class="btn btn-primary">Update Product</button>
                                    </div>
                                </div>

                                <div class="row">

                                    <!-- First column-->
                                    <div class="col-12 col-lg-8">
                                        <!-- Product Information -->
                                        <div class="card mb-6">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Product Information</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="text" class="form-control" id="product_name"
                                                        name="product_name" aria-label="Product title"
                                                        value="{{ $product->product_name }}">
                                                    <label for="product_name">Name</label>
                                                </div>

                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="text" class="form-control" id="model"
                                                        name="model" value="{{ $product->model }}">
                                                    <label for="model">Model</label>
                                                </div>

                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="text" class="form-control" id="sku"
                                                        value="{{ $product->sku }}" name="sku">
                                                    <label for="sku">SKU</label>
                                                </div>

                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="number" class="form-control" id="quantity"
                                                        value="{{ $product->quantity }}" name="quantity"
                                                        aria-label="Quantity">
                                                    <label for="quantity">Stock</label>
                                                </div>

                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="text" class="form-control" id="short_desc"
                                                        value="{{ cleanText($product->short_desc) }}" name="short_desc">
                                                    <label for="short_desc">Short Description</label>
                                                </div>

                                                <div class="form-floating form-floating-outline mb-5">
                                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
                                                    <label for="description">Description</label>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- /Product Information -->
                                        <div class="card mb-6">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 card-title">Product Images</h5>
                                            </div>
                                            <div class="card-body">
                                                <input type="file" class="form-control" id="image-upload"
                                                    name="images[]" multiple accept="image/*"
                                                    onchange="previewImages(event)">
                                            </div>
                                        </div>
                                        <div class="card mb-6">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 card-title">New Image</h5>
                                            </div>
                                            <div id="image-preview" style="display: flex; flex-wrap: wrap; gap: 10px;">
                                            </div>
                                        </div>
                                        <div class="card mb-6">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 card-title">Existing Image</h5>
                                            </div>
                                            <div style="display: flex; flex-wrap: wrap; gap: 10px;margin-left: 10px">
                                                @foreach ($product->images as $image)
                                                    <img src="{{ $image }}"
                                                        style="max-width: 100px;max-height: 100px;position: relative;display: inline-block;object-fit: cover;margin:10px;border: 1px solid rgb(221, 221, 221);">
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="card mb-6">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 card-title">Thumbnail Image</h5>
                                            </div>
                                            <div class="card-body">
                                                <input type="file" id="thumbnail-upload" name="thumbnail"
                                                    class="form-control" accept="image/*"
                                                    onchange="previewThumbnail(event)">
                                            </div>
                                        </div>


                                        <div class="card mb-6">
                                            <div id="thumbnail-preview" style="margin-top: 10px;">
                                                <div
                                                    class="card-header d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0 card-title">New Thumbnail</h5>
                                                </div>
                                                <img id="thumbnail-image" src="" alt="Thumbnail Preview"
                                                    style="max-width: 150px; max-height: 150px; object-fit: cover; display: none;margin:10px">
                                            </div>
                                        </div>


                                        <div class="card mb-6">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 card-title">Existing Image</h5>
                                            </div>
                                            <div style="display: flex; flex-wrap: wrap; gap: 10px;margin-left: 10px">
                                                <img id="thumbnail-image" src="{{ $product->thumbnail }}"
                                                    alt="Thumbnail old"
                                                    style="max-width: 150px; max-height: 150px; object-fit: cover;border: 1px solid rgb(221, 221, 221);margin:10px ">
                                            </div>
                                        </div>

                                        <div class="card mb-6">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 card-title">Upload New Video</h5>
                                            </div>
                                            <div class="card-body">
                                                <input type="file" class="form-control" name="video"
                                                    id="video-upload" accept="video/*">
                                                <video id="video-preview" controls
                                                    style="display:none; margin-top: 10px; width: 100%; max-height: 300px;">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                                        <script>
                                            document.getElementById('video-upload').addEventListener('change', function(event) {
                                                const file = event.target.files[0];
                                                const videoPreview = document.getElementById('video-preview');

                                                if (file) {
                                                    const objectURL = URL.createObjectURL(file);
                                                    videoPreview.src = objectURL;
                                                    videoPreview.style.display = 'block'; // Show the video player
                                                } else {
                                                    videoPreview.src = '';
                                                    videoPreview.style.display = 'none'; // Hide the video player if no file is selected
                                                }
                                            });
                                        </script>
                                        @if ($product->video)
                                        <div class="card mb-6">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 card-title">Existing Video</h5>
                                            </div>
                                            <div id="existing-video-container" class="card-body" style="margin-top: 10px;">
                                                <div class="video-container">
                                                    <video controls style="max-width: 100%; max-height: 600px; object-fit: cover; margin: 7px; padding: 10px;">
                                                        <source src="{{ $product->video }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                                <button type="button" class="btn btn-danger btn-sm mt-2" id="remove-existing-video" style="margin-left: 29px;">Remove Existing Video</button>
                                            </div>
                                        </div>
                                        
                                        @endif

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const videoInput = document.getElementById('video-upload');
                                                const existingVideoContainer = document.getElementById('existing-video-container');
                                                const removeExistingVideoButton = document.getElementById('remove-existing-video');

                                                // Handle the removal of the existing video
                                                if (removeExistingVideoButton) {
                                                    removeExistingVideoButton.addEventListener('click', function() {
                                                        if (confirm('Are you sure you want to remove the existing video?')) {
                                                            existingVideoContainer.remove(); // Remove the video container from the DOM
                                                            videoInput.value = '';
                                                        }
                                                    });
                                                }
                                            });
                                        </script>


                                        <!-- /Media -->

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
                                                        img.style.maxWidth = "100px"; // Adjust the image preview size if needed
                                                        img.style.maxHeight = "100px";
                                                        img.style.objectFit = "cover"; // Ensure images are not distorted
                                                        img.style.border = "1px solid #ddd"; // Optional: Add a border for better visibility
                                                        img.style.borderRadius = "4px"; // Optional: Round the corners
                                                        img.style.margin = "10px";

                                                        const removeBtn = document.createElement("button");
                                                        removeBtn.textContent = "Remove";
                                                        removeBtn.style.position = "absolute";
                                                        removeBtn.style.bottom = "5px";
                                                        removeBtn.style.right = "5px";
                                                        removeBtn.style.backgroundColor = "#ff4d4d"; // Red background
                                                        removeBtn.style.color = "#fff"; // White text
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

                                            function previewThumbnail(event) {
                                                const thumbnailImage = document.getElementById("thumbnail-image");
                                                const file = event.target.files[0];

                                                if (file) {
                                                    const reader = new FileReader();

                                                    reader.onload = function(e) {
                                                        thumbnailImage.src = e.target.result;
                                                        thumbnailImage.style.display = "block"; // Show the image preview
                                                        thumbnailImage.style.border = "1px solid #ddd"; // Optional: Add a border for better visibility
                                                        thumbnailImage.style.borderRadius = "4px"; // Optional: Round the corners
                                                    };

                                                    reader.readAsDataURL(file);
                                                } else {
                                                    thumbnailImage.style.display = "none"; // Hide the image preview if no file is selected
                                                }
                                            }

                                            document.addEventListener('DOMContentLoaded', function() {
                                                // const discardButton = document.getElementById('discard-button');
                                                // const form = document.getElementById('product-form');
                                                // const notification = document.getElementById('notification');

                                                // discardButton.addEventListener('click', function() {
                                                //     form.reset();
                                                //     document.getElementById("image-preview").innerHTML = "";
                                                //     document.getElementById("thumbnail-image").style.display = "none";
                                                //     selectedImages = []; // Clear the selected images list
                                                //     document.getElementById("image-upload").files = new DataTransfer()
                                                //         .files; // Clear the file input
                                                // });
                                            });
                                        </script>
                                        <!-- Variants -->
                                        <div class="card mb-6">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Variants</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <!-- Colors Section -->
                                                    <div class="col-md-6 mb-4">
                                                        <h6 class="fw-bold mb-3">Colors</h6>
                                                        <div data-repeater-list="attributes">
                                                            <div data-repeater-item>
                                                                <div class="d-flex flex-column">
                                                                    @php
                                                                        $colors = colors(); // Fetch all available colors
                                                                        $sizes = size();
                                                                        $existingColorIds = $product['attributes']
                                                                            ->pluck('color_id')
                                                                            ->filter()
                                                                            ->toArray();
                                                                        $existingSizeIds = $product['attributes']
                                                                            ->pluck('size_id')
                                                                            ->filter()
                                                                            ->toArray(); // Existing color IDs
                                                                        // Existing color IDs
                                                                        $commonData = app('commonData');
                                                                    @endphp
                                                                    @foreach ($colors as $color)
                                                                        <div class="form-check mb-2">
                                                                            <input type="checkbox"
                                                                                name="attributes[][color_id]"
                                                                                value="{{ $color->color_id }}"
                                                                                id="color-{{ $color->color_id }}"
                                                                                class="form-check-input"
                                                                                @if (in_array($color->color_id, $existingColorIds)) checked @endif>
                                                                            <label class="form-check-label"
                                                                                for="color-{{ $color->color_id }}">{{ $color->name }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- Sizes Section -->
                                                    <div class="col-md-6 mb-4">
                                                        <h6 class="fw-bold mb-3">Sizes</h6>
                                                        <div data-repeater-list="attributes">
                                                            <div data-repeater-item>
                                                                <div class="d-flex flex-column">
                                                                    @foreach ($sizes as $size)
                                                                        <div class="form-check mb-2">
                                                                            <input type="checkbox"
                                                                                name="attributes[][size_id]"
                                                                                value="{{ $size->size_id }}"
                                                                                id="size-{{ $size->size_id }}"
                                                                                class="form-check-input"
                                                                                @if (in_array($size->size_id, $existingSizeIds)) checked @endif>

                                                                            <label class="form-check-label"
                                                                                for="size-{{ $size->size_id }}">{{ $size->size }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /Variants -->
                                    <!-- Second column -->
                                    <div class="col-12 col-lg-4">
                                        <!-- Organize Card -->
                                        <div class="card mb-6">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Organize</h5>
                                            </div>
                                            <div class="card-body">
                                                <!-- Vendor -->
                                                {{-- <div class="mb-5 col ecommerce-select2-dropdown">
                                                  <select id="vendor" class="form-select form-select-sm" data-value="Select Vendor">
                                                      <option value="">Select Vendor</option>
                                                      <option value="men-clothing">Men's Clothing</option>
                                                      <option value="women-clothing">Women's Clothing</option>
                                                      <option value="kid-clothing">Kid's Clothing</option>
                                                  </select>
                                              </div> --}}

                                                <!-- Category -->
                                                <div
                                                    class="mb-5 col ecommerce-select2-dropdown d-flex justify-content-between align-items-center">
                                                    <div class="w-100 me-4">
                                                        <select id="category-org" name="category_id"
                                                            class="form-select form-select-sm"
                                                            data-placeholder="Select Category">
                                                            @foreach ($commonData['categories'] as $category)
                                                                <option value="{{ $category->category_id }}"
                                                                    {{ $category->category_id == $product->category_id ? 'selected' : '' }}>
                                                                    {{ $category->category_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    {{-- <div>
                                                      <button class="btn btn-outline-primary btn-icon">
                                                          <i class="ri-add-line"></i>
                                                      </button>
                                                  </div> --}}
                                                </div>

                                                {{-- <!-- Collection -->
                                              <div class="mb-5 col ecommerce-select2-dropdown">
                                                  <select id="collection" class="form-select form-select-sm" data-placeholder="Collection">
                                                      <option value="">Collection</option>
                                                      <option value="men-clothing">Men's Clothing</option>
                                                      <option value="women-clothing">Women's Clothing</option>
                                                      <option value="kid-clothing">Kid's Clothing</option>
                                                  </select>
                                              </div>
                          
                                              <!-- Status -->
                                              <div class="mb-5 col ecommerce-select2-dropdown">
                                                  <select id="status-org" class="form-select form-select-sm" data-placeholder="Select Status">
                                                      <option value="">Select Status</option>
                                                      <option value="Published">Published</option>
                                                      <option value="Scheduled">Scheduled</option>
                                                      <option value="Inactive">Inactive</option>
                                                  </select>
                                              </div>
                          
                                              <!-- Tags -->
                                              <div class="mb-4">
                                                  <div class="form-floating form-floating-outline">
                                                      <input id="ecommerce-product-tags" class="form-control h-auto" name="ecommerce-product-tags" value="Normal,Standard,Premium" aria-label="Product Tags" />
                                                      <label for="ecommerce-product-tags">Tags</label>
                                                  </div>
                                              </div> --}}
                                            </div>
                                        </div>
                                        <!-- /Organize Card -->
                                        <!-- Pricing Card -->
                                        <div class="card mb-6">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Pricing</h5>
                                            </div>
                                            <div class="card-body">
                                                <!-- Base Price -->
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="text" class="form-control"
                                                        id="ecommerce-product-price" value="{{ $product->price }}"
                                                        name="price" aria-label="Product price">
                                                    <label for="ecommerce-product-price">Price</label>
                                                </div>

                                                <!-- Discounted Price -->
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="text" class="form-control"
                                                        id="ecommerce-product-discount-price"
                                                        value="{{ $product->cost }}" name="cost"
                                                        aria-label="Product discounted price">
                                                    <label for="ecommerce-product-discount-price">Cost</label>
                                                </div>

                                                <!-- Charge tax check box -->
                                                {{-- <div class="form-check my-2">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="price-charge-tax" checked>
                                                    <label class="mb-2 text-heading" for="price-charge-tax">
                                                        Charge tax on this product
                                                    </label>
                                                </div> --}}

                                                <!-- Instock switch -->
                                                {{-- <div
                                                    class="d-flex justify-content-between align-items-center border-top pt-4 pb-2">
                                                    <p class="mb-0">In stock</p>
                                                    <div class="w-25 d-flex justify-content-end">
                                                        <div class="form-check form-switch me-n3">
                                                            <input type="checkbox" class="form-check-input" checked />
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <!-- Add Specification -->
                                        <div class="card mb-6">
                                            <div class="card-header">
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <div id="specifications-container">
                                                        <!-- Dynamic Specification Inputs Will Be Added Here -->
                                                    </div>
                                                    <button type="button" class="btn btn-secondary mt-3"
                                                        id="add-specification">Add Specification</button>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const specificationsContainer = document.getElementById('specifications-container');
                                                const addSpecificationButton = document.getElementById('add-specification');

                                                function addSpecificationField(key = '', value = '', index = null) {
                                                    if (index === null) {
                                                        index = specificationsContainer.children.length;
                                                    }

                                                    const specificationDiv = document.createElement('div');
                                                    specificationDiv.classList.add('mb-3');
                                                    specificationDiv.innerHTML = `
                                                        <div class="d-flex justify-content-between">
                                                            <div class="form-floating form-floating-outline w-45 me-2">
                                                                <input type="text" class="form-control" name="specifications[${index}][key]" placeholder="Specification Key" value="${key}">
                                                                <label>Key</label>
                                                            </div>
                                                            <div class="form-floating form-floating-outline w-45">
                                                                <input type="text" class="form-control" name="specifications[${index}][value]" placeholder="Specification Value" value="${value}">
                                                                <label>Value</label>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeSpecification(this)">Remove</button>
                                                    `;
                                                    specificationsContainer.appendChild(specificationDiv);
                                                }

                                                window.removeSpecification = function(button) {
                                                    button.parentElement.remove();
                                                    updateSpecificationIndexes();
                                                };

                                                addSpecificationButton.addEventListener('click', function() {
                                                    addSpecificationField();
                                                });

                                                function updateSpecificationIndexes() {
                                                    const specs = specificationsContainer.children;
                                                    for (let i = 0; i < specs.length; i++) {
                                                        const keyInput = specs[i].querySelector('input[name$="[key]"]');
                                                        const valueInput = specs[i].querySelector('input[name$="[value]"]');
                                                        if (keyInput) keyInput.name = `specifications[${i}][key]`;
                                                        if (valueInput) valueInput.name = `specifications[${i}][value]`;
                                                    }
                                                }

                                                // Example: Prepopulate specifications if editing an existing product
                                                const existingSpecifications = @json($product->specification ?? []);
                                                existingSpecifications.forEach((spec, index) => {
                                                    addSpecificationField(spec.key, spec.value, index);
                                                });
                                            });
                                        </script>


                                        <!-- /Second column -->
                                    </div>
                            </form>

                            <!-- Restock Tab -->
                        </div>
                    </div>
                    <!-- /Options-->
                </div>
            </div>
        </div>
        <!-- /Inventory -->
    </div>
    <!-- /Second column -->
    </div>
    </div>
    </div>
    <!-- / Content -->






    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
    </div>



    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>


    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    </div>
    <!-- / Layout wrapper -->
    <!-- Other head elements -->

    <!-- Core JS -->
    <script src="{{ asset('admin_asset/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/menu.js') }}"></script>


    <!-- Main JS -->
    <script src="{{ asset('admin_asset/js/main.js') }}"></script>

    <!-- Page JS -->

</body>

</html>
