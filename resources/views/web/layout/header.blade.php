<div id="header">
    <!--floating-button-->
    <a class="floating-img-button" href="https://wa.me/85254422598" target="_blank">
        <img class="show" src="{{asset('assets/web/assets/img/navigation/whatsapp-logo-1.png')}}" alt="Bootstrap">
        <img class="hide" src="{{asset('assets/web/assets/img/navigation/whatsapp-logo-2.png')}}" alt="Bootstrap">
    </a>

    <div class="container-fluid fixed-top">
        <div class="text-top">Free Shipping on Orders of $800 Within Hong Kong</div>
    </div>
    
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
                <div class="col-4 col-md-5 text-end">
                    <a class="navbar-search" href="#" type="button">
                        <img src="{{asset('assets/web/assets/img/navigation/search-icon.png')}}" alt="Bootstrap" width="25" height="24">
                    </a>
                    <a class="navbar-wishlist" href="#" type="button">
                        <img src="{{asset('assets/web/assets/img/navigation/wishlist-icon.png')}}" alt="Bootstrap" width="25" height="24">
                    </a>
                    <a class="navbar-my-account-icon nav-acc-mobile" href="{{Auth::user() ? route('account.details') : route('web.login')}}" type="{{Auth::user() ? 'button' : ''}}" id="dropdownMenuButton" data-bs-toggle="{{Auth::user() ? 'dropdown' : ''}}" aria-haspopup="{{(Auth::user()) ? 'true' : ''}}" aria-expanded="{{(Auth::user()) ? 'false' : ''}}">
                        <img src="{{asset('assets/web/assets/img/navigation/my-account-icon.png')}}" alt="Bootstrap" width="25" height="24">
                    </a>
                    <a class="navbar-my-account-icon nav-acc-desktop" href="{{Auth::user() ? route('account.details') : route('web.login')}}">
                        <img src="{{asset('assets/web/assets/img/navigation/my-account-icon.png')}}" alt="Bootstrap" width="25" height="24">
                    </a>
                    <div class="dropdown-menu dropdown-menu-acc" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('account.details')}}">
                            <div class="account-nav active">
                                <img src="{{asset('assets/web/assets/img/account_nav/account_detail.png')}}" alt="">
                                <div class="nav-title">
                                    Account Details
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="{{route('account.address')}}">
                            <div class="account-nav active">
                                <img src="{{asset('assets/web/assets/img/account_nav/addresses.png')}}" alt="">
                                <div class="nav-title">
                                    Addresses
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="{{route('account.order')}}">
                            <div class="account-nav active">
                                <img src="{{asset('assets/web/assets/img/account_nav/orders.png')}}" alt="">
                                <div class="nav-title">
                                    Orders
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="{{route('account.point')}}">
                            <div class="account-nav active">
                                <img src="{{asset('assets/web/assets/img/account_nav/points.png')}}" alt="">
                                <div class="nav-title">
                                    Point
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="{{route('web.logout')}}">
                            <div class="account-nav active">
                                <img src="{{asset('assets/web/assets/img/account_nav/log_out.png')}}" alt="">
                                <div class="nav-title">
                                    Log Out
                                </div>
                            </div>
                        </a>
                    </div>
                    <a class="navbar-cart-icon" href="{{route('cart.shopping_cart')}}" type="button">
                        <img src="{{asset('assets/web/assets/img/navigation/cart.png')}}" alt="Bootstrap" width="25" height="24">
                    </a>

                    <!--navbar-toggle-->
                    <a class="navbar-toggler-concept" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="narber-toggler-concept">
                            <img src="{{asset('assets/web/assets/img/navigation/menu_icon.png')}}" alt="Bootstrap" width="25" height="24">
                        </span>
                    </a>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header align-self-end">
                    <a type="button" class="" data-bs-dismiss="offcanvas" aria-label="Close">
                        <img src="{{asset('assets/web/assets/img/navigation/cross.png')}}" alt="Bootstrap" width="30" height="30">
                    </a>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item dropdown">
                            <button class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Brands
                            </button>
                            <ul class="dropdown-menu dropdown-brand">
                                @foreach ($brand_list as $brand)
                                    <li><a class="dropdown-item" href="{{route('web.brand',['brand_id' => $brand->id ])}}">{{ $brand->name }}</a></li>
                                @endforeach
                            </ul> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('web.product',['category_type' => 'skincare'])}}">Skincare</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('web.product',['category_type' => 'makeup'])}}">Makeup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('web.product',['category_type' => 'hairbody'])}}">Hair & Body</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('web.blog')}}">Blog</a>
                        </li>
                        <li class="nav-item dropdown">
                            <button class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About
                            </button>
                            <ul class="dropdown-menu dropdown-about">
                                <li><a class="dropdown-item" href="{{route('about.membership')}}">Membership</a></li>
                                <li><a class="dropdown-item" href="{{route('about.points')}}">Point to Cash Programme</a></li>
                                <li><a class="dropdown-item" href="{{route('about.contact')}}">Contact</a></li>
                                <li><a class="dropdown-item" href="{{route('about.tnc')}}">Terms & Conditions</a></li>
                                <li><a class="dropdown-item" href="{{route('about.shipping')}}">Shipping Info</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('web.how_to')}}">下單及享用優惠教學</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('web.voucher')}}">消費券 Consumption Voucher</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>