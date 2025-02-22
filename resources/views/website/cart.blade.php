@extends('layouts.app')
@section('title', 'Cart')

@section('content')
    <script>
        function updateCart(itemId, quantity) {
            axios.post(`/cart/update/${itemId}`, {
                    quantity: quantity,
                    cartPage: 1
                })
                .then(response => {
                    console.log('Cart updated successfully:');
                    location.reload();
                })
                .catch(error => {
                    console.error('Failed to update cart:', error);
                });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.quantity-plus').on('click', function() {
                var inputField = $(this).siblings('input');
                var currentValue = parseInt(inputField.val());
                var updatedValue = currentValue + 1;
                inputField.val(updatedValue);
                var itemId = $(this).closest('td').attr('id').split('-').slice(1).join(
                '-'); // Correctly handle the item ID
                updateCart(itemId, updatedValue);
            });

            $('.quantity-minus').on('click', function() {
                var inputField = $(this).siblings('input');
                var currentValue = parseInt(inputField.val());

                if (currentValue > 0) {
                    var updatedValue = currentValue - 1;
                    inputField.val(updatedValue);
                    var itemId = $(this).closest('td').attr('id').split('-').slice(1).join(
                    '-'); // Correctly handle the item ID
                    if (updatedValue > 0) {
                        updateCart(itemId, updatedValue);
                    } else {
                        removeCartProduct(itemId)
                    }
                }
            });
        });

        function removeCartProduct(id) {
            const url = `{{ route('remove_product_cart') }}`;
            console.log(id);
            axios.post(url, {
                    cart_id: id,
                })
                .then(response => {
                    Swal.fire({
                        title: "Product removed from cart",
                        icon: "success"
                    }).then(() => {
                        const itemElement = document.querySelector(`[data-id='${id}']`);
                        if (itemElement) {
                            const parentElement = itemElement.closest('.product-cart');
                            if (parentElement) {
                                parentElement.remove();
                                location.reload();
                            }
                        }
                    });
                })
                .catch(error => {
                    if (error.response) {
                        if (error.response.status === 401) {
                            console.error('Unauthorized access. Please log in.');
                            window.location.href = loginUrl;
                        } else {
                            console.error('An error occurred:', error.response.data);
                        }
                    } else if (error.request) {
                        console.error('No response received from the server.');
                    } else {
                        console.error('Error:', error.message);
                    }
                });
        }
    </script>

    <style>
        .amount {
            display: flex;
            justify-content: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.6rem;
            font-weight: 600;
            color: #333;
            letter-spacing: -0.05em;
        }
    </style>
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
                                                        <a href="#">
                                                            <figure>
                                                                <img src="{{ $item->product->thumbnail }}" alt="product"
                                                                    width="300" height="338">
                                                            </figure>
                                                        </a>
                                                        <button type="button" onClick="removeCartProduct('{{$item->cart_id}}')" class="btn btn-close"><i
                                                                class="fas fa-times"></i></button>
                                                    </div>
                                                </td>
                                                <td class="product-name">
                                                    <a href="{{ url('product-details/' . $item->product->slug) }}">
                                                        {{ $item->product->product_name }}
                                                    </a>
                                                </td>
                                                <td class="product-price">
                                                    <span class="amount"
                                                        style="font-family: Arial;">₹{{number_format((float) str_replace('₹', '', $item->product->price),2) }}</span>
                                                </td>
                                                <td class="product-quantity" id="item-{{ $item->cart_id }}">
                                                    <div class="input-group">
                                                        <input class="form-control" placeholder="{{ $item->quantity }}"
                                                            type="text" value="{{ $item->quantity }}">
                                                        <button class="quantity-plus w-icon-plus"></button>
                                                        <button class="quantity-minus w-icon-minus"></button>
                                                    </div>
                                                </td>
                                                @php
                                                    $subtotal +=
                                                        (float) str_replace('₹', '', $item->product->price) *
                                                        $item->quantity;
                                                @endphp
                                                <td class="product-subtotal">
                                                    <span class="amount"
                                                        style="font-family: Arial;">₹{{ number_format($subtotal,2) }}</span>
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
                                            <div class="cart-subtotal d-flex align-items-center  justify-content-between">
                                                <label class="ls-25">Subtotal</label>
                                                @php

                                                @endphp
                                                <span class="amount">₹{{ number_format($subtotal,2) }}</span>
                                            </div>

                                            <hr class="divider">
                                            @php
                                            $shipCost = 0;
                                            foreach ($shippingCost as $key => $shipping) {                                                
                                                if ($shipping->from <= $subtotal && $shipping->to >= $subtotal) {
                                                    $shipCost += $shipping->cost;
                                                }
                                            }                                    
                                            @endphp
                                           <div class="cart-subtotal d-flex align-items-center  justify-content-between">
                                            <label class="ls-25">Shipping</label>                                           
                                            <span class="amount">₹{{ number_format($shipCost,2) }}</span>
                                        </div>
                                            <hr class="divider mb-6">
                                            <div class="order-total d-flex justify-content-between align-items-center">
                                                <label>Total</label>
                                                <span class="ls-50 amount">₹ {{ number_format($subtotal+$shipCost,2)}}</span>
                                            </div>
                                            <a href="{{route('checkout')}}"
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
