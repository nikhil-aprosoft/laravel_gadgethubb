@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
    <div class="page-wrapper">
        <h1 class="d-none">Wolmart - Responsive Marketplace HTML Template</h1>

        @include('website.partials.header')
        <!-- Start of Main -->
        <main class="main checkout">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li><a href="{{ route('view-cart') }}">Shopping Cart</a></li>
                        <li class="active"><a href="{{ route('checkout') }}">Checkout</a></li>
                        {{-- <li><a href="{{ route('order-view') }}">Order Complete</a></li> --}}
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->


            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <form class="form checkout-form" action="{{ route('payment-request') }}" method="post">
                        @csrf
                        <div class="row mb-9">
                            <div class="col-lg-7 pr-lg-4 mb-4">
                                <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                    Billing Details
                                </h3>
                                <div class="row gutter-sm">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>First name *</label>
                                            <input type="text" class="form-control form-control-md" name="fname"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Last name</label>
                                            <input type="text" class="form-control form-control-md" name="lname"
                                                >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Phone number *</label>
                                    <input type="text" class="form-control form-control-md" name="phone_no" required>
                                </div>
                                <div class="form-group">
                                    <label>Street address *</label>
                                    <input type="text" placeholder="House number and street name"
                                        class="form-control form-control-md mb-2" name="address" required>
                                  
                                </div>
                                <div class="row gutter-sm">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Landmark *</label>
                                            <input type="text" class="form-control form-control-md" name="landmark"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label>Pincode *</label>
                                            <input type="text" class="form-control form-control-md" name="pincode"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City *</label>
                                            <input type="text" class="form-control form-control-md" name="city"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label>State *</label>
                                            <input type="text" class="form-control form-control-md" name="state"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Area *</label>
                                    <input type="text" class="form-control form-control-md" name="area">
                                </div>
                                <div class="form-group">
                                    <label>Alternate Phone (optional)</label>
                                    <input type="text" class="form-control form-control-md" name="alternate_phone">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="order-notes">Order notes (optional)</label>
                                    <textarea class="form-control mb-0" id="order-notes" name="order_notes" cols="30" rows="4"
                                        placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                                <div class="order-summary-wrapper sticky-sidebar">
                                    <h3 class="title text-uppercase ls-10">Your Order</h3>
                                    <div class="order-summary">
                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        <b>Product</b>
                                                    </th>
                                                </tr>
                                            </thead>
                                            @php
                                            $subtotal = 0;   
                                        @endphp
                                        
                                        <tbody>
                                            @foreach ($cartData as $item)
                                                <tr class="bb-no">
                                                    <td class="product-name">{{ $item->product->product_name }} <i class="fas fa-times"></i> <span class="product-quantity">1</span></td>
                                                    <td class="product-total" style="font-family: Arial;">₹ {{ number_format($item->price, 2) }}</td>
                                                </tr>
                                                @php
                                                    $subtotal += $item->price; // Assuming you want to sum the price, not subtotal.
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        
                                        <tr class="cart-subtotal bb-no">
                                            <td><b>Subtotal</b></td>
                                            <td><b style="font-family: Arial;">₹ {{ number_format($subtotal, 2) }}</b></td>
                                        </tr>
                                        
                                            <tfoot>
                                                <tr class="order-total">
                                                    <th>
                                                        <b>Total</b>
                                                    </th>
                                                    <td>
                                                        <b>₹ {{ number_format($subtotal, 2) }}</b>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        <div class="form-group place-order pt-6">
                                            <button type="submit" class="btn btn-dark btn-block btn-rounded">Place
                                                Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
        <!-- End of Main -->
        @include('website.partials.footer')
    </div>
@endsection
