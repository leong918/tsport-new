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
                        <div class="total-count-item">8 Items</div>
                        <div class="row row-cols-2 row-cols-lg-4 row-cols-md-3 row-cols-sm-3">
                            <div class="product-container col product-img">
                                <div class="product-image position-relative">
                                    <img class="show" src="{{asset('assets/web/assets/img/homepage/product-1.png')}}">
                                    <img class="hide" src="{{asset('assets/web/assets/img/homepage/product-1-hover.png')}}">
                                    <div class="wishlist-cart-container">
                                        <div class="row text-center">
                                            <div class="col-md-6">
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
                            <div class="product-container col product-img">
                                <div class="product-image position-relative">
                                    <img class="show" src="{{asset('assets/web/assets/img/homepage/product-2.png')}}">
                                    <img class="hide" src="{{asset('assets/web/assets/img/homepage/product-2-hover.png')}}">
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
                            <div class="product-container col product-img">
                                <div class="product-image position-relative">
                                    <img class="show" src="{{asset('assets/web/assets/img/homepage/product-5.png')}}">
                                    <img class="hide" src="{{asset('assets/web/assets/img/homepage/product-5-hover.png')}}">
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

                            <!-- offset-md-1 -->

                            <div class="product-container col product-img">
                                <div class="product-image position-relative">
                                    <img class="show" src="{{asset('assets/web/assets/img/homepage/product-2.png')}}">
                                    <img class="hide" src="{{asset('assets/web/assets/img/homepage/product-2-hover.png')}}">
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
                            <div class="product-container col product-img">
                                <div class="product-image position-relative">
                                    <img class="show" src="{{asset('assets/web/assets/img/homepage/product-3.png')}}">
                                    <img class="hide" src="{{asset('assets/web/assets/img/homepage/product-3-hover.png')}}">
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
                            <div class="product-container col product-img">
                                <div class="product-image position-relative">
                                    <img class="show" src="{{asset('assets/web/assets/img/homepage/product-4.png')}}">
                                    <img class="hide" src="{{asset('assets/web/assets/img/homepage/product-4-hover.png')}}">
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
                            <div class="product-container col product-img">
                                <div class="product-image position-relative">
                                    <img class="show" src="{{asset('assets/web/assets/img/homepage/product-1.png')}}">
                                    <img class="hide" src="{{asset('assets/web/assets/img/homepage/product-1-hover.png')}}">
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
                            <div class="product-container col product-img">
                                <div class="product-image position-relative">
                                    <img class="show" src="{{asset('assets/web/assets/img/homepage/product-2.png')}}">
                                    <img class="hide" src="{{asset('assets/web/assets/img/homepage/product-2-hover.png')}}">
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