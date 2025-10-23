<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <a class="navbar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}" style="text-decoration: none;">
            <h3 class="mb-0 text-white fw-bold sidebar-brand-full">TSports</h3>
            <h5 class="mb-0 text-white fw-bold sidebar-brand-narrow">TS</h5>
        </a>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-chart-bar nav-icon"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-title">Administration</li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.topic.index') }}">
                <i class="fa-solid fa-newspaper nav-icon"></i>
                Topic
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.match.index') }}">
                <i class="fa-solid fa-newspaper nav-icon"></i>
                Match
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.live-match.index') }}">
                <i class="fa-solid fa-video nav-icon"></i>
                Live Match
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.predict.index') }}">
                <i class="fa-solid fa-newspaper nav-icon"></i>
                Prediction
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.event.index') }}">
                <i class="fa-solid fa-newspaper nav-icon"></i>
                Event
            </a>
        </li>
        <li class="nav-title">System</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.user.index') }}">
                <i class="fa-solid fa-users nav-icon"></i>
                Users
            </a>
        </li>
        <li class="nav-group">
            <a class="nav-link" href="{{ route('admin.admin.index') }}">
                <i class="fa-solid fa-user-gear nav-icon"></i>
                Admin
            </a>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
