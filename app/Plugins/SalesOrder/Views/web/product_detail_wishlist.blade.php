<div class="col-2 d-flex justify-content-end wishlist-wrapper wishlist-button-hover-mobile" data-is-wishlist="{{ $product->checkWishlist($product->id) ? 1 : 0 }}" data-id="{{ $product->id }}" data-url="{{ route('cart.toggle_wishlist') }}">
    <img class="wishlist-mobile {{ $product->checkWishlist($product->id) ? 'd-none' : '' }}" src="{{ asset('assets/web/assets/img/product_details/wishlist_icon.png') }}">
    <img class="wishlist-mobile-added {{ $product->checkWishlist($product->id) ? '' : 'd-none' }}" src="{{asset('assets/web/assets/img/product_details/wish_list_icon_brown.png')}}">
</div>