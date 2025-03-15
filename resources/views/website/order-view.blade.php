@extends('layouts.app')
@section('title', 'Order')

<script src="https://cdn.tailwindcss.com"></script>

@section('content')
    <div class="page-wrapper">
        <h1 class="d-none">Wolmart - Responsive Marketplace HTML Template</h1>

        @include('website.partials.header')
        <!-- End of Header -->
    </div>
    <div class="bg-gray-100 py-6" style="margin: 60px;">
        <div class=" mx-auto bg-white rounded-lg shadow-lg p-6">
            <header class="flex justify-between items-center border-b pb-4">
                <h1 class="text-xl font-semibold text-[#1E2A42]">
                    Order Number <span class="text-[#6C5DD3] font-bold">#{{ $order->order_no }}</span>
                </h1>
                <div class="text text-gray-600">
                    <strong class="text-gray-500">Order Created:</strong>
                    <strong
                        class="text-gray-500">{{ \Carbon\Carbon::parse($order->created_at)->format('D, M j, Y h:i A') }}</strong>
                </div>
            </header>

            <!-- Customer, Delivery, and History -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-white shadow-sm p-4 rounded-lg border">
                    <h2 class="font-semibold text-[#1E2A42]">Customer Details</h2>
                    <p class="text-gray-600 mt-2"><strong class="text-gray-500">Name:</strong> {{ $order->address->fname }}
                    </p>

                    <p class="text-gray-600"><strong class="text-gray-500">Email:</strong>
                        <a href="#" class="text-[#6C5DD3] underline">{{ $order->user->email }}</a>
                    </p>
                    <p class="text-gray-600"><strong class="text-gray-500">Phone:</strong>+91
                        {{ $order->address->phone_no }}</p>

                </div>

                <div class="bg-white shadow-sm p-4 rounded-lg border">
                    <h2 class="font-semibold text-[#1E2A42]">Delivery Address</h2>
                    <p class="text-gray-600 mt-2"><strong class="text-gray-500">Address:</strong>
                        {{ $order->address->address }}</p>
                    <p class="text-gray-600"><strong class="text-gray-500">Area:</strong> {{ $order->address->area }}</p>
                    <p class="text-gray-600"><strong class="text-gray-500">Landmark:</strong>
                        {{ $order->address->landmark }}</p>
                    <p class="text-gray-600"><strong class="text-gray-500">Pincode:</strong> {{ $order->address->pincode }}
                    </p>
                </div>

                @if (!empty($order->shipping) && $order->shipping->isNotEmpty())
                @php $shipping = $order->shipping->sortByDesc('created_at')->first(); @endphp
                <div class="bg-white shadow-sm p-4 rounded-lg border">
                    <h2 class="font-semibold mb-4">Order History</h2>
                    <ul class="text-gray-700 text-[#1E2A42]">
                        <li class="mb-2"><strong class="text-gray-500">Expected Delivery:</strong> {{ \Carbon\Carbon::parse($shipping->expected_delivery_date)->format('D, M j, Y h:i A') }}</li>
                        <li class="mb-2"><strong class="text-gray-500">Shipping-ID:</strong> {{ $shipping->shipment_id }}</li>
                        <li class="mb-2"><strong class="text-gray-500">Delivery-Status:</strong> {{ ucfirst($shipping->delivery_status) }}</li>
                    </ul>
                </div>
            @else
                <div class="bg-white shadow-sm p-4 rounded-lg border">
                    <h2 class="font-semibold mb-4">Order History</h2>
                    <ul class="text-gray-700 text-[#1E2A42]">
                        <li><strong class="text-gray-500">Shipping:</strong> Processing</li>
                    </ul>
                </div>
            @endif
            
            </div>

            <!-- Item Summary & Order Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="col-span-2 bg-white shadow-sm p-4 rounded-lg border">
                    <h2 class="font-semibold text-[#1E2A42] mb-4">Item Summary</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left min-w-[600px]">
                            <thead>
                                <tr class="border-b text-gray-600">
                                    <th class="p-2">Item</th>
                                    <th class="p-2">QTY</th>
                                    <th class="p-2">Price</th>
                                    <th class="p-2">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr class="border-b">
                                        <td class="p-2 flex items-center space-x-3">
                                            <img src="{{ $item->product->thumbnail }}" class="w-24 h-24 rounded-md"
                                                alt="Item">
                                            <div>
                                                <p class="text-[#1E2A42] font-semibold">{{ $item->product->product_name }}
                                                </p>
                                                {{-- <p class="text-gray-500 text-xs">Colour: Blue</p> --}}
                                            </div>
                                        </td>
                                        <td class="p-2 text-gray-800">{{ $item->quantity }}</td>
                                        <td class="p-2 text-gray-800" style="font-family: Arial, Helvetica, sans-serif">
                                            ₹{{ $item->price }}</td>
                                        <td class="p-2 text-gray-800" style="font-family: Arial, Helvetica, sans-serif">
                                            ₹{{ $item->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white shadow-sm p-4 rounded-lg border">
                    <h2 class="font-semibold text-[#1E2A42] mb-4">Order Summary</h2>
                    <div class="space-y-3 text-gray-700 text-sm">
                        <p class="flex justify-between"><strong class="text-gray-500">Payment</strong> <span
                                class="text-gray-800"><strong
                                    class="text-gray-500">{{ $order->payments[0]->payment_method }}</strong></span></p>
                        <p class="flex justify-between"><span><strong class="text-gray-500">Shipping Cost</strong></span>
                            <span style="font-family: Arial, Helvetica, sans-serif">₹ <strong
                                    class="text-gray-500">{{ $order->shipcost }}</strong></span></p>
                        <p class="flex justify-between font-semibold text-lg">
                        <p class="flex justify-between"><span><strong class="text-gray-500">Total</strong></span>
                            <span style="font-family: Arial, Helvetica, sans-serif">
                                <strong class="text-gray-500">₹ {{ $order->payments[0]->amount + $order->shipcost }}
                                </strong>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
