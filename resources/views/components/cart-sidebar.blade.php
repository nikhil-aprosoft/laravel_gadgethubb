<div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
    <div class="cart-overlay"></div>
    <a href="#" class="cart-toggle label-down link" id="cart-toggle">
        <i class="w-icon-cart">
            <span class="cart-count" id="cart-count">{{ $carCount ?? 0 }}</span>
        </i>
        <span class="cart-label">Cart</span>
    </a>    
    <div class="dropdown-box" id="cart-dropdown">
        <div class="cart-header">
            <span>Shopping Cart</span>
            <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
        </div>

        <div class="products" id="cart-items">
            @foreach ($cartItems as $item)
                @include('cart.item', ['item' => $item])
            @endforeach
        </div>

        <div class="cart-total">
            <label>Subtotal:</label>
            <span class="price" id="cart-total">₹{{ $cartItems->sum(function ($item) {
                return (float) str_replace('₹', '', $item->product->price) * $item->quantity;
            }) }}</span>
        </div>

        <div class="cart-action">
            <a href="" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
            <a href="" class="btn btn-primary btn-rounded">Checkout</a>
        </div>
    </div>
</div>

<script>
    function removeCartProduct(cartId) {
        const removeUrl = "{{ route('cart.remove', ':id') }}".replace(':id', cartId);
        $.ajax({
            url: removeUrl,
            type: 'DELETE',
            success: function(response) {
                // Update cart count and items dynamically
                $('#cart-count').text(response.cartCount);
                $('#cart-items').html(response.cartItemsHtml);
                $('#cart-total').text(`₹${response.cartTotal}`);
            },
            error: function(xhr) {
                console.error('Error removing product:', xhr);
            }
        });
    }
</script>
