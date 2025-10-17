<header id="header">
    <div class="header-items">
        <button class="header-btn back-btn" type="button" aria-label="Go Back">
            <img src="{{ asset('assets/web/images/global/btn-back.png') }}" class="img img-fluid banner-img">
        </button>
        <button class="header-btn hamburger-btn" type="button" data-bs-toggle="offcanvas" 
            data-bs-target="#offcanvas-sidebar" aria-controls="offcanvas-sidebar" aria-label="Open Menu">
            <img src="{{ asset('assets/web/images/global/hamburger.png') }}" class="img img-fluid banner-img"
                style="pointer-events: none;" alt="Menu">
        </button>
    </div>
</header>

{{-- Push sidebar to separate stack to avoid ScrollSmoother conflicts --}}
@push('modals')
    <div class="offcanvas offcanvas-end sidebar" tabindex="-1" id="offcanvas-sidebar"
        aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header text-center position-relative">
            <button type="button" class="offcanvas-close" aria-label="Close" data-bs-dismiss="offcanvas">
                <img src="{{ asset('assets/web/images/global/btn-right.png') }}" alt="Close" class="img-fluid">
            </button>
            <a href="#" class="offcanvas-title" id="offcanvasSidebarLabel">
                <img src="{{ asset('assets/web/images/global/logo.png') }}" alt="Logo">
            </a>
        </div>
        <div class="offcanvas-body">
            <ul class="sidebar-list main">
                <li><a href="{{ route('web.home') }}" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/btn-home.png') }}" alt="主頁"></a></li>
                <li><a href="{{ route('web.ordering') }}" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/btn-order-area.png') }}" alt="點單區"></a></li>
                <li><a href="{{ route('web.events') }}" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/btn-events.png') }}" alt="活動專區"></a></li>
                <li><a href="{{ route('web.matches') }}" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/btn-matches.png') }}" alt="直播區"></a></li>
                <li><a href="{{ route('web.predict') }}" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/btn-prediction-home.png') }}" alt="預測專業"></a>
                </li>
                @auth
                    <li><a href="{{ route('web.profile') }}" class="sidebar-link">
                            <img src="{{ asset('assets/web/images/sidebar/btn-personal-home.png') }}" alt="個人主頁"></a></li>
                @endauth
            </ul>

            <div class="separator"></div>

            @guest
                <ul class="sidebar-list secondary">
                    <li><a href="{{ route('web.login') }}" class="sidebar-link">
                            <img src="{{ asset('assets/web/images/sidebar/btn-login.png') }}" alt="登錄"
                                class="img-fluid"></a></li>
                    <li><a href="{{ route('web.register') }}" class="sidebar-link">
                            <img src="{{ asset('assets/web/images/sidebar/btn-signup.png') }}" alt="註冊"
                                class="img-fluid"></a></li>
                </ul>
            @endguest

            <ul class="sidebar-list social-media">
                <li><a href="#" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/social-media-facebook.png') }}" alt="Facebook"
                            class="img-fluid"></a></li>
                <li><a href="#" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/social-media-telegram.png') }}" alt="Telegram"
                            class="img-fluid"></a></li>
                <li><a href="#" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/social-media-website.png') }}" alt="Website"
                            class="img-fluid"></a></li>
            </ul>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        // Set home route for back button functionality
        window.homeRoute = '{{ route("web.home") }}';
    </script>
@endpush
