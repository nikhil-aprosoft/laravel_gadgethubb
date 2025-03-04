@extends('layouts.app')
@section('title', 'My Account')
<script src="https://cdn.tailwindcss.com"></script>

@section('content')

    <!-- Header -->
    @include('website.partials.header')

    <!-- Orders Section -->
    <div id="orders-section" class="mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12 mx-12">
            @foreach ($orders as $order)      
            <!-- Order 1 -->
            <div class="bg-white shadow-md rounded-2xl p-4 sm:p-6 border border-grey">
                <!-- Order Header -->
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="text-gray-500 text-sm">Order ID</p>
                        <p class="text-xl font-bold">{{$order->order_no	}}</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="px-5 py-2 text-gray-600 text-base border border-gray-300 rounded-full">
                            Estimated arrival: <span class="font-semibold">{{$order->shipping->first()->expected_delivery_date ?? "Order not picked"}}</span>
                        </span>
                        @php
                        $status = $order->shipping->first()->Status ?? null;
                    @endphp
                    
                    <span class="px-5 py-2 text-base border rounded-full font-semibold 
                        {{ $status ? 'text-green-600 border-green-400' : 'text-blue-600 border-blue-400' }}">
                        {{ $status ?? "On Process" }}
                    </span>
                    
                    </div>                    
                </div>

                <!-- Order Route -->
                <div class="flex items-center justify-center space-x-6 my-6">
                    <!-- Origin -->
                    <div class="flex items-center space-x-2 px-4 py-2 bg-gray-100 rounded-full shadow-sm">
                        <i class="fas fa-truck text-gray-600"></i>
                        <span class="text-gray-700 text-sm font-medium">Jalandhar-Punjab</span>
                    </div>
                
                    <!-- Dashed Line -->
                    <div class="flex items-center space-x-1">
                        <span class="text-gray-500">•</span>
                        <div class="border-t-2 border-dashed border-gray-400 w-16"></div>
                        <i class="fas fa-arrow-right text-gray-500"></i>
                    </div>
                
                    <!-- Destination -->
                    <div class="flex items-center space-x-2 px-4 py-2 bg-gray-100 rounded-full shadow-sm">
                        <i class="fas fa-map-marker-alt text-gray-600"></i>
                        <span class="text-gray-700 text-sm font-medium">{{$order->address->first()->city}},{{$order->address->first()->state}}</span>
                    </div>
                </div>
                


                <!-- Scrollable Products Container -->
                <div class="mt-4 max-h-60 overflow-y-auto grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($order->items as $item)
                    <div class="flex items-center bg-gray-100 p-3 rounded-2xl">
                        <img src="{{$item->product->thumbnail}}" class="w-64  h-50 rounded-md border mr-4">
                        <div>
                            <p class="text-gray-700 font-semibold">{{$item->product->product_name}}/p>
                            <p class="text-gray-500 font-semibold" style="font-family: Arial, Helvetica, sans-serif">{{$item->product->price }}</p>
                        </div>
                    </div>
                    @endforeach
                                   
                </div>

                <hr class="my-4">
                <div class="flex justify-between">
                    <p class="text-gray-700 font-semibold" style="font-family: Arial, Helvetica, sans-serif">Total: ₹{{$order->payments->first()->amount ?? null}} ({{$order->items->count()}} items)</p>
                    <a href="{{ url('order-details/'.$order->order_no) }}"><button class="px-4 py-2 bg-black text-white rounded-2xl">Details</button></a>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <!-- Footer -->
    @include('website.partials.footer')

@endsection
