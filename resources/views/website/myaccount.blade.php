@extends('layouts.app')
@section('title', 'My-Account')

@section('content')
    <div class="page-wrapper">
        <h1 class="d-none">Wolmart - Responsive Marketplace HTML Template</h1>

        <!-- Start of Header -->
        @include('website.partials.header')
        <!-- End of Header -->


        <!-- Start of Main -->
        <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">My Account</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{ url('index') }}">Home</a></li>
                        <li>My account</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content pt-2">
                <div class="container">
                    <div class="tab tab-vertical row gutter-lg">
                        <ul class="nav nav-tabs mb-6" role="tablist">
                            <li class="nav-item">
                                <a href="#account-dashboard" class="nav-link active">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('orders-history')}}" class="nav-link">Orders</a>
                            </li>                         
                            {{-- <li class="nav-item">
                                <a href="#account-addresses" class="nav-link">Addresses</a>
                            </li> --}}
                           
                            <li class="link-item">
                                <a href="{{ route('view-wishlist') }}" class="nav-link">Wishlist</a>
                            </li>
                            <li class="link-item">
                                <a href="{{ url('logout') }}" class="nav-link">Logout</a>
                            </li>
                        </ul>

                        <div class="tab-content mb-6">
                            <div class="tab-pane active in" id="account-dashboard">
                                <p class="greeting">
                                    Hello
                                    <span class="text-dark font-weight-bold">{{ ucfirst(session('user')->name) }}
                                    </span>
                                </p>

                                <p class="mb-4">
                             
                                </p>

                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                        <a href="{{route('orders-history')}}" class="link-to-tab">
                                            <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-orders">
                                                    <i class="w-icon-orders"></i>
                                                </span>
                                                <div class="icon-box-content">
                                                    <p class="text-uppercase mb-0">Orders</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                
                                    {{-- <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                        <a href="#account-addresses" class="link-to-tab">
                                            <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-address">
                                                    <i class="w-icon-map-marker"></i>
                                                </span>
                                                <div class="icon-box-content">
                                                    <p class="text-uppercase mb-0">Addresses</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div> --}}

                                    <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                        <a href="{{ route('view-wishlist') }}" class="link-to-tab">                                                                                    
                                            <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-wishlist">
                                                    <i class="w-icon-heart"></i>
                                                </span>
                                                <div class="icon-box-content">
                                                    <p class="text-uppercase mb-0">Wishlist</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                        <a href="{{ url('logout') }}">
                                            <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-logout">
                                                    <i class="w-icon-logout"></i>
                                                </span>
                                                <div class="icon-box-content">
                                                    <p class="text-uppercase mb-0">Logout</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane mb-4" id="account-orders">
                                <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
                                    </div>
                                </div>
                               
                                @php
                                    $user = session('user');
                                    if ($user && isset($user->userid)) {
                                        $orders = App\Models\Order\Order::where('user_id', $user->userid)->get();
                                    } else {
                                        $orders = collect(); // Return an empty collection if no user is found
                                    }
                                @endphp                                                          
                            </div>
                            <div class="tab-pane" id="account-addresses">
                                <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-map-marker">
                                        <i class="w-icon-map-marker"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title mb-0 ls-normal">Addresses</h4>
                                    </div>
                                </div>
                                {{-- <p>The following addresses will be used on the checkout page
                                    by default.</p> --}}
                                @php
                                    $address = App\Models\Address::where('user_id', $user->userid)
                                        ->latest()
                                        ->limit(1)
                                        ->first();
                                @endphp
                                
                                <div class="row">

                                    <div class="col-sm-6 mb-6">
                                        <div class="ecommerce-address shipping-address pr-lg-8">
                                            <h4 class="title title-underline ls-25 font-weight-bold">Shipping Address</h4>
                                            @if ($address)
                                            <address class="mb-4">
                                                <table class="address-table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Name:</th>
                                                            <td>{{ $address->fname }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>State:</th>
                                                            <td>{{ $address->state }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>City:</th>
                                                            <td>{{ $address->city }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Area:</th>
                                                            <td>{{ $address->area }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Phone:</th>
                                                            <td>{{ $address->phone_no }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pincode:</th>
                                                            <td>{{ $address->pincode }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </address>
                                            @else
                                          <h4 class="text-center">  No Address</h4>      
                                            @endif
                                          
                                        </div>
                                    </div>

                                </div>
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
        @include('website.partials.footer')
    </div>
    <!-- End of Page Wrapper -->

@endsection
