@extends('web.layout.app')
@section('content')
<div id="complete" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="complete-wrapper">
                <div class="row justify-content-center complete-content-wrapper">
                    <div class="col-md-12 col-lg-8 complete-content-container">
                        <div class="complete-banner">
                            <div><img src="{{asset('assets/web/assets/img/complete/banner_with_text.png')}}" /></div>
                        </div>
                        <div class="order-details-title">Order Details</div>
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
                        <hr class="dividing-line" />
                        <div class="order-details-wrapper">
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
                            <hr />
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
                    <div class="mt-5 mt-lg-0 col-md-12 col-lg-4">
                        <div class="order-received-summary">
                            <div class="order-received-title">Your order has been received.</div>
                            <div class="order-no">Order No.9605</div>
                            <div class="d-flex payment-method-wrapper">
                                <div>Payment Method :</div>
                                <div class="payment-method">Alipay HK</div>
                            </div>
                            <div class="order-received-desc">
                                <div>Please Whatsapp +852-54425298 with your Order ID when the payment has been settled.</div>
                                <div>*Please complete payment within 12 hours after placing order. otherwise your order will be cancelled automatically:.</div>
                                <div>*You will be charged extra HK$30 for administrative fee if payment slip or completed payment screenshot is missing.</div>
                                <div>Order will only be shipped when the fee is received.</div>
                            </div>
                            <div>Our Bank Details</div>
                            <div class="our-details-wrapper">
                                <div class="d-flex">
                                    <div class="col-5">Company name</div>
                                    <div class="col-7">Great Fancy Ltd</div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-5">Bank name</div>
                                    <div class="col-7">Han Seng Bank</div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-5">Account number</div>
                                    <div class="col-7">788-001865-883</div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-5">Bank name</div>
                                    <div class="col-7">
                                        <div>Alipay HK</div>
                                        <div class="alipay-desc">
                                            Please find our Alipay HK QR code in the Page
                                            “消費券 Consumption Voucher” in our main menu.
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
    <div class="continue-shopping-product">
        <div class="">
            <div class="title-new">Continue Shopping</div>
        </div>
        <div class="swiper mySwiper-newproduct">
            <div class="swiper-wrapper">
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-1.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-1-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            <img class="star-rating" src="{{asset('assets/web/assets/img/homepage/5-star.png')}}">
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-2.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-2-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            <img class="star-rating" src="{{asset('assets/web/assets/img/homepage/5-star.png')}}">
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-3.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-3-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            <img class="star-rating" src="{{asset('assets/web/assets/img/homepage/5-star.png')}}">
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-4.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-4-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            <img class="star-rating" src="{{asset('assets/web/assets/img/homepage/5-star.png')}}">
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-5.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-5-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            <img class="star-rating" src="{{asset('assets/web/assets/img/homepage/5-star.png')}}">
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-1.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-1-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            <img class="star-rating" src="{{asset('assets/web/assets/img/homepage/5-star.png')}}">
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <div class="product-image position-relative">
                        <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-2.png')}}">
                        <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-2-hover.png')}}">
                        <div class="wishlist-cart-container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <!-- wishlist -->
                                    <div class="wishlist-container">
                                        <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                        <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--cart-->
                                    <div class="cart-container">
                                        <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                        <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            <img class="star-rating" src="{{asset('assets/web/assets/img/homepage/5-star.png')}}">
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide new-launches-product-img">
                    <img class="show" src="{{asset('assets/web/assets/img/homepage/new-launches-product-3.png')}}">
                    <img class="hide" src="{{asset('assets/web/assets/img/homepage/new-launches-product-3-hover.png')}}">
                    <div class="wishlist-cart-container">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <!-- wishlist -->
                                <div class="wishlist-container">
                                    <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                                    <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!--cart-->
                                <div class="cart-container">
                                    <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                    <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating-wishlist">
                            <img class="star-rating" src="{{asset('assets/web/assets/img/homepage/5-star.png')}}">
                            <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                        <div class="product-description">[全新升級配方] LOVINAH DRAGON'S BLOOD BRIGHTENING HYDARTING FACE TONIC 龍血樹抗氧亮肌爽膚水 100ML</div>
                        <div class="price-cart">
                            <div class="product-price">$490</div>
                            <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('body').on('click', '.minus', function() {
            var input_quantity = $(this).parent().find('.quantity-text');
            input_quantity.val(parseInt(input_quantity.val()) - 1);
        });

        $('body').on('click', '.plus', function() {
            var input_quantity = $(this).parent().find('.quantity-text');
            input_quantity.val(parseInt(input_quantity.val()) + 1);
        });
    });
</script>

<script>
    //new-product
    var swiper = new Swiper(".mySwiper-newproduct", {
        autoplay: {
            delay: 3000,
        },

        breakpoints: {
            375: {
                slidesPerView: 1.75,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 20,
            },
        }
    });
</script>
@endpush