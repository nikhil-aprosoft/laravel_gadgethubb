<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Add-Categry</title>

    <x-admin.head />
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -->
            <x-admin.aside-menu/>
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

                            <form id="product-form" action="{{ route('categories.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 gap-4 gap-md-0">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h4 class="mb-1">Add a new Category</h4>
                                    </div>
                                    <div class="d-flex align-content-center flex-wrap gap-4">
                                        <button type="button" id="discard-button"
                                            class="btn btn-outline-primary">Discard</button>
                                        <button type="submit" class="btn btn-primary">Publish Category</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- First column -->
                                    <div class="col-12 col-lg-8">
                                        <!-- Category Information -->
                                        <div class="card mb-6">
                                           
                                            <div class="card-body">
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <select id="category-org" name="parent_category_id"
                                                        class="form-select form-select-sm"
                                                        data-placeholder="Select Category">
                                                        <option value="">Select Parent Category</option>
                                                        @foreach ($parentCategory as $pC)                                                            
                                                        <option value="{{$pC->id}}">
                                                          {{$pC->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-6">
                                            
                                            <div class="card-body">
                                                <div class="form-floating form-floating-outline mb-5">
                                                    <input type="text" class="form-control" id="category_name"
                                                        placeholder="Category title" name="category_name"
                                                        aria-label="Category title" required>
                                                    <label for="category_name">Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Media -->
                                        <div class="card mb-6">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0 card-title">Image</h5>
                                            </div>
                                            <div class="card-body">
                                                <input type="file" class="form-control" id="image-upload"
                                                    name="category_image"  required accept="image/*" 
                                                    onchange="previewImages(event)">
                                            </div>
                                        </div>

                                        <div class="card mb-6">
                                            <div id="image-preview"
                                                style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
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
    {{-- <script src="{{ asset('admin_asset/js/app-ecommerce-product-add.js') }}"></script> --}}


</body>

</html>
