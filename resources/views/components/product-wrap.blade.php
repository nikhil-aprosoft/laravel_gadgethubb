<script>
    function wishList(product) {
        const url = `{{ route('wishlist') }}`;
        const loginUrl = `{{ route('register_login') }}`;
        axios.post(url, {
                product_id: product.product_id
            })
            .then(response => {
                Swal.fire({
                    title: "Product added to wishlist",
                    icon: "success"
                });
            })
            .catch(error => {
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
<div class="main-content">
    <nav class="toolbox sticky-toolbox sticky-content fix-top">
        <div class="toolbox-left">
            <a href="#"
                class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
                btn-icon-left"><i
                    class="w-icon-category"></i><span>Filters</span></a>
            <div class="toolbox-item toolbox-sort select-box text-dark">
                <label>Sort By :</label>
                <select name="orderby" class="form-control">
                    <option value="default" selected="selected">Default sorting</option>
                    <option value="popularity">Sort by popularity</option>
                    <option value="rating">Sort by average rating</option>
                    <option value="date">Sort by latest</option>
                    <option value="price-low">Sort by pric: low to high</option>
                    <option value="price-high">Sort by price: high to low</option>
                </select>
            </div>
        </div>

    </nav>
    <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
        @foreach ($products as $item)
            <div class="product-wrap">
                <div class="product text-center">
                    <figure class="product-media">
                        <a href="{{ route('product-details', ['slug' => $item->slug]) }}">
                            <img src="{{ $item->thumbnail }}" alt="Product" width="300" height="338" />
                        </a>
                        <div class="product-action-horizontal">
                            <a href="#" onclick="addToCart({{ json_encode($item) }})"
                                class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>

                            <a href="#" onClick="wishList({{ json_encode($item) }})"
                                class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>
                            <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quick View"
                                data-product="{{ json_encode($item) }}">
                            </a>
                        </div>
                    </figure>
                    <div class="product-details">
                        {{-- <div class="product-cat">

                            <a href="shop-banner-sidebar.html">{{ $item->category->category_name }}</a>
                        </div> --}}
                        <h3 class="product-name">
                            <a
                                href="{{ route('product-details', ['slug' => $item->slug]) }}">{{ $item->product_name }}</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="ratings-full">
                                <span class="ratings" style="width: 100%;"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <a href="{{ route('product-details', ['slug' => $item->slug]) }}" class="rating-reviews">(3
                                reviews)</a>
                        </div>
                        <div class="product-pa-wrapper">
                            <div class="product-price">
                                {{ $item->price }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Placeholder for dynamic component content -->
        <div id="quick-view-placeholder"></div>

        <!-- Hidden Blade components for each product -->
        @foreach ($products as $item)
            <x-quick-view :product="$item" id="quick-view-{{ $item->product_id }}" style="display: none;" />
        @endforeach

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.btn-quickview').on('click', function(e) {
                    e.preventDefault();
                    var productData = $(this).data('product');
                    var productId = productData.id; // Ensure each product has a unique ID

                    // Find the hidden component and show it
                    var quickViewHtml = $(`#quick-view-${productId}`).html();
                    $('#quick-view-placeholder').html(quickViewHtml).show();
                });
            });
        </script>




    </div>

    <div class="toolbox toolbox-pagination justify-content-between">
        <p class="showing-info mb-2 mb-sm-0">
            Showing<span>1-12 of 60</span>Products
        </p>
        <ul class="pagination">
            <li class="prev disabled">
                <a href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                    <i class="w-icon-long-arrow-left"></i>Prev
                </a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="next">
                <a href="#" aria-label="Next">
                    Next<i class="w-icon-long-arrow-right"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
