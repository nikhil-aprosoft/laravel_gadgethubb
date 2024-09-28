@extends('layouts.app')
@section('title', 'Wishlist')
@section('content')
    <div class="page-wrapper">
        <h1 class="d-none">Wolmart - Responsive Marketplace HTML Template</h1>

        <!-- Start of Header -->
        @include('website.partials.header')
        <!-- End of Header -->

        <!-- Start of Main -->
        <main class="main wishlist-page">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">Wishlist</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav mb-10">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="{{ url('index') }}">Home</a></li>
                        <li>Wishlist</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <h3 class="wishlist-title">My wishlist</h3>
                    @if ($wishlistItems->isNotEmpty())
                        <table class="shop-table wishlist-table">
                            <thead>
                                <tr>
                                    <th class="product-name"><span>Product</span></th>
                                    <th></th>
                                    <th class="product-price"><span>Price</span></th>
                                    <th class="product-stock-status"><span>Stock Status</span></th>
                                    <th class="wishlist-action">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlistItems as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="{{ route('product-details', ['slug' => $item->product->slug]) }}">
                                                    <figure>
                                                        <img src="{{ $item->product->thumbnail }}"
                                                            alt="{{ $item->product->product_name }}" width="300"
                                                            height="338">
                                                    </figure>
                                                </a>
                                                <button type="submit" class="btn btn-close"
                                                    onclick="removeFromWishlist({{ $item->id }})"><i
                                                        class="fas fa-times"></i></button>
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{ route('product-details', ['slug' => $item->product->slug]) }}">
                                                {{ $item->product->product_name }}
                                            </a>
                                        </td>
                                        <td class="product-price">
                                            <ins class="new-price">{{ $item->product->price }}</ins>
                                        </td>
                                        <td class="product-stock-status">
                                            <span class="wishlist-in-stock">{{$item->product->quantity > 0 ? "In Stock" : "out of stock"}}</span>
                                        </td>
                                        <td class="wishlist-action">
                                            <div class="d-lg-flex">
                                                <a href="{{ route('product-details', ['slug' => $item->product->slug]) }}"
                                                    class="btn btn-quickview btn-outline btn-default btn-rounded btn-sm mb-2 mb-lg-0">
                                                    View-Product</a>
                                                <a href="#"
                                                    class="btn btn-dark btn-rounded btn-sm ml-lg-2 btn-cart">Add to cart</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <div class="social-links">
                        <label>Share On:</label>
                        <div class="social-icons social-no-color border-thin">
                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                            <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                            <a href="#" class="social-icon social-email far fa-envelope"></a>
                            <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <div id="alertPlaceholder"></div>
        <!-- End of Main -->

        @include('website.partials.footer')
        <!-- End of Footer -->
    </div>
    <script>
        function removeFromWishlist(itemId) {

            axios.delete(`/wishlist/${itemId}`)
                .then(response => {
                    // Handle success response
                    Swal.fire({
                        title: "Product removed from wishlist",
                    });
                    location.reload();
                })
                .catch(error => {
                    // Handle error response
                    console.error(error);
                });
        }
    </script>
@endsection
