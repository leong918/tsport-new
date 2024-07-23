@extends('web.layout.app')
@section('content')
<div id="mission">
    <!-- header -->
    <div class="section-header">
        <div class="row gx-0 header-row">
            <div class="col-12 col-md-6 col-lg-5  banner-background">
                <div class="title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item p4"><a href="/">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item p4">{{ __('Who we are') }}</li>
                            <li class="breadcrumb-item active p4" aria-current="page">{{ __('Mission, Vision, Value') }}</li>
                        </ol>
                    </nav>
                    <h2 class="h2">
                        {!! __('Mission, Vision,<br/>Value') !!}
                    </h2>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7 d-none d-md-block">
                <img src="{{ asset('assets/web/assets/img/mission/banner.png') }}" alt="" class="img img-fluid banner-img h-100">
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="content-section">
        <div class="row content-wrapper">
            <div class="col-12 col-md-6 col-lg detail-wrapper">
                <div class="detail">
                    <img src="{{ asset('assets/web/assets/img/mission/mission-1.png') }}" alt="" class="img img-fluid">
                    <h3 class="h3">{{ __('Mission') }}</h3>
                    <p class="p2">
                        {{ __('Hello Smile Hong Kong (HSHK) is dedicated to serving the local Hong Kong community to improve the oral health of the underserved community with an emphasis on young children and children with special health care needs and to contribute to the enhancement of their overall quality of life. We endeavor to raise public awareness of oral health care by initiating educational programs with the public sector with a focus on anticipatory guidance to prevent dental and oral health issues and to provide dental care to the underserved community.') }}
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg detail-wrapper">
                <div class="detail">
                    <img src="{{ asset('assets/web/assets/img/mission/mission-2.png') }}" alt="" class="img img-fluid">
                    <h3 class="h3">{{ __('Vision') }}</h3>
                    <p class="p2">
                        {{ __('We believe everyone deserves a healthy “SMILE”. HSHK envisions to provide access to a “dental home” for the underserved community where they can have access to oral health education, preventive services, dental care screenings, and dental treatments.') }}
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg detail-wrapper">
                <div class="detail">
                    <img src="{{ asset('assets/web/assets/img/mission/mission-3.png') }}" alt="" class="img img-fluid">
                    <h3 class="h3">{{ __('Values') }}</h3>
                    <p class="p2">
                        {{ __('Our values represent our beliefs and guide how we behave. They are Love, Compassion, Respect, and Integrity.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- slick -->
         <div class="carousel-wrapper">
            <div class="slideshow d-flex align-items-center overflow-hidden" id="slogan-slideshow">
                <div class="swiper-slide">
                    <img src="{{ asset('assets/web/assets/img/home/slideshow-1.png') }}" alt="" class="img img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/web/assets/img/home/slideshow-2.png') }}" alt="" class="img img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/web/assets/img/home/slideshow-3.png') }}" alt="" class="img img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/web/assets/img/home/slideshow-4.png') }}" alt="" class="img img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/web/assets/img/home/slideshow-5.png') }}" alt="" class="img img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/web/assets/img/home/slideshow-6.png') }}" alt="" class="img img-fluid">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('assets/web/assets/img/home/slideshow-7.png') }}" alt="" class="img img-fluid">
                </div>
            </div>
         </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#about-carousel').slick({
        autoplay: true,
        fade: true,
        speed: 1000,
    });

    $('#slogan-slideshow').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 0,
        speed: 10000,
        cssEase: 'linear',
        infinite: true,
        pauseOnHover: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
        ]
    });
</script>
@endpush