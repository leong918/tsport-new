<div id="footer">
    <div class="container fixed-bottom">
        <div class="row" id="first-row">
            <div class="col-12 col-xl-2 col-lg-2 col-md-2 col-sm-12 text-center">
                <a class="text-body-secondary" href="{{route('web.home')}}">
                    <img src="{{asset('assets/web/assets/img/footer/logo.png')}}" alt="Bootstrap">
                </a>
            </div>
            <div class="col-12 col-xl-2 col-lg-2 col-md-2 col-sm-6">
                <div class="footer-primary">COMPANY</div>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{route('about.index')}}" class="nav-link p-0 text-body-secondary">About</a></li>
                    <li class="nav-item mb-2"><a href="{{route('about.contact')}}" class="nav-link p-0 text-body-secondary">Contact</a></li>
                </ul>
            </div>
            <div class="col-12 col-xl-2 col-lg-2 col-md-2 col-sm-6">
                <div class="footer-primary">
                    <p5>CUSTOMER SERVICES</p5>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{route('web.how_to')}}" class="nav-link p-0 text-body-secondary">下單及享用優惠教學</a></li>
                    <li class="nav-item mb-2"><a href="{{route('about.membership')}}" class="nav-link p-0 text-body-secondary">Membership</a></li>
                    <li class="nav-item mb-2"><a href="{{route('about.points')}}" class="nav-link p-0 text-body-secondary">Points to Cash Programme</a></li>
                    <li class="nav-item mb-2"><a href="{{ (Auth::user()) ? route('account.details') : route('web.login') }}" class="nav-link p-0 text-body-secondary">My account</a></li>
                    <li class="nav-item mb-2"><a href="{{route('about.shipping')}}" class="nav-link p-0 text-body-secondary">Shipping Info</a></li>
                </ul>
            </div>
            <div class="col-12 col-xl-3 col-lg-3 col-md-3 col-sm-6">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2" class="nav-link p-0 text-body-secondary">
                        Close on Every Saturday
                    </li>
                    <li class="nav-item mb-2" class="nav-link p-0 text-body-secondary">
                        Working Day Operating Hours 13:00-20:00pm
                    </li>
                    <li class="nav-item mb-2" class="nav-link p-0 text-body-secondary">
                        Please Whatsapp 54425298 at least 30 mins earlier<br>
                        if you would like to visit us at out Lai Chi Kok Studio
                    </li>
                </ul>
            </div>
            <div class="col-12 col-xl-3 col-lg-2 col-md-2 col-sm-6">
                <div class="row">
                    <div class="col-12 col-xl-4 col-lg-5 col-md-12">
                        <p class="footer-primary-info">PHONE</p>
                    </div>
                    <div class="col-12 col-xl-8 col-lg-7 col-md-12">
                        <a class="nav-item mb-3 nav-link p-0 text-body-secondary" href="tel:+85254422598">+85254422598</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-xl-4 col-lg-5 col-md-12">
                        <p class="footer-primary-info">EMAIL</p>
                    </div>
                    <div class="col-12 col-xl-8 col-lg-7 col-md-12">
                        <a class="nav-item mb-3 nav-link p-0 text-body-secondary" href="mailto:tcdistributorship@gmail.com">tcdistributorship@gmail.com</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-xl-4 col-lg-5 col-md-12">
                        <p class="footer-primary-info">WEBSITE</p>
                    </div>
                    <div class="col-12 col-xl-8 col-lg-7 col-md-12">
                        <a class="nav-item mb-3 nav-link p-0 text-body-secondary" href="http://www.tag-concept.com">http://www.tag-concept.com</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="second-row">
            <div class="col-12 col-xl-10 col-lg-9 col-md-8 col-sm-12">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2" class="nav-link p-0 text-body-secondary">
                        Welcome to TAG Concept. In order to promise you a safe and pleasant shopping experience,
                        we set terms and conditions to achieve a better understanding of expectations of both sides.
                        When you visit this website. It is supposed that you accept on behalf of and compilance with the terms.
                        Therefore, we highly recommend you to carefully read the page "Terms & Conditions.
                        IF YOU DO NOT ACCEPT THESE TERMS OF USE, PLEASE DO NOT USE THIS WEBSITE.
                    </li>
                </ul>
            </div>
            <div class="col-12 col-xl-2 col-lg-3 col-md-4 col-sm-6">
                <a class="text-body-secondary" href="#" type="button">
                    <img src="{{asset('assets/web/assets/img/footer/visa.png')}}" alt="Bootstrap">
                </a>
                <a class="text-body-secondary" href="#" type="button">
                    <img src="{{asset('assets/web/assets/img/footer/master-card.png')}}" alt="Bootstrap">
                </a>
                <a class="text-body-secondary" href="#" type="button">
                    <img src="{{asset('assets/web/assets/img/footer/american-express.png')}}" alt="Bootstrap">
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-12 col-lg-12 col-md-12 border-top">
        <p class="text-center text-body-secondary">COPYRIGHT © <?php echo $copyYear = date('Y') ?> Tag Concept</p>
    </div>
</div>