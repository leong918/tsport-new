@extends('web.layout.app')
@section('content')
<section id="about-membership" class="margin-header">
    <div class="top-section-wrapper">
        <div class="top-banner">
            <img src="{{$setting_model['membership_banner']}}" alt="">
        </div>
        <div class="title-and-nav text-center">
            <div class="forgot-password-title">Membership</div>
            <div class="nav-acc"><a href="{{route('web.home')}}">Home</a> > <a href="{{route('about.index')}}"> About</a> > <a href="{{route('about.membership')}}"> Membership</a></div>
        </div>
    </div>
    <div class="about-content">
        <div class="container">
            <div class="row row-about-content">
                <div class="col-12">
                    <div class="text-center title-about-membership">
                        會員制度<br/>
                        Tag Concept Membership
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="member-type">
                        <span>Just Member</span>
                    </div>
                    <div class="member-type-detail">
                        <p>{!! $setting_model['just_member_content'] !!}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="member-type">
                        <span>Insider</span>
                    </div>
                    <div class="member-type-detail">
                        <p>{!! $setting_model['insider_content'] !!}</p>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                <div class="member-type">
                        <span>Core</span>
                    </div>
                    <div class="member-type-detail">
                        <p>{!! $setting_model['core_content'] !!} </p>
                    </div>
                </div>
            </div>
            <div class="desc-bottom">
                <p>{!! $setting_model['remark_content'] !!}</p>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@endpush