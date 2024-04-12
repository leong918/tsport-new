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
                            @foreach($sales_order->salesOrderProduct as $orderProduct)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <img src="{{ $orderProduct->product_image }}">
                                        <div class="product-desc">
                                            {{ $orderProduct->product->getParameters('zh-CN')->name }}
                                            @if($orderProduct->product_attribute_term_name)
                                            <div class="attribute-desc ms-2">
                                                {!! $orderProduct->product_attribute_term_name !!}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="unit-price">${{ $orderProduct->price }}</td>
                                <td class="quantity-text">{{ $orderProduct->quantity }}</td>
                                <td class="total-price">${{ $orderProduct->total_price }}</td>
                            </tr>
                            @endforeach
                            {{-- <tr>
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
                            </tr> --}}
                        </table>
                        <div class="mobile-cart-item-list d-block d-md-none">
                            @foreach($sales_order->salesOrderProduct as $orderProduct)
                            <div class="cart-item-wrapper">
                                <div class="d-flex">
                                    <img src="{{ $orderProduct->product_image }}">
                                    <div class="cart-item-details d-flex flex-column justify-content-between items-center w-100">
                                        <div class="product-desc-wrapper">
                                            <div class="product-desc">
                                                {{ $orderProduct->product->getParameters('zh-CN')->name }}
                                            </div>
                                            @if($orderProduct->product_attribute_term_name)
                                            <div class="attribute-desc ms-2">
                                                {!! $orderProduct->product_attribute_term_name !!}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="product-price d-flex">
                                            <div class="label">Price:</div>
                                            <div class="data">${{ $orderProduct->price }}</div>
                                        </div>
                                        <div class="product-price-wrapper d-flex justify-content-between w-100">
                                            <div class="d-flex quantity-wrapper">
                                                <div class="label">Quantity:</div>
                                                <div class="data">{{ $orderProduct->quantity }}</div>
                                            </div>
                                            <div class="d-flex total-wrapper">
                                                <div class="label">Total:</div>
                                                <div class="data">${{ $orderProduct->total_price }}</div>
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
                                                <input type="text" value="1" class="quantity-text" readonly />
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
                        <hr class="dividing-line" />
                        <div class="order-details-wrapper">
                            <div class="subtotal">
                                <div class="d-flex justify-content-between data-content-wrapper">
                                    <div class="label">Subtotal</div>
                                    <div class="data-label">
                                        <div class="price">${{ $sales_order->subtotal }}</div>
                                    </div>
                                </div>
                            </div>
                            @if($sales_order->salesOrderTotal->where('code', 'discount')->count() > 0)
                            <div class="discount">
                                <div class="label">Discount</div>
                                @foreach($sales_order->salesOrderTotal->where('code', 'discount') as $discount)
                                <div class="d-flex justify-content-between data-content-wrapper">
                                    <div class="inner-label">{{ $discount->title }}</div>
                                    <div class="data-label">
                                        <div class="price">-${{ $discount->value }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            @if($sales_order->salesOrderTotal->where('code', 'coupon')->count() > 0)
                            <div class="coupon">
                                <div class="label">Coupon</div>
                                @foreach($sales_order->salesOrderTotal->where('code', 'coupon') as $coupon)
                                <div class="d-flex justify-content-between data-content-wrapper">
                                    <div class="inner-label">{{ $coupon->title }}</div>
                                    <div class="data-label">
                                        <div class="price">-${{ $coupon->value }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            <div class="point-redemption">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-between data-content-wrapper">
                                        <div class="label">Point redemption</div>
                                        <div class="data-label">
                                            <div class="price">-${{ $sales_order->point_redemption }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="shipping-fee">
                                <div class="d-flex justify-content-between data-content-wrapper">
                                    <div class="label">Shipping Fee</div>
                                    <div class="data-label">
                                        <div class="price">{{ $sales_order->delivery_partner.' : $'.$sales_order->shipping }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="shipping-fee-inner">
                                <div class="data-content-wrapper">
                                    <div class="inner-label">Shipping To:</div>
                                    <div class="inner-label">
                                        {{ $sales_order->address.', '.$sales_order->postcode.', '.$sales_order->city.', '.$sales_order->state.', '.$sales_order->country }}
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="total">
                                <div class="d-flex justify-content-between data-content-wrapper">
                                    <div class="label">Total</div>
                                    <div class="data-label">
                                        <div class="price">${{ $sales_order->total }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 mt-lg-0 col-md-12 col-lg-4">
                        <div class="order-received-summary"> 
                            <div class="order-received-title">Your order has been received.</div>
                            <div class="order-no">Order No: {{ $sales_order->sales_order_id }}</div>
                            @if($sales_order->payment_method)
                            <div class="d-flex payment-method-wrapper">
                                <div class="payment-method-title">Payment Method :</div>
                                <div class="payment-method">{{ array_flip(App\Plugins\SalesOrder\Models\SalesOrder::PAYMENT_METHOD)[$sales_order->payment_method] }}</div>
                            </div>
                            @endif
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
                @foreach ($product_list as $product)
                <div class="swiper-slide product-img">
                    <a href="{{route('web.product_detail', ['alias' => $product->alias])}}">
                        <div class="product-image position-relative">
                            <img class="show" src="{{$product->productImage->first()->url}}">
                            @if(function_exists('salesOrderRenderView'))
                            {{ salesOrderRenderView('product_list_hover_web', $product) }}
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="rating-wishlist">
                                @if(function_exists('reviewRenderView'))
                                {{ reviewRenderView('common_star_rating', $product) }}
                                @endif
                                @if(function_exists('salesOrderRenderView'))
                                {{ salesOrderRenderView('product_list_wishlist_mobile', $product) }}
                                @endif
                            </div>
                            <div class="product-description">{{ $product->name }}</div>
                            <div class="price-cart">
                                <div class="product-price">$ {{$product->productPrice[0]->price}}</div>
                                @if(function_exists('salesOrderRenderView'))
                                {{ salesOrderRenderView('product_list_cart_mobile', $product) }}
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
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