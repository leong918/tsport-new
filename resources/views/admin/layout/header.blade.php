<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <div class="left-content d-flex align-items-center">
            <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <i class="fa-solid fa-bars"></i>
            </button>
            <a class="header-brand d-md-none" href="#">
                <img src="{{asset('assets/web/assets/img/sidebar/logo.png')}}" alt="hellosmile" class="img-fluid sidebar-brand-narrow" width="118" height="46" >
            </a>
            <ul class="header-nav d-none d-md-flex">
                <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
            </ul>
        </div>

        <div class="right-content d-flex align-items-center">
            <ul class="header-nav me-4">
                <li class="nav-item dropdown d-flex align-items-center"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md"><img class="avatar-img" src="https://ui-avatars.com/api/?name={{ auth('admin')->user()->name }}" alt="{{ auth('admin')->user()->name }}"></div></a>
                    <div class="dropdown-menu dropdown-menu-end pt-0">
                        <div class="dropdown-divider border-top-0 mb-0"></div>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.admin.profile') }}">
                            <i class="fa-regular fa-user icon me-2"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}">
                            <i class="fa-solid fa-arrow-right-from-bracket icon me-2"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            @yield('breadcrumb')
        </ol>
        </nav>
    </div>
</header>