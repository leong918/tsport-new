@extends('web.layout.app')
@section('content')
<section id="about-contact" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{$setting_model['contact_banner']}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">Contact</div>
            <div class="nav-acc"><a href="{{route('web.home')}}">Home</a> > <a href="{{route('about.index')}}"> About</a> > <a href="{{route('about.contact')}}"> Contact</a></div>
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
                            {{ $setting_model['tel_no'] }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mg-btm-20">
                    <div class="contact-info-sub">
                        <img src="{{asset('assets/web/assets/img/about_contact/whatsapp.png')}}" alt="">
                        <div class="details">
                            <p>WhatsApp</p>
                            {{ $setting_model['whatsapp_no'] }}
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
                            {{ $setting_model['contact_email'] }}
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
                            {!! $setting_model['contact_address'] !!}
                        </div>
                    </div>
                    <div class="hrs">
                        <div class="hrs-title">
                            Open Hour
                        </div>
                        <div class="hrs-hrs">
                            {{ $setting_model['open_hour'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-content col-12 col-lg-9">
                {!! $setting_model['map_url'] !!}
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@endpush