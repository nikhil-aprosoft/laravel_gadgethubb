<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Sandeep-Tech-Porduct</title>

    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description" content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/icons/favicon.png">
    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: {
                families: ['Poppins:400,500,600,700']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '{{ asset('assets/js/webfont.js') }}';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="preload" href="{{ asset('assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2') }}"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }}" as="font"
        type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2') }}"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/wolmart87d5.woff?png09e') }}" as="font" type="font/woff"
        crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Add this in the <head> section of your Blade template -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="home">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var status = @json(session('status'));
            var statusType = @json(session('status_type'));

            if (status) {
                Swal.fire({
                    title: statusType === 'success' ? 'Success!' : 'Error!',
                    text: status,
                    icon: statusType === 'success' ? 'success' : 'error'
                });
            }
        });
        function addToCart(product) {
        const url = `{{ route('cart') }}`;
        const loginUrl = `{{ route('register_login') }}`;

        axios.post(url, {
                product_id: product.product_id,
                quantity: 1
            })
            .then(response => {
                Swal.fire({
                    title: "Product added to cart",
                    icon: "success"
                });
                setTimeout(() => {
                    location.reload();
                }, 2000);
            })
            .catch(error => {
                // console.error("There was an error adding the product to the cart:", error);
                // alert("Failed to add to cart. Please try again.");

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
    <div class="page-wrapper">
        <h1 class="d-none">Wolmart - Responsive Marketplace HTML Template</h1>
        <!-- Start of Header -->
        @include('website.partials.header')
        <!-- End of Header -->

        <!-- Start of Main-->
        <main class="main">
            <section class="intro-section">
                <div class="swiper-container swiper-theme nav-inner pg-inner swiper-nav-lg animation-slider pg-xxl-hide nav-xxl-show nav-hide"
                    data-swiper-options="{
                    'slidesPerView': 1,
                    'autoplay': {
                        'delay': 8000,
                        'disableOnInteraction': false
                    }
                }">
                    <div class="swiper-wrapper">
                        @foreach ($featureBanners as $fb)
                            <div class="swiper-slide banner banner-fixed intro-slide intro-slide1"
                                style="background-image: url(assets/images/demos/demo1/sliders/slide-1.jpg); background-color: #ebeef2;">
                                <div class="container">
                                    <figure class="slide-image skrollable slide-animate">
                                        <img src="assets/images/demos/demo1/sliders/shoes.png" alt="Banner"
                                            data-bottom-top="transform: translateY(10vh);"
                                            data-top-bottom="transform: translateY(-10vh);" width="474"
                                            height="397">
                                    </figure>
                                    <div class="banner-content y-50 text-right">
                                        <h5 class="banner-subtitle font-weight-normal text-default ls-50 lh-1 mb-2 slide-animate"
                                            data-animation-options="{
                               'name': 'fadeInRightShorter',
                               'duration': '1s',
                               'delay': '.2s'
                           }">
                                            Custom <span class="p-relative d-inline-block">Men’s</span>
                                        </h5>
                                        <h3 class="banner-title font-weight-bolder ls-25 lh-1 slide-animate"
                                            data-animation-options="{
                               'name': 'fadeInRightShorter',
                               'duration': '1s',
                               'delay': '.4s'
                           }">
                                            RUNNING SHOES
                                        </h3>
                                        {{-- <p class="font-weight-normal text-default slide-animate"
                                   data-animation-options="{
                               'name': 'fadeInRightShorter',
                               'duration': '1s',
                               'delay': '.6s'
                           }">
                                   Sale up to <span class="font-weight-bolder text-secondary">30% OFF</span>
                               </p> --}}

                                        <a href="shop-list.html"
                                            class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                                            data-animation-options="{
                               'name': 'fadeInRightShorter',
                               'duration': '1s',
                               'delay': '.8s'
                           }">SHOP
                                            NOW<i class="w-icon-long-arrow-right"></i></a>

                                    </div>
                                    <!-- End of .banner-content -->
                                </div>
                                <!-- End of .container -->
                            </div>
                        @endforeach
                        <!-- End of .intro-slide1 -->
                    </div>
                    <div class="swiper-pagination"></div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
                <!-- End of .swiper-container -->
            </section>
            <!-- End of .intro-section -->

            <div class="container">
                <div class="swiper-container appear-animate icon-box-wrapper br-sm mt-6 mb-6"
                    data-swiper-options="{
                    'slidesPerView': 1,
                    'loop': false,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 2
                        },
                        '768': {
                            'slidesPerView': 3
                        },
                        '1200': {
                            'slidesPerView': 4
                        }
                    }
                }">
                    <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
                        <div class="swiper-slide icon-box icon-box-side icon-box-primary">
                            <span class="icon-box-icon icon-shipping">
                                <i class="w-icon-truck"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title font-weight-bold mb-1">Free Shipping & Returns</h4>
                                <p class="text-default">For all orders over $99</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box icon-box-side icon-box-primary">
                            <span class="icon-box-icon icon-payment">
                                <i class="w-icon-bag"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title font-weight-bold mb-1">Secure Payment</h4>
                                <p class="text-default">We ensure secure payment</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box icon-box-side icon-box-primary icon-box-money">
                            <span class="icon-box-icon icon-money">
                                <i class="w-icon-money"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title font-weight-bold mb-1">Money Back Guarantee</h4>
                                <p class="text-default">Any back within 30 days</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box icon-box-side icon-box-primary icon-box-chat">
                            <span class="icon-box-icon icon-chat">
                                <i class="w-icon-chat"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title font-weight-bold mb-1">Customer Support</h4>
                                <p class="text-default">Call or email us 24/7</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Iocn Box Wrapper -->

                {{-- <div class="row category-banner-wrapper appear-animate pt-6 pb-8">
                    @foreach ($banners as $b)
                        <div class="col-md-6 mb-4">
                            <div class="banner banner-fixed br-xs">
                                <figure>
                                    <img src="assets/images/demos/demo1/categories/1-1.jpg" alt="Category Banner"
                                        width="610" height="160" style="background-color: #ecedec;" />
                                </figure>
                                <div class="banner-content y-50 mt-0">
                                    <h5 class="banner-subtitle font-weight-normal text-dark">Get up to <span
                                            class="text-secondary font-weight-bolder text-uppercase ls-25">20%
                                            Off</span>
                                    </h5>
                                    <h3 class="banner-title text-uppercase">{{ $b->banner_text }}
                                    </h3>
                                    <div class="banner-price-info font-weight-normal">Starting at <span
                                            class="text-secondary                       font-weight-bolder">$170.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> --}}
                {{-- <style>
                    .banner-content {
                        text-align: left; /* Align text to the left */
                        padding-left: 20px; /* Add some padding on the left side */
                        margin-top: auto; /* Center vertically if needed */
                    }

                    .banner-content h5,
                    .banner-content h3,
                    .banner-content .banner-price-info {
                        margin-bottom: 10px; /* Adjust space between text elements */
                    }

                    .banner-title {
                        font-size: 1.5rem; /* Adjust font size as needed */
                    }

                    .banner-price-info {
                        font-size: 1.2rem; /* Adjust font size for price info */
                    }

                    .banner {
                        position: relative; /* Make sure content is positioned correctly */
                        overflow: hidden; /* Ensure content doesn't overflow */
                    }

                    figure {
                        margin: 0; /* Remove default margin */
                    }

                    img {
                        width: 100%; /* Make images responsive */
                        height: auto; /* Maintain aspect ratio */
                    }
                </style>
                 --}}
                <div class="row category-banner-wrapper appear-animate pt-6 pb-8">
                    <div class="col-md-6 mb-4">
                        <div class="banner banner-fixed br-xs">
                            <figure>
                                <img src="{{ asset('assets/images/short_banner/1.png') }}" alt="Category Banner"
                                    width="610" height="160" style="background-color: #ecedec;" />
                            </figure>
                            {{-- <div class="banner-content y-50 mt-0">
                                <h5 class="banner-subtitle font-weight-normal text-dark">Get up to <span
                                        class="text-secondary font-weight-bolder text-uppercase ls-25">20% Off</span>
                                </h5>
                                <h3 class="banner-title text-uppercase" style="font-size: 2.5rem;">Sports
                                    Outfits<br><span class="font-weight-normal text-capitalize">Collection</span>
                                </h3>
                                <div class="banner-price-info font-weight-normal" style="font-size: initial;">Starting
                                    at <span class="text-secondary font-weight-bolder">$170.00</span>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="banner banner-fixed br-xs">
                            <figure>
                                <img src="{{ asset('assets/images/short_banner/2.png') }}" alt="Category Banner"
                                    width="610" height="160" style="background-color: #636363;" />
                            </figure>
                            {{-- <div class="banner-content y-50 mt-0">
                                <h5 class="banner-subtitle font-weight-normal text-capitalize">New Arrivals</h5>
                                <h3 class="banner-title text-white text-uppercase" style="font-size: 2.5rem;">
                                    Accessories<br><span class="font-weight-normal text-capitalize">Collection</span>
                                </h3>
                                <div class="banner-price-info text-white font-weight-normal text-capitalize"
                                    style="font-size: 2.5rem;">Only From
                                    <span class="text-secondary font-weight-bolder">$90.00</span>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- End of Category Banner Wrapper -->

                <!-- End of Category Banner Wrapper -->

                <div class="row deals-wrapper appear-animate mb-8">
                    <div class="col-lg-9 mb-4">
                        <div class="single-product h-100 br-sm">
                            <h4 class="title-sm title-underline font-weight-bolder ls-normal">
                                Deals Hot of The Day
                            </h4>
                            <div class="swiper">
                                <div class="swiper-container swiper-theme nav-top swiper-nav-lg"
                                    data-swiper-options="{
                                    'spaceBetween': 20,
                                    'slidesPerView': 1
                                }">
                                    <div class="swiper-wrapper row cols-1 gutter-no">
                                        @foreach ($dailyDeals as $dailyDeal)
                                            @php
                                                $product = $dailyDeal['product'];
                                                $attributes = $product->colorAndSize($product);
                                            @endphp
                                            <div class="swiper-slide">
                                                <div class="product product-single row">
                                                    <div class="col-md-6">
                                                        <div
                                                            class="product-gallery product-gallery-sticky product-gallery-vertical">
                                                            <div
                                                                class="swiper-container product-single-swiper swiper-theme nav-inner">
                                                                <div class="swiper-wrapper row cols-1 gutter-no">
                                                                    @foreach ($product->images as $item)
                                                                        <div class="swiper-slide">
                                                                            <figure class="product-image">
                                                                                <img src="{{ $item }}"
                                                                                    data-zoom-image="{{ $item }}"
                                                                                    alt="Product Image" width="800"
                                                                                    height="900">
                                                                            </figure>
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                                <button class="swiper-button-next"></button>
                                                                <button class="swiper-button-prev"></button>
                                                                <div class="product-label-group">
                                                                    <label
                                                                        class="product-label label-discount">{{ $dailyDeal->discount_amount }}%
                                                                        off</label>
                                                                </div>
                                                            </div>
                                                            <div class="product-thumbs-wrap swiper-container"
                                                                data-swiper-options="{
                                                            'direction': 'vertical',
                                                            'breakpoints': {
                                                                '0': {
                                                                    'direction': 'horizontal',
                                                                    'slidesPerView': 4
                                                                },
                                                                '992': {
                                                                    'direction': 'vertical',
                                                                    'slidesPerView': 'auto'
                                                                }
                                                            }
                                                        }">
                                                                <div
                                                                    class="product-thumbs swiper-wrapper row cols-lg-1 cols-4 gutter-sm">
                                                                    @foreach ($product->small_thumbs as $item)
                                                                        <div class="product-thumb swiper-slide">
                                                                            <img src="{{ $item }}"
                                                                                alt="Product thumb" width="60"
                                                                                height="68" />
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="product-details scrollable">
                                                            <h2 class="product-title mb-1"><a
                                                                    href="{{ url('product-details/' . $product->slug) }}">{{ $product->product_name }}</a>
                                                            </h2>

                                                            <hr class="product-divider">

                                                            <div class="product-price"><ins
                                                                    class="new-price ls-50">{{ $product->price }}</ins>
                                                            </div>

                                                            <div class="product-countdown-container flex-wrap">
                                                                <label class="mr-2 text-default">Offer Ends In:</label>
                                                                <div class="product-countdown countdown-compact"
                                                                    data-until="2022, 12, 31" data-compact="true">
                                                                    @php
                                                                        $countdown = getDealExpireTime($dailyDeal);
                                                                        echo $countdown;
                                                                    @endphp
                                                                </div>
                                                            </div>

                                                            <div class="ratings-container">
                                                                <div class="ratings-full">
                                                                    <span class="ratings" style="width: 80%;"></span>
                                                                    <span class="tooltiptext tooltip-top"></span>
                                                                </div>
                                                                <a href="#" class="rating-reviews">(3
                                                                    Reviews)</a>
                                                            </div>

                                                            @if ($attributes['attributes'])
                                                                @php
                                                                    $hasColor = false;
                                                                    $hasSize = false;

                                                                    foreach ($attributes['attributes'] as $attribute) {
                                                                        if (
                                                                            isset($attribute['color']) &&
                                                                            !empty($attribute['color'])
                                                                        ) {
                                                                            \Log::alert('message');
                                                                            $hasColor = true;
                                                                        }

                                                                        if (
                                                                            isset($attribute['size']) &&
                                                                            !empty($attribute['size'])
                                                                        ) {
                                                                            $hasSize = true;
                                                                        }
                                                                    }
                                                                @endphp

                                                                @if ($hasColor)
                                                                    <div
                                                                        class="product-form product-variation-form product-color-swatch">
                                                                        <label>Color:</label>
                                                                        <div
                                                                            class="d-flex align-items-center product-variations">
                                                                            @foreach ($attributes['attributes'] as $attribute)
                                                                                @if (isset($attribute['color']) && !empty($attribute['color']))
                                                                                    <a href="#" class="color"
                                                                                        style="background-color: {{ $attribute['color']['hex_value'] }};display: inline-block;width: 30px;heig;height: 29px;"
                                                                                        title="{{ $attribute['color']['name'] }}">
                                                                                    </a>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                @if ($hasSize)
                                                                    <div
                                                                        class="product-form product-variation-form product-size-swatch">
                                                                        <label class="mb-1">Size:</label>
                                                                        <div
                                                                            class="flex-wrap d-flex align-items-center product-variations">
                                                                            @foreach ($attributes['attributes'] as $attribute)
                                                                                @if (isset($attribute['size']) && !empty($attribute['size']))
                                                                                    <a href="#"
                                                                                        class="size">{{ $attribute['size']['size'] }}</a>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                        <a href="#"
                                                                            class="product-variation-clean">Clean
                                                                            All</a>
                                                                    </div>
                                                                @endif
                                                            @endif

                                                            <div class="product-form pt-4">
                                                                <div class="product-qty-form mb-2 mr-2">
                                                                    <div class="input-group">
                                                                        <input class="quantity form-control"
                                                                            type="number" min="1"
                                                                            max="10000000">
                                                                        <button
                                                                            class="quantity-plus w-icon-plus"></button>
                                                                        <button
                                                                            class="quantity-minus w-icon-minus"></button>
                                                                    </div>
                                                                </div>
                                                                <button class="btn btn-primary btn-cart"  onclick="addToCart({{ json_encode($product) }})">
                                                                    <i class="w-icon-cart"></i>
                                                                    <span>Add to Cart</span>
                                                                </button>
                                                            </div>

                                                            <div class="social-links-wrapper mt-1">
                                                                <div class="social-links mx-auto">
                                                                    <div
                                                                        class="social-icons social-no-color border-thin">
                                                                        <a href="#"
                                                                            class="social-icon social-facebook w-icon-facebook"></a>
                                                                        <a href="#"
                                                                            class="social-icon social-twitter w-icon-twitter"></a>
                                                                        <a href="#"
                                                                            class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                                                        <a href="#"
                                                                            class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                                                        <a href="#"
                                                                            class="social-icon social-youtube fab fa-linkedin-in"></a>
                                                                    </div>
                                                                </div>
                                                                {{-- <span class="divider d-xs-show"></span> --}}
                                                                {{-- <div class="product-link-wrapper d-flex">
                                                                    <a href="#"
                                                                    onClick="wishList({{ json_encode($product) }})"   class="btn-product-icon btn-wishlist w-icon-heart"></a>
                                                                    <a href="#"
                                                                        class="btn-product-icon btn-compare btn-icon-left w-icon-compare"></a>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="swiper-button-prev"></button>
                                    <button class="swiper-button-next"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-4">
                        <div class="widget widget-products widget-products-bordered h-100">
                            <div class="widget-body br-sm h-100">
                                <h4 class="title-sm title-underline font-weight-bolder ls-normal mb-2">Best Seller</h4>
                                <div class="swiper">
                                    <div class="swiper-container swiper-theme nav-top"
                                        data-swiper-options="{
                                        'slidesPerView': 3,
                                        'spaceBetween': 20,
                                        'slidesPerGroup': 3,
                                        'breakpoints': {
                                            '576': {
                                                'slidesPerView': 2,
                                                'slidesPerGroup': 2
                                            },
                                            '768': {
                                                'slidesPerView': 3,
                                                'slidesPerGroup': 3
                                            },
                                            '992': {
                                                'slidesPerView': 1,
                                                'slidesPerGroup': 1
                                            }
                                        }
                                    }">
                                        <div class="swiper-wrapper">
                                            @foreach ($bestSeller->chunk(3) as $chunk)
                                                <!-- Chunk the items into groups of 3 -->
                                                <div class="swiper-slide">
                                                    @foreach ($chunk as $bS)
                                                        <div class="product-widget-wrap">
                                                            <div class="product product-widget bb-no">
                                                                <figure class="product-media">
                                                                    <a
                                                                        href="{{ route('product-details', ['slug' => $bS->slug]) }}">
                                                                        <img src="{{ $bS->thumbnail }}"
                                                                            alt="Product" width="105"
                                                                            height="118" />
                                                                    </a>
                                                                </figure>
                                                                <div class="product-details">
                                                                    <h4 class="product-name">
                                                                        <a
                                                                            href="{{ route('product-details', ['slug' => $bS->slug]) }}">{{ $bS->product_name }}</a>
                                                                    </h4>
                                                                    <div class="ratings-container">
                                                                        {{-- <div class="ratings-full">
                                                                            <span class="ratings" style="width: 100%;"></span>
                                                                            <span class="tooltiptext tooltip-top"></span>
                                                                        </div> --}}
                                                                    </div>
                                                                    <div class="product-price">
                                                                        <ins
                                                                            class="new-price">{{ $bS->price }}</ins>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>

                                        <button class="swiper-button-next"></button>
                                        <button class="swiper-button-prev"></button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
    </div>
    <!-- End of Deals Wrapper -->
    </div>

    <section class="category-section top-category bg-grey pt-10 pb-10 appear-animate">
        <div class="container pb-2">
            <h2 class="title justify-content-center pt-1 ls-normal mb-5">Top Categories Of The Month</h2>
            <div class="swiper">
                <div class="swiper-container swiper-theme pg-show"
                    data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 3
                                },
                                '768': {
                                    'slidesPerView': 5
                                },
                                '992': {
                                    'slidesPerView': 6
                                }
                            }
                        }">
                    <div class="swiper-wrapper row cols-lg-6 cols-md-5 cols-sm-3 cols-2">
                        @php
                            $commonData = app('commonData');
                            $categories = $commonData['categories'];
                        @endphp
                        @foreach ($categories as $cat)
                            <div class="swiper-slide category category-classic category-absolute overlay-zoom br-xs">
                                <a href="{{ url('category/' . $cat->slug) }}" class="category-media">

                                    <img src="{{ $cat->category_image }}" alt="Category" width="130"
                                        height="130">
                                </a>
                                <div class="category-content">
                                    <h4 class="category-name">{{ $cat->category_name }}</h4>
                                    <a href="{{ url('category/' . $cat->slug) }}"
                                        class="btn btn-primary btn-link btn-underline">Shop
                                        Now</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of .category-section top-category -->
    <div class="container">

        <x-product-tabs :tabs="[
            [
                'title' => 'FEATURED',
                'products' => $newArrival,
            ],
            [
                'title' => 'BEST SELLER',
                'products' => $bestSeller,
            ],
        ]" />

        <x-shoes-section :data="$shoesSection" />


        <!-- Example usage in a Blade view -->
        <x-recent-product-view :recentViews="$recentViews" />

    </div>

    
    </div>
    <!--End of Catainer -->
    </main>
    <!-- End of Main -->

    <!-- Start of Footer -->
    @include('website.partials.footer')
    <!-- End of Quick view -->

    <!-- Plugin JS File -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/jquery.plugin/jquery.plugin.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/zoom/jquery.zoom.js"></script>
    <script src="assets/vendor/jquery.countdown/jquery.countdown.min.js"></script>
    <script src="assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/vendor/skrollr/skrollr.min.js"></script>

    <!-- Swiper JS -->
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.min.js"></script>
    <script src="{{ asset('assets/js/search.js') }}"></script>
</body>

</html>
