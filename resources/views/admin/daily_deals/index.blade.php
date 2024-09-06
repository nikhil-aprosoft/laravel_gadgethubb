<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
    data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>View-Deals</title>
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
                                        <div
                                            class="card-header d-flex rounded-0 flex-wrap py-0 pb-5 pb-md-0 m-5 justify-content-between align-items-center">
                                            <!-- Search Input or Other Content on the Left Side -->
                                            <div class="d-flex align-items-center me-auto">
                                                <!-- Add any additional content here if needed, like a search input -->
                                            </div>

                                            <!-- Add Deal Button on the Right Side -->
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-secondary add-new btn-primary ms-n1 waves-effect waves-light"
                                                    tabindex="0" aria-controls="DataTables_Table_0" type="button"
                                                    data-bs-toggle="offcanvas"
                                                    data-bs-target="#offcanvasEcommerceCategoryList">
                                                    <span>
                                                        <i class="ri-add-line me-0 me-sm-1"></i>
                                                        <span class="d-none d-sm-inline-block" style="color: white;"><a href="{{ url('admin/daily-deals/create')}}"style="color: white;">Add Deal</a></span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>

                                        @if ($errors->any())
                                            <div class="alert alert-danger mt-3">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif


                                        <div class="container">
                                            <h3 class="mb-4">View Deals</h3>
                                            <table class="datatables-daily-deals table dataTable no-footer dtr-column"
                                                id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Discount Amount</th>
                                                        <th>Discount Type</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dailyDeals as $deal)
                                                        <tr>
                                                        <tr class="odd">
                                                            <td class="sorting_1">
                                                                <div
                                                                    class="d-flex justify-content-start align-items-center product-name">
                                                                    <div class="avatar-wrapper me-4">
                                                                        <div
                                                                            class="avatar rounded-2 bg-label-secondary">
                                                                            <img src="{{ $deal->product->thumbnail }}"
                                                                                alt="Product-15" class="rounded-2">
                                                                        </div>
                                                                    </div>

                                                                    <div class="d-flex flex-column"><span
                                                                            class="text-nowrap text-heading fw-medium">{{ $deal->product->product_name }}</span>
                                                                        <small class="text-truncate d-none d-sm-block">
                                                                            @php
                                                                                $words = explode(
                                                                                    ' ',
                                                                                    $deal->product->short_desc,
                                                                                );
                                                                                $limitedWords = array_slice(
                                                                                    $words,
                                                                                    0,
                                                                                    15,
                                                                                );
                                                                                $limitedDesc = implode(
                                                                                    ' ',
                                                                                    $limitedWords,
                                                                                );
                                                                            @endphp

                                                                            @foreach (explode('|', $limitedDesc) as $desc)
                                                                                @if (trim($desc))
                                                                                    <li>{{ trim($desc) }}</li>
                                                                                @endif
                                                                            @endforeach
                                                                        </small>
                                                                    </div>
                                                            </td>
                                                            <!-- Assuming there's a relationship with Product -->
                                                            <td>{{ $deal->discount_amount }}</td>
                                                            <td>{{ $deal->discount_type }}</td>
                                                            <td>{{ $deal->start_date->format('Y-m-d') }}</td>
                                                            <td>{{ $deal->end_date ? $deal->end_date->format('Y-m-d') : 'N/A' }}
                                                            </td>
                                                            <td>{{ ucfirst($deal->status) }}</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        More actions
                                                                    </button>
                                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                        <!-- Edit Button -->
                                                                        <li>
                                                                            <a class="dropdown-item" href="{{ route('daily-deals.edit', $deal->id) }}">
                                                                                <button type="button" class="btn btn-primary w-100">Edit</button>
                                                                            </a>
                                                                        </li>
                                                                        <!-- Delete Form -->
                                                                        <li>
                                                                            <form action="{{ route('daily-deals.destroy', $deal->id) }}" method="POST" style="display:inline-block;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger w-100" style="margin-left: 24px;" onclick="return confirm('Are you sure?')">Delete</button>
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row mx-1">
                                            <style>
                                                /* Custom CSS for dropdown spacing */
                                                .dropdown-menu {
                                                    padding: 0; /* Remove default padding */
                                                    margin: 0; /* Remove default margin */
                                                }
                                            
                                                .dropdown-item {
                                                    padding: 0.5rem 1rem; /* Adjust padding to your preference */
                                                    margin: 0; /* Ensure no margin around items */
                                                }
                                            
                                                .dropdown-item button {
                                                    margin: 0; /* Remove margin from buttons inside dropdown */
                                                }
                                            
                                                .btn {
                                                    margin: 0.2rem; /* Add margin to buttons if needed */
                                                }
                                            
                                                .dropdown-menu li {
                                                    margin-bottom: 0.5rem; /* Add margin between list items */
                                                }
                                            </style>
                                            

                                        </div>

                                        <div style="width: 1%;"></div>
                                    </div>
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
    {{-- product image --}}
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
    <!-- / Layout wrapper -->
    <script src="{{ asset('admin_asset/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/menu.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin_asset/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    </script>
</body>

</html>

<!-- beautify ignore:end -->
