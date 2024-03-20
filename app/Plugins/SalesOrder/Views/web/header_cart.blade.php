@php
    $userCartRepository = new \App\Plugins\SalesOrder\Repositories\UserCartRepository(new \Illuminate\Container\Container);
    $cart_count = $userCartRepository->getUserCartByType(auth()->user() ? auth()->user()->id : getPublicIp(), auth()->user() ? 'login' : 'guest')->count();
@endphp

<a class="navbar-cart-icon" href="{{route('cart.shopping_cart')}}" type="button">
    <img src="{{asset('assets/web/assets/img/navigation/cart.png')}}" alt="Bootstrap" width="25" height="24">
    @if($cart_count > 0)
    <span id="cart-count">{{ $cart_count }}</span>
    @endif
</a>