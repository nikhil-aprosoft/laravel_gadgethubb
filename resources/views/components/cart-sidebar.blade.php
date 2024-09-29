<div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
    <div class="cart-overlay"></div>
    <a href="#" class="cart-toggle label-down link">
        <i class="w-icon-cart">
            @php
                $userId = session('user')->userid ?? null;
                $carCount = $userId ? Cart::where('user_id', $userId)->count() : 0;
            @endphp
            <span class="cart-count">{{ $carCount }}</span>
        </i>
        <span class="cart-label">Cart</span>
    </a>
    <div class="dropdown-box">
        <div class="cart-header">
            <span>Shopping Cart</span>
            <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
        </div>

        <div class="products">
            @php
                $cartItems = $userId ? Cart::with('product')->where('user_id', $userId)->get() : collect();
            @endphp

            @foreach ($cartItems as $item)
                <div class="product product-cart">
                    <div class="product-detail">
                        <a href="{{ route('product.show', $item->product->id) }}"
                            class="product-name">{{ $item->product->name }}</a>
                        <div class="price-box">
                            <span class="product-quantity">{{ $item->quantity }}</span>
                            <span class="product-price">${{ number_format($item->product->price, 2) }}</span>
                        </div>
                    </div>
                    <figure class="product-media">
                        <a href="{{ route('product.show', $item->product->id) }}">
                            <img src="{{ asset('assets/images/cart/' . $item->product->image) }}"
                                alt="{{ $item->product->name }}" height="84" width="94" />
                        </a>
                    </figure>
                    <button class="btn btn-link btn-close" aria-label="button" data-id="{{ $item->id }}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endforeach
        </div>

        <div class="cart-total">
            <label>Subtotal:</label>
            <span
                class="price">${{ number_format(
                    $cartItems->sum(function ($item) {
                        return $item->product->price * $item->quantity;
                    }),
                    2,
                ) }}</span>
        </div>

        <div class="cart-action">
            <a href="{{ route('cart.index') }}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
            <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-rounded">Checkout</a>
        </div>
    </div>
    <!-- End of Dropdown Box -->
</div>
