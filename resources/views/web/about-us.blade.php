@extends('web.layout.app')
@section('content')
<div id="about-us">
    <div class="section-header">
        <div class="row gx-0 header-row">
            <div class="col-12 col-md-5 banner-background">
                <div class="title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item p4"><a href="/">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item p4">{{ __('Who we are') }}</li>
                            <li class="breadcrumb-item active p4" aria-current="page">{{ __('About Us') }}</li>
                        </ol>
                    </nav>
                    <h2 class="h2">
                        {{ __('About Us') }}
                    </h2>
                </div>
            </div>
            <div class="col-12 col-md-7 d-none d-md-block">
                <img src="{{ asset('assets/web/assets/img/about-us/banner.png') }}" alt="" class="img img-fluid banner-img h-100">
            </div>
        </div>
    </div>
    <div class="content-section">
        <div class="content-top m-auto">
            <div class="row d-flex align-items-center justify-content-between w-100">
                <div class="col-12 col-md-6 col-lg-5">
                    <div id="about-carousel">
                        <img src="{{ asset('assets/web/assets/img/about-us/1.png') }}" alt="" class="img img-fluid carousel-img">
                        <img src="{{ asset('assets/web/assets/img/about-us/2.png') }}" alt="" class="img img-fluid carousel-img">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="content-wrapper m-auto mt-5 mt-md-0">
                        <h3 class="h3">{{ __('“The mouth is the mirror of your health”.') }}</h3>
                        <p class="p2">
                            {!! __('A healthy body starts with a healthy set of teeth, especially for young children and children with special health care needs') !!}
                            <br/>
                            <br/>
                            {!! __('We believe oral health is the foundation of wellbeing and happiness. An effort made for the happiness of others lifts above us. Not everyone can do great things but we can all do small things with great love.') !!}
                        </p>
                        <div class="row">
                            <div class="col-5 stats">
                                <h2 class="h2">50%</h2>
                                <p class="p2">
                                    {{ __('of children had suffered from tooth decay by the age of 5.') }}
                                </p>
                            </div>
                            <div class="col-5 stats">
                                <h2 class="h2">81.2%</h2>
                                <p class="p2">
                                    {{ __('of all teeth that experienced decay.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-bottom">
            <div class="row d-flex align-items-center w-100">
                <div class="col-12 col-md-8 order-2 order-md-1">
                    <div class="content-wrapper">
                        <p class="p2">
                            {{ __('Irene returned to her hometown, Hong Kong, in 2011, after practicing in the United States as a pediatric dentist for a few years where she mainly served the underprivileged communities and children with special healthcare needs') }}
                        </p>
                        <p class="p2">
                            {{ __('After some years of talks and planning, Irene and Richard started their own journey in founding a non-profit organization,') }}
                            <br/><br/>
                            {{ __('We believe oral health is the foundation of wellbeing and happiness. An effort made for the happiness of others lifts above us.') }}
                        </p>
                        <h3 class="h3">
                            {{ __('Not everyone can do great things but we can all do small things with great love.') }}
                        </h3>
                    </div>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-center order-1 order-md-2">
                    <img src="{{ asset('assets/web/assets/img/about-us/about-3.png') }}" alt="" class="img img-fluid hand-img">
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
</script>
@endpush