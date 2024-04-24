<div class="wishlist-cart-container">
    <div class="row text-center">
        <div class="col-md-6"> 
            <div class="wishlist-container wishlist-button-hover" data-is-wishlist="{{ $product->checkWishlist($product->id) ? 1 : 0 }}" data-id="{{ $product->id }}" data-url="{{ route('cart.toggle_wishlist')}}">
                <img class="wishlist-hide {{ $product->checkWishlist($product->id) ? 'd-none' : '' }}" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                <img class="wishlist-hover-show" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                <img class="wishlist-added {{ $product->checkWishlist($product->id) ? '' : 'd-none' }}" src="{{asset('assets/web/assets/img/homepage/added_to_wishlist.png')}}">
            </div>
        </div>
        <div class="col-md-6">
            <!--cart-->
            @if(count($product->productAttribute) > 0)
            <div class="cart-container cart-button-redirect" data-href="{{route('web.product_detail', ['alias' => $product->alias])}}">
                <img class="cart-hide" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                <img class="cart-hover-show" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
            </div>
            @else
            @if($product->quantity === 0 && !$product->is_backorder)
            <div class="cart-container"> 
                <img class="cart-hide cart-out-stock" src="{{asset('assets/web/assets/img/homepage/out-of-stock-cart.png')}}">
            </div>
            @else
            <div class="cart-container cart-button-hover" data-id="{{ $product->id }}" data-url="{{ route('cart.add_to_cart') }}">
                <img class="cart-hide" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                <img class="cart-hover-show" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
            </div>
            @endif
            @endif
        </div>
    </div>
</div>
