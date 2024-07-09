<div id="header">
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container">
            <div class="row align-items-center">

                <!-- spacer for centering -->
                <div class="col-md-5 d-none d-md-block"></div>
                <!--navbar-logo-->
                <div class="col-8 col-md-2 text-center">
                    <a class="navbar-brand p-0 m-0" href="{{route('web.home')}}">
                        <img src="{{asset('assets/web/assets/img/navigation/logo.png')}}" alt="Bootstrap" width="140px" height="auto">
                    </a>
                </div>
                <!-- navbar-icon -->
                <div class="col-4 col-md-5 text-end functional-wrapper">
                    <a class="navbar-search" data-bs-toggle="collapse" href="#nav-search-toggle" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <img src="{{asset('assets/web/assets/img/navigation/search-icon.png')}}" alt="Bootstrap" width="25" height="24">
                    </a>

                    <!--navbar-toggle-->
                    <a class="navbar-toggler-concept" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <img src="{{asset('assets/web/assets/img/navigation/menu_icon.png')}}" alt="Bootstrap" width="25" height="24">
                    </a>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header align-self-end">
                    <a data-bs-dismiss="offcanvas" aria-label="Close">
                        <img src="{{asset('assets/web/assets/img/navigation/cross.png')}}" alt="Bootstrap" width="30" height="30">
                    </a>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item dropdown">
                            <button class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Brands
                            </button>
                        </li>
                        <li class="nav-item dropdown">
                            <button class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About
                            </button>
                            <ul class="dropdown-menu dropdown-about">
                                <li><a class="dropdown-item" href="#">About</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">下單及享用優惠教學</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">消費券 Consumption Voucher</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>