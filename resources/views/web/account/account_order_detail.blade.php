@extends('web.layout.app')
@section('content')
<div id="my-order-detail" class="margin-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="forgot-password-title">My Account</div>
                <div class="nav-acc"><a href="#">Home</a> > <a href="#"> My Account </a> > <a href="#"> Orders </a></div>
            </div>
            @include('web.account.account_nav')
            <div class="col-xl-9 col-12">
                <div class="forgot-password-wrapper">
                    <div class="forgot-password-container">
                        <div class="empty-addr">
                            <div class="title">Order Details</div>
                            <div class="row row-order-info">
                                <div class="col-5 col-md-4 col-lg-3">
                                    <div class="mg-order-info">
                                        Order No.
                                    </div>
                                </div>
                                <div class="col-7 col-md-8 col-lg-9">
                                    <div class="mg-order-info">
                                        #9605
                                    </div>
                                </div>
                                <div class="col-5 col-md-4 col-lg-3">
                                    <div class="mg-order-info">
                                        Order Date
                                    </div>
                                </div>
                                <div class="col-7 col-md-8 col-lg-9">
                                    <div class="mg-order-info">
                                        August 16, 2023
                                    </div>
                                </div>
                                <div class="col-5 col-md-4 col-lg-3">
                                    <div class="mg-order-info">
                                        Payment Method
                                    </div>
                                </div>
                                <div class="col-7 col-md-8 col-lg-9">
                                    <div class="mg-order-info">
                                        Alipay HK
                                    </div>
                                </div>
                                <div class="col-5 col-md-4 col-lg-3">
                                    <div class="mg-order-info">
                                        Status
                                    </div>
                                </div>
                                <div class="col-7 col-md-8 col-lg-9">
                                    <div class="mg-order-info">
                                        On hold
                                    </div>
                                </div>
                                <div class="col-5 col-md-4 col-lg-3">
                                    <div class="mg-order-info">
                                        Delivery Method
                                    </div>
                                </div>
                                <div class="col-7 col-md-8 col-lg-9">
                                    <div class="mg-order-info">
                                        SF EXPRESS
                                    </div>
                                </div>
                            </div>
                            <div class="table-wrap overflow-x-hidden">
                                <div class="title">Shipping Address</div>
                                <div class="row row-shipping-addr">
                                    <div class="col-lg-9">
                                        <div class="addr-display">
                                            Ben Lam<br/>
                                            WorkShop D 11/F, Hop Hing Industrial Building, 704 Castle Peak Road<br/>
                                            Lai Chi Kok<br/>
                                            Kowloon<br/>
                                            Phone no : 63531944<br/>
                                            Email: ben712502@gmail.com
                                        </div>
                                    </div>
                                </div>
                                <table class="cart-item-list d-none d-md-block">
                                    <tr>
                                        <th style="width:50%">Product</th>
                                        <th style="width:15%">Price</th>
                                        <th style="width:20%">Quantity</th>
                                        <th style="width:15%">Total</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <img src="{{asset('assets/web/assets/img/shopping_cart/product_1.png')}}">
                                                <div class="product-desc">【全新升級配方】LOVINAH DRAGON'S BLOOD
                                                    BRIGHTENING+HYDARTING FACE TONIC
                                                    龍血樹抗氧亮肌爽膚水100ML
                                                </div>
                                            </div>
                                        </td>
                                        <td class="unit-price">$490</td>
                                        <td>
                                            <div class="d-flex justify-content-center quantity-wrapper">
                                                <input type="text" value="1" class="quantity-text" readonly />
                                            </div>
                                        </td>
                                        <td class="total-price">$490</td>
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
                                            <div class="d-flex justify-content-center quantity-wrapper">
                                                <input type="text" value="1" class="quantity-text" readonly />
                                            </div>
                                        </td>
                                        <td class="total-price">$490</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
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
                                                <input type="text" value="1" class="quantity-text" readonly />
                                            </div>
                                        </td>
                                        <td class="total-price">$0</td>
                                        <td></td>
                                    </tr>
                                </table>
                                <div class="mobile-cart-item-list d-block d-md-none">
                                    <div class="cart-item-wrapper">
                                        <div class="d-flex">
                                            <img src="{{asset('assets/web/assets//img/shopping_cart/product_1.png')}}">
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
                                                        <input type="text" value="1" class="quantity-text" readonly />
                                                    </div>
                                                    <div class="d-flex total-wrapper">
                                                        <div class="label">Total:</div>
                                                        <div class="data">$490</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
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
                                                        <input type="text" value="1" class="quantity-text" readonly />
                                                    </div>
                                                    <div class="d-flex total-wrapper">
                                                        <div class="label">Total:</div>
                                                        <div class="data">$490</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="giveaway-desc">
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
                                                        <input type="text" value="1" class="quantity-text" readonly />
                                                    </div>
                                                    <div class="d-flex total-wrapper">
                                                        <div class="label">Total:</div>
                                                        <div class="data">$490</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order-summary">
                            <div class="order-summary-title">Order Total</div>
                            <div class="subtotal">
                                <div class="d-flex justify-content-between data-content-wrapper">
                                    <div class="label">Subtotal</div>
                                    <div class="data-label">
                                        <div class="price">$980</div>
                                    </div>
                                </div>
                            </div>
                            <div class="discount">
                                <div class="label">Discount</div>
                                <div class="d-flex justify-content-between data-content-wrapper">
                                    <div class="inner-label">Member discount</div>
                                    <div class="data-label">
                                        <div class="price">-$49</div>
                                    </div>
                                </div>
                            </div>
                            <div class="coupon">
                                <div class="label">Coupon</div>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-between data-content-wrapper">
                                        <div class="inner-label">IOTH-JM-VO-D12</div>
                                        <div class="data-label">
                                            <div class="price">-$98</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="point-redemption">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-between data-content-wrapper">
                                        <div class="label">Point redemption</div>
                                        <div class="data-label">
                                            <div class="price">$10</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="shipping-fee">
                                <div class="d-flex justify-content-between data-content-wrapper">
                                    <div class="label">Shipping Fee</div>
                                    <div class="data-label">
                                        <div class="price">SF EXPRESS : $30</div>
                                    </div>
                                </div>
                            </div>
                            <div class="shipping-fee-inner">
                                <div class="data-content-wrapper">
                                    <div class="inner-label">Shipping To:</div>
                                    <div class="inner-label">
                                        ABC XXXXXXXXXX HONG KONG ISLAND.
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="total">
                                <div class="d-flex justify-content-between data-content-wrapper">
                                    <div class="label">Total</div>
                                        <div class="data-label">
                                        <div class="price">$980</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $('.left').on('mouseover', function(){
        $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/left_2.png')}}');
    })
    $('.left').on('mouseleave', function(){
        $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/left_1.png')}}');
    })
    $('.left img').on('mouseover', function(){
        $(this).attr('src', '{{asset('assets/web/assets/img/account_order/left_2.png')}}');
    })
    $('.left img').on('mouseleave', function(){
        $(this).attr('src', '{{asset('assets/web/assets/img/account_order/left_1.png')}}');
    })
    $('.right').on('mouseover', function(){
        $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/right_2.png')}}');
    })
    $('.right').on('mouseleave', function(){
        $(this).find('img').attr('src', '{{asset('assets/web/assets/img/account_order/right_1.png')}}');
    })
    $('.right img').on('mouseover', function(){
        $(this).attr('src', '{{asset('assets/web/assets/img/account_order/right_2.png')}}');
    })
    $('.right img').on('mouseleave', function(){
        $(this).attr('src', '{{asset('assets/web/assets/img/account_order/right_1.png')}}');
    })
</script>
@endpush