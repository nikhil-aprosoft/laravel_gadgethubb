<div class="product-wrapper-1 appear-animate mb-5">
    <div class="title-link-wrapper pb-1 mb-4">
        <h2 class="title ls-normal mb-0">New Shoes Arrivals</h2>
        <a href="shop-boxed-banner.html" class="font-size-normal font-weight-bold ls-25 mb-0">More Products<i class="w-icon-long-arrow-right"></i></a>
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-4 mb-4">
            <div class="banner h-100 br-sm" style="background-image: url(assets/images/demos/demo1/banners/2.jpg); background-color: #ebeced;">
                <div class="banner-content content-top" style="margin: 40px;">
                    <h5 class="banner-subtitle font-weight-normal mb-2">Weekend Sale</h5>
                    <hr class="banner-divider bg-dark mb-2">
                    <h3 class="banner-title font-weight-bolder ls-25 text-uppercase">
                        New Arrivals<br> 
                        <span class="font-weight-normal text-capitalize">Collection</span>
                    </h3>
                    <a href="shop-banner-sidebar.html" class="btn btn-dark btn-outline btn-rounded btn-sm">Shop Now</a>
                </div>
            </div>
        </div>
        <!-- End of Banner -->

        <div class="col-lg-9 col-sm-8">
            <div class="swiper-container swiper-theme" data-swiper-options="{
                'spaceBetween': 20,
                'slidesPerView': 2,
                'breakpoints': {
                    '992': {'slidesPerView': 3},
                    '1200': {'slidesPerView': 4}
                }
            }">
                <div class="swiper-wrapper row cols-xl-4 cols-lg-3 cols-2">
                    @foreach ($data as $shoe)
                    <div class="swiper-slide product-col">
                        <div class="product-wrap product text-center">
                            <figure class="product-media">
                                <a href="">
                                    <img src="{{ asset($shoe->thumbnail) }}" alt="{{ $shoe->product_name }}" width="216" height="243" />
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                    <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                    <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a>
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a href="">{{ $shoe->product_name     }}</a></h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: {{ $shoe->rating * 20 }}%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="" class="rating-reviews">( 7 reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">${{ number_format($shoe->price, 2) }}</ins>
                                    @if($shoe->old_price)
                                        <del class="old-price">${{ number_format($shoe->old_price, 2) }}</del>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>
