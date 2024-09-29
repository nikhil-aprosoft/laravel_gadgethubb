<div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
    <div class="cart-overlay"></div>
    <a href="#" class="cart-toggle label-down link">
        <i class="w-icon-cart">
            @php
                $userId = session('user')->userid ?? null;
                $carCount = $userId ? App\Models\Cart::where('user_id', $userId)->count() : 0;
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
                $cartItems = $userId ? App\Models\Cart::with('product')->where('user_id', $userId)->get() : collect();
            @endphp

            @foreach ($cartItems as $item)
                <div class="product product-cart">
                    <div class="product-detail">
                        <a href="{{ route('product-details', ['slug' => $item->product->slug]) }}"
                            class="product-name">{{ $item->product->product_name }}</a>
                        <div class="price-box">
                            <span class="product-quantity">{{ $item->quantity }}</span>
                            <span class="product-price">{{ $item->product->price }}</span>
                        </div>
                    </div>
                    <figure class="product-media">
                        <a href="{{ route('product-details', ['slug' => $item->product->slug]) }}">
                            <img src="{{ $item->product->thumbnail }}" alt="{{ $item->product->name }}" height="84"
                                width="94" />
                        </a>
                    </figure>
                    <button class="btn btn-link btn-close"
                        onclick="removeCartProduct({{ json_encode($item->cart_id) }})" aria-label="button"
                        data-id="{{ $item->cart_id }}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endforeach
        </div>

        <div class="cart-total">
            <label>Subtotal:</label>
            <span
                class="price">₹{{ $cartItems->sum(function ($item) {
                    return (float) str_replace('₹', '', $item->product->price) * $item->quantity;
                }) }}</span>
        </div>

        <div class="cart-action">
            <a href="" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
            <a href="" class="btn btn-primary btn-rounded">Checkout</a>
        </div>
    </div>
    <!-- End of Dropdown Box -->
</div>
<script>
    function removeCartProduct(id) {
        const url = `{{ route('remove_product_cart') }}`;
        console.log(id);
        axios.post(url, {
                cart_id: id,
            })
            .then(response => {
                Swal.fire({
                    title: "Product removed from cart",
                    icon: "success"
                }).then(() => {
                    const itemElement = document.querySelector(`[data-id='${id}']`);
                    if (itemElement) {
                        const parentElement = itemElement.closest('.product-cart');
                        if (parentElement) {
                            parentElement.remove();
                        }
                    }
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
</script>
