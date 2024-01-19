<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        VVinners
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-chart-bar nav-icon"></i>
             Dashboard<span class="badge bg-info-gradient ms-auto">NEW</span></a></li>
        <li class="nav-title">System Config</li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <i class="fa-solid fa-user-gear nav-icon"></i> Admin</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.admin.index') }}"><span class="nav-icon"></span> Admin List</a></li>
            </ul>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>