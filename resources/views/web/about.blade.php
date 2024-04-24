@extends('web.layout.app')
@section('content')
<section id="about" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{$setting_model['about_banner']}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">About</div>
            <div class="nav-acc"><a href="{{route('web.home')}}">Home</a> > <a href="{{route('about.index')}}"> About</a></div>
        </div>
    </div>
    <div class="about-content">
        <div class="container">
            <div class="row row-about-content">
                <div class="col-lg-6 col-12 left-content-wrap">
                    <div class="left-content">
                        <div class="left-chinese mb-5">
                            <p>{!! $setting_model['about_content'] !!}</p>
                        </div>
                        <div class="bottom-social">
                            <div class="fb">
                                <img src="{{asset('assets/web/assets/img/about/fb.png')}}" alt="">
                                <a href="{{$setting_model['facebook_url']}}"><span>{{ $setting_model['facebook_text'] }}</span></a>
                            </div>
                            <div class="ig">
                                <img src="{{asset('assets/web/assets/img/about/ig.png')}}" alt="">
                                <a href="{{$setting_model['instagram_url']}}"><span>{{ $setting_model['instagram_text'] }}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="right-content">
                        <img src="{{$setting_model['about_right_image']}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@endpush