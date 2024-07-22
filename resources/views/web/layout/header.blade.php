
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
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav" aria-expanded="false" aria-controls="mobileNav">
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
                                        <li><a class="dropdown-item" href="{{ route('web.mission') }}">{{ __('Mission, Vision, Value') }}</a></li>
                                        <li><a class="dropdown-item" href="{{ route('web.founder') }}">{{ __('Founder & Committee Members') }}</a></li>
                                        <li><a class="dropdown-item" href="{{ route('web.our-partner') }}">{{ __('Our Partners') }}</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('web.what-do-we-do') }}">{{ __('What do we do') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('web.event') }}">{{ __('News & Events') }}</a>
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
                                <a class="nav-link" href="{{ route('web.contact-us') }}">{{ __('Contact Us') }}</a>
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
    <div id="mobileNav" class="collapse mobile-nav">
        <div class="mobile-nav-content">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 h5">
                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between" data-bs-toggle="collapse" href="#collapse-who" role="button" aria-expanded="false" aria-controls="collapse-who">
                        {{ __('Who we are') }}
                        <span class="arrow ms-2">
                            <img src="{{ asset('assets/web/assets/img/header/arrow-down.png') }}" alt="" class="img img-fluid arrow-down">
                        </span>
                    </a>
                    <div class="collapse" id="collapse-who">
                        <ul class="list-group">
                            <li class="list-item"><a class="p2" href="{{ route('web.about-us') }}">{{ __('About Us') }}</a></li>
                            <li class="list-item"><a class="p2" href="{{ route('web.mission') }}">{{ __('Mission, Vision, Value') }}</a></li>
                            <li class="list-item"><a class="p2" href="{{ route('web.founder') }}">{{ __('Founder & Committee Members') }}</a></li>
                            <li class="list-item"><a class="p2" href="{{ route('web.our-partner') }}">{{ __('Our Partners') }}</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.what-do-we-do') }}">{{ __('What do we do') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.event') }}">{{ __('News & Events') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between" data-bs-toggle="collapse" href="#collapse-programme" role="button" aria-expanded="false" aria-controls="collapse-programme">
                        {{ __('Programme') }}
                        <span class="arrow ms-2">
                            <img src="{{ asset('assets/web/assets/img/header/arrow-down.png') }}" alt="" class="img img-fluid arrow-down">
                        </span>
                    </a>
                    <div class="collapse" id="collapse-programme">
                        <ul class="list-group">
                            <li class="list-item"><a class="p2" href="#">{{ __('Healthy Teeth Collaboration') }}</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Blog') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.contact-us') }}">{{ __('Contact Us') }}</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="{{ asset('assets/web/assets/img/header/search.png') }}" alt="" class="img img-fluid search-icon">
                    </a>
                </li> --}}
            </ul>
            <ul class="navbar-nav language-nav flex-row mb-0">
                @foreach($locales as $locale => $label)
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}">
                            {{ $label }}
                        </a>
                    </li>
                @endforeach
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

    $('#mobileNav').on('show.bs.collapse', function(e) {
        $('body').css('overflow', 'hidden');
    })

    $('#mobileNav').on('hide.bs.collapse', function(e) {
        $('body').css('overflow', '');
    })

    $('#collapse-who').on('show.bs.collapse', function () {
        $(this).siblings().find('.arrow-down').removeClass('down').addClass('up');
    });

    $('#collapse-who').on('hide.bs.collapse', function () {
        $(this).siblings().find('.arrow-down').removeClass('up').addClass('down');
    });

    $('#collapse-programme').on('show.bs.collapse', function () {
        $(this).siblings().find('.arrow-down').removeClass('down').addClass('up');
    });

    $('#collapse-programme').on('hide.bs.collapse', function () {
        $(this).siblings().find('.arrow-down').removeClass('up').addClass('down');
    });
</script>
@endpush