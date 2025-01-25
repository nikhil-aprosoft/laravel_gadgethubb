@extends('layouts.app')
@section('title', 'Order-view')

@section('content')
<div class="page-wrapper">
    <h1 class="d-none">Wolmart - Responsive Marketplace HTML Template</h1>

    @include('website.partials.header')

    @php
        $order = App\Models\Order\Order::with(['items.product', 'payments'])->where('orderid', $orderId)->first();
    @endphp

    <!-- Start of Main -->
    <main class="main order">
        <!-- Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li><a href="{{ route('view-cart') }}">Shopping Cart</a></li>
                    <li><a href="{{ route('checkout') }}">Checkout</a></li>
                    <li class="active"><a href="#">Order Complete</a></li>
                </ul>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="page-content mb-10 pb-2">
            <div class="container">
                <div class="order-success text-center font-weight-bolder text-dark">
                    <i class="fas fa-check" style="color: green;"></i>
                    Thank you. Your order has been received.
                </div>

                <!-- Order Summary -->
                <ul class="order-view list-style-none">
                    <li>
                        <label>Order number</label>
                        <strong>{{ $order->order_no }}</strong>
                    </li>
                    <li>
                        <label>Status</label>
                        <strong>{{ $order->payments->first()->payment_status }}</strong>
                    </li>
                    <li>
                        <label>Date</label>
                        <strong>{{ $order->created_at->diffForHumans() }}</strong>
                    </li>
                    <li>
                        <label>Total</label>
                        <strong class="rupessPrice" style="font-family: Arial;">₹ {{ number_format($order->payments->first()->amount, 2) }}</strong>
                    </li>
                    <li>
                        <label>Payment Source</label>
                        <strong>{{ ucfirst($order->payments->first()->payment_source) }}</strong>
                    </li>
                    
                </ul>

                <!-- Order Details -->
                <div class="order-details-wrapper mb-5">
                    <h4 class="title text-uppercase ls-25 mb-5">Order Details</h4>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th class="text-dark">Product</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $orderItem)
                                <tr>
                                    <td>
                                        <a href="{{ route('product-details', ['slug' =>$orderItem->product->slug]) }}">{{ $orderItem->product->product_name }}</a>&nbsp;<strong>x {{ $orderItem->quantity }}</strong>
                                    </td>
                                    <td style="font-family: Arial;">₹{{ number_format($orderItem->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Subtotal:</th>
                                <td style="font-family: Arial;">₹{{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity), 2) }}</td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td>Flat rate</td>
                            </tr>
                            <tr>
                                <th>Payment method:</th>
                                <td>{{ $order->payments[0]->payment_method }}</td>
                            </tr>
                            <tr class="total">
                                <th class="border-no">Total:</th>
                                <td class="border-no" style="font-family: Arial;">₹{{ number_format($order->payments[0]->amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </main>

    @include('website.partials.footer')
</div>
@endsection
