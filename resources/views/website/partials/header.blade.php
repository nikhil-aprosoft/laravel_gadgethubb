<!-- Start of Header -->
<header class="header header-border">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">Welcome to Wolmart Store message or remove it!</p>
            </div>
            <div class="header-right">
                <span class="divider d-lg-show"></span>
                <a href="{{ route('contact-us') }}" class="d-lg-show">Contact Us</a>
                @if (session('user'))
                    <a href="{{ route('myaccount') }}" class="d-lg-show">My Account</a>
                    <a href="{{ route('logout') }}" class="d-lg-show">Logout</a>
                @else
                    <a href="{{ url('login') }}" class="d-lg-show login sign-in"><i class="w-icon-account"></i>Sign
                        In</a>
                    <span class="delimiter d-lg-show">/</span>
                    <a href="{{ url('login') }}" class="ml-0 d-lg-show login register">Register</a>
                @endif
            </div>
        </div>
    </div>
    <!-- End of Header Top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left mr-md-4">
                <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
                </a>
                <a href="{{ url('index') }}" class="logo ml-lg-0">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo" width="144" height="45" />
                </a>
                <form class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
                    <div class="select-box">
                        <select id="category" name="category">
                            <option value="">All Categories</option>
                            <?php
                            $commonData = app('commonData');
                            $categories = $commonData['categories'];
                            ?>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <script>
                        var searchRoute = "{{ route('search') }}"; // Replace 'search.route' with your route name
                    </script>
                    <input type="text" class="form-control" name="search" id="search" placeholder="Search in..."
                        required />
                    <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                    </button>
                </form>
                <div id="search-results"></div>
            </div>
            <div class="header-right ml-4">
                <div class="header-call d-xs-show d-lg-flex align-items-center">
                    <a href="tel:#" class="w-icon-call"></a>
                    <div class="call-info d-lg-show">
                        <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                            <a href="https://portotheme.com/cdn-cgi/l/email-protection#3a19"
                                class="text-capitalize">Call now</a>
                        </h4>
                        <a href="tel:+91 8699643223" class="phone-number font-weight-bolder ls-50">+91 8699643223</a>
                    </div>
                </div>
                <a class="wishlist label-down link d-xs-show" href="{{ route('view-wishlist') }}">
                    <i class="w-icon-heart"></i>
                    <span class="wishlist-label d-lg-show">Wishlist</span>
                </a>
                <x-cart-sidebar />
            </div>
        </div>
    </div>
    <!-- End of Header Middle -->

    <div class="header-bottom sticky-content fix-top sticky-header">
        <div class="container">
            <div class="inner-wrap">
                <div class="header-left">
                    <div class="dropdown category-dropdown has-border" data-visible="true">
                        <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories">
                            <i class="w-icon-category"></i>
                            <span>Browse Categories</span>
                        </a>
                        <?php
                        $commonData = app('commonData');
                        $categories = $commonData['categories'];
                        ?>
                        <div class="dropdown-box">
                            <ul class="menu vertical-menu category-menu">
                                @foreach ($commonData['parentCategoriesMega'] as $item)
                                    @if (count($item['categories']) > 0)
                                        <!-- Check if there are categories to display -->
                                        <li>
                                            <a href="shop-fullwidth-banner.html">
                                                <i class="w-icon-tshirt2"></i>{{ $item->name }}
                                            </a>
                                            <ul class="megamenu">
                                                <li>
                                                    <ul>
                                                        @foreach ($item['categories'] as $cat)
                                                            @if ($cat->category_name)
                                                                <!-- Check if category name is present -->
                                                                <li>
                                                                    <a
                                                                        href="{{ route('category.product', ['slug' => $cat->slug]) }}">
                                                                        {{ $cat->category_name }}
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                    </div>
                    <nav class="main-nav">
                        <ul class="menu active-underline">
                            <li>
                                <a href="{{ url('index') }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('products') }}">Products</a>
                            </li>
                            <li>
                                <a href="{{ route('daily-deals') }}">Daily-Deals</a>
                            </li>
                            <li>
                                <a href="{{ route('contact-us') }}">Contact Us</a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</header>
<!-- End of Header -->
