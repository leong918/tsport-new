@php
    $userCartRepository = new \App\Plugins\SalesOrder\Repositories\UserCartRepository(new \Illuminate\Container\Container);
    $cart_count = $userCartRepository->getUserCartByType(auth()->user() ? auth()->user()->id : getPublicIp(), auth()->user() ? 'login' : 'guest')->count();
@endphp

<a class="navbar-cart-icon" href="{{route('cart.shopping_cart')}}">
    <img src="{{asset('assets/web/assets/img/navigation/cart.png')}}" alt="Bootstrap" width="25" height="24">
    <span id="cart-count" class="{{ $cart_count > 0 ? '' : 'd-none' }}">{{ $cart_count }}</span>
</a>