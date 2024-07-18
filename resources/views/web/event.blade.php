@extends('web.layout.app')
@section('content')
<div id="event">
    <div class="section-header">
        <div class="row gx-0 header-row">
            <div class="col-12 col-md-5 banner-background">
                <div class="title">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item p4"><a href="{{ route('web.home') }}">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active p4" aria-current="page">{{ __('News & Events') }}</li>
                        </ol>
                    </nav>
                    <h2 class="h2">
                        {{ __('News & Events') }}
                    </h2>
                </div>
            </div>
            <div class="col-12 col-md-7 d-none d-md-block">
                <img src="{{ asset('assets/web/assets/img/event/banner.png') }}" alt="" class="img img-fluid banner-img h-100">
            </div>
        </div>
    </div>
    <div class="content-section">
        <div class="container">
            <div class="event-category-tab-container">
                <ul class="event-category-tab">
                    <li>
                        <a href="#" class="active">{{ __('All') }}</a>
                    </li>
                    <li>
                        <a href="#">{{ __('News') }}</a>
                    </li>
                    <li>
                        <a href="#">{{ __('Events') }}</a>
                    </li>
                </ul>
            </div>
            <div class="row event-list-container">
                <div class="col-lg-4 col-sm-12 event-container">
                    <a href="{{ route('web.event_details') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="img-wrapper d-flex justify-content-center">
                                    <img src="{{ asset('assets/web/assets/img/event/post-img-1.png') }}" alt="" class="img img-fluid event-img">
                                </div>
                                <p class="p3">2023/11/03</p>
                                <h5 class="h5">Hello Smile HK x ChickenSoup Foundation</h5>
                                <div class="d-flex justify-content-end">
                                    <a class="event-arrow-wrapper" href="#">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow-after">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-12 event-container">
                    <a href="{{ route('web.event_details') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="img-wrapper d-flex justify-content-center">
                                    <img src="{{ asset('assets/web/assets/img/event/post-img-1.png') }}" alt="" class="img img-fluid event-img">
                                </div>
                                <p class="p3">2023/11/03</p>
                                <h5 class="h5">Hello Smile HK x ChickenSoup Foundation</h5>
                                <div class="d-flex justify-content-end">
                                    <a class="event-arrow-wrapper" href="#">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow-after">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-12 event-container">
                    <a href="{{ route('web.event_details') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="img-wrapper d-flex justify-content-center">
                                    <img src="{{ asset('assets/web/assets/img/event/post-img-1.png') }}" alt="" class="img img-fluid event-img">
                                </div>
                                <p class="p3">2023/11/03</p>
                                <h5 class="h5">Hello Smile HK x ChickenSoup Foundation</h5>
                                <div class="d-flex justify-content-end">
                                    <a class="event-arrow-wrapper" href="#">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow-after">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-12 event-container">
                    <a href="{{ route('web.event_details') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="img-wrapper d-flex justify-content-center">
                                    <img src="{{ asset('assets/web/assets/img/event/post-img-1.png') }}" alt="" class="img img-fluid event-img">
                                </div>
                                <p class="p3">2023/11/03</p>
                                <h5 class="h5">Hello Smile HK x ChickenSoup Foundation</h5>
                                <div class="d-flex justify-content-end">
                                    <a class="event-arrow-wrapper" href="#">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow-after">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-12 event-container">
                    <a href="{{ route('web.event_details') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="img-wrapper d-flex justify-content-center">
                                    <img src="{{ asset('assets/web/assets/img/event/post-img-1.png') }}" alt="" class="img img-fluid event-img">
                                </div>
                                <p class="p3">2023/11/03</p>
                                <h5 class="h5">Hello Smile HK x ChickenSoup Foundation</h5>
                                <div class="d-flex justify-content-end">
                                    <a class="event-arrow-wrapper" href="#">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow-after">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-12 event-container">
                    <a href="{{ route('web.event_details') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="img-wrapper d-flex justify-content-center">
                                    <img src="{{ asset('assets/web/assets/img/event/post-img-1.png') }}" alt="" class="img img-fluid event-img">
                                </div>
                                <p class="p3">2023/11/03</p>
                                <h5 class="h5">Hello Smile HK x ChickenSoup Foundation</h5>
                                <div class="d-flex justify-content-end">
                                    <a class="event-arrow-wrapper" href="#">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow-after">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-12 event-container">
                    <a href="{{ route('web.event_details') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="img-wrapper d-flex justify-content-center">
                                    <img src="{{ asset('assets/web/assets/img/event/post-img-1.png') }}" alt="" class="img img-fluid event-img">
                                </div>
                                <p class="p3">2023/11/03</p>
                                <h5 class="h5">Hello Smile HK x ChickenSoup Foundation</h5>
                                <div class="d-flex justify-content-end">
                                    <a class="event-arrow-wrapper" href="#">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow-after">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-12 event-container">
                    <a href="{{ route('web.event_details') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="img-wrapper d-flex justify-content-center">
                                    <img src="{{ asset('assets/web/assets/img/event/post-img-1.png') }}" alt="" class="img img-fluid event-img">
                                </div>
                                <p class="p3">2023/11/03</p>
                                <h5 class="h5">Hello Smile HK x ChickenSoup Foundation</h5>
                                <div class="d-flex justify-content-end">
                                    <a class="event-arrow-wrapper" href="#">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow-after">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-12 event-container">
                    <a href="{{ route('web.event_details') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="img-wrapper d-flex justify-content-center">
                                    <img src="{{ asset('assets/web/assets/img/event/post-img-1.png') }}" alt="" class="img img-fluid event-img">
                                </div>
                                <p class="p3">2023/11/03</p>
                                <h5 class="h5">Hello Smile HK x ChickenSoup Foundation</h5>
                                <div class="d-flex justify-content-end">
                                    <a class="event-arrow-wrapper" href="#">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow">
                                        <img src="{{ asset('assets/web/assets/img/event/event-arrow.png') }}" alt="" class="img img-fluid event-arrow-after">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="pagination-container">
                <img src="{{ asset('assets/web/assets/img/event/pagination-prev-inactive.png') }}" alt="" class="img img-fluid" id="event-prev">
                <ul>
                    <li>
                        <a href="#" class="active">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                </ul>
                <img src="{{ asset('assets/web/assets/img/event/pagination-next-active.png') }}" alt="" class="img img-fluid" id="event-next">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    
</script>
@endpush