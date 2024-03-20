@if(count($product->productAttribute) > 0)
<a class="cart-container" href="{{route('web.product_detail', ['alias' => $product->alias])}}">
    <img class="cart-mobile" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
</a>
@else
<div class="cart-container cart-button-hover" data-id="{{ $product->id }}" data-url="{{ route('cart.add_to_cart') }}">
    <img class="cart-mobile" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
</div>
@endif