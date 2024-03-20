@extends('web.layout.app')
@section('content')
<div id="brand" class="overflow-x-hidden margin-header">
    <div class="">
        <div class="product-banner">
            <img src="{{ $brand->image }}" />
            <div class="product-title-wrapper">
                <div class="product-title">{{ $brand->name }}</div>
                <div class="product-nav d-flex justify-content-center"><span><a style="color: #6D5E44" class="text-decoration-none" href=" {{ route('web.home') }}">Home</a></span><span>></span><span>Brands</span><span>></span><span>{{ $brand->name }}</</span></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center content-wrapper">
            <div class="d-block d-md-none filter-wrapper row">
                <a href="#offcanvasNav"  data-bs-toggle="offcanvas" class="d-inline-block"><img src="{{asset('assets/web/assets/img/brand/filter.png')}}" /></a>
            </div>
            <div class="offcanvas offcanvas-start col-5" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-body">
                    <div class="col-12 nav-wrapper">
                        <div class="category-wrapper">
                            <div class="list-title">Category</div>
                            <ul>
                                @foreach ($category_list as $category)
                                    <li><button data-target-section="{{ $category->name }}" class="canvas-category-button">{{ $category->name }}</button></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-block col-md-3 nav-wrapper">
                <div class="category-wrapper">
                    <div class="list-title">Category</div>
                    <ul>
                        @foreach ($category_list as $category)
                            <li><a href="{{ route('web.product', ['category_id' => $category->id ]) }}" >{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9 product-wrapper" id="targetElement">
                <div class="tnc">
                    <div class="tnc-para">
                        {!! $brand->getParameters('cn')->description !!}
                    </div>
                </div>
                @foreach($product_list as $category => $category_product_list)
                <div class="product" id="{{ $category }}">
                    <div class="type">{{ $category }}</div>
                    <div class="container">
                        <div class="row row-cols-2 row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-3">
                            @foreach($category_product_list as $product)
                            <div class="product-container col product-img">
                                <div class="product-image position-relative">
                                    <a href="{{route('web.product_detail', ['alias' => $product->alias])}}">
                                        <img class="show" src="{{$product->productImage()->first()->url}}">
                                    </a>
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
                                        <div class="product-price">{{$product->code .' '.$product->price }}</div>
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
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.canvas-category-button').click(function(e) {

        var targetSection = $(this).data('target-section');

        $('#offcanvasNav').offcanvas('hide');

        $('#offcanvasNav').on('hidden.bs.offcanvas', function () {
            $('html, body').animate({
                scrollTop: $('#' + targetSection).offset().top
            }, 0);
        });
    });
    
  // Set the target element
//   var targetElement = $('#targetElement');
//   var footerElement = $('#footer');

//   // Function to check if the page has scrolled to the target element
//   function isScrolledToElement(element) {
//     var scrollPosition = $(window).scrollTop();
//     var elementOffset = element.offset().top;

//     return scrollPosition >= elementOffset;
//   }

//   // Event listener for scroll
//   $(window).scroll(function() {
//     // Check if scrolled to the target element
//     if (isScrolledToElement(targetElement)) {
//       $('.category-wrapper').addClass('active');

//       if ($(window).scrollTop() + window.innerHeight >= $('#footer').offset().top) {
//         // Perform your action when the page reaches the footer
//         $('.category-wrapper').css('top', '-100%');
//         }
//         else{
//             $('.category-wrapper').css('top', '0');
//         }
        
//     } else {
//       $('.category-wrapper').removeClass('active');
//     }
//   });
});

</script>
@endpush