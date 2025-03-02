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
                                                        data-col="1" aria-label="">#</th>
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
                                                @foreach ($order->items as $key => $item)
                                                    @php
                                                        $product = $item->product;
                                                    @endphp
                                                    <tr class="odd">
                                                        <td class="control" style="display: none;" tabindex="0">
                                                        </td>
                                                        <td class="  dt-checkboxes-cell"> {{ $key == 0 ? 1 : $key }}
                                                        </td>
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
                                   @if ($order->shipping->first() && isset($order->shipping->first()->tracking_code))
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
                                    </ul>
                                </div>
                                @else
                                <div class="card-body mt-3">
                                    <ul class="timeline pb-0 mb-0">                                
                                        <li class="timeline-item timeline-item-transparent border-primary">
                                            <span class="timeline-point timeline-point-primary"></span>
                                            <div class="timeline-event">
                                                <div class="timeline-header mb-1">
                                                    <h6 class="mb-0">Not pick-up yet</h6>
                                                    <small class="text-muted">{{$order->created_at->format('l h:i A')
                                                    }}</small>
                                                </div>
                                                <p class="mt-1 mb-3">Waiting for a courier to be assigned</p>
                                            </div>
                                        </li>                                      
                                    </ul>
                                </div>
                                   @endif
                                   
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
                                                <a href="{{ url('admin/orders/user-details/' . $order->user_id) }}">
                                                    <h6 class="mb-0">{{ ucfirst($order->user->name) }}</h6>
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
                                        <p class="mb-1">City:{{ $order->address->city }} </p>
                                        {{-- <p class="mb-1">Pincode:{{ $order->address->pincode }}  </p> --}}
                                        <p class="mb-0">Mobile:{{ $order->address->phone_no }} </p>
                                    </div>
                                </div>
                                <div class="card mb-6">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-1">Shipping address</h5>
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
