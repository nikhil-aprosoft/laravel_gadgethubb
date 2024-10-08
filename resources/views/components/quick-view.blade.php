<!-- Start of Quick View -->
<div class="product product-single product-popup">
    <div class="row gutter-lg">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-gallery product-gallery-sticky">
                <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                    <div class="swiper-wrapper row cols-1 gutter-no">

                        @php
                            $imageCount = count($product->images);
                        @endphp

                        @for ($i = 0; $i < $imageCount; $i++)
                            <div class="swiper-slide">
                                <figure class="product-image">
                                    <img src="{{ $product->images[$i] }}" data-zoom-image="{{ $product->pop_images[$i] }}"
                                        alt="pop-images" width="800" height="900">
                                </figure>
                            </div>
                        @endfor

                    </div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
                <div class="product-thumbs-wrap swiper-container"
                    data-swiper-options="{
                    'navigation': {
                        'nextEl': '.swiper-button-next',
                        'prevEl': '.swiper-button-prev'
                    }
                }">
                    <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                        @foreach ($product->small_thumbs as $smallThumb)
                            <div class="product-thumb swiper-slide">
                                <img src="{{ $smallThumb }}" alt="Product Thumb" width="103" height="116">
                            </div>
                        @endforeach
                    </div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
            </div>
        </div>
        <div class="col-md-6 overflow-hidden p-relative">
            <div class="product-details scrollable pl-0">
                <h2 class="product-title">{{ $product->product_name }}</h2>
                <div class="product-bm-wrapper">
                    {{-- <figure class="brand">
                        <img src="{{ asset('assets/images/products/brand/brand-1.jpg') }}" alt="Brand"
                            width="102" height="48" />
                    </figure> --}}
                    <div class="product-meta">
                        <div class="product-categories">
                            Category:
                            <span class="product-category"><a
                                    href="#">{{ $product->category->category_name }}</a></span>
                        </div>
                        <div class="product-sku">
                            SKU: <span>{{ $product->sku }}</span>
                        </div>
                    </div>
                </div>

                <hr class="product-divider">

                <div class="product-price">{{ $product->price }}</div>

                <div class="ratings-container">
                    <div class="ratings-full">
                        <span class="ratings" style="width: 80%;"></span>
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <a href="#" class="rating-reviews">(3 Reviews)</a>
                </div>

                <div class="product-short-desc">
                    <ul class="list-type-check list-style-none">
                        @foreach (explode('|', $product->short_desc) as $desc)
                            @if (trim($desc))
                                <li>{{ trim($desc) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>


                <hr class="product-divider">
                @if ($product['attributes'])
                    @php
                        $hasColor = false;
                        $hasSize = false;

                        foreach ($product['attributes'] as $attribute) {
                            if (isset($attribute['color']) && !empty($attribute['color'])) {
                                $hasColor = true;
                            }

                            if (isset($attribute['size']) && !empty($attribute['size'])) {
                                $hasSize = true;
                            }
                        }
                    @endphp

                    @if ($hasColor)
                        <div class="product-form product-variation-form product-color-swatch">
                            <label>Color:</label>
                            <div class="d-flex align-items-center product-variations">
                                @foreach ($product['attributes'] as $attribute)
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
                        <div class="product-form product-variation-form product-size-swatch">
                            <label class="mb-1">Size:</label>
                            <div class="flex-wrap d-flex align-items-center product-variations">
                                @foreach ($product['attributes'] as $attribute)
                                    @if (isset($attribute['size']) && !empty($attribute['size']))
                                        <a href="#" class="size">{{ $attribute['size']['size'] }}</a>
                                    @endif
                                @endforeach
                            </div>
                            <a href="#" class="product-variation-clean">Clean All</a>
                        </div>
                    @endif
                @endif



                <div class="product-form">
                    <div class="product-qty-form">
                        <div class="input-group">
                            <input class="quantity form-control" type="number" min="1" max="10000000">
                            <button class="quantity-plus w-icon-plus"></button>
                            <button class="quantity-minus w-icon-minus"></button>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-cart">
                        <i class="w-icon-cart"></i>
                        <span>Add to Cart</span>
                    </button>
                </div>
                {{-- 
                <div class="social-links-wrapper">
                    <div class="social-links">
                        <div class="social-icons social-no-color border-thin">
                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>                            
                        
                            <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                            
                        </div>
                    </div>
                    <span class="divider d-xs-show"></span>
                    <div class="product-link-wrapper d-flex">
                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                        <a href="#"
                            class="btn-product-icon btn-compare btn-icon-left w-icon-compare"><span></span></a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
