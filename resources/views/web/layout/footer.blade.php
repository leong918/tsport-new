<div id="footer">
    <div class="row footer-wrapper m-auto align-items-c">
        <div class="col-12 col-lg-2">
            <a class="img-wrapper img-wrapper d-flex justify-content-center" href="#">
                <img src="{{asset('assets/web/assets/img/header/logo.png')}}" alt="hellosmile" class="img img-fluid logo">
            </a>
        </div>
        <div class="col-12 col-lg-9 mt-4 mt-lg-0">
            <div class="row row-top justify-content-between align-items-center h6 flex-column flex-sm-row">
                <a class="h6" href="/about">
                    {{ __('page.About Us') }}
                </a>
                <a class="h6" href="#">
                    {{ __('page.What do we do') }}
                </a>
                <a class="h6" href="#">
                    {{ __('page.News & Events') }}
                </a>
                <a class="h6" href="#">
                    {{ __('page.Programme') }}
                </a>
                <a class="h6" href="#">
                    {{ __('page.Blog') }}
                </a>
                <a class="h6" href="#">
                    {{ __('page.Contact Us') }}
                </a>
            </div>
            <div class="row row-bottom align-items-center justify-content-center">
                <div class="col-12 col-sm d-flex align-items-center h6">
                    {{ __('page.Follow Us') }} 
                    <a href="https://www.instagram.com/hellosmilehk/" target="_blank">
                        <img src="{{asset('assets/web/assets/img/footer/instagram.png')}}" alt="instagram" class="img img-fluid instagram">
                    </a>
                </div>
                <div class="col-12 col-sm">
                    <p class="p4 mb-0 text-center text-sm-end">© hellosmile HK {{ date('Y') }}. All right reserved.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-1 mt-4 mt-lg-0">
            <div class="top-wrapper d-flex justify-content-center justify-content-lg-end">
                <img src="{{asset('assets/web/assets/img/footer/top.png')}}" alt="hellosmile" class="img img-fluid scroll-top">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('.scroll-top').click(function() {
        window.scrollTo(0, 0);
    })
</script>
@endpush