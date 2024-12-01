@extends('layouts.app')
@section('title', 'Cart')

@section('content')

    <script>
        function updateCart(itemId, quantity) {
            axios.post(`/cart/update/${itemId}`, {
                    quantity: quantity
                })
                .then(response => {
                    console.log('Cart updated successfully:', response.data);
                })
                .catch(error => {
                    console.error('Failed to update cart:', error);
                });
        }
    </script>

    <div class="page-wrapper">
        <h1 class="d-none">Wolmart - Responsive Marketplace HTML Template</h1>

        @include('website.partials.header')
        <!-- End of Header -->

        <!-- Start of Main -->
        <main class="main cart">
            @if ($cartItems->isEmpty())
                <div class="emptycart" style="margin:15px;">
                    <h2 class="text-center">
                        No Product in cart
                    </h2>
                </div>
            @else
                <!-- Start of Breadcrumb -->
                <nav class="breadcrumb-nav">
                    <div class="container">
                        <ul class="breadcrumb shop-breadcrumb bb-no">
                            <li class="active"><a href="{{ route('view-cart') }}">Shopping Cart</a></li>
                            <li><a href="{{ route('checkout') }}">Checkout</a></li>
                            {{-- <li><a href="order.html">Order Complete</a></li> --}}
                        </ul>
                    </div>
                </nav>
                <!-- End of Breadcrumb -->

                <!-- Start of PageContent -->
                <div class="page-content">
                    <div class="container">
                        <div class="row gutter-lg mb-10">
                            <div class="col-lg-8 pr-lg-4 mb-6">
                                <table class="shop-table cart-table">
                                    <thead>
                                        <tr>
                                            <th class="product-name"><span>Product</span></th>
                                            <th></th>
                                            <th class="product-price"><span>Price</span></th>
                                            <th class="product-quantity"><span>Quantity</span></th>
                                            <th class="product-subtotal"><span>Subtotal</span></th>
                                        </tr>
                                    </thead>
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <div class="p-relative">
                                                        <a href="product-default.html">
                                                            <figure>
                                                                <img src="{{ $item->product->thumbnail }}" alt="product"
                                                                    width="300" height="338">
                                                            </figure>
                                                        </a>
                                                        <button type="button" class="btn btn-close"><i
                                                                class="fas fa-times"></i></button>
                                                    </div>
                                                </td>
                                                <td class="product-name">
                                                    <a href="product-default.html">
                                                        {{ $item->product->product_name }}
                                                    </a>
                                                </td>
                                                <td class="product-price"><span class="amount"
                                                        style="font-family: Arial;">{{ $item->product->price }}</span></td>
                                                <td class="product-quantity" x-data="{ quantity: {{ $item->quantity }} }">
                                                    <div class="input-group">
                                                        <input class="quantity form-control" type="number" min="1"
                                                            x-model="quantity" id="quantityInput{{ $item->id }}"
                                                            max="100000"
                                                            @change="quantity = Math.max(1, quantity); updateCart({{ $item->cart_id }}, quantity)">
                                                        <button class="quantity-plus w-icon-plus"
                                                            @click="quantity = Math.min(100000, quantity + 1); updateCart({{ $item->cart_id }}, quantity)"></button>
                                                        <button class="quantity-minus w-icon-minus"
                                                            @click="quantity = Math.max(1, quantity - 1); updateCart({{ $item->cart_id }}, quantity)"></button>
                                                    </div>
                                                </td>
                                                @php
                                                    $subtotal +=
                                                        (float) str_replace('₹', '', $item->product->price) *
                                                        $item->quantity;

                                                @endphp
                                                <td class="product-subtotal">
                                                    <span class="amount"
                                                        style="font-family: Arial;">₹{{ $subtotal }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="cart-action mb-6">
                                    <a href="{{ route('products') }}"
                                        class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i
                                            class="w-icon-long-arrow-left"></i>Continue Shopping</a>

                                    <a href="{{ route('clear-cart') }}" class="btn btn-rounded btn-default btn-clear"
                                        data-bs-toggle="modal">Clear Cart</a>
                                </div>
                            </div>
                            <div class="col-lg-4 sticky-sidebar-wrapper">
                                <div class="pin-wrapper" style="height: 789.2px;">
                                    <div class="sticky-sidebar"
                                        style="border-bottom: 0px rgb(102, 102, 102); width: 393.317px;">
                                        <div class="cart-summary mb-4">
                                            <h3 class="cart-title text-uppercase">Cart Totals</h3>
                                            <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                                <label class="ls-25">Subtotal</label>
                                                @php

                                                @endphp
                                                <span>₹ {{ $subtotal }}</span>
                                            </div>

                                            <hr class="divider">

                                            <ul class="shipping-methods mb-2">
                                                <li>
                                                    <label
                                                        class="shipping-title text-dark font-weight-bold">Shipping</label>
                                                </li>

                                                <li>
                                                    <div class="custom-radio">
                                                        <input type="radio" id="flat-rate" class="custom-control-input"
                                                            name="shipping">
                                                        <label for="flat-rate" class="custom-control-label color-dark">Flat
                                                            rate:
                                                            $5.00</label>
                                                    </div>
                                                </li>
                                            </ul>
                                            <hr class="divider mb-6">
                                            <div class="order-total d-flex justify-content-between align-items-center">
                                                <label>Total</label>
                                                <span class="ls-50">$100.00</span>
                                            </div>
                                            <a href="#"
                                                class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                                Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
            @endif
    </div>
    </div>
    </div>
    <!-- End of PageContent -->
    </main>
    <!-- End of Main -->
    @include('website.partials.footer')
    </div>
@endsection
