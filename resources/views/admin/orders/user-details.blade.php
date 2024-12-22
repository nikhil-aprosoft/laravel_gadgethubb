<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>User Details</title>
    <link rel="stylesheet" href="{{ asset('admin_asset/vendor/css/rtl/core.css') }}">
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


                        <div class="row">
                            <!-- User Sidebar -->
                            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                                <!-- User Card -->
                                <div class="card mb-6">
                                    <div class="card-body pt-12">
                                        <div class="user-avatar-section">
                                            <div class=" d-flex align-items-center flex-column">
                                                <img class="img-fluid rounded mb-4"
                                                    src="{{ asset('admin_asset/img/avatars/10.png') }}" height="120"
                                                    width="120" alt="User avatar" />
                                                <div class="user-info text-center">
                                                    <h5>Violet Mendoza</h5>
                                                    <span class="badge bg-label-danger rounded-pill">Customer</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                                            <div class="d-flex align-items-center me-5 gap-4">
                                                <div class="avatar">
                                                    <div class="avatar-initial bg-label-primary rounded">
                                                        <i class='ri-check-line ri-24px'></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0">{{ $paidOrderCount }}</h5>
                                                    <span>Paid Order</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-4">
                                                <div class="avatar">
                                                    <div class="avatar-initial bg-label-primary rounded">
                                                        <i class="ri-pie-chart-2-line ri-24px"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h5 class="mb-0">{{ $pendingOrderCount }}</h5>
                                                    <span>Pending Order</span>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="pb-4 border-bottom mb-4">Details</h5>
                                        <div class="info-container">
                                            <ul class="list-unstyled mb-6">
                                                <li class="mb-2">
                                                    <span class="h6">Username:</span>
                                                    <span>{{ $user->name }}</span>
                                                </li>
                                                <li class="mb-2">
                                                    <span class="h6">Email:</span>
                                                    <span>{{ $user->email }}</span>
                                                </li>
                                                <li class="mb-2">
                                                    <span class="h6">Status:</span>
                                                    <span class="badge bg-label-success rounded-pill">Active</span>
                                                </li>
                                                <li class="mb-2">
                                                    <span class="h6">Role:</span>
                                                    <span>Customer</span>
                                                </li>
                                                {{-- <li class="mb-2">
                                                    <span class="h6">Tax id:</span>
                                                    <span>Tax-8965</span>
                                                </li> --}}
                                                {{-- <li class="mb-2">
                                                    <span class="h6">Contact:</span>
                                                    <span>$</span>
                                                </li>
                                                <li class="mb-2">
                                                    <span class="h6">Languages:</span>
                                                    <span>French</span>
                                                </li>
                                                <li class="mb-2">
                                                    <span class="h6">Country:</span>
                                                    <span>England</span>
                                                </li> --}}
                                            </ul>
                                            {{-- <div class="d-flex justify-content-center">
                                                <a href="javascript:;" class="btn btn-primary me-4"
                                                    data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
                                                <a href="javascript:;"
                                                    class="btn btn-outline-danger suspend-user">Suspend</a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <!-- /User Card -->

                                <!-- /Plan Card -->
                            </div>
                            <!--/ User Sidebar -->


                            <!-- User Content -->
                            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                                <!-- User Tabs -->
                                <div class="nav-align-top">
                                    <ul class="nav nav-pills flex-column flex-md-row flex-wrap mb-6 row-gap-2">
                                        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                                                    class="ri-group-line me-1_5"></i>Account</a></li>
                                        {{-- <li class="nav-item"><a class="nav-link" href="app-user-view-security.html"><i
                                                    class="ri-lock-2-line me-1_5"></i>Security</a></li>
                                        <li class="nav-item"><a class="nav-link" href="app-user-view-billing.html"><i
                                                    class="ri-bookmark-line me-1_5"></i>Billing & Plans</a></li>
                                        <li class="nav-item"><a class="nav-link"
                                                href="app-user-view-notifications.html"><i
                                                    class="ri-notification-4-line me-1_5"></i>Notifications</a></li>
                                        <li class="nav-item"><a class="nav-link"
                                                href="app-user-view-connections.html"><i
                                                    class="ri-link-m me-1_5"></i>Connections</a></li> --}}
                                    </ul>
                                </div>
                                <!--/ User Tabs -->


                                <!-- Invoice table -->
                                <div class="card mb-4">
                                    <div class="card-datatable table-responsive">
                                        <div id="DataTables_Table_1_wrapper"
                                            class="dataTables_wrapper dt-bootstrap5 no-footer">
                                            <div class="card-header d-flex">
                                                <div class="head-label">
                                                    <h5 class="card-title mb-0">Order List</h5>
                                                </div>
                                                <div class="dt-action-buttons text-end pt-0">
                                                    <div class="dt-buttons btn-group flex-wrap">
                                                        <div class="btn-group">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table datatable-invoice dataTable no-footer dtr-column"
                                                id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"
                                                style="width: 813px;">
                                                <thead>
                                                    <tr>
                                                        <th class="control sorting dtr-hidden" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1" style="width: 0px; display: none;"
                                                            aria-label=": activate to sort column ascending"></th>
                                                        <th class="sorting sorting_desc" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1" style="width: 83px;"
                                                            aria-label="#: activate to sort column ascending"
                                                            aria-sort="descending">#</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1" style="width: 99px;"
                                                            aria-label="Status: activate to sort column ascending">
                                                            Status</th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1" style="width: 86px;"
                                                            aria-label="Total: activate to sort column ascending">Total
                                                        </th>
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_1" rowspan="1"
                                                            colspan="1" style="width: 150px;"
                                                            aria-label="Issued Date: activate to sort column ascending">
                                                            Order Date</th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                                            style="width: 175px;" aria-label="Action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($user->orders as $order)
                                                        <tr class="odd">
                                                            <td class="  control" style="display: none;"
                                                                tabindex="0">
                                                            </td>
                                                            <td class="sorting_1"><a
                                                                    href="app-invoice-preview.html"><span>#{{ $order->order_no }}</span></a>
                                                            </td>
                                                            <td>
                                                                @php
                                                                    $payment = $order->payments->first();
                                                                    $status =
                                                                        $payment->payment_status ?? 'No record found';
                                                                    $total = $payment->amount ?? 0;
                                                                @endphp
                                                                {{ $status }}
                                                            </td>
                                                            <td>₹{{ $total }}</td>
                                                            <td><span
                                                                    class="d-none">{{ $order->created_at->format('M d, Y, H:i') }}
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <a
                                                                        href="{{url('admin/orders/order-details', ['order' => $order->order_no])}}"
                                                                        class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect"
                                                                        data-bs-toggle="tooltip" aria-label="Preview"
                                                                        data-bs-original-title="Preview"><i
                                                                            class="ri-eye-line ri-22px"></i></a>
                                                                            {{-- <button
                                                                        class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect dropdown-toggle hide-arrow"
                                                                        data-bs-toggle="dropdown"><i
                                                                            class="ri-more-2-line ri-22px"></i></button> --}}
                                                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                                            href="javascript:;"
                                                                            class="dropdown-item"><i
                                                                                class="ri-download-line me-2"></i><span>Download</span></a><a
                                                                            href="javascript:;"
                                                                            class="dropdown-item"><i
                                                                                class="ri-pencil-line me-2"></i><span>Edit</span></a><a
                                                                            href="javascript:;"
                                                                            class="dropdown-item delete-record"><i
                                                                                class="ri-stack-line me-2"></i><span>Duplicate</span></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{-- <div class="row mx-5 row-gap-2">
                                                <div class="col-sm-12 col-xxl-6 pe-5">
                                                    <div class="dataTables_info" id="DataTables_Table_1_info"
                                                        role="status" aria-live="polite">Showing 1 to 7 of 50 entries
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xxl-6">
                                                    <div class="dataTables_paginate paging_simple_numbers"
                                                        id="DataTables_Table_1_paginate">
                                                        <ul class="pagination">
                                                            <li class="paginate_button page-item previous disabled"
                                                                id="DataTables_Table_1_previous"><a
                                                                    aria-controls="DataTables_Table_1"
                                                                    aria-disabled="true" role="link"
                                                                    data-dt-idx="previous" tabindex="-1"
                                                                    class="page-link">Previous</a></li>
                                                            <li class="paginate_button page-item active"><a
                                                                    href="#" aria-controls="DataTables_Table_1"
                                                                    role="link" aria-current="page"
                                                                    data-dt-idx="0" tabindex="0"
                                                                    class="page-link">1</a></li>
                                                            <li class="paginate_button page-item "><a href="#"
                                                                    aria-controls="DataTables_Table_1" role="link"
                                                                    data-dt-idx="1" tabindex="0"
                                                                    class="page-link">2</a></li>
                                                            <li class="paginate_button page-item "><a href="#"
                                                                    aria-controls="DataTables_Table_1" role="link"
                                                                    data-dt-idx="2" tabindex="0"
                                                                    class="page-link">3</a></li>
                                                            <li class="paginate_button page-item "><a href="#"
                                                                    aria-controls="DataTables_Table_1" role="link"
                                                                    data-dt-idx="3" tabindex="0"
                                                                    class="page-link">4</a></li>
                                                            <li class="paginate_button page-item "><a href="#"
                                                                    aria-controls="DataTables_Table_1" role="link"
                                                                    data-dt-idx="4" tabindex="0"
                                                                    class="page-link">5</a></li>
                                                            <li class="paginate_button page-item disabled"
                                                                id="DataTables_Table_1_ellipsis"><a
                                                                    aria-controls="DataTables_Table_1"
                                                                    aria-disabled="true" role="link"
                                                                    data-dt-idx="ellipsis" tabindex="-1"
                                                                    class="page-link">…</a></li>
                                                            <li class="paginate_button page-item "><a href="#"
                                                                    aria-controls="DataTables_Table_1" role="link"
                                                                    data-dt-idx="7" tabindex="0"
                                                                    class="page-link">8</a></li>
                                                            <li class="paginate_button page-item next"
                                                                id="DataTables_Table_1_next"><a href="#"
                                                                    aria-controls="DataTables_Table_1" role="link"
                                                                    data-dt-idx="next" tabindex="0"
                                                                    class="page-link">Next</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <!-- /Invoice table -->
                            </div>
                            <!--/ User Content -->
                        </div>

                        <!-- Modal -->

                        <!-- /Modal -->
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



    <!-- Main JS -->
    <script src="{{ asset('admin_asset/js/main.js') }}"></script>

    <!-- Page JS -->
    {{-- <script src="{{ asset('admin_asset/js/app-ecommerce-product-add.js') }}"></script> --}}


</body>

</html>
