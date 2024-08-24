<h2 class="title justify-content-center ls-normal mb-4 mt-10 pt-1 appear-animate">Popular Departments</h2>
<div class="tab tab-nav-boxed tab-nav-outline appear-animate">
    <ul class="nav nav-tabs justify-content-center" role="tablist">
        @foreach ($tabs as $index => $tab)
            <li class="nav-item mr-2 mb-2">
                <a class="nav-link {{ $loop->first ? 'active' : '' }} br-sm font-size-md ls-normal"
                    href="#tab{{ $index }}">{{ $tab['title'] }}</a>
            </li>
        @endforeach
    </ul>
</div>
<!-- End of Tab -->
<div class="tab-content product-wrapper appear-animate">
    @foreach ($tabs as $index => $tab)
        <div class="tab-pane {{ $loop->first ? 'active' : '' }} pt-4" id="tab{{ $index }}">
            <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                @foreach ($tab['products'] as $product)
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="{{ url('product-details/' . $product['slug']) }}">
                                    <img src="{{ $product['thumbnail'] }}" alt="Product" width="300"
                                        height="338" />
                                    @if (isset($product['images'][1]))
                                        <img src="{{ $product['images'][1] }}" alt="Product" width="300"
                                            height="338" />
                                    @endif
                                </a>
                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                        title="Add to cart"></a>
                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                        title="Add to wishlist"></a>
                                    <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                        title="Quickview"></a>
                                    <!-- <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a> -->
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a
                                        href="{{ url('product-details/' . $product['slug']) }}">{{ $product['product_name'] }}</a>
                                </h4>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 90%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="{{ $product['link'] }}" class="rating-reviews">4.6</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">{{ $product['price'] }}</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- End of Tab Pane -->
    @endforeach
</div>
