@extends('web.layout.app')
@section('content')
<div id="home" class="overflow-x-hidden">
    <!-- Banner container -->
    <div class="banner">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div id="first-item" class="carousel-item active">
                    <img src="{{asset('assets/web/assets/img/homepage/homepage-banner.png')}}" class="img-fluid carousel-image" />
                    <div class="container carousel-caption">
                        <div class="caption-wrapper">
                            <div class="carousel-heading">Relaxation & Radiance Mask</div><br>
                            <div class="carousel-description">
                                <ul>
                                    <li>極佳舒敏抗炎效果</li>
                                    <li>顯著改善皮膚發紅,腫脹,痕癢,乾燥,脫皮等炎症</li>
                                    <li>修復並增強皮膚屏障,提升肌膚的防禦能力</li>
                                    <li>擺脫反覆敏感的皮膚煩惱</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="second-item" class="carousel-item" data-bs-interval="2000">
                    <img src="{{asset('assets/web/assets/img/homepage/homepage-banner.png')}}" class="img-fluid carousel-image" />
                    <div class="container carousel-caption">
                        <div class="caption-wrapper">
                            <div class="carousel-heading">Relaxation & Radiance Mask</div><br>
                            <div class="carousel-description">
                                <ul>
                                    <li>極佳舒敏抗炎效果</li>
                                    <li>顯著改善皮膚發紅,腫脹,痕癢,乾燥,脫皮等炎症</li>
                                    <li>修復並增強皮膚屏障,提升肌膚的防禦能力</li>
                                    <li>擺脫反覆敏感的皮膚煩惱</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="third-item" class="carousel-item">
                    <img src="{{asset('assets/web/assets/img/homepage/homepage-banner.png')}}" class="img-fluid carousel-image" />
                    <div class="container carousel-caption">
                        <div class="caption-wrapper">
                            <div class="carousel-heading">Relaxation & Radiance Mask</div><br>
                            <div class="carousel-description">
                                <ul>
                                    <li>極佳舒敏抗炎效果</li>
                                    <li>顯著改善皮膚發紅,腫脹,痕癢,乾燥,脫皮等炎症</li>
                                    <li>修復並增強皮膚屏障,提升肌膚的防禦能力</li>
                                    <li>擺脫反覆敏感的皮膚煩惱</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container promo -->
    <div class="promo">
        <div class="title-promo">
            雙十一優惠 <br>
            (11-20 NOV)
        </div>
        <div class="swiper mySwiper-promo">
            <div class="swiper-wrapper">
                <div class="swiper-slide promotion-img"><img src="{{asset('assets/web/assets/img/homepage/image-56.png')}}"></div>
                <div class="swiper-slide promotion-img"><img src="{{asset('assets/web/assets/img/homepage/image-57.png')}}"></div>
                <div class="swiper-slide promotion-img"><img src="{{asset('assets/web/assets/img/homepage/image-58.png')}}"></div>
                <div class="swiper-slide promotion-img"><img src="{{asset('assets/web/assets/img/homepage/image-59.png')}}"></div>
                <div class="swiper-slide promotion-img"><img src="{{asset('assets/web/assets/img/homepage/image-60.png')}}"></div>
                <div class="swiper-slide promotion-img"><img src="{{asset('assets/web/assets/img/homepage/image-61.png')}}"></div>
            </div>
        </div>
    </div>

    <!-- container product-->
    <div class="product">
        <div class="row">
            <div class="col-12 order-md-first order-last col-md-8">
                <div class="swiper mySwiper-product">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide product-img">
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
                        <div class="swiper-slide product-img">
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
                        <div class="swiper-slide product-img">
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
                        <div class="swiper-slide product-img">
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
                        <div class="swiper-slide product-img">
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
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="oval" id="first-oval">
                    <div class="main-title">
                        Wellness |<br>
                        Vita Recherche |<br>
                        collagenvita
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="oval" id="second-oval">
                    <div class="main-title">
                        Superstars of <br> Ve Oola
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="swiper mySwiper-product">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide product-img">
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
                        <div class="swiper-slide product-img">
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
                        <div class="swiper-slide product-img">
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
                        <div class="swiper-slide product-img">
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
                        <div class="swiper-slide product-img">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- container new product-->
    <div class="new-product">
        <div class="container">
            <div class="title-new">New Launches of Lovinah are here demonstrating what innovative and unique truly mean.</div>
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


        <!-- best seller and new container-->
        <div class="best-seller">
            <div class="container">
                <div class="row">
                    <div class="col-12 order-md-first order-last col-md-4">
                        <div class="container oval-block-best-seller">
                            <div class="oval">
                                <div class="main-title">BEST SELLER</div>
                                <div class="explore-button">
                                    <button class="btn btn-primary" id="explore-now" type="button">EXPLORE NOW</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="best-seller-img">
                            <img src="{{asset('assets/web/assets/img/homepage/best-seller.png')}}" class="d-block w-100" alt="item-1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-md-8">
                        <div class="new-img">
                            <img src="{{asset('assets/web/assets/img/homepage/new.png')}}" class="d-block w-100" alt="item-1">
                        </div>
                    </div>
                    <div class="col-0 col-md-4">
                        <div class="oval-block-new">
                            <div class="oval">
                                <div class="main-text">NEW</div>
                                <div class="discover-button">
                                    <button class="btn btn-primary" id="discover-now" type="button">DISCOVER NOW</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- recommend container-->
        <div class="recommend">
            <div class="container">
                <div class="title-recommend">A Few Things We Think You'll Love</div>
                <div class="row row-cols-2 row-cols-lg-5 row-cols-md-4 row-cols-sm-3">
                    <div class="recommend-product-container col recommend-product-img">
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
                    <div class="recommend-product-container col recommend-product-img">
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
                    <div class="recommend-product-container col recommend-product-img">
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

                    <div class="recommend-product-container col recommend-product-img">
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
                    <div class="recommend-product-container col recommend-product-img">
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

                    <div class="recommend-product-container col recommend-product-img">
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
                    <div class="recommend-product-container col recommend-product-img">
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
                    <div class="recommend-product-container col recommend-product-img">
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
                    <div class="recommend-product-container col recommend-product-img">
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
                    <div class="recommend-product-container col recommend-product-img">
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
                </div>
                <div class="more-button">
                    <button class="btn btn-primary" id="view-more" type="button">SEE ALL PRODUCTS</button>
                </div>
            </div>
        </div>
    </div>
    <!-- blog container -->
    <div class="blog">
        <div class="container">
            <div class="title-blog">Blog</div>
            <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2">
                <div class="blog-container blog-img">
                    <div class="blog-block">
                        <div class="img-block">
                            <img src="{{asset('assets/web/assets/img/homepage/blog-img-1.png')}}">
                        </div>
                        <div class="blog-description">
                            <div class="blog-date">July 22, 2023</div>
                            <div class="blog-main">新星级抗氧化王者一乙艦載油X LOVINAH新品早CA雙精華</div>
                        </div>
                        <div class="blog-button" type="button">READ MORE</div>
                    </div>
                </div>
                <div class="blog-container col blog-img">
                    <div class="blog-block">
                        <div class="img-block">
                            <img src="{{asset('assets/web/assets/img/homepage/blog-img-2.png')}}">
                        </div>
                        <div class="blog-description">
                            <div class="blog-date">September 17, 2022</div>
                            <div class="blog-main">防曬們是非我細細聲講給你(下)</div>
                        </div>
                        <div class="blog-button" type="button">READ MORE</div>
                    </div>
                </div>
                <div class="blog-container col blog-img">
                    <div class="blog-block">
                        <div class="img-block">
                            <img src="{{asset('assets/web/assets/img/homepage/blog-img-3.png')}}">
                        </div>
                        <div class="blog-description">
                            <div class="blog-date">September 9, 2022</div>
                            <div class="blog-main">防曬們是非我細細聲調給你(上)</div>
                        </div>
                        <div class="blog-button" type="button">READ MORE</div>
                    </div>
                </div>
                <div class="blog-container col blog-img">
                    <div class="blog-block">
                        <div class="img-block">
                            <img src="{{asset('assets/web/assets/img/homepage/blog-img-4.png')}}">
                        </div>
                        <div class="blog-description">
                            <div class="blog-date">August 24, 2022</div>
                            <div class="blog-main">護膚油同腦袋?一樣,都是個好東 西!LOVINAH三支神級BEAUTY OIL ELIXIR有咩分別?</div>
                        </div>
                        <div class="blog-button" type="button">READ MORE</div>
                    </div>
                </div>
            </div>
            <div class="more-button">
                <button class="btn btn-primary" id="blog-view-more" type="button">MORE</button>
            </div>
        </div>
    </div>

    <!-- brands container -->
    <div class="brands">
        <div class="brands-title">Brands</div>
        <div class="swiper mySwiper-brands">
            <div class="swiper-wrapper">
                <div class="swiper-slide brand-img"><img src="{{asset('assets/web/assets/img/homepage/brand-1.png')}}"></div>
                <div class="swiper-slide brand-img"><img src="{{asset('assets/web/assets/img/homepage/brand-2.png')}}"></div>
                <div class="swiper-slide brand-img"><img src="{{asset('assets/web/assets/img/homepage/brand-3.png')}}"></div>
                <div class="swiper-slide brand-img"><img src="{{asset('assets/web/assets/img/homepage/brand-4.png')}}"></div>
                <div class="swiper-slide brand-img"><img src="{{asset('assets/web/assets/img/homepage/brand-5.png')}}"></div>
                <div class="swiper-slide brand-img"><img src="{{asset('assets/web/assets/img/homepage/brand-6.png')}}"></div>
                <div class="swiper-slide brand-img"><img src="{{asset('assets/web/assets/img/homepage/brand-7.png')}}"></div>
                <div class="swiper-slide brand-img"><img src="{{asset('assets/web/assets/img/homepage/brand-8.png')}}"></div>
                <div class="swiper-slide brand-img"><img src="{{asset('assets/web/assets/img/homepage/brand-9.png')}}"></div>
                <div class="swiper-slide brand-img"><img src="{{asset('assets/web/assets/img/homepage/brand-10.png')}}"></div>
            </div>
        </div>
    </div>

    <!-- discover container -->
    <div class="discover">
        <div class=container>
            <div class="container-discover text-center">
                <div class="discover-title">More To Discover</div>
                <div class="row row-cols-2 row-cols-md-5 row-cols-sm-3">
                    <div class="discover-product-container col discover-product-img">
                        <img src="{{asset('assets/web/assets/img/homepage/more-to-discover-1.png')}}">
                        <div class="discover-description">Body Wash & Scrub</div>
                    </div>
                    <div class="discover-product-container col discover-product-img">
                        <img src="{{asset('assets/web/assets/img/homepage/more-to-discover-2.png')}}">
                        <div class="discover-description">Eyes Care</div>
                    </div>
                    <div class="discover-product-container col discover-product-img">
                        <img src="{{asset('assets/web/assets/img/homepage/more-to-discover-3.png')}}">
                        <div class="discover-description">Exfoliator & Mask</div>
                    </div>
                    <div class="discover-product-container col discover-product-img">
                        <img src="{{asset('assets/web/assets/img/homepage/more-to-discover-4.png')}}">
                        <div class="discover-description">Sun Protection</div>
                    </div>
                    <div class="discover-product-container col discover-product-img">
                        <img src="{{asset('assets/web/assets/img/homepage/more-to-discover-5.png')}}">
                        <div class="discover-description">Cleanser</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    //promo
    var swiper = new Swiper(".mySwiper-promo", {
        autoplay: {
            delay: 3000,
        },

        breakpoints: {
            375: {
                slidesPerView: 1.75,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        },

    });

    //product
    var swiper = new Swiper(".mySwiper-product", {
        autoplay: {
            delay: 3000,
        },

        breakpoints: {
            375: {
                slidesPerView: 1.75,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        }
    });

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


    //brands
    var swiper = new Swiper(".mySwiper-brands", {
        autoplay: {
            delay: 3000,
        },

        breakpoints: {
            375: {
                slidesPerView: 1.5,
                spaceBetween: 10,
            },

            425: {
                slidesPerView: 3,
                spaceBetween: 10,
            },

            768: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 6.2,
                spaceBetween: 20,
            },
        }
    });
</script>
@endpush