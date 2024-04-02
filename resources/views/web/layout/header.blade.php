<div id="header">
    <!--floating-button-->
    <a class="floating-img-button" href="https://wa.me/85254422598" target="_blank">
        <img class="show" src="{{asset('assets/web/assets/img/navigation/whatsapp-logo-1.png')}}" alt="Bootstrap">
        <img class="hide" src="{{asset('assets/web/assets/img/navigation/whatsapp-logo-2.png')}}" alt="Bootstrap">
    </a>

    @if (isset($top_bar))
    <div class="container-fluid fixed-top" style="background-color: {{ $top_bar->background_colour }}">
        <div class="text-top">{!! $top_bar->content !!}</div>
    </div>
    @endif
    
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
                    @if(function_exists('salesOrderRenderView'))
                    {{ salesOrderRenderView('header_wishlist') }}
                    @endif
                    <a class="navbar-my-account-icon nav-acc-mobile" href="{{auth()->user() ? route('account.details') : route('web.login')}}">
                        <img src="{{asset('assets/web/assets/img/navigation/my-account-icon.png')}}" alt="Bootstrap" width="25" height="24">
                    </a>
                    <a class="navbar-my-account-icon nav-acc-desktop" href="{{auth()->user() ? route('account.details') : route('web.login')}}">
                        <img src="{{asset('assets/web/assets/img/navigation/my-account-icon.png')}}" alt="Bootstrap" width="25" height="24">
                    </a>
                    @if(function_exists('salesOrderRenderView'))
                    {{ salesOrderRenderView('header_cart') }}
                    @endif

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
                                @foreach ($sidebar_brand_list as $brand)
                                    <li><a class="dropdown-item" href="{{route('web.brand',['brand_id' => $brand->id ])}}">{{ $brand->name }}</a></li>
                                @endforeach
                            </ul> 
                        </li>

                        @foreach ($sidebar_category_list as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('web.product',['category_id' => $category->id ])}}">{{$category->name}}</a>
                        </li>
                        @endforeach
                        
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
                        <hr/>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('cart.wishlist')}}">Wishlist</a>
                        </li>
                        @if(auth()->user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{auth()->user() ? route('account.details') : route('web.login')}}">My Account</a>
                        </li>
                        <hr/>
                        <li class="nav-item nav-logout">
                            <a class="nav-link" href="{{route('web.logout')}}">
                                <img src="{{asset('assets/web/assets/img/navigation/logout.png')}}" alt="">
                                Logout
                            </a>
                        </li>
                        @else
                        <hr/>
                        <li class="nav-item nav-logout">
                            <a class="nav-link" href="{{auth()->user() ? route('account.details') : route('web.login')}}">
                                <img src="{{asset('assets/web/assets/img/navigation/my-account-icon.png')}}" alt="">
                                Login
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>