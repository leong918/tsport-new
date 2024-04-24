<div class="d-flex">
    <div class="wishlist-container wishlist-button-hover-mobile me-2" data-is-wishlist="{{ $product->checkWishlist($product->id) ? 1 : 0 }}" data-id="{{ $product->id }}" data-url="{{ route('cart.toggle_wishlist') }}">
        <img class="wishlist-mobile {{ $product->checkWishlist($product->id) ? 'd-none' : '' }}" src="{{ asset('assets/web/assets/img/homepage/add-wishlist-2.png') }}">
        <img class="wishlist-mobile-added {{ $product->checkWishlist($product->id) ? '' : 'd-none' }}" src="{{asset('assets/web/assets/img/homepage/added_to_wishlist.png')}}">
    </div>
    @if($product->quantity === 0 && !$product->is_backorder)
    <div class="cart-container"> 
        <img class="cart-mobile cart-out-stock" src="{{asset('assets/web/assets/img/homepage/out-of-stock-cart.png')}}">
    </div>
    @else
    @if(count($product->productAttribute) > 0)
    <div class="cart-container cart-button-redirect" href="{{route('web.product_detail', ['alias' => $product->alias])}}">
        <img class="cart-mobile" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
    </div>
    @else
    <div class="cart-container cart-button-hover" data-id="{{ $product->id }}" data-url="{{ route('cart.add_to_cart') }}">
        <img class="cart-mobile" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
    </div>
    @endif
    @endif
</div>