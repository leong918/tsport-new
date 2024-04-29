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
                            @foreach($blog_list as $blog)
                                <div class="blog-container blog-img">
                                    <div class="blog-block">
                                        <a href="{{route('web.blog_detail', ['blog_id' => $blog->id])}}">
                                            <div class="img-block">
                                                <img src="{{ $blog->getParameters('zh-CN')->image }}">
                                            </div>
                                            <div class="blog-description">
                                                <div class="blog-date">{{ $blog->publishedDate()  }}</div>
                                                <div class="blog-main">{{ $blog->name  }}</div>
                                            </div>
                                            <div class="blog-button-wrapper">
                                                <span class="blog-button">READ MORE</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
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