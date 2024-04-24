@extends('web.layout.app')
@section('content')
<div id="shopping_cart" class="overflow-x-hidden margin-header">
    <div class="container">
        <div class="row justify-content-center {{ count($cartList) > 0 ? '' : 'd-none' }}" id="fullCartSection">
            <div class="shopping-cart-wrapper">
                <div class="shopping-cart-title">Shopping Cart</div>
                <div class="row justify-content-center shopping-cart-content">
                    <div class="col-md-12 col-lg-8 shopping-cart-content">
                        <div class="shopping-cart-banner">
                            <div><img src="{{$setting_model['shopping_cart_banner']}}" /></div>
                            <div>
                                @if (count($shopping_cart_banner_product->productAttribute) > 0)
                                <button class="add-to-cart d-none d-lg-block cart-button-redirect" data-href="{{ route('web.product_detail', ['alias' => $shopping_cart_banner_product->alias]) }}">
                                ADD TO CART
                                </button>
                                @else
                                <button class="add-to-cart d-none d-lg-block cart-button-hover" data-id="{{ $shopping_cart_banner_product->id }}" data-url="{{ route('cart.add_to_cart') }}">
                                ADD TO CART
                                </button>
                                @endif
                            </div>
                        </div>
                        <div>
                            @if (count($shopping_cart_banner_product->productAttribute) > 0)
                            <button class="add-to-cart d-block d-lg-none cart-button-redirect" data-href="{{ route('web.product_detail', ['alias' => $shopping_cart_banner_product->alias]) }}">
                            ADD TO CART
                            </button>
                            @else
                            <button class="add-to-cart d-block d-lg-none cart-button-hover" data-id="{{ $shopping_cart_banner_product->id }}" data-url="{{ route('cart.add_to_cart') }}">
                            ADD TO CART
                            </button>
                            @endif
                        </div>
                        <table class="cart-item-list d-none d-md-block">
                            <tr>
                                <th style="width:50%">Product</th>
                                <th style="width:14%">Price</th>
                                <th style="width:17%">Quantity</th>
                                <th style="width:14%">Total</th>
                                <th style="width:5%"></th>
                            </tr>
                            @foreach($cartList as $cart)
                            <tr class="cart-main-list">
                                <td>
                                    <div class="d-flex">
                                        <img src="{{ $cart->product->getFirstProductImage()->url }}">
                                        <div class="product-desc">
                                            {{ $cart->product->getParameters('zh-CN')->name }}
                                            @if($cart->product_attribute_term)
                                            <div class="attribute-desc ms-2">
                                                {!! $cart->description !!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="unit-price">${{ number_format($cart->price, 2) }}</td>
                                <td>
                                    <div class="d-flex justify-content-between quantity-wrapper" data-cart-id="{{ $cart->id }}">
                                        <button class="action-button minus"><img src="{{asset('assets/web/assets/img/shopping_cart/minus.png')}}" /></button>
                                        <input type="text" value="{{ $cart->quantity }}" class="quantity-text" readonly/>
                                        <button class="action-button plus"><img src="{{asset('assets/web/assets/img/shopping_cart/plus.png')}}" /></button>
                                    </div>
                                </td>
                                <td class="total-price">${{ number_format($cart->total_price, 2) }}</td>
                                <td>
                                    <button class="remove-button" data-cart-id="{{ $cart->id }}">
                                        <img src="{{asset('assets/web/assets/img/shopping_cart/remove.png')}}" />
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            {{-- <tr>
                                <td colspan="4">
                                    <div class="giveaway-desc">
                                        Giveaway
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <img src="{{asset('assets/web/assets/img/shopping_cart/product_2.png')}}">
                                        <div class="product-desc">【全新升級配方】LOVINAH DRAGON'S BLOOD
                                            BRIGHTENING+HYDARTING FACE TONIC
                                            龍血樹抗氧亮肌爽膚水100ML
                                        </div>
                                    </div>
                                </td>
                                <td class="unit-price">$490</td>
                                <td>
                                    <div class="quantity-wrapper">
                                        <input type="text" value="1" class="quantity-text" readonly/>
                                    </div>
                                </td>
                                <td class="total-price">$0</td>
                                <td></td>
                            </tr> --}}
                        </table>
                        <div class="mobile-cart-item-list d-block d-md-none">
                            @foreach($cartList as $cart)
                            <div class="cart-item-wrapper cart-main-list">
                                <div class="d-flex">
                                    <img src="{{ $cart->product->getFirstProductImage()->url }}">
                                    <div class="cart-item-details d-flex flex-column justify-content-between items-center w-100">
                                        <div class="d-flex justify-content-between">
                                            <div class="product-desc-wrapper">
                                                <div class="product-desc">
                                                    {{ $cart->product->getParameters('zh-CN')->name }}
                                                </div>
                                                @if($cart->product_attribute_term)
                                                <div class="attribute-desc ms-2">
                                                    {!! $cart->description !!}
                                                </div>
                                                @endif
                                            </div>
                                            <div>
                                                <button class="remove-button" data-cart-id="{{ $cart->id }}">
                                                    <img src="{{asset('assets/web/assets/img/shopping_cart/remove.png')}}" />
                                                </button>
                                            </div>
                                        </div>
                                        <div class="product-price d-flex">
                                            <div class="label">Price:</div>
                                            <div class="data">${{ number_format($cart->price, 2) }}</div>
                                        </div>
                                        <div class="product-price-wrapper d-flex justify-content-between">
                                            <div class="d-flex quantity-wrapper" data-cart-id="{{ $cart->id }}">
                                                <button class="action-button minus"><img src="{{asset('assets/web/assets//img/shopping_cart/minus.png')}}" /></button>
                                                <input type="text" value="{{ $cart->quantity }}" class="quantity-text" readonly/>
                                                <button class="action-button plus"><img src="{{asset('assets/web/assets//img/shopping_cart/plus.png')}}" /></button>
                                            </div>
                                            <div class="d-flex total-wrapper">
                                                <div class="label">Total:</div>
                                                <div class="data total-price">${{ number_format($cart->total_price, 2) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{-- <div class="giveaway-desc">
                                Giveaway
                            </div>
                            <div class="cart-item-wrapper">
                                <div class="d-flex">
                                    <img src="{{asset('assets/web/assets//img/shopping_cart/product_2.png')}}">
                                    <div class="cart-item-details d-flex flex-column justify-content-between items-center">
                                        <div class="product-desc">
                                            【全新升級配方】LOVINAH DRAGON'S BLOOD
                                            BRIGHTENING+HYDARTING FACE TONIC
                                            龍血樹抗氧亮肌爽膚水100ML
                                        </div>
                                        <div class="product-price d-flex">
                                            <div class="label">Price:</div>
                                            <div class="data">$490</div>
                                        </div>
                                        <div class="product-price-wrapper d-flex justify-content-between">
                                            <div class="d-flex quantity-wrapper">
                                                <div class="label">Quantity:</div>
                                                <input type="text" value="1" class="quantity-text" readonly/>
                                            </div>
                                            <div class="d-flex total-wrapper">
                                                <div class="label">Total:</div>
                                                <div class="data">$490</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <hr style="margin: 20px 0"/>
                        <div class="d-flex coupon-wrapper">
                            <input type="text" class="coupon-text" id="coupon-text" placeholder="Coupon"/>
                            <button class="coupon-button" id="apply-coupon-btn">APPLY COUPON</button>
                        </div>
                    </div>
                    <div class="mt-5 mt-lg-0 col-md-12 col-lg-4">
                        <div class="order-summary">
                            <div class="cart-title">Cart Totals</div>
                            @include('sales_order::web.cart.total')
                            <div class="checkout">
                                @if(auth()->user())
                                <a href="{{ route('cart.checkout') }}" class="btn btn-primary btn-checkout">
                                    CHECKOUT
                                </a>
                                @else
                                <button type="button" class="btn btn-primary btn-checkout" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    CHECKOUT
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="desc-wrapper">
                            <div class="d-flex justify-content-center text-center cn-desc-wrapper">
                                <div class="cn-desc">請先登入或註冊您的帳戶 ,<br/>以便順利完成交易。謝謝 !</div>
                            </div>
                            <div class="d-flex justify-content-center text-center en-desc-wrapper">
                                <div class="en-desc">Please log in or create your account to proceed with the transaction smoothh; Thank you!</div>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('web.login') }}" class="login-button">LOGIN</a>
                        </div>
                        <div class="my-3 text-center">or</div>
                        <div>
                            <a href="{{ route('web.register') }}" class="register-button">CREATE ACCOUNT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center {{ count($cartList) > 0 ? 'd-none' : '' }}" id="emptyCartSection">
            <div class="shopping-cart-wrapper">
                <div class="shopping-cart-title">Shopping Cart</div>
                <div class="empty-cart-content">
                    Your cart is currently empty.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script id="discountLayout" type="x-tmpl-mustache">
    <div class="d-flex justify-content-between data-content-wrapper">
        <div class="inner-label">@{{ name }}</div>
        <div class="data-label">
            <div class="price">-$@{{ price }}</div>
        </div>
    </div>
</script>
<script id="couponLayout" type="x-tmpl-mustache">
    <div class="d-flex">
        <div class="d-flex justify-content-between data-content-wrapper">
            <div class="inner-label">@{{ name }}</div>
            <div class="data-label">
                <div class="price">-$@{{ price }}</div>
            </div>
        </div>
        <div class="btn-remove-wrapper">
            <button class="remove-coupon-button" data-id="@{{ id }}">remove</button>
        </div>
    </div>
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('body').on('click', '.action-button', function() {
        $('.action-button').prop('disabled', true);
        $('.btn-checkout').prop('disabled', true);
        $('#apply-coupon-btn').prop('disabled', true);
        var cart_id = $(this).parents('.quantity-wrapper').data('cart-id');
        var input_quantity = $(this).parent().find('.quantity-text');

        if ($(this).hasClass('plus')) {
            input_quantity.val(parseInt(input_quantity.val()) + 1);
        } else {
            input_quantity.val(parseInt(input_quantity.val()) - 1);
        }

        if (input_quantity.val() <= 0) {
            $(this).parents('.cart-main-list').remove();
        }

        axios({
            method: "post",
            url: "{{ route('cart.update_cart_qty') }}",
            data: {
                cart_id: cart_id,
                quantity: input_quantity.val()
            }
        })
        .then(response => {
            $('.action-button').prop('disabled', false);
            $('.btn-checkout').prop('disabled', false);
            $('#apply-coupon-btn').prop('disabled', false);
            $(this).parents('.cart-main-list').find('.total-price').html('$' + response.data.subtotal);
            updateColumnValue(response.data.cartTotal);

            if (response.data.cartCount > 0) {
                $('#fullCartSection').removeClass('d-none');
                $('#emptyCartSection').addClass('d-none');
                $('#cart-count').removeClass('d-none').text(response.data.cart_count);
            } else {
                $('#fullCartSection').addClass('d-none');
                $('#emptyCartSection').removeClass('d-none');
                $('#cart-count').addClass('d-none').text(response.data.cart_count);
            }
        })
        .catch(error => {
            $('.action-button').prop('disabled', false);
            $('.btn-checkout').prop('disabled', false);
            $('#apply-coupon-btn').prop('disabled', false);
            showSwal('Fail!', error.response.data.msg);
        });
    });

    $('.remove-button').on('click', function() {
        $('.action-button').prop('disabled', true);
        $('.btn-checkout').prop('disabled', true);
        $('#apply-coupon-btn').prop('disabled', true);
        $(this).parents('.cart-main-list').remove();

        axios({
            method: "post",
            url: "{{ route('cart.update_cart_qty') }}",
            data: {
                cart_id: $(this).data("cart-id"),
                quantity: 0
            }
        })
        .then(response => {
            $('.action-button').prop('disabled', false);
            $('.btn-checkout').prop('disabled', false);
            $('#apply-coupon-btn').prop('disabled', false);
            $(this).parents('.cart-main-list').find('.total-price').html('$' + response.data.subtotal);
            updateColumnValue(response.data.cartTotal);

            if (response.data.cartCount > 0) {
                $('#fullCartSection').removeClass('d-none');
                $('#emptyCartSection').addClass('d-none');
                $('#cart-count').removeClass('d-none').text(response.data.cart_count);
            } else {
                $('#fullCartSection').addClass('d-none');
                $('#emptyCartSection').removeClass('d-none');
                $('#cart-count').addClass('d-none').text(response.data.cart_count);
            }
        })
        .catch(error => {
            $('.action-button').prop('disabled', false);
            $('.btn-checkout').prop('disabled', false);
            $('#apply-coupon-btn').prop('disabled', false);
            showSwal('Fail!', error.response.data.msg);
        });
    })

    $('#apply-coupon-btn').on('click', function() {
        $('.action-button').prop('disabled', true);
        $('.btn-checkout').prop('disabled', true);
        $('#apply-coupon-btn').prop('disabled', true);

        var coupon = $('#coupon-text').val();
        if (coupon == '') {
            showSwal('Fail!', 'Please fill in coupon to apply!');
        }

        axios({
            method: "post",
            url: "{{ route('cart.apply_coupon') }}",
            data: {
                coupon: coupon
            }
        })
        .then(response => {
            $('.action-button').prop('disabled', false);
            $('.btn-checkout').prop('disabled', false);
            $('#apply-coupon-btn').prop('disabled', false);
            $('#coupon-text').val('');
            updateColumnValue(response.data.cartTotal);
        })
        .catch(error => {
            $('.action-button').prop('disabled', false);
            $('.btn-checkout').prop('disabled', false);
            $('#apply-coupon-btn').prop('disabled', false);
            showSwal('Fail!', error.response.data.msg);
        });
    })
});
</script>
@endpush