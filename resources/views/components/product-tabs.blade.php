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
                                    <a href="javascript:void(0)" id="show-user"
                                        data-url="{{ route('quick-view', $product['slug']) }}"
                                        class="btn-product-icon btn-quickview w-icon-search">
                                    </a>

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


<div class="product product-single product-popup">
    <div class="row gutter-lg">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-gallery product-gallery-sticky">
                <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                    <div class="swiper-wrapper row cols-1 gutter-no" id="productImages">


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
                    <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm" id="thumbImages">

                    </div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
            </div>
        </div>
        <div class="col-md-6 overflow-hidden p-relative">
            <div class="product-details scrollable pl-0">
                <h2 class="product-title" id="productName"></h2>
                <div class="product-bm-wrapper">
                    <figure class="brand">
                        <img src="assets/images/products/brand/brand-1.jpg" alt="Brand" width="102"
                            height="48" />
                    </figure>
                    <div class="product-meta">
                        <div class="product-categories">
                            Category:
                            <span class="product-category"><a id="productCategory"></a></span>
                        </div>
                        <div class="product-sku">
                            SKU: <span id="sku"></span>
                        </div>
                    </div>
                </div>
                <div class="ratings-container">
                    <div class="ratings-full">
                        <span class="ratings" style="width: 80%;"></span>
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <a href="#" class="rating-reviews">(3 Reviews)</a>
                </div>
                <hr class="product-divider">

                <div class="product-short-desc" id="productShortDesc">
                    <!-- Short description will be updated here -->
                </div>

                <!-- Color Swatch -->
                <div class="product-form product-variation-form product-color-swatch" id="productColorSwatch">
                    <label>Color:</label>
                    <div class="d-flex align-items-center product-variations" id="colorVariations">
                        <!-- Colors will be inserted here -->
                    </div>
                </div>

                <!-- Size Swatch -->
                <div class="product-form product-variation-form product-size-swatch" id="productSizeSwatch">
                    <label class="mb-1">Size:</label>
                    <div class="flex-wrap d-flex align-items-center product-variations" id="sizeVariations">
                        <!-- Sizes will be inserted here -->
                    </div>
                    <a href="#" class="product-variation-clean" id="cleanSizeSwatch">Clean All</a>
                </div>

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
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('click', '#show-user', function() {
            const userURL = $(this).data('url');

            $.ajax({
                url: userURL,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    updateProductDetails(data);
                },
                error: function() {
                    alert('Failed to fetch product details');
                }
            });
        });

        function updateProductDetails(data) {
            // Update basic product details
            $('#productName').text(data.product_name);
            $('#productCategory').text(data.category.category_name);
            $('#sku').text(data.sku);
            $('#productPrice').text(data.price);

            // Update images
            updateProductImages(data.images, data.small_thumbs);

            // Update short description
            updateShortDescription(data.short_desc);

            // Update color swatches
            updateColorSwatches(data.attributes);

            // Update size swatches
            updateSizeSwatches(data.attributes);
        }

        function updateProductImages(images, popImages) {
            console.log('Updating product images...');
            console.log('Images:', images);
            console.log('Pop Images:', popImages);

            const imagesHtml = images.map((image, i) => `
        <div class="swiper-slide">
            <figure class="product-image">
                <img src="${image}" data-zoom-image="${popImages[i]}" alt="Product image" width="800" height="900">
            </figure>
        </div>
    `).join('');

            const productThumbHtml = popImages.map((popImage) => `
        <div class="product-thumb swiper-slide">
            <figure class="product-image">
                <img src="${popImage}" data-zoom-image="${popImage}" alt="Product image" width="103" height="116">
            </figure>
        </div>
    `).join('');

            $('#productImages').html(imagesHtml);
            $('#thumbImages').html(productThumbHtml);

            console.log('Product images and thumbnails updated.');

            // Reinitialize Swiper
            if (typeof Swiper !== 'undefined') {
                console.log('Reinitializing Swiper...');
                new Swiper('.swiper-container', {
                    // your Swiper configuration here
                });
            }
        }


        function updateShortDescription(shortDesc) {
            if (shortDesc) {
                const descriptions = shortDesc.split('|').map(desc => desc.trim()).filter(desc => desc).map(
                    desc => `<li>${desc}</li>`).join('');
                $('#productShortDesc').html(`<ul class="list-type-check list-style-none">${descriptions}</ul>`);
            } else {
                $('#productShortDesc').empty();
            }
        }

        function updateColorSwatches(attributes) {
            if (attributes) {
                const colorSwatches = attributes
                    .filter(attr => attr.color && attr.color.hex_value)
                    .map(attr => `
                        <a href="#" class="color" style="background-color: ${attr.color.hex_value}; display: inline-block; width: 30px; height: 29px;" title="${attr.color.name}"></a>
                    `).join('');

                if (colorSwatches) {
                    $('#productColorSwatch').show();
                    $('#colorVariations').html(colorSwatches);
                } else {
                    $('#productColorSwatch').hide();
                }
            } else {
                $('#productColorSwatch').hide();
            }
        }

        function updateSizeSwatches(attributes) {
            if (attributes) {
                const sizeSwatches = attributes
                    .filter(attr => attr.size && attr.size.size)
                    .map(attr => `<a href="#" class="size">${attr.size.size}</a>`)
                    .join('');

                if (sizeSwatches) {
                    $('#productSizeSwatch').show();
                    $('#sizeVariations').html(sizeSwatches);
                } else {
                    $('#productSizeSwatch').hide();
                }
            } else {
                $('#productSizeSwatch').hide();
            }
        }
    });
</script>
