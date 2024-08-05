@extends('web.layout.app')
@section('content')
<div id="our-partner">
    <!-- header -->
    <div class="section-header">
        <div class="row gx-0 header-row">
            <div class="col-12 col-md-6 col-lg-5  banner-background">
                <div class="title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item p4"><a href="/">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item p4">{{ __('Who we are') }}</li>
                            <li class="breadcrumb-item active p4" aria-current="page">{{ __('Our Partner') }}</li>
                        </ol>
                    </nav>
                    <h2 class="h2">
                        {!! __('Our Partner') !!}
                    </h2>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-7 d-none d-md-block">
                <img src="{{ asset('assets/web/assets/img/our-partner/banner.png') }}" alt="" class="img img-fluid banner-img h-100 w-100">
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="content-section">
        <div class="row content-wrapper w-100 justify-content-center align-items-center m-auto">
            <div class="d-xs-none d-sm-none d-md-none d-lg-block col-lg-1 col-xxl-1"></div>
            <div class="col-12 col-md-5 col-lg-3 col-xxl-3 mb-5 d-flex justify-content-center">
                <img src="{{ asset('assets/web/assets/img/our-partner/soco.png') }}" alt="" class="img img-fluid soco">
            </div>
            <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xxl-3 mt-5 mb-5 mt-md-0 d-flex justify-content-center">
                <img src="{{ asset('assets/web/assets/img/our-partner/chicken-soup.png') }}" alt="" class="img img-fluid chicken-soup">
            </div>
            <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xxl-3 mt-5 mb-5 mt-md-0 d-flex justify-content-center">
                <img src="{{ asset('assets/web/assets/img/our-partner/heep-hong.png') }}" alt="" class="img img-fluid chicken-soup">
            </div>
            <div class="d-xs-none d-sm-none d-md-none d-lg-block col-lg-1 col-xxl-1"></div>
            <div class="d-xs-none d-sm-none d-md-none d-lg-block col-lg-1 col-xxl-1"></div>
            <div class="col-12 col-sm-8 col-md-5 col-lg-2 col-xxl-2 mt-5 mb-5 mt-md-0 d-flex justify-content-center">
                <img src="{{ asset('assets/web/assets/img/our-partner/nda.png') }}" alt="" class="img img-fluid chicken-soup">
            </div>
            <div class="col-12 col-sm-8 col-md-5 col-lg-2 col-xxl-2 mt-5 mb-5 mt-md-0 d-flex justify-content-center">
                <img src="{{ asset('assets/web/assets/img/our-partner/children.png') }}" alt="" class="img img-fluid soco">
            </div>
            <div class="col-12 col-sm-8 col-md-5 col-lg-2 col-xxl-2 mt-5 mb-5 mt-md-0 d-flex justify-content-center">
                <img src="{{ asset('assets/web/assets/img/our-partner/faith_in_love.png') }}" alt="" class="img img-fluid soco">
            </div>
            <div class="d-xs-none d-sm-none d-md-none d-lg-block col-lg-1 col-xxl-1"></div>
        </div>
    </div>
</div>
@endsection