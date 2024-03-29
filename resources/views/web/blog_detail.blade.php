@extends('web.layout.app')
@section('content')
<div id="blog-detail" class="overflow-x-hidden margin-header">
    <div class="blog">
        <div class="container">
            <div class="row justify-content-center content-wrapper">
                <div class="col-12">
                    <div class="top-title-wrap">
                        <div class="dates">
                            {{ $blog->publishedDate() }}
                        </div>
                        <div class="blog-title">
                            {{ $blog->name }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="blog-left">
                        <div>
                            <img src="{{ $blog->getParameters('cn')->image }}" alt="">
                        </div>
                        <div class="left-desc">
                            {!! $blog->getParameters('cn')->content !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="right-wrapper">
                        <div class="right-title">
                            Product
                        </div>
                        <div class="product-wrapper row">
                            @foreach($product_list as $product)
                            <a href="{{route('web.product_detail', ['alias' => $product->alias])}}" class="product-container col-6 col-md-4 col-lg-12 product-img">
                                <div class="product-image position-relative">
                                    <img class="show" src="{{$product->productImage()->first()->url}}">
                                    @if(function_exists('salesOrderRenderView'))
                                    {{ salesOrderRenderView('product_list_hover_web', $product) }}
                                    @endif
                                </div>
                                <div class="product-info">
                                    <div class="rating-wishlist">
                                        @if(function_exists('reviewRenderView'))
                                        {{ reviewRenderView('common_star_rating') }}
                                        @endif
                                        @if(function_exists('salesOrderRenderView'))
                                        {{ salesOrderRenderView('product_list_wishlist_mobile', $product) }}
                                        @endif
                                    </div>
                                    <div class="product-description">{{ $product->name }}</div>
                                    <div class="price-cart">
                                        <div class="product-price">{{$product->code .' '.$product->price }}</div>
                                        @if(function_exists('salesOrderRenderView'))
                                        {{ salesOrderRenderView('product_list_cart_mobile', $product) }}
                                        @endif
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="comment-section">
            <div class="container">
                <div class="title">Comments ({{ $blog->firstLayerBlogComment()->count() }})</div>
                @foreach($blog->firstLayerBlogComment() as $blog_comment)
                <div class="main-comment">
                    <div class="username-date">
                        <div class="username">{{ $blog_comment->username }}</div>
                        <div class="date">{{ $blog_comment->date() }}</div>
                    </div>
                    <div class="comment">{{ $blog_comment->comment }}</div>
                    <div class="sub-comment px-2">
                        @foreach($blog_comment->blogSubComment as $blog_sub_comment)
                        <div class="username-date">
                            <div class="username">{{ $blog_sub_comment->username }}</div>
                            <div class="date">{{ $blog_sub_comment->date() }}</div>
                        </div>
                        <div class="comment">{{ $blog_sub_comment->comment }}</div>
                        @endforeach
                    </div>
                    @if(auth()->user())
                    <div class="sub-reply">
                        Reply<br/>
                        {{ html()->form('POST', route("web.create_blog_comment"))->id('blog_sub_comment')->open()  }}
                        <div class="d-flex">
                            <div class="reply-input">
                                {{ html()->text('comment')->class('sub-reply-input') }}
                                {{ html()->hidden('blog_id')->value($blog->id) }}
                                {{ html()->hidden('parent_id')->value($blog_comment->id) }}
                            </div>
                            <div class="reply-button">
                                {{-- {!! auth()->user() ? '<button type="submit">POST COMMENT</button>' : '<a href="'.route('web.login').'"">POST COMMENT</a>'!!} --}}
                                <button type="submit">Reply</button>
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                    @endif
                </div>
                @endforeach
                <div class="main-reply">
                        {{ html()->form('POST', route("web.create_blog_comment"))->id('blog_comment')->open()  }}
                        <div class="main-reply-title">Leave A Reply</div>
                        {{ html()->textarea('comment')->class('main-reply-input')->rows(4)->placeholder('Comment') }}
                        {{ html()->hidden('blog_id')->value($blog->id) }}
                        <div class="submit-reply-section">
                            {!! auth()->user() ? '<button type="submit">POST COMMENT</button>' : '<a href="'.route('web.login').'"">POST COMMENT</a>'!!}
                        </div>
                        {{ html()->form()->close() }}
                </div>
            </div>
        </div>
        <div class="more-section">
            <div class="container">
                <div class="more-title">More</div>
                <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2">
                    @foreach($blog_list as $blog)
                    <div class="blog-container col blog-img">
                        <div class="blog-block">
                            <div class="img-block">
                                <img src="{{ $blog->getParameters('cn')->image }}">
                            </div>
                            <div class="blog-description">
                                <div class="blog-date">{{ $blog->publishedDate() }}</div>
                                <div class="blog-main">{{ $blog->name }}</div>
                            </div>
                            <div class="blog-button-wrapper">
                                <a href="{{route('web.blog_detail', ['blog_id' => $blog->id])}}" class="blog-button">READ MORE</a>
                            </div>                        
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() { 

        $("#blog_sub_comment, #blog_comment").submit(function(e) {
            e.preventDefault();

            var url = $(this).attr('action');
            let formData = new FormData(this);

            axios({
                method: "post",
                url: url,
                data: formData,
                headers: { "Content-Type": "multipart/form-data" },
            })
            .then(response => {
                Swal.fire({
                    title: '{{__("page.blog_comment_added")}}',
                    text: '{{__("page.txt_blog_added")}}',
                    icon: 'success',
                    confirmButtonClass: 'btn btn-success',
                        confirmButtonText: '{{__("page.ok")}}',
                });
                window.location.reload();
            })
            .catch(error => {
                Swal.fire({
                    title: '{{__("page.blog_comment_fail_add")}}',
                    text: error.response.data.msg,
                    icon: 'error',
                    confirmButtonClass: 'btn btn-danger',
                    confirmButtonText: '{{__("page.ok")}}',
                });
            });
        });
    });
</script>
@endpush