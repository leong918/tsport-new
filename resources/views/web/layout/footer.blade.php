<div id="footer">
    <div class="row footer-wrapper m-auto">
        <div class="col-6 col-lg-2 order-1">
            <a class="img-wrapper img-wrapper" href="/">
                <img src="{{asset('assets/web/assets/img/header/logo.png')}}" alt="hellosmile" class="img img-fluid logo">
            </a>
        </div>
        <div class="col-12 col-lg-9 mt-4 mt-lg-0 order-3 order-lg-2">
            <div class="row row-top mb-0 justify-content-between align-items-lg-center h6 flex-column flex-lg-row">
                <a class="h6" href="{{ route('web.about-us') }}">
                    {{ __('About Us') }}
                </a>
                <a class="h6" href="{{ route('web.what-do-we-do') }}">
                    {{ __('What do we do') }}
                </a>
                <a class="h6" href="#">
                    {{ __('News & Events') }}
                </a>
                <a class="h6" href="#">
                    {{ __('Programme') }}
                </a>
                <a class="h6" href="#">
                    {{ __('Blog') }}
                </a>
                <a class="h6" href="#">
                    {{ __('Contact Us') }}
                </a>
            </div>
            <div class="row row-bottom align-items-center justify-content-center">
                <div class="col-12 col-lg d-flex align-items-center h6">
                    {{ __('Follow Us') }} 
                    <a href="https://www.instagram.com/hellosmilehk/" target="_blank" class="mt-0">
                        <img src="{{asset('assets/web/assets/img/footer/instagram.png')}}" alt="instagram" class="img img-fluid instagram">
                    </a>
                </div>
                <div class="col-12 col-lg">
                    <p class="p4 mb-0 text-start text-lg-end mt-2 mt-lg-0">© hellosmile HK {{ date('Y') }}. All right reserved.</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-1 order-2 order-lg-3">
            <div class="top-wrapper d-flex justify-content-end">
                <img src="{{ asset('assets/web/assets/img/footer/top.png') }}" alt="hellosmile" class="img img-fluid scroll-top">
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