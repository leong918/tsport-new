<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
            <img src="{{asset('assets/web/assets/img/sidebar/logo.png')}}" alt="hellosmile" class="img-fluid sidebar-brand-full">
            <img src="{{asset('assets/web/assets/img/sidebar/logo-mobile.png')}}" alt="hellosmile" class="img-fluid sidebar-brand-narrow">
        </a>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-chart-bar nav-icon"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-title">Shop</li>
        <li class="nav-group">
            <a class="nav-link" href="{{ route('admin.admin.index') }}">
                <i class="fa-solid fa-user-gear nav-icon"></i>
                Admin
            </a>
        </li>
        <li class="nav-group">
            <a class="nav-link" href="{{ route('admin.blog.index') }}">
                <i class="fa-solid fa-blog nav-icon"></i>
                Blog
            </a>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>