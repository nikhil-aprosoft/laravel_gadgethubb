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
                                                    <h5 class="mb-0">{{$paidOrderCount}}</h5>
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
                                                    <h5 class="mb-0">{{$pendingOrderCount}}</h5>
                                                    <span>Pending Order</span>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="pb-4 border-bottom mb-4">Details</h5>
                                        <div class="info-container">
                                            <ul class="list-unstyled mb-6">
                                                <li class="mb-2">
                                                    <span class="h6">Username:</span>
                                                    <span>{{$user->name}}</span>
                                                </li>
                                                <li class="mb-2">
                                                    <span class="h6">Email:</span>
                                                    <span>{{$user->email}}</span>
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
                                        <table class="table datatable-invoice">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>#</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Issued Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <!-- /Invoice table -->
                            </div>
                            <!--/ User Content -->
                        </div>

                        <!-- Modal -->
                        <!-- Edit User Modal -->
                        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="text-center mb-6">
                                            <h4 class="mb-2">Edit User Information</h4>
                                            <p class="mb-6">Updating user details will receive a privacy audit.</p>
                                        </div>
                                        <form id="editUserForm" class="row g-5" onsubmit="return false">
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalEditUserFirstName"
                                                        name="modalEditUserFirstName" class="form-control"
                                                        value="Oliver" placeholder="Oliver" />
                                                    <label for="modalEditUserFirstName">First Name</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalEditUserLastName"
                                                        name="modalEditUserLastName" class="form-control" value="Queen"
                                                        placeholder="Queen" />
                                                    <label for="modalEditUserLastName">Last Name</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalEditUserName"
                                                        name="modalEditUserName" class="form-control"
                                                        value="oliver.queen" placeholder="oliver.queen" />
                                                    <label for="modalEditUserName">Username</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalEditUserEmail"
                                                        name="modalEditUserEmail" class="form-control"
                                                        value="oliverqueen@gmail.com"
                                                        placeholder="oliverqueen@gmail.com" />
                                                    <label for="modalEditUserEmail">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <select id="modalEditUserStatus" name="modalEditUserStatus"
                                                        class="form-select" aria-label="Default select example">
                                                        <option value="1" selected>Active</option>
                                                        <option value="2">Inactive</option>
                                                        <option value="3">Suspended</option>
                                                    </select>
                                                    <label for="modalEditUserStatus">Status</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalEditTaxID" name="modalEditTaxID"
                                                        class="form-control modal-edit-tax-id"
                                                        placeholder="123 456 7890" />
                                                    <label for="modalEditTaxID">Tax ID</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">US (+1)</span>
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" id="modalEditUserPhone"
                                                            name="modalEditUserPhone"
                                                            class="form-control phone-number-mask"
                                                            value="+1 609 933 4422" placeholder="+1 609 933 4422" />
                                                        <label for="modalEditUserPhone">Phone Number</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <select id="modalEditUserLanguage" name="modalEditUserLanguage"
                                                        class="select2 form-select" multiple>
                                                        <option value="">Select</option>
                                                        <option value="english" selected>English</option>
                                                        <option value="spanish">Spanish</option>
                                                        <option value="french">French</option>
                                                        <option value="german">German</option>
                                                        <option value="dutch">Dutch</option>
                                                        <option value="hebrew">Hebrew</option>
                                                        <option value="sanskrit">Sanskrit</option>
                                                        <option value="hindi">Hindi</option>
                                                    </select>
                                                    <label for="modalEditUserLanguage">Language</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <select id="modalEditUserCountry" name="modalEditUserCountry"
                                                        class="select2 form-select" data-allow-clear="true">
                                                        <option value="">Select</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="Belarus">Belarus</option>
                                                        <option value="Brazil">Brazil</option>
                                                        <option value="Canada">Canada</option>
                                                        <option value="China">China</option>
                                                        <option value="France">France</option>
                                                        <option value="Germany">Germany</option>
                                                        <option value="India" selected>India</option>
                                                        <option value="Indonesia">Indonesia</option>
                                                        <option value="Israel">Israel</option>
                                                        <option value="Italy">Italy</option>
                                                        <option value="Japan">Japan</option>
                                                        <option value="Korea">Korea, Republic of</option>
                                                        <option value="Mexico">Mexico</option>
                                                        <option value="Philippines">Philippines</option>
                                                        <option value="Russia">Russian Federation</option>
                                                        <option value="South Africa">South Africa</option>
                                                        <option value="Thailand">Thailand</option>
                                                        <option value="Turkey">Turkey</option>
                                                        <option value="Ukraine">Ukraine</option>
                                                        <option value="United Arab Emirates">United Arab Emirates
                                                        </option>
                                                        <option value="United Kingdom">United Kingdom</option>
                                                        <option value="United States">United States</option>
                                                    </select>
                                                    <label for="modalEditUserCountry">Country</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="editBillingAddress" />
                                                    <label for="editBillingAddress" class="text-heading">Use as a
                                                        billing address?</label>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary me-3">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Edit User Modal -->
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
