<div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
    @foreach ($products as $product)
        <div class="product-wrap">
            <div class="product text-center">
                <figure class="product-media">
                    <a href="{{ $product['link'] }}">
                        <img src="{{ $product['image1'] }}" alt="Product" width="300" height="338" />
                        @if (isset($product['image2']))
                            <img src="{{ $product['image2'] }}" alt="Product" width="300" height="338" />
                        @endif
                    </a>
                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                        <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                        <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a>
                    </div>
                </figure>
                <div class="product-details">
                    <h4 class="product-name"><a href="{{ $product['link'] }}">{{ $product['name'] }}</a></h4>
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: {{ $product['rating'] }}%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="{{ $product['link'] }}" class="rating-reviews">({{ $product['reviews'] }} Reviews)</a>
                    </div>
                    <div class="product-price">
                        <ins class="new-price">{{ $product['price'] }}</ins>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
