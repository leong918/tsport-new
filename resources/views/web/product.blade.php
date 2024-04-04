@extends('web.layout.app')
@section('content')

<div id="product" class="overflow-x-hidden margin-header">
    <div class="product-banner">
        <img src="{{asset('assets/web/assets/img/product/product_bg.png')}}" />
        <div class="product-title-wrapper">
            @if(isset($current_category))
            <div class="product-title text-capitalize">{{$current_category->name}}</div> 
            @elseif(isset($search_keyword))
            <div class="product-title text-capitalize">Search Result</div> 
            @else
            <div class="product-title text-capitalize">Products</div> 
            @endif
            <div class="product-nav d-flex justify-content-center">
                <span><a class="text-decoration-none" href="{{ route('web.home') }}">Home</a></span>
                @if (!empty($current_category->parent_category_id))
                <span>></span>
                <span class="text-capitalize"><a class="text-decoration-none" href="{{ route('web.product', ['category_id' => $parent_category->id ]) }}">{{ $parent_category->name }}</a></span>
                @endif
                <span>></span>
                @if(isset($current_category))
                <span class="text-capitalize">
                    <a class="text-decoration-none" href="{{ route('web.product',['category_id' => $current_category->id ]) }}">
                        {{ $current_category->name }}
                    </a>
                </span>
                @elseif(isset($search_keyword))
                <span class="text-capitalize">Search Result</span>
                @else
                <span class="text-capitalize">Products</span>
                @endif   
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center content-wrapper">
            <div class="d-block d-md-none filter-wrapper row">
                <a href="#offcanvasNav"  data-bs-toggle="offcanvas" class="d-inline-block"><img src="{{asset('assets/web/assets/img/product/filter.png')}}" /></a>
            </div>
            <div class="offcanvas offcanvas-start col-5" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-body">
                    <div class="col-sm-12 nav-wrapper">
                        <div class="category-wrapper">
                            <div class="list-title">Category</div>
                            <ul>
                                <li><a href="#" class="category-btn" data-category-id={{isset($current_category) ? $current_category->id : '0'}}>{{ isset($current_category) ? $current_category->name : ''}}</a></li>
                            </ul>
                        </div>
                        <div class="brand-wrapper">
                            <div class="list-title">Brands</div>
                            <ul>
                                @foreach ($brand_list as $brand)
                                    <li><a href="#">{{ $brand->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-block col-md-3 nav-wrapper">
                @if (isset($category_list) && !isset($search_keyword) && $category_list->count() > 0)
                <div class="category-wrapper">
                    <div class="list-title">Category</div>
                    <ul>
                        @foreach ($category_list as $category)
                            <li><a href="{{ route('web.product', ['category_id' => $category->id]) }}" class="category-btn" data-category-id={{$category->id}}>{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(!isset($search_keyword))
                <div class="brand-wrapper">
                    <div class="list-title">Brands</div>
                    <ul>
                        @foreach ($brand_list as $brand)
                            <li><a href="{{route('web.brand',['brand_id' => $brand->id])}}">{{ $brand->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="col-sm-12 {{ isset($category_list) && isset($brand_list) && !isset($search_keyword) ? 'col-md-9' : 'col-md-12 product-wrapper-padding' }} product-wrapper">
                <div class="product">
                    <div class="container">
                        {!! isset($search_keyword) ? '<div class="total-count-item"> Showing '.$product_list->count().' results for "'.$search_keyword.'"</div>' : '' !!}
                        <div class="row row-cols-2 {{ isset($current_category) && isset($brand_list) ? 'row-cols-xl-4 row-cols-lg-3' : 'row-cols-lg-4' }} row-cols-md-3 row-cols-sm-3" id="productListContainer">
                            @include("web.product_list")
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection