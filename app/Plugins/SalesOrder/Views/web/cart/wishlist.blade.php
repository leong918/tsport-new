@extends('web.layout.app')
@section('content')
<div id="wishlist" class="overflow-x-hidden margin-header">
    <div class="">
        <div class="product-banner">
            <div class="product-title-wrapper">
                <div class="product-title">Wishlist</div>
                <div class="product-nav d-flex justify-content-center"><span>Home</span><span>></span><span>Wishlist</span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center content-wrapper">
            <div class="col-12 product-wrapper" id="targetElement">
                <div class="product">
                    <div class="container">
                        <div class="total-count-item">{{ $wishlist_count > 0 ? $wishlist_count. ' Items' : 'No product in wishlist' }} </div>
                        <div class="row row-cols-2 row-cols-lg-4 row-cols-md-3 row-cols-sm-3">
                            @foreach ($wishlist_record as $wishlist)
                            <div class="product-container col product-img">
                                <a href="{{route('web.product_detail', ['alias' => $wishlist->product->alias])}}">
                                    <div class="product-image position-relative">
                                        <img class="show" src="{{ $wishlist->product->getFirstProductImage()->url }}">
                                        <div class="wishlist-cart-container">
                                            <div class="row text-center">
                                                <div class="col-md-6">
                                                    <div class="wishlist-container wishlist-remove-button-hover" data-id="{{ $wishlist->product->id }}" data-url="{{ route('cart.remove_wishlist') }}">
                                                        <img class="wishlist-hide" src="{{asset('assets/web/assets/img/global/del.png')}}">
                                                        <img class="wishlist-hover-show bg-white rounded-circle p-2" src="{{asset('assets/web/assets/img/shopping_cart/remove.png')}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!--cart-->
                                                    <div class="cart-container cart-button-hover" data-id="{{ $wishlist->product->id }}" data-url="{{ route('cart.add_to_cart') }}">
                                                        <img class="cart-hide" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                                                        <img class="cart-hover-show" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="product-info">
                                    <div class="rating-wishlist">
                                        @if(function_exists('reviewRenderView'))
                                        {{ reviewRenderView('common_star_rating', $wishlist->product) }}
                                        @endif
                                    </div>
                                    <div class="product-description">
                                        <div>{{ $wishlist->product->name }}</div>
                                        <a href="#"><img class="wishlist-mobile bg-white rounded-circle p-2 wishlist-remove-button-hover" data-id="{{ $wishlist->product->id }}" data-url="{{ route('cart.remove_wishlist') }}" src="{{asset('assets/web/assets/img/shopping_cart/remove.png')}}"></a>
                                    </div>
                                    <div class="price-cart">
                                        <div class="product-price">${{ $wishlist->product->getCurrencyParameters('HKD')->price }}</div>
                                        <img class="cart-mobile" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
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
<script type="text/javascript">
    $(document).ready(function() {
    // Set the target element
    var targetElement = $('#targetElement');
    var footerElement = $('#footer');

    // Function to check if the page has scrolled to the target element
    function isScrolledToElement(element) {
        var scrollPosition = $(window).scrollTop();
        var elementOffset = element.offset().top;

        return scrollPosition >= elementOffset;
    }

    // Event listener for scroll
    $(window).scroll(function() {
        // Check if scrolled to the target element
        if (isScrolledToElement(targetElement)) {
        $('.category-wrapper').addClass('active');
        if ($(window).scrollTop() + window.innerHeight >= $('#footer').offset().top) {
            console.log('Reached the footer');
            // Perform your action when the page reaches the footer
            $('.category-wrapper').css('top', '-100%');
            }
            else{
                $('.category-wrapper').css('top', '0');
            }
        } else {
        $('.category-wrapper').removeClass('active');
        }
    });
    });

</script>
@endpush