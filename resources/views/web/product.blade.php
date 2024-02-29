@extends('web.layout.app')
@section('content')

<div id="product" class="overflow-x-hidden margin-header">
    <div class="product-banner">
        <img src="{{asset('assets/web/assets/img/product/product_bg.png')}}" />
        <div class="product-title-wrapper">
            <div class="product-title text-capitalize">{{ $category_type ? renderModelData(Category::TYPE, $category_type):"Search Result" }}</div>
            <div class="product-nav d-flex justify-content-center"><span>Home</span><span>></span><span class="text-capitalize">{{ $category_type ? renderModelData(Category::TYPE, $category_type):"Search Result"  }}</span></div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center content-wrapper">
            @if(isset($category_list) && isset($brand_list))
            <div class="d-block d-md-none filter-wrapper row">
                <a href="#offcanvasNav"  data-bs-toggle="offcanvas" class="d-inline-block"><img src="{{asset('assets/web/assets/img/product/filter.png')}}" /></a>
            </div>
            <div class="offcanvas offcanvas-start col-5" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-body">
                    <div class="col-sm-12 nav-wrapper">
                        <div class="category-wrapper">
                            <div class="list-title">Category</div>
                            <ul>
                                @foreach ($category_list as $category)
                                    <li><a href="#" class="category-btn">{{ $category->name }}</a></li>
                                @endforeach
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
                <div class="category-wrapper">
                    <div class="list-title">Category</div>
                    <ul>
                        @foreach ($category_list as $category)
                            <li><a href="#" class="category-btn" data-category-id={{ $category->id}}>{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="brand-wrapper">
                    <div class="list-title">Brands</div>
                    <ul>
                        @foreach ($brand_list as $brand)
                            <li><a href="{{route('web.brand',['brand_id' => $brand->id])}}">{{ $brand->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            <div class="col-sm-12 {{ isset($category_list) && isset($brand_list) ? 'col-md-9' : 'col-md-12 product-wrapper-padding' }} product-wrapper">
                <div class="product">
                    <div class="container">
                        {!! isset($search_keyword) ? '<div class="total-count-item"> Showing 10 results for "'.$search_keyword.'"</div>' : '' !!}
                        <div class="row row-cols-2 {{ isset($category_list) && isset($brand_list) ? 'row-cols-xl-4 row-cols-lg-3' : 'row-cols-lg-4' }} row-cols-md-3 row-cols-sm-3" id="productListContainer">
                            @include("web.product_list")
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.category-btn').click(function(){
            event.preventDefault();
            var category_id = $(this).data('category-id');
            @if(!empty($category_type))
                axios.get('{{ route('web.product', ['category_type' => $category_type]) }}', {params: { category_id: category_id }})
                    .then( response => {
                        $('#productListContainer').html(response.data); 
                    })
                    .catch( error => {
                        console.error(error);
                    });
            @endif
        });
    });
</script>

@endpush