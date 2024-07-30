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
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 d-flex justify-content-center">
                <img src="{{ asset('assets/web/assets/img/our-partner/soco.png') }}" alt="" class="img img-fluid soco">
            </div>
            <div class="col-9 col-sm-8 col-md-5 col-lg-4 col-xxl-3 mt-5 mt-md-0 d-flex justify-content-center">
                <img src="{{ asset('assets/web/assets/img/our-partner/chicken-soup.png') }}" alt="" class="img img-fluid chicken-soup">
            </div>
        </div>
    </div>
</div>
@endsection