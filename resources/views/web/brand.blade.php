@extends('web.layout.app')
@section('content')
<div id="brand" class="overflow-x-hidden margin-header">
    <div class="">
        <div class="product-banner">
            <img src="{{asset('assets/web/assets/img/brand/bg.png')}}" />
            <div class="product-title-wrapper">
                <div class="product-title">Lovinah</div>
                <div class="product-nav d-flex justify-content-center"><span>Home</span><span>></span><span>Brands</span><span>></span><span>Lovinah</span></div>
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
                                <li><a href="#">Cleanser</a></li>
                                <li><a href="#">Ampoules</a></li>
                                <li><a href="#">Toners</a></li>
                                <li><a href="#">Water-based Serums</a></li>
                                <li><a href="#">Facial oil Elixirs</a></li>
                                <li><a href="#">Masks</a></li>
                                <li><a href="#">Moisturizier</a></li>
                                <li><a href="#">Eye Care</a></li>
                                <li><a href="#">Makeup</a></li>
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
                        <li><a href="#">Ampoules</a></li>
                        <li><a href="#">Toners</a></li>
                        <li><a href="#">Water-based Serums</a></li>
                        <li><a href="#">Facial oil Elixirs</a></li>
                        <li><a href="#">Masks</a></li>
                        <li><a href="#">Moisturizier</a></li>
                        <li><a href="#">Eye Care</a></li>
                        <li><a href="#">Makeup</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 product-wrapper" id="targetElement">
                <div class="tnc">
                    <div class="tnc-para">
                        <p class="title">
                            Tag Concept(本店)連續四年為Lovinah指定香港及澳門地區代理商,保證每月新鮮貨。
                            對產品具有深入了解及擁有豐富治理皮膚經驗,能針對客人 個別皮膚狀況提供最正宗最有效使用方法,有別於一般一買一賣的零售體驗,給你優質的售後跟進服務。
                        </p>
                        <p class="title">Lovinah Supernatural Skincare品牌故事及理念:</p>
                        <p>
                            Joy Ekhator 是 Lovinah 的創辦人,她在家鄉尼日利亞的一個傳統非洲家庭中長大。
                            她的祖母是一名草藥師、傳統醫生、接骨師和助產士。祖母向她傳授古老的非洲植物知識,自小她就 從祖母身上體驗到大自然的治愈力量。
                            Joy在全職擔任計算機程序員的時候,同時在三年內生了三個孩子,龐大的壓力令她荷爾蒙重失調,體重驟增,並且全臉長滿痤瘡,非常痛苦。她 試了市面上的產品,但沒有為她帶來任何效果。而當時她的孩子的皮膚亦同樣出現問題,在拜訪多個醫生之後,她最小的兒子得到了處方類固醇—這就是轉折點,她拒絕讓兒子服用類固 醇,並決定從大自然的力量去找尋求真正的治愈。她感謝自己的決定,因為大自然真的用超自然力量治癒了她和她的孩子。這就是Lovinah誕生的開始。
                        </p>
                        <p>
                            Lovinah Supernatural Skincare是對古代非洲美容智慧和傳統草藥配方的致敬與體現。
                            品牌的自然護膚品的靈感,是來自古老的非洲美容秘訣和擁有數百年歷史的傳統非洲植物療法,並 加入現代技術,以解決不同的皮膚問題。 
                            Lovinah提供一系列全植物高性能和多功能產品,旨在照顧和解決惱人的荷爾蒙問題,以及預防皮膚衰老,明顯改善膚色,幫助皮膚抵抗環境的 污染和損害。
                        </p>
                        <p>
                            所有產品不含:對羥基苯甲酸酯,鄰苯二甲酸鹽,硫酸鹽,塑化劑,麩質,礦物油,石油,不經動物試驗。
                        </p>
                    </div>
                </div>
                <div class="product">
                    <div class="type">Cleansers</div>
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