@extends('web.layout.app')
@section('content')
<div id="blog">
    <div class="section-header">
        <div class="row gx-0 header-row">
            <div class="col-12 col-md-5 banner-background">
                <div class="title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item p4"><a href="/">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item p4"><a href="/blog">{{ __('Blog') }}</a></li>
                        </ol>
                    </nav>
                    <h2 class="h2">
                        {{ __('Blog') }}
                    </h2>
                </div>
            </div>
            <div class="col-12 col-md-7 d-none d-md-block">
                <img src="{{ asset('assets/web/assets/img/about-us/banner.png') }}" alt=""
                    class="img img-fluid banner-img h-100">
            </div>
        </div>
    </div>
    <div class="content-section">
        @if(count($knowledges) != 0)
        <div class="d-flex justify-content-center">
            <h3 class="h3">{{ __('Dental Knowledge') }}</h3>
        </div>
        <div id="knowledge-blog">
            <div class="knowledge-blog-wrapper m-auto">
                <div class="knowledge-swiper" id="knowledge-swiper">
                    <div class="swiper-wrapper">
                        @foreach($knowledges as $knowledge)
                        <div class="swiper-slide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="img-wrapper d-flex justify-content-center">
                                        <img src="{{ $knowledge->image }}" alt="" class="img img-fluid blog-img">
                                    </div>
                                    <p class="p3">{{ $knowledge->publishedDate() }}</p>
                                    <h5 class="h5 card_desc">{{ $knowledge->getParameters(app()->getLocale(),
                                        'name') }}</h5>
                                    <div class="d-flex justify-content-end">
                                        <a class="blog-arrow-wrapper"
                                            href="{{ route('web.blog_details', $knowledge->id)}}">
                                            <img src="{{ asset('assets/web/assets/img/home/event-arrow.png') }}" alt=""
                                                class="img img-fluid blog-arrow">
                                            <img src="{{ asset('assets/web/assets/img/home/event-arrow.png') }}" alt=""
                                                class="img img-fluid blog-arrow-after">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row m-auto d-flex align-items-center">
                        <div class="col-md-12 col-xl-3 col-lg-3">
                            <div class="pagination-wrapper d-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/web/assets/img/home/event-left-inactive.png') }}" alt=""
                                    class="img img-fluid" id="blog-left">
                                <div class="swiper-pagination p2"></div>
                                <img src="{{ asset('assets/web/assets/img/home/event-right.png') }}" alt=""
                                    class="img img-fluid" id="blog-right">
                            </div>
                        </div>
                        <div class="col-md-0 col-xl-9 col-lg-9">
                            <div class="scrollbar-wrapper">
                                <div class="swiper-scrollbar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(count($interviews) != 0)
        <div id="interviews-blog" class="interviews-blog">
            <div class="row interviews-blog-wrapper m-auto justify-content-center d-flex">
                <div class="d-flex justify-content-center">
                    <h3 class="h3">{{ __('Interviews') }}</h3>
                </div>
                <div class="col-12 col-lg-6 col-xl-5 mt-lg-0">
                    <div class="interview-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="img-wrapper d-flex justify-content-center">
                                    <img src="{{ $first_interview->image }}" alt="" class="img img-fluid blog-img">
                                </div>
                                <p class="p3">{{ $first_interview->publishedDate() }}</p>
                                <h5 class="h5 card-desc">{{ $first_interview->getParameters(app()->getLocale(),
                                    'name') }}</h5>
                                <div class="d-flex justify-content-end">
                                    <a class="blog-arrow-wrapper"
                                        href="{{ route('web.blog_details', $first_interview->id)}}">
                                        <img src="{{ asset('assets/web/assets/img/blog/blog-arrow.png') }}" alt=""
                                            class="img img-fluid blog-arrow">
                                        <img src="{{ asset('assets/web/assets/img/blog/blog-arrow.png') }}" alt=""
                                            class="img img-fluid blog-arrow-after">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="d-flex blog-list-wrapper">
                        <div class="blog-list">
                            @foreach($interviews as $interview)
                            <a href="{{ route('web.blog_details', $interview->id)}}" class="blog-detail">
                                <div class="row d-flex">
                                    <div class="col-5 col-md-4">
                                        <div class="img-wrapper">
                                            <img src="{{ $interview->image }}" alt="" class="img img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <p class="p3">{{ $interview->publishedDate() }}</p>
                                        <h5 class="h5">
                                            {{ $interview->getParameters(app()->getLocale(), 'name')}}
                                        </h5>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
        var knowledgeSwiper = new Swiper("#knowledge-swiper", {
        navigation:{
            nextEl: "#blog-right",
            prevEl: "#blog-left",
        },
        freeMode: true,
        slidesPerView: 1,
        spaceBetween: 10,
        scrollbar: {
            el: ".swiper-scrollbar",
            hide: false,
            dragSize: 200,
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
                    $('#blog-left').attr('src', "{{ asset('assets/web/assets/img/home/event-left-inactive.png') }}");
                } else {
                    $('#blog-left').attr('src', "{{ asset('assets/web/assets/img/home/event-left.png') }}");
                }

                if (activeIndex == swiper.slides.length - 1) {
                    $('#blog-right').attr('src', "{{ asset('assets/web/assets/img/home/event-right-inactive.png') }}");
                } else {
                    $('#blog-right').attr('src', "{{ asset('assets/web/assets/img/home/event-right.png') }}");
                }
            },
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 10
            }
        }
     });

     $(document).ready(function() {
    // Function to adjust heights
    function adjustHeights() {
        var cardHeight = $('.interview-card').outerHeight();
        $('.blog-list-wrapper').css({
            'max-height': cardHeight + 'px',
            'overflow-y': 'auto' 
        });
    }

    adjustHeights();
    $(window).resize(adjustHeights); 
});

    </script>
    @endpush