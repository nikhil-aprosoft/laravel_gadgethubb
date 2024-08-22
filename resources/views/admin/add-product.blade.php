<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Add-Product</title>

    <x-admin.head />
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo ">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo me-1">
                            <span style="color:var(--bs-primary);">
                                <svg width="30" height="24" viewBox="0 0 250 196" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
                                        fill="currentColor" />
                                    <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z" fill="black" />
                                    <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z" fill="black" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
                                        fill="currentColor" />
                                    <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z" fill="black" />
                                    <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z" fill="black" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                                        fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                                        fill="white" fill-opacity="0.15" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                                        fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                                        fill="white" fill-opacity="0.3" />
                                </svg>
                            </span>
                        </span>
                        <span class="app-brand-text demo menu-text fw-semibold ms-2">Materio</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="menu-toggle-icon d-xl-block align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ri-git-commit-line"></i>
                            <div data-i18n="Wizard Examples">Products</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ url('add-product') }}" class="menu-link">
                                    <div data-i18n="Checkout">Add-Product</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="wizard-ex-property-listing.html" class="menu-link">
                                    <div data-i18n="Property Listing">Property Listing</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="wizard-ex-create-deal.html" class="menu-link">
                                    <div data-i18n="Create Deal">Create Deal</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </aside>
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

                            <form id="product-form" action="{{ route('products.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 gap-4 gap-md-0">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h4 class="mb-1">Add a new Product</h4>
                                        <p class="mb-0">Orders placed across your store</p>
                                    </div>
                                    <div class="d-flex align-content-center flex-wrap gap-4">
                                        <button type="button" id="discard-button"
                                            class="btn btn-outline-primary">Discard</button>
                                        <button type="submit" class="btn btn-primary">Publish Product</button>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const discardButton = document.getElementById('discard-button');
                                        const form = document.getElementById('product-form');

                                        discardButton.addEventListener('click', function() {
                                            form.reset();
                                            document.getElementById("image-preview").innerHTML = "";
                                            document.getElementById("thumbnail-image").style.display = "none";
                                        });
                                    });
                                </script>
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
                                                        placeholder="Product title" name="product_name"
                                                        aria-label="Product title" required>
                                                    <label for="product_name">Name</label>
                                                </div>

                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="text" class="form-control" id="model"
                                                        placeholder="Model" name="model">
                                                    <label for="model">Model</label>
                                                </div>

                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="text" class="form-control" id="sku"
                                                        placeholder="SKU" name="sku">
                                                    <label for="sku">SKU</label>
                                                </div>

                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="number" class="form-control" id="quantity"
                                                        placeholder="Quantity" name="quantity" aria-label="Quantity"
                                                        required>
                                                    <label for="quantity">Stock</label>
                                                </div>

                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="text" class="form-control" id="short_desc"
                                                        placeholder="Short Description" name="short_desc">
                                                    <label for="short_desc">Short Description</label>
                                                </div>

                                                <div class="form-floating form-floating-outline mb-5">
                                                    <textarea class="form-control" id="description" placeholder="Description" name="description" rows="3"></textarea>
                                                    <label for="description">Description</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Product Information -->

                                        <!-- Media -->
                                        <div class="card mb-6">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 card-title">Product Images</h5>
                                            </div>
                                            <div class="card-body">
                                                <input type="file" class="form-control"id="image-upload"
                                                    name="images[]" multiple accept="image/*"
                                                    onchange="previewImages(event)">
                                            </div>
                                        </div>

                                        <div class="card mb-6">
                                            <div id="image-preview"
                                                style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                                        </div>

                                        <div class="card mb-6">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 card-title">Thumbnail Image</h5>
                                            </div>
                                            <div class="card-body">
                                                <input type="file" id="thumbnail-upload" name="thumbnail"
                                                    class="form-control" accept="image/*"
                                                    onchange="previewThumbnail(event)">
                                                <div id="thumbnail-preview" style="margin-top: 10px;">
                                                    <img id="thumbnail-image" src="" alt="Thumbnail Preview"
                                                        style="max-width: 150px; max-height: 150px; object-fit: cover; display: none;">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Media -->

                                        <script>
                                            function previewImages(event) {
                                                const previewDiv = document.getElementById("image-preview");
                                                previewDiv.innerHTML = ""; // Clear previous previews

                                                const files = event.target.files;
                                                for (let i = 0; i < files.length; i++) {
                                                    const file = files[i];
                                                    const reader = new FileReader();

                                                    reader.onload = function(e) {
                                                        const img = document.createElement("img");
                                                        img.src = e.target.result;
                                                        img.style.maxWidth = "100px"; // Adjust the image preview size if needed
                                                        img.style.maxHeight = "100px";
                                                        img.style.objectFit = "cover"; // Ensure images are not distorted
                                                        img.style.border = "1px solid #ddd"; // Optional: Add a border for better visibility
                                                        img.style.borderRadius = "4px"; // Optional: Round the corners

                                                        // Add double-click event listener to remove image
                                                        img.addEventListener('dblclick', function() {
                                                            previewDiv.removeChild(img); // Remove the image from the preview
                                                        });

                                                        previewDiv.appendChild(img);
                                                    };

                                                    reader.readAsDataURL(file);
                                                }
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
                                                const discardButton = document.getElementById('discard-button');
                                                const form = document.getElementById('product-form');
                                                const notification = document.getElementById('notification');

                                                discardButton.addEventListener('click', function() {
                                                    form.reset();
                                                    document.getElementById("image-preview").innerHTML = "";
                                                    document.getElementById("thumbnail-image").style.display = "none";
                                                });

                                                form.addEventListener('submit', function(event) {
                                                    event.preventDefault(); // Prevent the default form submission

                                                    // Simulate a successful product addition (replace with your actual form submission logic)
                                                    setTimeout(function() {
                                                        notification.style.display = 'block'; // Show the notification
                                                        setTimeout(function() {
                                                            notification.style.display =
                                                            'none'; // Hide the notification after a few seconds
                                                        }, 5000); // Hide after 5 seconds
                                                    }, 1000); // Simulate network delay
                                                });
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
                                                                    @foreach ($colors as $color)
                                                                        <div class="form-check mb-2">
                                                                            <input type="checkbox"
                                                                                name="attributes[][color_id]"
                                                                                value="{{ $color->color_id }}"
                                                                                id="color-{{ $color->color_id }}"
                                                                                class="form-check-input">
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
                                                                                class="form-check-input">
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
                                                  <select id="vendor" class="form-select form-select-sm" data-placeholder="Select Vendor">
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
                                                            <option value="">Select Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->category_id }}">
                                                                    {{ $category->category_name }}</option>
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
                                                    <input type="number" class="form-control"
                                                        id="ecommerce-product-price" placeholder="Price"
                                                        name="price" aria-label="Product price">
                                                    <label for="ecommerce-product-price">Price</label>
                                                </div>

                                                <!-- Discounted Price -->
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="number" class="form-control"
                                                        id="ecommerce-product-discount-price"
                                                        placeholder="Discounted Price" name="cost"
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
                                        <!-- /Pricing Card -->
                                    </div>
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
    <script src="{{ asset('admin_asset/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('admin_asset/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/tagify/tagify.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin_asset/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('admin_asset/js/app-ecommerce-product-add.js') }}"></script>


</body>

</html>
