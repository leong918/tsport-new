@extends('web.layout.app')
@section('content')

<div id="product" class="overflow-x-hidden margin-header">
    <div class="product-banner">
        <img src="{{asset('assets/web/assets/img/product/product_bg.png')}}" />
        <div class="product-title-wrapper">
            <div class="product-title">Skin Care</div>
            <div class="product-nav d-flex justify-content-center"><span>Home</span><span>></span><span>Skincare</span></div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center content-wrapper">
            <div class="d-block d-md-none filter-wrapper row">
                <a href="#offcanvasNav"  data-bs-toggle="offcanvas" class="d-inline-block"><img src="{{asset('assets/web/assets/img/product/filter.png')}}" /></a>
            </div>
            <div class="offcanvas offcanvas-start col-5" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-body">
                    <div class="col-sm-12 nav-wrapper">
                        <div class="category-wrapper">
                            <div class="list-title">Category</div>
                            <ul>
                                <li><a href="#">Cleanser</a></li>
                                <li><a href="#">Toner & Face Mist</a></li>
                                <li><a href="#">Serum & Face Oil</a></li>
                                <li><a href="#">Exfollator & Mask</a></li>
                                <li><a href="#">Moisturizer</a></li>
                                <li><a href="#">Eye Care</a></li>
                                <li><a href="#">Lip Care</a></li>
                                <li><a href="#">Sun Protection</a></li>
                                <li><a href="#">Tool</a></li>
                            </ul>
                        </div>
                        <div class="brand-wrapper">
                            <div class="list-title">Brands</div>
                            <ul>
                                <li><a href="#">Ve Oola</a></li>
                                <li><a href="#">Lovinah</a></li>
                                <li><a href="#">Josh Rosebrook</a></li>
                                <li><a href="#">Odacite</a></li>
                                <li><a href="#">Vita Recherche</a></li>
                                <li><a href="#">Woods Copenhagen</a></li>
                                <li><a href="#">CS12</a></li>
                                <li><a href="#">Root Science</a></li>
                                <li><a href="#">SANGRE DE FRUTA</a></li>
                                <li><a href="#">RETREATMENT BOTANICS</a></li>
                                <li><a href="#">I-N (INTELLIGENT NUTRIENTS)</a></li>
                                <li><a href="#">Karmameju</a></li>
                                <li><a href="#">L:A BRUKET</a></li>
                                <li><a href="#">LERNBERGER STAFSING</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-block col-md-3 nav-wrapper">
                        <div class="category-wrapper">
                            <div class="list-title">Category</div>
                            <ul>
                                <li><a href="#">Cleanser</a></li>
                                <li><a href="#">Toner & Face Mist</a></li>
                                <li><a href="#">Serum & Face Oil</a></li>
                                <li><a href="#">Exfollator & Mask</a></li>
                                <li><a href="#">Moisturizer</a></li>
                                <li><a href="#">Eye Care</a></li>
                                <li><a href="#">Lip Care</a></li>
                                <li><a href="#">Sun Protection</a></li>
                                <li><a href="#">Tool</a></li>
                            </ul>
                        </div>
                        <div class="brand-wrapper">
                            <div class="list-title">Brands</div>
                            <ul>
                                <li><a href="#">Ve Oola</a></li>
                                <li><a href="#">Lovinah</a></li>
                                <li><a href="#">Josh Rosebrook</a></li>
                                <li><a href="#">Odacite</a></li>
                                <li><a href="#">Vita Recherche</a></li>
                                <li><a href="#">Woods Copenhagen</a></li>
                                <li><a href="#">CS12</a></li>
                                <li><a href="#">Root Science</a></li>
                                <li><a href="#">SANGRE DE FRUTA</a></li>
                                <li><a href="#">RETREATMENT BOTANICS</a></li>
                                <li><a href="#">I-N (INTELLIGENT NUTRIENTS)</a></li>
                                <li><a href="#">Karmameju</a></li>
                                <li><a href="#">L:A BRUKET</a></li>
                                <li><a href="#">LERNBERGER STAFSING</a></li>
                            </ul>
                        </div>
                    </div>
            <div class="col-sm-12 col-md-9 product-wrapper">
                    <div class="product">
                        <div class="container">
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
@endpush