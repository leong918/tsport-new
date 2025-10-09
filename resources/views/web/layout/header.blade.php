<header id="header">
    <div class="header-items">
        <button class="header-btn back-btn" onclick="goBack()" type="button" aria-label="Go Back">
            <img src="{{ asset('assets/web/images/global/btn-back.png') }}" class="img img-fluid banner-img">
        </button>
        <button class="header-btn hamburger-btn" type="button" data-bs-target="#offcanvas-sidebar"
            data-bs-toggle="offcanvas" aria-controls="offcanvas-sidebar" aria-label="Open Menu">
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
            <button type="button" class="offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close">
                <img src="{{ asset('assets/web/images/global/btn-right.png') }}" alt="Close" class="img-fluid">
            </button>
            <a href="#" class="offcanvas-title" id="offcanvasSidebarLabel">
                <img src="{{ asset('assets/web/images/global/logo.png') }}" alt="Logo">
            </a>
        </div>
        <div class="offcanvas-body">
            <ul class="sidebar-list main">
                <li><a href="{{ route('web.home') }}" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/btn-home.png') }}" alt="主页"></a></li>
                <li><a href="{{ route('web.ordering') }}" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/btn-order-area.png') }}" alt="点单区"></a></li>
                <li><a href="{{ route('web.events') }}" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/btn-events.png') }}" alt="活动专区"></a></li>
                <li><a href="{{ route('web.live-matches') }}" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/btn-live-matches.png') }}" alt="直播区"></a></li>
                <li><a href="#" class="sidebar-link">
                        <img src="{{ asset('assets/web/images/sidebar/btn-prediction-home.png') }}" alt="预测专业"></a>
                </li>
                @auth
                    <li><a href="{{ route('web.profile') }}" class="sidebar-link">
                            <img src="{{ asset('assets/web/images/sidebar/btn-personal-home.png') }}" alt="个人主页"></a></li>
                @endauth
            </ul>

            <div class="separator"></div>

            @guest
                <ul class="sidebar-list secondary">
                    <li><a href="{{ route('web.login') }}" class="sidebar-link">
                            <img src="{{ asset('assets/web/images/sidebar/btn-login.png') }}" alt="登录"
                                class="img-fluid"></a></li>
                    <li><a href="{{ route('web.register') }}" class="sidebar-link">
                            <img src="{{ asset('assets/web/images/sidebar/btn-signup.png') }}" alt="注册"
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

<script>
/**
 * Global back button functionality
 * Goes to previous page in browser history, with fallback to home page
 */
function goBack() {
    // Check if there's history to go back to
    if (window.history.length > 1 && document.referrer) {
        // Check if the referrer is from the same domain to avoid going to external sites
        const currentDomain = window.location.hostname;
        const referrerUrl = new URL(document.referrer);
        
        if (referrerUrl.hostname === currentDomain) {
            window.history.back();
        } else {
            // If referrer is external, go to home page
            window.location.href = '{{ route("web.home") }}';
        }
    } else {
        // No history or referrer, go to home page
        window.location.href = '{{ route("web.home") }}';
    }
}

// Make goBack function globally available
window.goBack = goBack;
</script>
