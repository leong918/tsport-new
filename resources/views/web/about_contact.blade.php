@extends('web.layout.app')
@section('content')
<section id="about-contact" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{asset('assets/web/assets/img/about_contact/bg.png')}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">Contact</div>
            <div class="nav-acc"><a href="#">Home</a> > <a href="#"> About</a> > <a href="#"> Contact</a></div>
        </div>
    </div>
    <div class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12 mg-btm-20">
                    <div class="contact-info-sub">
                        <img src="{{asset('assets/web/assets/img/about_contact/phone.png')}}" alt="">
                        <div class="details">
                            <p>Tel</p>
                            3907 0151
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mg-btm-20">
                    <div class="contact-info-sub">
                        <img src="{{asset('assets/web/assets/img/about_contact/whatsapp.png')}}" alt="">
                        <div class="details">
                            <p>WhatsApp</p>
                            (+852) 5442 5298
                        </div>
                    </div>
                    <div class="bottom-note">
                        For general inquiries
                    </div>
                </div>
                <div class="col-lg-4 col-12 mg-btm-20">
                    <div class="contact-info-sub">
                        <img src="{{asset('assets/web/assets/img/about_contact/email.png')}}" alt="">
                        <div class="details">
                            <p>Email</p>
                            tcdistributorship@gmail.com
                        </div>
                    </div>
                    <div class="bottom-note">
                        Please contact us by email if you are a brand and interested in partnering with us
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="addr-map-wrapper row">
            <div class="left-content col-12 col-lg-3">
                <div class="title-contact-visit">
                    Come Visit Us
                </div>
                <div class="left-addr-n-hrs">
                    <img src="{{asset('assets/web/assets/img/about_contact/location.png')}}" alt="">
                    <div class="addr">
                        <div class="addr-title">
                            Address
                        </div>
                        <div class="addr-addr">
                            Workshop D 1 11/F, Hop Hing Industrial
                            Building, 704 Castle Peak ROad, Lai Chi Kok,
                            Kowloon
                        </div>
                    </div>
                    <div class="hrs">
                        <div class="hrs-title">
                            Open Hour
                        </div>
                        <div class="hrs-hrs">
                            13:00 -20:00
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-content col-12 col-lg-9">
                <img src="{{asset('assets/web/assets/img/about_contact/map.png')}}" alt="">
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@endpush