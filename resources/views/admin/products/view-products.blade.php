<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View product</title>
    <x-admin.head />
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                        <div class="card mb-6">
                            <div class="card-widget-separator-wrapper">
                                <div class="card-body card-widget-separator">
                                    <div class="row gy-4 gy-sm-1">
                                        <div class="col-sm-6 col-lg-3">
                                            <div
                                                class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
                                                <div>
                                                    <p class="mb-1">In-store Sales</p>
                                                    <h4 class="mb-1">$5,345.43</h4>
                                                    <p class="mb-0"><span class="me-2">5k orders</span><span
                                                            class="badge rounded-pill bg-label-success">+5.7%</span></p>
                                                </div>
                                                <div class="avatar me-sm-6">
                                                    <span
                                                        class="avatar-initial rounded bg-label-secondary text-heading">
                                                        <i class="ri-home-6-line ri-24px"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <hr class="d-none d-sm-block d-lg-none me-6">
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div
                                                class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-4 pb-sm-0">
                                                <div>
                                                    <p class="mb-1">Website Sales</p>
                                                    <h4 class="mb-1">$674,347.12</h4>
                                                    <p class="mb-0"><span class="me-2">21k orders</span><span
                                                            class="badge rounded-pill bg-label-success">+12.4%</span>
                                                    </p>
                                                </div>
                                                <div class="avatar me-lg-6">
                                                    <span
                                                        class="avatar-initial rounded bg-label-secondary text-heading">
                                                        <i class="ri-computer-line ri-24px"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <hr class="d-none d-sm-block d-lg-none">
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div
                                                class="d-flex justify-content-between align-items-start border-end pb-4 pb-sm-0 card-widget-3">
                                                <div>
                                                    <p class="mb-1">Discount</p>
                                                    <h4 class="mb-1">$14,235.12</h4>
                                                    <p class="mb-0">6k orders</p>
                                                </div>
                                                <div class="avatar me-sm-6">
                                                    <span
                                                        class="avatar-initial rounded bg-label-secondary text-heading">
                                                        <i class="ri-gift-line ri-24px"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <p class="mb-1">Affiliate</p>
                                                    <h4 class="mb-1">$8,345.23</h4>
                                                    <p class="mb-0"><span class="me-2">150 orders</span><span
                                                            class="badge rounded-pill bg-label-danger">-3.5%</span></p>
                                                </div>
                                                <div class="avatar">
                                                    <span
                                                        class="avatar-initial rounded bg-label-secondary text-heading">
                                                        <i class="ri-money-dollar-circle-line ri-24px"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $globalService = app('commonData');
                        @endphp
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Filter</h5>
                                <div class="d-flex justify-content-between align-items-center row pt-4 gap-4 gap-md-0">
                                    <div class="col-md-4 product_category">
                                        <select id="ProductCategory" class="form-select text-capitalize">
                                            @foreach ($globalService['categories'] as $item)
                                                <option value="{{ $item['category_id'] }}">{{ $item['category_name'] }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-4 product_status">
                                        <select id="ProductStatus" class="form-select text-capitalize">
                                            <option value="">Select Status</option>
                                            <option value="Scheduled">Scheduled</option>
                                            <option value="Publish">Publish</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 product_stock">
                                        <select id="ProductStock" class="form-select text-capitalize">
                                            <option value=""> Stock </option>
                                            <option value="Out_of_Stock">Out of Stock</option>
                                            <option value="In_Stock">In Stock</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-datatable table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="card-header d-flex border-top rounded-0 flex-wrap py-0 pb-5 pb-md-0">
                                        <!-- Button on the Left Side -->
                                        <div class="button-container me-auto">
                                            <div
                                                class="dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center gap-4 pt-0 m-5">
                                                <div class="dt-buttons btn-group flex-wrap d-flex">
                                                    <a href="{{ url('admin/products/create') }}"
                                                        class="btn btn-secondary add-new btn-primary waves-effect waves-light"
                                                        tabindex="0" aria-controls="DataTables_Table_0"
                                                        type="button">
                                                        <span>
                                                            <i class="ri-add-line ri-16px me-0 me-sm-1_5"></i>
                                                            <span class="d-none d-sm-inline-block">Add Product</span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table class="datatables-products table dataTable no-footer dtr-column"
                                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"
                                    style="width: 1396px;">
                                    <thead>
                                        <tr>
                                            <th class="control sorting_disabled dtr-hidden" rowspan="1"
                                                colspan="1" style="width: 0px; display: none;" aria-label="">
                                            </th>

                                            <th class="sorting sorting_asc" tabindex="0"
                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 446px;"
                                                aria-label="product: activate to sort column descending"
                                                aria-sort="ascending">product</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 140px;"
                                                aria-label="category: activate to sort column ascending">category
                                            </th>
                                            {{-- <th class="sorting_disabled" rowspan="1" colspan="1"
                                                style="width: 55px;" aria-label="stock">stock</th> --}}
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 46px;"
                                                aria-label="sku: activate to sort column ascending">sku</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 76px;"
                                                aria-label="price: activate to sort column ascending">price</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 36px;"
                                                aria-label="qty: activate to sort column ascending">qty</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 99px;"
                                                aria-label="status: activate to sort column ascending">status</th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1"
                                                style="width: 88px;" aria-label="Actions">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($products as $item)
                                            <tr class="odd">
                                                <td class="sorting_1">
                                                    <div
                                                        class="d-flex justify-content-start align-items-center product-name">
                                                        <div class="avatar-wrapper me-4">
                                                            <div class="avatar rounded-2 bg-label-secondary"><img
                                                                    src="{{ $item->thumbnail }}" alt="Product-15"
                                                                    class="rounded-2"></div>
                                                        </div>

                                                        <div class="d-flex flex-column"><span
                                                                class="text-nowrap text-heading fw-medium">{{ $item->product_name }}</span>
                                                            <small class="text-truncate d-none d-sm-block">
                                                           
                                                            
                                                            </small>
                                                        </div>
                                                </td>
                                                <td>
                                                    <h6 class="text-truncate d-flex align-items-center mb-0 fw-normal">
                                                        <span
                                                            class="avatar-sm rounded-circle d-flex justify-content-center align-items-center bg-label-primary me-4"><i
                                                                class="ri-computer-line"></i></span>{{ $item->category->category_name }}
                                                    </h6>
                                                </td>
                                                {{-- <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            role="switch"
                                                            id="flexSwitchCheckChecked{{ $item->product_id }}"
                                                            @if ($item->quantity > 0) checked @endif>
                                                    </div>
                                                </td> --}}
                                                <td><span>{{ $item->sku }}</span></td>
                                                <td><span>{{ $item->price }}</span></td>
                                                <td><span>{{ $item->quantity }}</span></td>
                                                <td><span
                                                        class="badge rounded-pill bg-label-{{ $item->is_active == 1 ? 'success' : 'danger' }}"
                                                        text-capitalized="">{{ $item->is_active == 1 ? 'Published' : 'Deactivated' }}</span>
                                                </td>
                                                <td>

                                                    <div class="d-inline-block text-nowrap">
                                                        <button
                                                            class="btn btn-sm btn-icon btn-text-secondary waves-effect rounded-pill text-body dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="ri-edit-box-line ri-22px"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                                            <a href="{{url('admin/products/update/'.$item->slug)}}" class="dropdown-item"
                                                                >View</a>
                                                                @if($item->is_active == 1)
                                                            <a href="{{url('admin/products/activate-deactivate/'.$item->slug)}}"
                                                                class="dropdown-item">Deactivate</a>
                                                                @else
                                                                <a href="{{url('admin/products/activate-deactivate/'.$item->slug)}}"
                                                                    class="dropdown-item">Activate</a>
                                                                    @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                <div class="row mx-1">
                                    <!-- Pagination Container -->
                                    <div class="pagination-container d-flex justify-content-end mt-3">
                                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                            <ul class="pagination">
                                                {{-- Previous Button --}}
                                                @if ($products->onFirstPage())
                                                    <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                                                        <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" class="page-link waves-effect">Previous</a>
                                                    </li>
                                                @else
                                                    <li class="paginate_button page-item previous" id="DataTables_Table_0_previous">
                                                        <a href="{{ $products->previousPageUrl() }}" aria-controls="DataTables_Table_0" role="link" class="page-link waves-effect">Previous</a>
                                                    </li>
                                                @endif
                                
                                                {{-- Pagination Links --}}
                                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                                    <li class="paginate_button page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                                                        <a href="{{ $products->url($i) }}" aria-controls="DataTables_Table_0" role="link" class="page-link waves-effect">{{ $i }}</a>
                                                    </li>
                                                @endfor
                                
                                                {{-- Next Button --}}
                                                @if ($products->hasMorePages())
                                                    <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                                                        <a href="{{ $products->nextPageUrl() }}" aria-controls="DataTables_Table_0" role="link" class="page-link waves-effect">Next</a>
                                                    </li>
                                                @else
                                                    <li class="paginate_button page-item next disabled" id="DataTables_Table_0_next">
                                                        <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" class="page-link waves-effect">Next</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div style="width: 1%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Options-->
            </div>
        </div>
    </div>
    <!-- /Inventory -->
    </div>
    <!-- /Second column -->
    {{-- switch modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener to all switches
            document.querySelectorAll('.form-check-input').forEach(function(switchElement) {
                switchElement.addEventListener('change', function() {
                    if (!this.checked) { // If switch is being turned off
                        // Show confirmation modal
                        var confirmModal = new bootstrap.Modal(document.getElementById(
                            'confirmModal'));
                        confirmModal.show();

                        // Handle confirmation
                        document.getElementById('confirmBtn').addEventListener('click', function() {
                            // Proceed with out-of-stock logic
                            // Example: Send an AJAX request to update the status
                            var itemId = switchElement.id.replace('flexSwitchCheckChecked',
                                '');
                            // Make sure you include necessary CSRF token and AJAX handling
                            fetch(`/update-stock-status/${itemId}`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content')
                                    },
                                    body: JSON.stringify({
                                        in_stock: false
                                    })
                                }).then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Optionally, provide feedback to the user
                                    }
                                }).catch(error => {
                                    console.error('Error:', error);
                                });

                            confirmModal.hide();
                        }, {
                            once: true
                        }); // Ensure event listener is removed after use
                    }
                });
            });
        });
    </script>
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm
                        Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to mark this product as out of
                    stock?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmBtn" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
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
    <!-- Core JS -->
    <script src="{{ asset('admin_asset/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('admin_asset/js/main.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('admin_asset/js/app-ecommerce-product-add.js') }}"></script>
</body>

</html>
