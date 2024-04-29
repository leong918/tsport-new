@extends('web.layout.app')

<x-alert />

@section('content')

@php
    $productRepository = new \App\Repositories\ProductRepository(new \Illuminate\Container\Container);
@endphp

<div id="home" class="overflow-x-hidden">
    <!-- Banner container -->
    <div class="banner">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel"  data-bs-interval="3000">
            <div class="carousel-indicators">
                @php
                    $count = 0;
                    $slideCount = 1;
                @endphp
                @foreach ($slider_list->where('type', 'main') as $slider)
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="{{ $count }}" class="{{ $slideCount == 1 ? 'active' : ''}}" aria-current="true" aria-label="Slide {{ $slideCount }}"></button>
                @php
                    $count++;
                    $slideCount++;
                @endphp
                @endforeach
            </div>
            <div class="carousel-inner">
                @php
                    $imageCount = 1;
                @endphp
                @foreach ($slider_list->where('type', 'main') as $slider)
                <div class="carousel-item {{ $imageCount == 1 ? 'active' : '' }}">
                    <a href="{{ $slider->url }}" target="_blank">
                        <img src="{{ $slider->image }}" class="img-fluid carousel-image" />
                        {{-- <div class="container carousel-caption">
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
                        </div> --}}
                    </a>
                </div>
                @php
                    $imageCount++;
                @endphp
                @endforeach
            </div>
        </div>
    </div>
    <!-- container promo -->
    <div class="promo">
        <div class="title-promo">
            {!! $setting_list->where('key', 'sub_slider_title')->first()->value !!}
        </div>
        <div class="swiper mySwiper-promo">
            <div class="swiper-wrapper">
                @foreach ($slider_list->where('type', 'sub') as $slider)
                <div class="swiper-slide promotion-img">
                    <a href="{{ $slider->url }}" target="_blank"><img src="{{ $slider->image }}"></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- container product-->
    <div class="product">
        <div class="row">
            <div class="col-12 order-md-first order-last col-md-8">
                <div class="swiper mySwiper-product">
                    <div class="swiper-wrapper">
                        @php
                            $product_list = $productRepository->find(json_decode($setting_list->where('key', 'product_right_select')->first()->value));
                        @endphp
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
                                    </div>
                                    <div class="product-description">{{ $product->name }}</div>
                                    <div class="price-cart">
                                        <div class="product-price">${{$product->getCurrencyParameters('HKD')->price}}</div>
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
            <div class="col-md-4">
                <div class="oval" id="first-oval">
                    <div class="main-title">
                        {!! $setting_list->where('key', 'section_right_title')->first()->value !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 col-md-4">
                <div class="oval" id="second-oval">
                    <div class="main-title">
                        {!! $setting_list->where('key', 'section_left_title')->first()->value !!}
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="swiper mySwiper-product">
                    <div class="swiper-wrapper">
                        @php
                            $product_list = $productRepository->find(json_decode($setting_list->where('key', 'product_left_select')->first()->value));
                        @endphp
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
                                    </div>
                                    <div class="product-description">{{ $product->name }}</div>
                                    <div class="price-cart">
                                        <div class="product-price">${{$product->getCurrencyParameters('HKD')->price}}</div>
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
    </div>

    <!-- container new product-->
    <div class="new-product">
        <div class="container">
            <div class="title-new">
                {!! $setting_list->where('key', 'section_center_title')->first() ->value !!}
            </div>
        </div>
        <div class="swiper mySwiper-newproduct">
            <div class="swiper-wrapper">
                @php
                    $product_list = $productRepository->find(json_decode($setting_list->where('key', 'product_center_select')->first()->value));
                @endphp
                @foreach ($product_list as $product)
                <div class="swiper-slide new-launches-product-img">
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
                            </div>
                            <div class="product-description">{{ $product->name }}</div>
                            <div class="price-cart">
                                <div class="product-price">${{$product->getCurrencyParameters('HKD')->price}}</div>
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


        <!-- best seller and new container-->
        <div class="best-seller">
            <div class="container">
                <div class="row">
                    <div class="col-12 order-md-first order-last col-md-4">
                        <div class="container oval-block-best-seller">
                            <div class="oval">
                                <div class="main-title">BEST SELLER</div>
                                <div class="explore-button">
                                    <a class="btn btn-primary" id="explore-now" href="{{route('web.best_seller')}}">EXPLORE NOW</a>
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
                                    <a class="btn btn-primary" id="discover-now" href="{{route('web.product_new')}}">DISCOVER NOW</a>
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
                <div class="title-recommend">
                    {!! $setting_list->where('key', 'recommended_title')->first() ->value !!}
                </div>
                <div class="row row-cols-2 row-cols-lg-5 row-cols-md-4 row-cols-sm-3">
                    @php
                        $product_list = $productRepository->find(json_decode($setting_list->where('key', 'product_recommended_select')->first()->value))->take(10);
                    @endphp
                    @foreach ($product_list as $product)
                    <div class="recommend-product-container col recommend-product-img">
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
                                </div>
                                <div class="product-description">{{ $product->name }}</div>
                                <div class="price-cart">
                                    <div class="product-price">${{$product->getCurrencyParameters('HKD')->price}}</div>
                                    @if(function_exists('salesOrderRenderView'))
                                    {{ salesOrderRenderView('product_list_cart_mobile', $product) }}
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="more-button">
                    <a class="btn btn-primary" id="view-more" href="{{ route('web.product') }}">SEE ALL PRODUCTS</a>
                </div>
            </div>
        </div>
    </div>
    <!-- blog container -->
    <div class="blog">
        <div class="container">
            <div class="title-blog">Blog</div>
            <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2">
                @foreach ($blog_list->take(4) as $blog)
                <div class="blog-container blog-img">
                    <div class="blog-block">
                    <a class="text-decoration-none" style="color: inherit" href="{{route('web.blog_detail', ['blog_id' => $blog->id])}}">
                            <div class="img-block">
                                <img src="{{ $blog->getParameters('zh-CN')->image }}">
                            </div>
                            <div class="blog-description">
                                <div class="blog-date">{{ $blog->publishedDate()  }}</div>
                                <div class="blog-main">{{ $blog->name  }}</div>
                            </div>
                            <div class="blog-button">
                                <div style="color: inherit"">READ MORE</div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="more-button">
                <a class="btn btn-primary" id="blog-view-more" href="{{route('web.blog')}}">MORE</a>
            </div>
        </div>
    </div>

    <!-- brands container -->
    <div class="brands">
        <div class="brands-title">Brands</div>
        <div class="swiper mySwiper-brands">
            <div class="swiper-wrapper">
                @foreach ($brand_list as $brand)
                <div class="swiper-slide brand-img"><img src="{{ $brand->logo }}"></div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- discover container -->
    <div class="discover">
        <div class=container>
            <div class="container-discover text-center">
                <div class="discover-title">More To Discover</div>
                <div class="swiper mySwiper-category">
                    <div class="swiper-wrapper">
                        @foreach ($more_discover_category_list as $category)
                        <div class="swiper-slide more-discover-img">
                            <a href="{{ route('web.product', ['category_id' => $category->id ]) }}">
                                <img src="{{$category->image}}">
                            </a>
                            <div class="discover-description">{{$category->name}}</div>
                        </div>
                        @endforeach
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

    //more to discover
    var swiper = new Swiper(".mySwiper-category", {
        autoplay: {
            delay: 3000,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
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