<div class="wishlist-container wishlist-button-hover-mobile" data-is-wishlist="{{ $product->checkWishlist($product->id) ? 1 : 0 }}" data-id="{{ $product->id }}" data-url="{{ route('cart.toggle_wishlist') }}">
    <img class="wishlist-mobile {{ $product->checkWishlist($product->id) ? 'd-none' : '' }}" src="{{ asset('assets/web/assets/img/homepage/add-wishlist-2.png') }}">
    <img class="wishlist-mobile-added {{ $product->checkWishlist($product->id) ? '' : 'd-none' }}" src="{{asset('assets/web/assets/img/homepage/added_to_wishlist.png')}}">
</div>
