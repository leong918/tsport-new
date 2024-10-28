@extends('web.layout.app')

@section('u_meta')
    <meta name="url" content="{{ route('web.blog_details', $blog->id) }}">
    <meta name="description" content="{{ $blog->getParameters(app()->getLocale(), 'description') }}">
    <title>{{'Hello Smile Hong Kong | ' . $blog->getParameters(app()->getLocale(), 'name') }}</title>
@endsection

@section('content')
<div id="blog-details">
    <div class="section-header">
        <div class="row justify-content-center align-items-center">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item p4"><a href="/">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item p4"><a href="/blog">{{ __('Blog') }}</a></li>
                        <li class="breadcrumb-item active p4" aria-current="page">{{ $blog->getParameters(app()->getLocale(), 'name') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12">
                <p class="p3 justify-content-center d-flex">{{ $blog->publishedDate() }}</p>
            </div>
            <div class="col-12">
                <h2 class="h3 justify-content-center d-flex">{{ $blog->getParameters(app()->getLocale(), 'name') }}</h2>
            </div>
            <div class="col-12 col-md-7">
                <div class="d-flex justify-content-center">
                    <img src="{{ $blog->image }}" alt="" class="img img-fluid d-none d-md-block h-100">
                </div>
            </div>
        </div>
    </div>
    
    <div class="content-section">
        <div class="m-auto">
            <div class="row d-flex align-items-center justify-content-between w-100">
                <div class="col-12 col-md-12">
                    <div class="content-wrapper m-auto mt-5 mt-md-0">
                        <div class="col-12 col-md-12">
                            <div class="share-to-container">
                                <img src="{{ asset('assets/web/assets/img/blog-details/share.png') }}"
                                    class="share-to-icon share" alt="...">
                                <div id="facebook">
                                    <a target="_blank"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ route('web.blog_details', $blog->id) }}&display=popup">
                                        <img src="{{ asset('assets/web/assets/img/blog-details/facebook.png') }}"
                                            class="share-to-icon social-media" alt="...">
                                    </a>
                                </div>
                                <div id="twitter">
                                    <a target="_blank"
                                        href="https://twitter.com/intent/tweet?url={{ route('web.blog_details', $blog->id) }}">
                                        <img src="{{ asset('assets/web/assets/img/blog-details/twitter.png') }}"
                                            class="share-to-icon social-media" alt="..." id="twitter">
                                    </a>
                                </div>
                                <div id="linkedin">
                                    <a target="_blank"
                                        href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('web.blog_details', $blog->id) }}">
                                        <img src="{{ asset('assets/web/assets/img/blog-details/linkedin.png') }}"
                                            class="share-to-icon social-media" alt="..." id="linkedin">
                                    </a>
                                </div>
                                <div id="copy-link">
                                    <a id="copy-link-address" href="{{ route('web.blog_details', $blog->id) }}">
                                        <img src="{{ asset('assets/web/assets/img/blog-details/copy.png') }}"
                                            class="share-to-icon social-media" alt="..." id="whatsapp">
                                    </a>
                                </div>
                            </div>
                        </div>
                        {!! $blog->getParameters(app()->getLocale(), 'content') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#copy-link-address').click(function(e) {
        e.preventDefault();
        var copyText = $(this).attr('href');
        document.addEventListener('copy', function(e) {
            e.clipboardData.setData('text/plain', copyText);
            e.preventDefault();
        }, true);
        document.execCommand('copy');
        alert('copied text: ' + copyText); 
      });
</script>
@endpush
