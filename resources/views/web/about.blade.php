@extends('web.layout.app')
@section('content')
<section id="about" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{asset('assets/web/assets/img/about/about_bg.png')}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">About</div>
            <div class="nav-acc"><a href="#">Home</a> > <a href="#"> About</a></div>
        </div>
    </div>
    <div class="about-content">
        <div class="container">
            <div class="row row-about-content">
                <div class="col-lg-6 col-12 left-content-wrap">
                    <div class="left-content">
                        <div class="left-chinese">
                            <p>引進成分高效 、純淨的全天然品牌</p>
                            <p>無毒 、無害、 無動物測試是我們對產品的堅持</p>
                        </div>
                        <div class="left-eng">
                            <p>We are TAG Concept, a natural skincare shop purchasing you high quality and out-standing performance products from our dearest worldwide partnering brands</p>
                        </div>
                        <div class="bottom-social">
                            <div class="fb">
                                <img src="{{asset('assets/web/assets/img/about/fb.png')}}" alt="">
                                <a href="http://www.facebook.com/tagconcept"><span>http://www.facebook.com/tagconcept</span></a>
                            </div>
                            <div class="ig">
                                <img src="{{asset('assets/web/assets/img/about/ig.png')}}" alt="">
                                <a href="https://www.instagram.com/tagconcept/?hl=en"><span>@tagconcept</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="right-content">
                        <img src="{{asset('assets/web/assets/img/about/img.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@endpush