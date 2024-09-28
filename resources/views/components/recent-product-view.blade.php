<h2 class="title title-underline mb-4 ls-normal appear-animate">Your Recent Views</h2>
<div class="swiper-container swiper-theme shadow-swiper appear-animate pb-4 mb-8"
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
        },
        '1200': {
            'slidesPerView': 8
        }
    }
}">
    <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-2">
        @foreach ($recentViews as $view)
            <div class="swiper-slide product-wrap mb-0">
                <div class="product text-center product-absolute">
                    <figure class="product-media">
                        <a href="{{ route('product-details', ['slug' => $view->product->slug]) }}">
                            <img src="{{ $view->product->thumbnail }}" alt="{{ $view->product->product_name }}"
                                width="130" height="146" style="background-color: #fff" />
                        </a>
                    </figure>
                    <h4 class="product-name">
                        <a href="{{ route('product-details', ['slug' => $view->product->slug]) }}">
                            {{ $view->product->product_name }}
                        </a>
                    </h4>
                </div>
            </div>
            <!-- End of Product Wrap -->
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
