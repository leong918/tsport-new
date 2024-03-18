<div class="wishlist-cart-container">
    <div class="row text-center">
        <div class="col-md-6"> 
            <div class="wishlist-container">
                <img class="wishlist-hide" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                <img class="wishlist-hover-show" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
            </div>
        </div>
        <div class="col-md-6">
            <!--cart-->
            @if(count($product->productAttribute) > 0)
            <a class="cart-container" href="{{route('web.product_detail', ['alias' => $product->alias])}}">
                <img class="cart-hide" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                <img class="cart-hover-show" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
            </a>
            @else
            <div class="cart-container cart-button-hover" data-id="{{ $product->id }}" data-url="{{ route('cart.add_to_cart') }}">
                <img class="cart-hide" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                <img class="cart-hover-show" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
            </div>
            @endif
        </div>
    </div>
</div>