<footer class="footer appear-animate" data-animation-options="{
    'name': 'fadeIn'
}">

    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-about">
                        <a href="{{ url('index') }}" class="logo-footer">
                            <img src="assets/images/logo_footer.png" alt="logo-footer" width="144" height="45" />
                        </a>
                        <div class="widget-body">
                            <p class="widget-about-title">Got Question? Call us 24/7</p>
                            <a href="tel:18005707777" class="widget-about-call">1-800-570-7777</a>
                            <p class="widget-about-desc">Register now to get updates on pronot get up icons
                                & coupons ster now toon.
                            </p>

                            <div class="social-icons social-icons-colored">
                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="widget">
                        <h3 class="widget-title">Company</h3>
                        <ul class="widget-body">
                            <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                            <li><a href="#">Order History</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="widget-body">
                            {{-- <li><a href="#">Track My Order</a></li> --}}
                            <li><a href="{{route('view-cart')}}">View Cart</a></li>
                            <li><a href="{{route('register-login')}}">Sign In</a></li>                
                            <li><a href="{{ route('view-wishlist') }}">My Wishlist</a></li>                
                        </ul>
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>
                        <ul class="widget-body">
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Money-back guarantee!</a></li>
                            <li><a href="#">Product Returns</a></li>
                            <li><a href="#">Support Center</a></li>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Term and Conditions</a></li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
       
        <div class="footer-bottom">
            <div class="footer-center">
                <p class="copyright">Copyright © 2021 Wolmart Store. All Rights Reserved.</p>
            </div>
           
        </div>
    </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Page-wrapper-->

<!-- Start of Sticky Footer -->
<div class="sticky-footer sticky-content fix-bottom">
    <a href="{{ url('index') }}" class="sticky-link active">
        <i class="w-icon-home"></i>
        <p>Home</p>
    </a>
    <a href="shop-banner-sidebar.html" class="sticky-link">
        <i class="w-icon-category"></i>
        <p>Shop</p>
    </a>
    <a href="my-account.html" class="sticky-link">
        <i class="w-icon-account"></i>
        <p>Account</p>
    </a>
    <div class="cart-dropdown dir-up">
        <a href="cart.html" class="sticky-link">
            <i class="w-icon-cart"></i>
            <p>Cart</p>
        </a>
        <div class="dropdown-box">
            <div class="products">
                <div class="product product-cart">
                    <div class="product-detail">
                        <h3 class="product-name">
                            <a href="product-default.html">Beige knitted elas<br>tic
                                runner shoes</a>
                        </h3>
                        <div class="price-box">
                            <span class="product-quantity">1</span>
                            <span class="product-price">$25.68</span>
                        </div>
                    </div>
                    <figure class="product-media">
                        <a href="product-default.html">
                            <img src="assets/images/cart/product-1.jpg" alt="product" height="84"
                                width="94" />
                        </a>
                    </figure>
                    <button class="btn btn-link btn-close" aria-label="button">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="product product-cart">
                    <div class="product-detail">
                        <h3 class="product-name">
                            <a href="product-default.html">Blue utility pina<br>fore
                                denim dress</a>
                        </h3>
                        <div class="price-box">
                            <span class="product-quantity">1</span>
                            <span class="product-price">$32.99</span>
                        </div>
                    </div>
                    <figure class="product-media">
                        <a href="product-default.html">
                            <img src="assets/images/cart/product-2.jpg" alt="product" width="84"
                                height="94" />
                        </a>
                    </figure>
                    <button class="btn btn-link btn-close" aria-label="button">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="cart-total">
                <label>Subtotal:</label>
                <span class="price">$58.67</span>
            </div>

            <div class="cart-action">
                <a href="cart.html" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                <a href="checkout.html" class="btn btn-primary  btn-rounded">Checkout</a>
            </div>
        </div>
        <!-- End of Dropdown Box -->
    </div>

    <div class="header-search hs-toggle dir-up">
        <a href="#" class="search-toggle sticky-link">
            <i class="w-icon-search"></i>
            <p>Search</p>
        </a>
        <form action="#" class="input-wrapper">
            <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                required />
            <button class="btn btn-search" type="submit">
                <i class="w-icon-search"></i>
            </button>
        </form>
    </div>
</div>
<!-- End of Sticky Footer -->

<!-- Start of Scroll Top -->
<a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i
        class="w-icon-angle-up"></i> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
        <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35"
            cy="35" r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
    </svg> </a>
<!-- End of Scroll Top -->

<!-- Start of Mobile Menu -->
<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    <div class="mobile-menu-container scrollable">
        <form action="#" method="get" class="input-wrapper">
            <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                required />
            <button class="btn btn-search" type="submit">
                <i class="w-icon-search"></i>
            </button>
        </form>
        <!-- End of Search Form -->

        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link active">Main Menu</a>
                </li>
                <li class="nav-item">
                    <a href="#categories" class="nav-link">Categories</a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane active" id="main-menu">
                <ul class="mobile-menu">
                    <li><a href="{{ url('index') }}">Home</a></li>
                    <li><a href="{{ route('products') }}">Products</a></li>
                    <li><a href="{{ route('daily-deals') }}">Daily Deals</a></li>
                    <li><a href="{{ route('contact-us') }}">/Contact Us</a></li>
                </ul>
            </div>

            <div class="tab-pane" id="categories">
                <ul class="mobile-menu">
                    <?php $commonData = app('commonData'); ?>

                    @foreach ($commonData['parentCategoriesMega'] as $cat)
                        <li>
                            <a href="#">
                                <i class="w-icon-tshirt2"></i>{{ $cat->name }}
                            </a>
                            <ul>
                                @foreach ($cat['categories'] as $item)
                                    <li>
                                        <a
                                            href="{{ route('category.product', ['slug' => $item->slug]) }}">{{ $item->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach

                    @foreach ($commonData['parentCategoriesNormal'] as $cat)
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-heartbeat"></i>{{ $cat->name }}
                            </a>
                        </li>
                    @endforeach

                    <li>
                        <a href="shop-banner-sidebar.html" class="font-weight-bold text-primary text-uppercase ls-25">
                            View All Categories<i class="w-icon-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- End of Mobile Menu -->

<!-- Start of Newsletter popup -->
<div class="newsletter-popup mfp-hide">
    <div class="newsletter-content">
        <h4 class="text-uppercase font-weight-normal ls-25">Get Up to<span class="text-primary">25% Off</span>
        </h4>
        <h2 class="ls-25">Sign up to Wolmart</h2>
        <p class="text-light ls-10">Subscribe to the Wolmart market newsletter to
            receive updates on special offers.</p>
        <form action="#" method="get" class="input-wrapper input-wrapper-inline input-wrapper-round">
            <input type="email" class="form-control email font-size-md" name="email" id="email2"
                placeholder="Your email address" required="">
            <button class="btn btn-dark" type="submit">SUBMIT</button>
        </form>
        <div class="form-checkbox d-flex align-items-center">
            <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup"
                required="">
            <label for="hide-newsletter-popup" class="font-size-sm text-light">Don't show this popup
                again.</label>
        </div>
    </div>
</div>
<!-- End of Newsletter popup -->



<style>
    #search-results {
        position: absolute;
        /* Ensure it’s positioned relative to the nearest positioned ancestor */
        z-index: 1000;
        /* Ensure it appears above other content */
        background: #fff;
        /* White background for better visibility */
        border: 1px solid #ddd;
        /* Optional border for distinction */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Optional shadow for better separation */
        display: none;
        /* Hide by default */
    }

    .search-results-container {
        padding: 12px;
        border: 1px solid #ddd;
        background-color: #fff;
        position: absolute;
        width: 30%;
        z-index: 1000;
        display: none;
    }

    /* Styling for individual search items */
    .search-item {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .search-item:last-child {
        border-bottom: none;
    }

    /* Styling for search item links */
    .search-item-link {
        text-decoration: none;
        color: #333;
        display: flex;
        align-items: center;
    }

    .search-item-title {
        margin: 0;
        font-size: 16px;
    }

    .search-item-price {
        margin: 0;
        font-size: 14px;
        color: #666;
    }
</style>
