@extends('layouts.app')
@section('title', 'Daily-Deals')
@section('content')
<div class="page-wrapper">
    <h1 class="d-none">Wolmart - Responsive Marketplace HTML Template</h1>
    
    <!-- Start of Header -->
    @include('website.partials.header')
    <!-- End of Header -->

    <!-- Start of Main -->
    <main class="main">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb bb-no">
                    <li><a href="{{ url('index') }}">Home</a></li>
                    <li><a href="{{ url('shop') }}">Shop</a></li>
                    
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content mb-10">
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center mb-6"
                style="background-image: url('{{ asset('assets/images/shop/banner2.jpg') }}'); background-color: #FFC74E;">
                <div class="container banner-content">
                    <h4 class="banner-subtitle font-weight-bold">Accessories Collection</h4>
                    <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-10">Smart Watches</h3>
                    <a href="shop-banner-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">Discover Now<i class="w-icon-long-arrow-right"></i></a>
                </div>
            </div>
            <!-- End of Shop Banner -->

            <div class="container-fluid">
                <!-- Start of Shop Content -->
                <div class="shop-content">
                    <!-- Start of Shop Main Content -->
                    <x-product-wrap :products="$products" />
                    <!-- End of Shop Main Content -->
                </div>
                <!-- End of Shop Content -->
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->

    @include('website.partials.footer')
    <!-- End of Footer -->
</div>
@endsection
