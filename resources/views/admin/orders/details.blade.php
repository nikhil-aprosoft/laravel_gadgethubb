<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>View-Order Details</title>
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
                @php
                    $payments = $order->payments->first();
                    $shipping = $order->shipping->first();
                    $deliveryStatus = $shipping->delivery_status ?? 'No Picked';
                @endphp
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 gap-3">
                            <div class="d-flex flex-column justify-content-center">
                                <div class="d-flex align-items-center mb-1">
                                    <h5 class="mb-0">Order-ID - {{ $order->order_no }}</h5>
                                    <span
                                        class="badge 
                                    @if ($payments->payment_status == 'pending') bg-label-warning
                                    @elseif($payments->payment_status == 'failed')
                                        bg-label-danger
                                    @else
                                        bg-label-success @endif 
                                    me-2 ms-2 rounded-pill">

                                        {{ $payments->payment_status }}</span>
                                    <span class="badge bg-label-info rounded-pill">{{ $deliveryStatus }}</span>
                                </div>
                                <p class="mt-1 mb-3">{{ $order->created_at->format('M d, Y, H:i') }}</p>
                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                {{-- <button class="btn btn-outline-danger delete-order">Delete Order</button> --}}
                            </div>
                        </div>

                        <!-- Order Details Table -->

                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="card mb-6">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title m-0">Order details</h5>
                                    </div>
                                    <div class="card-datatable table-responsive">
                                        <table class="datatables-order-details table dataTable no-footer dtr-column"
                                            id="DataTables_Table_0" style="width: 812px;">
                                            <thead>
                                                <tr>
                                                    <th class="control sorting_disabled dtr-hidden" rowspan="1"
                                                        colspan="1" style="width: 0px; display: none;"
                                                        aria-label=""></th>
                                                    <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all"
                                                        rowspan="1" colspan="1" style="width: 18px;"
                                                        data-col="1" aria-label=""><input type="checkbox"
                                                            class="form-check-input"></th>
                                                    <th class="w-50 sorting_disabled" rowspan="1" colspan="1"
                                                        style="width: 366px;" aria-label="products">products</th>
                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                        style="width: 77px;" aria-label="price">price</th>
                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                        style="width: 61px;" aria-label="qty">qty</th>
                                                    <th class="sorting_disabled" rowspan="1" colspan="1"
                                                        style="width: 94px;" aria-label="total">total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $total = $order->items->sum('price');
                                                @endphp
                                                @foreach ($order->items as $item)
                                                    @php
                                                        $product = $item->product;
                                                    @endphp
                                                    <tr class="odd">
                                                        <td class="control" style="display: none;" tabindex="0">
                                                        </td>
                                                        <td class="  dt-checkboxes-cell"><input type="checkbox"
                                                                class="dt-checkboxes form-check-input"></td>
                                                        <td class="sorting_1">
                                                            <div
                                                                class="d-flex justify-content-start align-items-center product-name">
                                                                <div class="avatar-wrapper me-3">
                                                                    <div
                                                                        class="avatar avatar-sm rounded-2 bg-label-secondary">
                                                                        <img src="{{ $product->thumbnail }}"
                                                                            alt="product-Wooden Chair"
                                                                            class="rounded-2">
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-column"><span
                                                                        class="text-nowrap text-heading fw-medium">{{ $product->product_name }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><span>{{ $product->price }}</span></td>
                                                        <td><span>{{ $item->quantity }}</span></td>
                                                        <td><span>₹{{ $item->price }}</span></td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end align-items-center m-4 p-1 mb-0 pb-0">
                                            <div class="order-calculations m-4">
                                                <div class="d-flex justify-content-start gap-4 mb-2">
                                                    <span class="w-px-100 text-heading">Discount:</span>
                                                    <h6 class="mb-0">₹00.00</h6>
                                                </div>
                                                <div class="d-flex justify-content-start gap-4">
                                                    <h6 class="w-px-100 mb-0">Total:</h6>
                                                    <h6 class="mb-0">₹{{ $total }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <style>
                                    html:not([dir="rtl"]) .border-primary,
                                    html[dir="rtl"] .border-primary {
                                        border-color: #8c57ff !important;

                                        }html:not([dir="rtl"]) .timeline-item {
                                            border-left: 1px solid #e6e5e8;
                                            border-left-color: rgb(230, 229, 232);
                                        }

                                        .timeline .timeline-item {
                                            position: relative;
                                            padding-left: 1.4rem;
                                        }
                                </style>
                                <div class="card mb-6">
                                    <div class="card-header">
                                        <h5 class="card-title m-0">Shipping activity</h5>
                                    </div>
                                    <div class="card-body mt-3">
                                        <ul class="timeline pb-0 mb-0">
                                            <li class="timeline-item timeline-item-transparent border-primary">
                                                <span class="timeline-point timeline-point-primary"></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-1">
                                                        <h6 class="mb-0">Order was placed (Order ID: #32543)</h6>
                                                        <small class="text-muted">Tuesday 11:29 AM</small>
                                                    </div>
                                                    <p class="mt-1 mb-3">Your order has been placed successfully</p>
                                                </div>
                                            </li>
                                            <li class="timeline-item timeline-item-transparent border-primary">
                                                <span class="timeline-point timeline-point-primary"></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-1">
                                                        <h6 class="mb-0">Pick-up</h6>
                                                        <small class="text-muted">Wednesday 11:29 AM</small>
                                                    </div>
                                                    <p class="mt-1 mb-3">Pick-up scheduled with courier</p>
                                                </div>
                                            </li>
                                            <li class="timeline-item timeline-item-transparent border-primary">
                                                <span class="timeline-point timeline-point-primary"></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-1">
                                                        <h6 class="mb-0">Dispatched</h6>
                                                        <small class="text-muted">Thursday 11:29 AM</small>
                                                    </div>
                                                    <p class="mt-1 mb-3">Item has been picked up by courier</p>
                                                </div>
                                            </li>
                                            <li class="timeline-item timeline-item-transparent border-primary">
                                                <span class="timeline-point timeline-point-primary"></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-1">
                                                        <h6 class="mb-0">Package arrived</h6>
                                                        <small class="text-muted">Saturday 15:20 AM</small>
                                                    </div>
                                                    <p class="mt-1 mb-3">Package arrived at an Amazon facility, NY</p>
                                                </div>
                                            </li>
                                            <li class="timeline-item timeline-item-transparent">
                                                <span class="timeline-point timeline-point-primary"></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-1">
                                                        <h6 class="mb-0">Dispatched for delivery</h6>
                                                        <small class="text-muted">Today 14:12 PM</small>
                                                    </div>
                                                    <p class="mt-1 mb-3">Package has left an Amazon facility, NY</p>
                                                </div>
                                            </li>
                                            <li
                                                class="timeline-item timeline-item-transparent border-transparent pb-0">
                                                <span class="timeline-point timeline-point-secondary"></span>
                                                <div class="timeline-event pb-0">
                                                    <div class="timeline-header mb-1">
                                                        <h6 class="mb-0">Delivery</h6>
                                                    </div>
                                                    <p class="mt-1 mb-3">Package will be delivered by tomorrow</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card mb-6">
                                    <div class="card-body">
                                        <h5 class="card-title mb-6">Customer details</h5>
                                        <div class="d-flex justify-content-start align-items-center mb-6">
                                            <div class="avatar me-3">
                                                <img src="{{ asset('admin_asset/img/avatars/1.png') }}"
                                                    alt="Avatar" class="rounded-circle">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="{{url('admin/orders/user-details/'.$order->user_id)}}">
                                                    <h6 class="mb-0">{{ $order->user->name }}</h6>
                                                </a>
                                                <span>Mail: {{ $order->user->email }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center mb-6">
                                            <span
                                                class="avatar rounded-circle bg-label-success me-3 d-flex align-items-center justify-content-center"><i
                                                    class='ri-shopping-cart-line ri-24px'></i></span>
                                            <h6 class="text-nowrap mb-0">@php
                                                echo $order->count('user_id');
                                            @endphp</h6>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-1">Contact info</h6>
                                            {{-- <h6 class="mb-1"><a href=" javascript:;" data-bs-toggle="modal"
                                                    data-bs-target="#editUser">Edit</a></h6> --}}
                                        </div>
                                        <p class="mb-1">Email: Shamus889@yahoo.com</p>
                                        <p class="mb-0">Mobile:{{ $order->address->phone_no }} </p>
                                    </div>
                                </div>

                                <div class="card mb-6">

                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-1">Shipping address</h5>
                                        {{-- <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#addNewAddress">Edit</a></h6> --}}
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-0">{{ $order->address->address }}
                                            <br>{{ $order->address->area }} <br>{{ $order->address->landmark }}
                                            <br>{{ $order->address->pincode }} <br>
                                            {{ $order->address->city }}<br>{{ $order->address->state }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                                        name="modalEditUserLastName" class="form-control"
                                                        value="Queen" placeholder="Queen" />
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
                                                        billing
                                                        address?</label>
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

                        <!-- Add New Address Modal -->
                        <div class="modal fade" id="addNewAddress" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="text-center mb-6">
                                            <h4 class="address-title mb-2">Add New Address</h4>
                                            <p class="address-subtitle">Add new address for express delivery</p>
                                        </div>
                                        <form id="addNewAddressForm" class="row g-5" onsubmit="return false">

                                            <div class="col-12">
                                                <div class="row g-5">
                                                    <div class="col-md mb-md-0">
                                                        <div class="form-check custom-option custom-option-basic">
                                                            <label class="form-check-label custom-option-content"
                                                                for="customRadioHome">
                                                                <input name="customRadioTemp" class="form-check-input"
                                                                    type="radio" value=""
                                                                    id="customRadioHome" checked />
                                                                <span class="custom-option-header">
                                                                    <span class="h6 mb-0 d-flex align-items-center"><i
                                                                            class="ri-home-smile-2-line ri-20px me-1"></i>Home</span>
                                                                </span>
                                                                <span class="custom-option-body">
                                                                    <small>Delivery time (9am – 9pm)</small>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md mb-md-0">
                                                        <div class="form-check custom-option custom-option-basic">
                                                            <label class="form-check-label custom-option-content"
                                                                for="customRadioOffice">
                                                                <input name="customRadioTemp" class="form-check-input"
                                                                    type="radio" value=""
                                                                    id="customRadioOffice" />
                                                                <span class="custom-option-header">
                                                                    <span class="h6 mb-0 d-flex align-items-center"><i
                                                                            class="ri-building-line ri-20px me-1"></i>Office</span>
                                                                </span>
                                                                <span class="custom-option-body">
                                                                    <small>Delivery time (9am – 5pm) </small>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalAddressFirstName"
                                                        name="modalAddressFirstName" class="form-control"
                                                        placeholder="John" />
                                                    <label for="modalAddressFirstName">First Name</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalAddressLastName"
                                                        name="modalAddressLastName" class="form-control"
                                                        placeholder="Doe" />
                                                    <label for="modalAddressLastName">Last Name</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <select id="modalAddressCountry" name="modalAddressCountry"
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
                                                        <option value="India">India</option>
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
                                                    <label for="modalAddressCountry">Country</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalAddressAddress1"
                                                        name="modalAddressAddress1" class="form-control"
                                                        placeholder="12, Business Park" />
                                                    <label for="modalAddressAddress1">Address Line 1</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalAddressAddress2"
                                                        name="modalAddressAddress2" class="form-control"
                                                        placeholder="Mall Road" />
                                                    <label for="modalAddressAddress2">Address Line 2</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalAddressLandmark"
                                                        name="modalAddressLandmark" class="form-control"
                                                        placeholder="Nr. Hard Rock Cafe" />
                                                    <label for="modalAddressLandmark">Landmark</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalAddressCity"
                                                        name="modalAddressCity" class="form-control"
                                                        placeholder="Los Angeles" />
                                                    <label for="modalAddressCity">City</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalAddressState"
                                                        name="modalAddressState" class="form-control"
                                                        placeholder="California" />
                                                    <label for="modalAddressLandmark">State</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="modalAddressZipCode"
                                                        name="modalAddressZipCode" class="form-control"
                                                        placeholder="99950" />
                                                    <label for="modalAddressZipCode">Zip Code</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="billingAddress" />
                                                    <label for="billingAddress">Use as a billing address?</label>
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
                        <!--/ Add New Address Modal -->



                    </div>
                    <!-- / Content -->
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



    <!-- Main JS -->
    <script src="{{ asset('admin_asset/js/main.js') }}"></script>

    <!-- Page JS -->
    {{-- <script src="{{ asset('admin_asset/js/app-ecommerce-product-add.js') }}"></script> --}}


</body>

</html>
