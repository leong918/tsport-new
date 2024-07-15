
@php
    $locales = [
        'en' => 'EN',
        'sc' => '简',
        'tc' => '繁'
    ];
    unset($locales[LaravelLocalization::getCurrentLocale()]);
@endphp

<div id="header">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="">
                    <a class="navbar-brand d-flex align-items-center" href="/">
                        <img src="{{asset('assets/web/assets/img/header/logo.png')}}" alt="hellosmile" class="img img-fluid d-none d-lg-block">
                        <img src="{{asset('assets/web/assets/img/header/logo-mobile.png')}}" alt="hellosmile" class="img img-fluid d-block d-lg-none">
                    </a>
                </div>
                <div class="">
                    <button class="navbar-toggler" type="button">
                        <img src="{{asset('assets/web/assets/img/header/hamburger.png')}}" alt="hellosmile" class="img img-fluid">
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 p3 align-items-center">
                            <li class="nav-item dropdown" id="about-dropdown">
                                <a class="nav-link" href="#">
                                    {{ __('Who we are') }}
                                </a>
                                <div class="dropdown-menu-wrapper">
                                    <ul class="dropdown-menu p3" id="about-menu">
                                        <li><a class="dropdown-item" href="{{ route('web.about-us') }}">{{ __('About Us') }}</a></li>
                                        <li><a class="dropdown-item" href="#">{{ __('Mission, Vision, Value') }}</a></li>
                                        <li><a class="dropdown-item" href="#">{{ __('Founder & Committee Members') }}</a></li>
                                        <li><a class="dropdown-item" href="#">{{ __('Our Partners') }}</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{ __('What do we do') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{ __('News & Events') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="programDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('Programme') }}
                                </a>
                                <div class="dropdown-menu-wrapper">
                                    <ul class="dropdown-menu p3" aria-labelledby="programDropdown">
                                        <li><a class="dropdown-item" href="#">{{ __('Healthy Teeth Collaboration') }}</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{ __('Blog') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{ __('Contact Us') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-uppercase" href="#">
                                    {{ LaravelLocalization::getCurrentLocaleNative() }}
                                </a>
                                <div class="dropdown-menu-wrapper">
                                    <ul class="dropdown-menu p3">
                                        @foreach($locales as $locale => $label)
                                            <li><a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}">{{ $label }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <img src="{{ asset('assets/web/assets/img/header/search.png') }}" alt="" class="img img-fluid search-icon">
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- mobile-nav -->
    <div id="mobileNav" class="mobile-nav">
        <div class="mobile-nav-content">
            <div class="text-end">
                <i id="mobile-nav-close" class="fa-solid fa-xmark"></i>
            </div>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 p3 align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('About Us') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('What do we do') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('News & Events') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Programme') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Blog') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Contact Us') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-uppercase" href="#">
                        {{ LaravelLocalization::getCurrentLocale() }}
                    </a>
                    <div class="dropdown-menu-wrapper">
                        <ul class="dropdown-menu p3">
                            @foreach($locales as $locale => $label)
                                <li><a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}">{{ $label }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="{{ asset('assets/web/assets/img/header/search.png') }}" alt="" class="img img-fluid search-icon">
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('.dropdown').hover(function() {
        $(this).find('.nav-link').addClass('active');
    }, function() {
        $(this).find('.nav-link').removeClass('active');
    });

    $('.navbar-toggler').click(function (e) {
        e.stopPropagation();
        $('#mobileNav').toggleClass('show');
    });

    $('#mobile-nav-close').click(function(e) {
        e.stopPropagation();
        $('#mobileNav').removeClass('show');
    });
</script>
@endpush