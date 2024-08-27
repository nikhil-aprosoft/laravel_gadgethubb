<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
    data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Categories</title>
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
                        <div class="app-ecommerce-category">
                            <!-- Category List Table -->
                            <div class="card">
                                <div class="card-datatable table-responsive">
                                    <div id="DataTables_Table_0_wrapper"
                                        class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <div class="card-header d-flex rounded-0 flex-wrap py-0 pb-5 pb-md-0 m-5">
                                            <div class="me-5 ms-n2">
                                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                    <label><input type="search" class="form-control form-control-sm"
                                                            placeholder="Search"
                                                            aria-controls="DataTables_Table_0"></label>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex justify-content-start justify-content-md-end align-items-baseline">
                                                <div
                                                    class="dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center mb-0 gap-4 pt-0">
                                                    <div class="dt-buttons btn-group flex-wrap">
                                                        <button
                                                            class="btn btn-secondary add-new btn-primary ms-n1 waves-effect waves-light"
                                                            tabindex="0" aria-controls="DataTables_Table_0"
                                                            type="button" data-bs-toggle="offcanvas"
                                                            data-bs-target="#offcanvasEcommerceCategoryList">
                                                            <span>
                                                                <i class="ri-add-line me-0 me-sm-1"></i>
                                                                <span class="d-none d-sm-inline-block">Add
                                                                    Category</span>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="datatables-category-list table dataTable no-footer dtr-column"
                                            id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"
                                            style="width: 1394px;">
                                            <thead>
                                                <tr>
                                                    <th class="control sorting_disabled dtr-hidden" rowspan="1"
                                                        colspan="1" style="width: 0px; display: none;"
                                                        aria-label="">
                                                    </th>
                                                    <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all"
                                                        rowspan="1" colspan="1" style="width: 18px;"
                                                        data-col="1" aria-label=""><input type="checkbox"
                                                            class="form-check-input">
                                                    </th>
                                                    <th class="sorting sorting_desc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 699px;"
                                                        aria-label="Categories: activate to sort column ascending"
                                                        aria-sort="descending">Categories</th>
                                                    <th class="text-nowrap text-sm-end sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 191px;"
                                                        aria-label="Total Products &amp;nbsp;: activate to sort column ascending">
                                                        Total Products &nbsp;</th>
                                                    <th class="text-nowrap text-sm-end sorting_disabled" rowspan="1"
                                                        colspan="1" style="width: 160px;" aria-label="Total Earning">
                                                        Total Earning</th>
                                                    <th class="text-lg-center sorting_disabled" rowspan="1"
                                                        colspan="1" style="width: 118px;" aria-label="Actions">
                                                        Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php
                                                $commonData = app('commonData');
                                                
                                                $parentCategoriesMega = $commonData['parentCategoriesMega'];
                                                ?>
                                                @foreach ($category as $item)
                                                    <tr class="odd">
                                                        <td class="  control" style="display: none;" tabindex="0">
                                                        </td>
                                                        <td class="  dt-checkboxes-cell"><input type="checkbox"
                                                                class="dt-checkboxes form-check-input"></td>
                                                        <td class="sorting_1">
                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="avatar-wrapper me-3 rounded-2 bg-label-secondary user-name">
                                                                    <div class="avatar">
                                                                        <img src="{{ $item->category_image }}"
                                                                            alt="Product-8">
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <span
                                                                        class="text-heading fw-medium text-wrap">{{ $item->category_name }}</span><small
                                                                        class="text-truncate mb-0 d-none d-sm-block">
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-sm-end pe-3">{{ count($item['products']) }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-sm-end">[It will be dynamic after orders
                                                                table]</div>
                                                        </td>
                                                        <td>
                                                            <div
                                                                class="d-flex align-items-sm-center justify-content-sm-center">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal{{ $item->id }}">
                                                                    Edit
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $item->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="exampleModalLabel{{ $item->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5"
                                                                        id="exampleModalLabel">Edit Category</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('categories.update', $item->category_id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div
                                                                            class="form-floating form-floating-outline mb-5 fv-plugins-icon-container">
                                                                            <select class="form-select"
                                                                                aria-label="Default select example"
                                                                                name="parent_category_id">
                                                                                <option selected>Open this select menu
                                                                                </option>
                                                                                @foreach ($parentCategoriesMega as $prM)
                                                                                    <option value="{{ $prM->id }}"
                                                                                        {{ $prM->id == $item->parent_category_id ? 'selected' : '' }}>
                                                                                        {{ $prM->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div
                                                                            class="form-floating form-floating-outline mb-5 fv-plugins-icon-container">
                                                                            <input type="text" class="form-control"
                                                                                id="ecommerce-category-title"
                                                                                value="{{ $item->category_name }}"
                                                                                name="category_name"
                                                                                aria-label="category title">
                                                                            <label
                                                                                for="ecommerce-category-title">Category-Name</label>
                                                                            <div
                                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="form-floating form-floating-outline mb-5 fv-plugins-icon-container">
                                                                            <input type="file" class="form-control"
                                                                                id="category-image-input"
                                                                                name="category_image"
                                                                                aria-label="category title"
                                                                                onchange="previewImage()">
                                                                            <label
                                                                                for="category-image-input">Category-Image</label>
                                                                            <div
                                                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                                            </div>
                                                                            <!-- Image Preview -->
                                                                            <img id="category-image-preview"
                                                                                src="{{ $item->category_image }}"
                                                                                class="img-fluid mt-2"
                                                                                alt="category_image">
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save changes</button>
                                                                </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <script>
                                                    function previewImage() {
                                                        const fileInput = document.getElementById('category-image-input');
                                                        const file = fileInput.files[0];
                                                        const preview = document.getElementById('category-image-preview');

                                                        if (file) {
                                                            const reader = new FileReader();
                                                            reader.onload = function(e) {
                                                                preview.src = e.target.result;
                                                            }
                                                            reader.readAsDataURL(file);
                                                        } else {
                                                            preview.src = ''; // Fallback or previous image source if no file is selected
                                                        }
                                                    }
                                                </script>
                                                <style>
                                                    .avatar-wrapper {
                                                        width: 150px;
                                                        /* Adjust width as needed */
                                                        height: 150px;
                                                        /* Adjust height as needed */
                                                        display: flex;
                                                        justify-content: center;
                                                        align-items: center;
                                                        overflow: hidden;
                                                    }

                                                    .avatar {
                                                        width: 100%;
                                                        height: 100%;
                                                        display: flex;
                                                        justify-content: center;
                                                        align-items: center;
                                                    }

                                                    .avatar img {
                                                        width: 100%;
                                                        height: 100%;
                                                        object-fit: cover;
                                                        /* Ensures the image covers the container while maintaining its aspect ratio */
                                                    }
                                                </style>
                                            </tbody>
                                        </table>
                                        <div class="row mx-1">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_info m-3" role="status" aria-live="polite">
                                                    Showing {{ $category->firstItem() }} to
                                                    {{ $category->lastItem() }} of {{ $category->total() }} entries
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_paginate paging_simple_numbers">
                                                    {{ $category->links() }}
                                                    <!-- This generates the pagination links -->
                                                </div>
                                            </div>
                                        </div>

                                        <div style="width: 1%;"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Offcanvas to add new customer -->
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEcommerceCategoryList"
                                aria-labelledby="offcanvasEcommerceCategoryListLabel">
                                <!-- Offcanvas Header -->
                                <div class="offcanvas-header py-6">
                                    <h5 id="offcanvasEcommerceCategoryListLabel" class="offcanvas-title">Add Category
                                    </h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <!-- Offcanvas Body -->
                                <div class="offcanvas-body border-top">
                                      <!-- Category Information -->
                                      <div class="card mb-6">
                                           
                                        <div class="card-body">
                                            <div class="form-floating form-floating-outline mb-5">
                                                <select id="category-org" name="parent_category_id"
                                                    class="form-select form-select-sm"
                                                    data-placeholder="Select Category">
                                                    <option value="">Select Parent Category</option>
                                                    @foreach ($parentCategoriesMega as $pC)                                                            
                                                    <option value="{{$pC->id}}">
                                                      {{$pC->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-6">
                                        <form id="product-form" action="{{ route('categories.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
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
                                            <button type="submit" class="btn btn-primary">Publish Category</button>
                                    </div>
                                </form>  
                                </div>
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
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>


        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>

    </div>
    <!-- / Layout wrapper -->
    <script src="{{ asset('admin_asset/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/menu.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin_asset/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>

<!-- beautify ignore:end -->
