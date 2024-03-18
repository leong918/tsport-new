@extends('web.layout.app')
@section('content')
<div id="product_details" class="margin-header">
    <div class="container details-wrapper">
        <div class="row">
            <div class="col-12 row nav-wrapper">
                <div class="d-flex nav-title-wrapper">
                    <div>Home</div>
                    @if (!empty($product_parent_category))
                    <div>></div>
                    <div class="text-capitalize">{{ $product_parent_category->name }}</div>
                    @endif
                    <div>></div>
                    <div class="text-capitalize">{{ $product->category->name }}</div>
                </div>
            </div>
            <div class="col-12 col-lg-6 row justify-content-between image-wrapper">
                <div class="col-12 col-lg-2 image-viewer-slider slider-nav p-0">
                    @foreach($product->productImage as $product_image)
                        <div class="d-flex flex-column justify-content-center align-center"><img src="{{ $product_image->url }}"></div>
                    @endforeach                </div>
                <div class="col-12 col-lg-10 image-viewer slider-for">
                    @foreach($product->productImage as $product_image)
                        <div class=""><img src="{{$product_image->url}}"></div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-lg-6 product-wrapper">
                <div class="row">
                    @if(function_exists('reviewRenderView'))
                    {{ reviewRenderView('product_detail_top_review') }}
                    @endif
                    <div class="col-9">
                        <div class="">
                            <div class="col-10 product-title">{{ $product->name }}</div>
                        </div>
                    </div>
                    <div class="col-2 d-flex justify-content-end wishlist-wrapper">
                        <img src="{{asset('assets/web/assets/img/product_details/wishlist_icon.png')}}">
                    </div>
                </div>
                <div class="d-flex justify-content-between product-action-wrapper">
                    <div class="product-price d-flex flex-column justify-content-center">
                        {{ $product->code.' '.$product->price }}
                    </div>
                    <div class="d-flex justify-content-between product-quantity-wrapper">
                        <div><button class="action-button minus"><img src="{{asset('assets/web/assets/img/product_details/minus.png')}}" /></button></div>
                        <div><input type="text" value="1" class="quantity-text" readonly /></div>
                        <div><button class="action-button plus"><img src="{{asset('assets/web/assets/img/product_details/plus.png')}}" /></button></div>
                    </div>
                </div>
                <div class="row action-button-wrapper">
                    <div class="col-12 col-lg-6 ps-0"><button class="cart-button">ADD TO CART</button></div>
                    <div class="col-12 col-lg-6 pe-0"><button class="buy-button">BUY IT NOW</button></div>
                </div>

                <div class="row">
                    <div class="col-12 product-details-wrapper mx-auto">
                        <div class="product-details-list">{!! $product->getParameters('en')->information!!}</div>
                    </div>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 product-info-wrapper">
        <div class="col-12 col-md-10 col-lg-7">
            <ul class="nav nav-tabs info-action-button" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#desciption" type="button" role="tab" aria-controls="desciption" aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ingredients" type="button" role="tab" aria-controls="ingredients" aria-selected="false">Ingredients</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#usage" type="button" role="tab" aria-controls="usage" aria-selected="false">Usage</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="false">Additional Information</button>
                </li>
                @if(function_exists('reviewRenderView'))
                {{ reviewRenderView('product_detail_nav_title') }}
                @endif
            </ul>
            <div class="tab-content description" id="myTabContent">
                <div class="tab-pane fade show active" id="desciption" role="tabpanel" aria-labelledby="desciption-tab">
                    <div class="content-wrapper">
                        {!! $product->getParameters('en')->description !!}
                    </div>
                </div>
                <div class="tab-pane fade" id="ingredients" role="tabpanel" aria-labelledby="ingredients-tab">
                    <div class="content-wrapper">
                        {!! $product->getParameters('en')->ingredient !!}
                    </div>
                </div>
                <div class="tab-pane fade" id="usage" role="tabpanel" aria-labelledby="usage-tab">
                    <div class="content-wrapper">
                        {!! $product->getParameters('en')->usage !!}
                    </div>
                </div>
                <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <div class="content-wrapper">
                        {!! $product->getParameters('en')->additional_information !!}
                    </div>
                </div>
                @if(function_exists('reviewRenderView'))
                {{ reviewRenderView('product_detail_nav_content') }}
                @endif
            </div>
        </div>
    </div>
    <div class="continue-shopping-product">
        <div class="">
            <div class="title-new">Related Products</div>
        </div>
        <div class="swiper mySwiper-continueproduct">
            <div class="swiper-wrapper">
                @if($product->productRelated->count())
                    @foreach($product->productRelated as $productRelated)
                        <a href="{{route('web.product_detail', ['alias' => $productRelated->relatedProduct->alias])}}" class="swiper-slide new-launches-product-img">
                            <div class="product-image position-relative">
                                <img class="show" src="{{ $productRelated->relatedProduct->productImage->first()->url }}">
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
                                    @if(function_exists('reviewRenderView'))
                                    {{ reviewRenderView('common_star_rating') }}
                                    @endif
                                    <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                                </div>
                                <div class="product-description">{{ $productRelated->relatedProduct->name }}</div>
                                <div class="price-cart">
                                    <div class="product-price">{{ $productRelated->relatedProduct->getCurrencyParameters('HKD')->price }}</div>
                                    <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    //new-product
    var swiper = new Swiper(".mySwiper-continueproduct", {
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

    $(document).ready(function() {
        var selectReviewStar = 0;

        $('body').on('click', '.review-star-control', function() {
            var selectedStar = $(this).data("number");
            selectReviewStar = selectedStar;
            $('.review-star-control').each(function(){
                if($(this).data("number") <= selectedStar){
                    $(this).children('img').attr("src", "{{asset('assets/web/assets/img/product_details/star_1.png')}}");
                }else{
                    $(this).children('img').attr("src", "{{asset('assets/web/assets/img/product_details/star_2.png')}}");
                }
            });
        }),

        $('.leave-review-wrapper .star-wrapper').hover(
            function() {
                $('.review-star-control').hover(
                    function() {
                        var selectedStar = $(this).data("number");
                        $('.review-star-control').each(function(){
                            if($(this).data("number") <= selectedStar){
                                $(this).children('img').attr("src", "{{asset('assets/web/assets/img/product_details/star_1.png')}}");
                            }
                        });
                        
                    },
                    function() {
                        $('.review-star-control').each(function(){
                            $(this).children('img').attr("src", "{{asset('assets/web/assets/img/product_details/star_2.png')}}");
                        })
                    },
                )
            } , 
            function(){
                $('.review-star-control').each(function(){
                    if($(this).data("number") <= selectReviewStar){
                        $(this).children('img').attr("src", "{{asset('assets/web/assets/img/product_details/star_1.png')}}");
                    }else{
                        $(this).children('img').attr("src", "{{asset('assets/web/assets/img/product_details/star_2.png')}}");
                    }
                });
            }
        );

        $('body').on('click', '.minus', function() {
            var input_quantity = $(this).parent().parent().find('.quantity-text');
            input_quantity.val(parseInt(input_quantity.val()) - 1);
        });

        $('body').on('click', '.plus', function() {
            var input_quantity = $(this).parent().parent().find('.quantity-text');
            input_quantity.val(parseInt(input_quantity.val()) + 1);
        });

        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            infinite: false,
            asNavFor: '.slider-nav',
            centerMode: true
        });
        $('.slider-nav').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 4,
            infinite: false,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            focusOnSelect: true,
            prevArrow: '',
            nextArrow: '',
            rows: 0,
            vertical: true,
            verticalSwiping: true,
            responsive: [{
                breakpoint: 991,
                settings: {
                    vertical: false,
                    verticalSwiping: false,
                    prevArrow: '',
                    nextArrow: '',
                },
            }],
        });
    });
</script>
@endpush