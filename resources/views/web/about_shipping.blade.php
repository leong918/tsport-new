@extends('web.layout.app')
@section('content')
<section id="about-shipping" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{$setting_model['shipping_banner']}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">Shipping Info</div>
            <div class="nav-acc"><a href="{{route('web.home')}}">Home</a> > <a href="{{route('about.index')}}"> About</a> > <a href="{{route('about.shipping')}}"> Shipping Info</a></div>
        </div>
    </div>
    <div class="tnc">
        <div class="container">
            <div class="tnc-para">
                {!! $setting_model['cn_shipping_info'] !!}
            </div>
            <div class="tnc-para-eng">
                {!! $setting_model['en_shipping_info'] !!}
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@endpush