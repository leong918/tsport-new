@extends('web.layout.app')

<x-alert />

@section('content')

<div id="home" class="overflow-x-hidden">
    <div class="swiper banner">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('assets/web/assets/img/home/banner-1.jpg') }}" alt="" class="img img-fluid banner-img">
                <div class="banner-content">
                    <h2 class="banner-title h2">
                        {!! __('EVERYONE DESERVES A HEALTHY "SMILE"') !!}
                    </h2>
                    <a href="#" class="button p2 d-flex align-items-center btn-more">
                        {{ __('Read More') }}
                        <img src="{{ asset('assets/web/assets/img/home/right-arrow.png') }}" alt="" class="img img-fluid arrow">
                    </a>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('assets/web/assets/img/home/banner-2.jpg') }}" alt="" class="img img-fluid banner-img">
                <div class="banner-content">
                    <h2 class="banner-title h2">
                        {!! __('WE CAN ALL DO SMALL THINGS WITH GREAT LOVE') !!}
                    </h2>
                    <a href="#" class="button p2 d-flex align-items-center btn-more">
                        {{ __('Read More') }}
                        <img src="{{ asset('assets/web/assets/img/home/right-arrow.png') }}" alt="" class="img img-fluid arrow">
                    </a>
                </div>
            </div>
        </div>
        <div class="swiper-bottom d-flex align-items-center">
            <div class="swiper-pagination"></div>
            <img src="{{ asset('assets/web/assets/img/home/play.png') }}" alt="" class="img img-fluid play d-none d-lg-block">
            <img src="{{ asset('assets/web/assets/img/home/pause.png') }}" alt="" class="img img-fluid pause d-none d-lg-block">
            <img src="{{ asset('assets/web/assets/img/home/play-mobile.png') }}" alt="" class="img img-fluid play d-block d-lg-none">
            <img src="{{ asset('assets/web/assets/img/home/pause-mobile.png') }}" alt="" class="img img-fluid pause d-block d-lg-none">
        </div>
    </div>

    <!-- slogan -->
    <div class="slogan text-center">
        <div class="content-wrapper m-auto">
            <p class="p2">
                {{ __('Hello Smile Hong Kong (HSHK) is dedicated to serving the local Hong Kong community to improve the oral health of the underserved community') }}
            </p>
            <h2 class="h2">
                {{ __('"Love, Compassion, Respect, and Integrity"') }}
            </h2>
        </div>
        <div class="slideshow d-flex align-items-center" id="slogan-slideshow">
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
        <a href="#" class="button p2 d-flex align-items-center btn-more m-auto mt-5">
            {{ __('Read More') }}
            <img src="{{ asset('assets/web/assets/img/home/right-arrow.png') }}" alt="" class="img img-fluid arrow">
        </a>
    </div>

    <!-- what we do -->
    <div id="what-we-do">
        <div class="what-wrapper m-auto">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <h1 class="h1">{{ __('What We Do.') }}</h1>
                <a href="#" class="button p2 d-none d-lg-flex align-items-center btn-more">
                    {{ __('Read More') }}
                    <img src="{{ asset('assets/web/assets/img/home/right-arrow.png') }}" alt="" class="img img-fluid arrow">
                </a>
            </div>
            <div class="row align-items-center justify-content-between mt-5 mt-lg-4">
                <div class="col-10 col-sm-8 col-lg-5 m-auto mb-5 mb-lg-0">
                    <div id="what-carousel">
                        <img src="{{ asset('assets/web/assets/img/home/what-we-do-1.png') }}" alt="" class="img img-fluid">
                        <img src="{{ asset('assets/web/assets/img/home/what-we-do-2.png') }}" alt="" class="img img-fluid">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="detail d-flex align-items-center">
                        <div class="img-wrapper">
                            <img src="{{ asset('assets/web/assets/img/home/education.png') }}" alt="" class="img img-fluid">
                        </div>
                        <div class="detail-content">
                            <h4 class="h4">{{ __('Public Education') }}</h4>
                            <p class="p2">
                                {{ __('Organizing educational trainings & disseminate educational information to health institutions or personnel, schools, general public') }}
                            </p>
                        </div>
                    </div>
                    <div class="detail d-flex align-items-center">
                        <div class="img-wrapper">
                            <img src="{{ asset('assets/web/assets/img/home/professional.png') }}" alt="" class="img img-fluid">
                        </div>
                        <div class="detail-content">
                            <h4 class="h4">{{ __('Professional Team') }}</h4>
                            <p class="p2">
                                {{ __('Providing qualified team at public events') }}
                            </p>
                        </div>
                    </div>
                    <div class="detail d-flex align-items-center">
                        <div class="img-wrapper">
                            <img src="{{ asset('assets/web/assets/img/home/dental.png') }}" alt="" class="img img-fluid">
                        </div>
                        <div class="detail-content">
                            <h4 class="h4">{{ __('Dental service for the persons with special needs') }}</h4>
                            <p class="p2">
                                {{ __('Providing dental service to persons with special needs') }}
                            </p>
                        </div>
                    </div>
                    <div class="detail d-flex align-items-center">
                        <div class="img-wrapper">
                            <img src="{{ asset('assets/web/assets/img/home/community.png') }}" alt="" class="img img-fluid">
                        </div>
                        <div class="detail-content">
                            <h4 class="h4">{{ __('Community Outreach') }}</h4>
                            <p class="p2">
                                {{ __('Provide dental care screenings, oral health education, dental treatments') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="button p2 d-flex d-lg-none align-items-center btn-more m-auto mt-3">
                        {{ __('Read More') }}
                        <img src="{{ asset('assets/web/assets/img/home/right-arrow.png') }}" alt="" class="img img-fluid arrow">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- news events -->
    <div id="news-event">
        <div class="row news-event-wrapper m-auto justify-content-between">
            <div class="col-12 col-lg-6 col-xl-7">
                <div class="title d-flex align-items-center justify-content-between">
                    <h1 class="h1">{{ __('News') }}</h1>
                    <a href="{{ route('web.event', ['type' => 'news']) }}" class="button p2 d-none d-lg-flex align-items-center btn-more">
                        {{ __('More') }}
                        <img src="{{ asset('assets/web/assets/img/home/right-arrow.png') }}" alt="" class="img img-fluid arrow">
                    </a>
                </div>
                <div class="news-list">
                    @foreach($news as $new)
                    <a href="{{ route('web.event_details', $new['slug']) }}" class="news-detail">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="img-wrapper">
                                    <img src="{{ $new['banner'] }}" alt="news-1" class="img img-fluid">
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <p class="p3">{{ $new['date']->format('Y/m/d') }}</p>
                                <h5 class="h5">
                                    {{ $new['name'] }}
                                </h5>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                <a href="#" class="button p2 d-flex d-lg-none align-items-center btn-more mt-5 m-auto">
                    {{ __('More') }}
                    <img src="{{ asset('assets/web/assets/img/home/right-arrow.png') }}" alt="" class="img img-fluid arrow">
                </a>
            </div>
            <div class="col-12 col-lg-5 col-xl-4 mt-5 mt-lg-0">
                <div class="title d-flex align-items-center justify-content-between">
                    <h1 class="h1">{{ __('Events') }}</h1>
                    <a href="{{ route('web.event', ['type' => 'event']) }}" class="button p2 d-none d-lg-flex align-items-center btn-more">
                        {{ __('More') }}
                        <img src="{{ asset('assets/web/assets/img/home/right-arrow.png') }}" alt="" class="img img-fluid arrow">
                    </a>
                </div>
                <div class="event-swiper" id="event-swiper">
                    <div class="swiper-wrapper">
                        @foreach($events as $event)
                        <div class="swiper-slide">
                            <a href="{{ route('web.event_details', $event['slug']) }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="img-wrapper d-flex justify-content-center">
                                        <img src="{{ $event['banner'] }}" alt="" class="img img-fluid event-img">
                                    </div>
                                    <p class="p3">{{ $event['date']->format('Y/m/d') }}</p>
                                    <h5 class="h5">{{ $event['name'] }}</h5>
                                    <div class="d-flex justify-content-end">
                                        <a class="event-arrow-wrapper" href="#">
                                            <img src="{{ asset('assets/web/assets/img/home/event-arrow.png') }}" alt="" class="img img-fluid event-arrow">
                                            <img src="{{ asset('assets/web/assets/img/home/event-arrow.png') }}" alt="" class="img img-fluid event-arrow-after">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="pagination-wrapper d-flex align-items-center justify-content-center">
                        <img src="{{ asset('assets/web/assets/img/home/event-left-inactive.png') }}" alt="" class="img img-fluid" id="event-left">
                        <div class="swiper-pagination p2"></div>
                        <img src="{{ asset('assets/web/assets/img/home/event-right.png') }}" alt="" class="img img-fluid" id="event-right">
                    </div>
                </div>
                <a href="#" class="button p2 d-flex d-lg-none align-items-center btn-more mt-5 m-auto">
                    {{ __('More') }}
                    <img src="{{ asset('assets/web/assets/img/home/right-arrow.png') }}" alt="" class="img img-fluid arrow">
                </a>
            </div>
        </div>
    </div>

    <!-- programme -->
     <div id="programme" class="programme">
        <div class="programme-wrapper m-auto">
            <h1 class="h1 text-lg-center">{{ __('Programme') }}</h1>
            <div class="card">
                <a href="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="img-wrapper overflow-hidden">
                                    <img src="{{ asset('assets/web/assets/img/home/programme-1.png') }}" alt="programme" class="img img-fluid">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="content-wrapper d-flex flex-column justify-content-between h-100 mt-3 mt-md-0">
                                    <div>
                                        <h3 class="h3">Healthy Teeth Collaboration</h3>
                                        <p class="p2">
                                            Aenean sed nisl quis nisl pulvinar porttitor dui nunc dapibus justo, quis ornare purus ante eget mi, Henean sed nisl quis nisl pulvinar 
                                            porttitor dui nunc dapibus justo, quis ornare purus ante egetmi. Enean sed nisl quiorttitor dui nunc dapibus justo, quis ornare purus ante eget mi
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="event-arrow-wrapper">
                                            <img src="{{ asset('assets/web/assets/img/home/event-arrow.png') }}" alt="" class="img img-fluid event-arrow">
                                            <img src="{{ asset('assets/web/assets/img/home/event-arrow.png') }}" alt="" class="img img-fluid event-arrow-after">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
     </div>
</div>
@endsection

@push('scripts')
<script>
    const swiper = new Swiper('.swiper', {
        loop: true,
        // autoplay: { delay: 3000 },
        speed: 3000,
        effect: "fade",
        fadeEffect: {
            crossFade: true
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    $('.play').click(function() {
        swiper.autoplay.start();
        console.log('play');
    })

    $('.pause').click(function() {
        swiper.autoplay.stop();
        console.log('pause');
    })

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
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });

    $('#what-carousel').slick({
        autoplay: true,
        fade: true,
        speed: 1000,
    });

    var eventSwiper = new Swiper("#event-swiper", {
        navigation:{
            nextEl: "#event-right",
            prevEl: "#event-left",
        },
        spaceBetween: 30,
        effect: "creative",
        creativeEffect: {
            prev: {
                // translate: [0, 0, -400],
                // scale: 1.3,
                opacity: 0,
            },
            next: {
                opacity: 1,
                translate: ["100%", 0, 0],
            },
        },
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
            clickable: true,
            renderBullet: function (index, className) {
                return '<span class="' + className + '">' + (index + 1) + "</span>";
            },
        },
        on: {
            slideChange: function () {
                var swiper = this;
                var activeIndex = swiper.realIndex;

                if (activeIndex === 0) {
                    $('#event-left').attr('src', "{{ asset('assets/web/assets/img/home/event-left-inactive.png') }}");
                } else {
                    $('#event-left').attr('src', "{{ asset('assets/web/assets/img/home/event-left.png') }}");
                }

                if (activeIndex == swiper.slides.length - 1) {
                    $('#event-right').attr('src', "{{ asset('assets/web/assets/img/home/event-right-inactive.png') }}");
                } else {
                    $('#event-right').attr('src', "{{ asset('assets/web/assets/img/home/event-right.png') }}");
                }
            },
        }
     });
</script>
@endpush