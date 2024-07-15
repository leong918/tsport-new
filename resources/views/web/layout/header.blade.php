
@php
    $locales = [
        'en' => 'EN',
        'zh_CN' => '简',
        'zh_TW' => '繁'
    ];
    unset($locales[app()->getLocale()]);
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
                                    {{ __('page.Who we are') }}
                                </a>
                                <div class="dropdown-menu-wrapper">
                                    <ul class="dropdown-menu p3" id="about-menu">
                                        <li><a class="dropdown-item" href="{{ route('web.about-us') }}">{{ __('page.About Us') }}</a></li>
                                        <li><a class="dropdown-item" href="#">{{ __('page.Mission, Vision, Value') }}</a></li>
                                        <li><a class="dropdown-item" href="#">{{ __('page.Founder & Committee Members') }}</a></li>
                                        <li><a class="dropdown-item" href="#">{{ __('page.Our Partners') }}</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{ __('page.What do we do') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{ __('page.News & Events') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="programDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('page.Programme') }}
                                </a>
                                <div class="dropdown-menu-wrapper">
                                    <ul class="dropdown-menu p3" aria-labelledby="programDropdown">
                                        <li><a class="dropdown-item" href="#">{{ __('page.Healthy Teeth Collaboration') }}</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{ __('page.Blog') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">{{ __('page.Contact Us') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-uppercase" href="#">
                                    {{ app()->getLocale() }}
                                </a>
                                <div class="dropdown-menu-wrapper">
                                    <ul class="dropdown-menu p3">
                                        @foreach($locales as $locale => $label)
                                            <li><a class="dropdown-item" href="#">{{ $label }}</a></li>
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
                    <a class="nav-link" href="#">{{ __('page.About Us') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('page.What do we do') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('page.News & Events') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('page.Programme') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('page.Blog') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('page.Contact Us') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-uppercase" href="#">
                        {{ app()->getLocale() }}
                    </a>
                    <div class="dropdown-menu-wrapper">
                        <ul class="dropdown-menu p3">
                            @foreach($locales as $locale => $label)
                                <li><a class="dropdown-item" href="#">{{ $label }}</a></li>
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
    
    $(document).click(function(event) {
        if (!$(event.target).closest('#mobileNav').length && !$(event.target).is('.navbar-toggler')) {
            $('#mobileNav').removeClass('show');
        }
    });
</script>
@endpush