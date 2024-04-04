@extends('web.layout.app')
@section('content')
<section id="about-tnc" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{$setting_model['tnc_banner']}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">Terms & Conditions</div>
            <div class="nav-acc"><a href="{{route('web.home')}}">Home</a> > <a href="{{route('about.index')}}"> About</a> > <a href="{{route('about.tnc')}}"> Terms & Conditions</a></div>
        </div>
    </div>
    <div class="tnc">
        <div class="container">
            <div class="tnc-para">
                {!! $setting_model['cn_tnc'] !!}
            </div>
            <div class="tnc-para-eng">
                {!! $setting_model['en_tnc'] !!}
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@endpush