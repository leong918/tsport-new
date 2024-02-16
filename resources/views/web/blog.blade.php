@extends('web.layout.app')
@section('content')
<div id="blog" class="overflow-x-hidden margin-header">
    <div class="">
        <div class="product-banner">
            <img src="{{asset('assets/web/assets/img/blog/bg.png')}}" />
            <div class="product-title-wrapper">
                <div class="product-title">Blog</div>
                <div class="product-nav d-flex justify-content-center"><span>Home</span><span>></span><span>Blog</span></div>
            </div>
        </div>
    </div>
    <div class="blog">
        <div class="container">
            <div class="row justify-content-center content-wrapper">
                <div class="col-12 product-wrapper" id="targetElement">
                    <div class="product">
                        <div class="container">
                        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2">
                            <div class="blog-container blog-img">
                                <div class="blog-block">
                                    <div class="img-block">
                                        <img src="{{asset('assets/web/assets/img/homepage/blog-img-1.png')}}">
                                    </div>
                                    <div class="blog-description">
                                        <div class="blog-date">July 22, 2023</div>
                                        <div class="blog-main">新星级抗氧化王者一乙艦載油X LOVINAH新品早CA雙精華</div>
                                    </div>
                                    <div class="blog-button" type="button">READ MORE</div>
                                </div>
                            </div>
                            <div class="blog-container col blog-img">
                                <div class="blog-block">
                                    <div class="img-block">
                                        <img src="{{asset('assets/web/assets/img/homepage/blog-img-2.png')}}">
                                    </div>
                                    <div class="blog-description">
                                        <div class="blog-date">September 17, 2022</div>
                                        <div class="blog-main">防曬們是非我細細聲講給你(下)</div>
                                    </div>
                                    <div class="blog-button" type="button">READ MORE</div>
                                </div>
                            </div>
                            <div class="blog-container col blog-img">
                                <div class="blog-block">
                                    <div class="img-block">
                                        <img src="{{asset('assets/web/assets/img/homepage/blog-img-3.png')}}">
                                    </div>
                                    <div class="blog-description">
                                        <div class="blog-date">September 9, 2022</div>
                                        <div class="blog-main">防曬們是非我細細聲調給你(上)</div>
                                    </div>
                                    <div class="blog-button" type="button">READ MORE</div>
                                </div>
                            </div>
                            <div class="blog-container col blog-img">
                                <div class="blog-block">
                                    <div class="img-block">
                                        <img src="{{asset('assets/web/assets/img/homepage/blog-img-4.png')}}">
                                    </div>
                                    <div class="blog-description">
                                        <div class="blog-date">August 24, 2022</div>
                                        <div class="blog-main">護膚油同腦袋?一樣,都是個好東 西!LOVINAH三支神級BEAUTY OIL ELIXIR有咩分別?</div>
                                    </div>
                                    <div class="blog-button" type="button">READ MORE</div>
                                </div>
                            </div>
                            <div class="blog-container col blog-img">
                                <div class="blog-block">
                                    <div class="img-block">
                                        <img src="{{asset('assets/web/assets/img/homepage/blog-img-7.png')}}">
                                    </div>
                                    <div class="blog-description">
                                        <div class="blog-date">August 24, 2022</div>
                                        <div class="blog-main">邊支TONER最啱你?即刻嚟睇睇啦:)</div>
                                    </div>
                                    <div class="blog-button" type="button">READ MORE</div>
                                </div>
                            </div>
                            <div class="blog-container col blog-img">
                                <div class="blog-block">
                                    <div class="img-block">
                                        <img src="{{asset('assets/web/assets/img/homepage/blog-img-8.png')}}">
                                    </div>
                                    <div class="blog-description">
                                        <div class="blog-date">August 24, 2022</div>
                                        <div class="blog-main">護膚油同腦袋?一樣,都是個好東 西!LOVINAH三支神級BEAUTY OIL ELIXIR有咩分別?</div>
                                    </div>
                                    <div class="blog-button" type="button">READ MORE</div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush