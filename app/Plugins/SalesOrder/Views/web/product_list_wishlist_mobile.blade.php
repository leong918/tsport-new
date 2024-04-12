<div class="wishlist-container wishlist-button-hover" data-is-wishlist="{{ $product->checkWishlist($product->id) ? 1 : 0 }}" data-id="{{ $product->id }}" data-url="{{ route('cart.toggle_wishlist') }}">
    <img class="wishlist-mobile" src="{{ asset('assets/web/assets/img/homepage/add-wishlist-2.png') }}">
</div>
