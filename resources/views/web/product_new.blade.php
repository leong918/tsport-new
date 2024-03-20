@extends('web.layout.app')
@section('content')
<div id="best_seller" class="overflow-x-hidden margin-header">
    <div class="product-banner">
        <img src="{{asset('assets/web/assets/img/new/bg.png')}}" />
        <div class="product-title-wrapper">
            <div class="product-title">New</div>
            <div class="product-nav d-flex justify-content-center"><span>Home</span><span>></span><span>New</span></div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center content-wrapper">
            <div class="col-12 product-wrapper" id="targetElement">
                <div class="product">
                    <div class="container">
                        <div class="row row-cols-2 row-cols-lg-4 row-cols-md-3 row-cols-sm-3">
                            @foreach($product_list as $product)
                                <div class="product-container col product-img">
                                    <div class="product-image position-relative">
                                        <img class="show" src="{{ $product->getFirstProductImage()->url }}">
                                        @if(function_exists('salesOrderRenderView'))
                                        {{ salesOrderRenderView('product_list_hover_web', $product) }}
                                        @endif
                                    </div>
                                    <div class="product-info">
                                        <div class="rating-wishlist">
                                            @if(function_exists('reviewRenderView'))
                                            {{ reviewRenderView('common_star_rating') }}
                                            @endif
                                            @if(function_exists('salesOrderRenderView'))
                                            {{ salesOrderRenderView('product_list_wishlist_mobile', $product) }}
                                            @endif
                                        </div>
                                        <div class="product-description">{{ $product->name }}</div>
                                        <div class="price-cart">
                                            <div class="product-price">{{ $product->code . ' ' .$product->price }}</div>
                                            @if(function_exists('salesOrderRenderView'))
                                            {{ salesOrderRenderView('product_list_cart_mobile', $product) }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush