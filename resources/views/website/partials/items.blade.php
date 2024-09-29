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
