@foreach($product_list as $product)
    <a href="{{route('web.product_detail', ['alias' => $product->alias])}}" class="product-container col product-img">
        <div class="product-image position-relative">
            <img class="show" src="{{$product->productImage()->first()->url}}">
            @if(function_exists('salesOrderRenderView'))
            {{ salesOrderRenderView('product_list_hover_web', $product) }}
            @endif
        </div>
        <div class="product-info">
            <div class="rating-wishlist">
                @if(function_exists('reviewRenderView'))
                {{ reviewRenderView('common_star_rating', $product) }}
                @endif
                @if(function_exists('salesOrderRenderView'))
                {{ salesOrderRenderView('product_list_wishlist_mobile', $product) }}
                @endif
            </div>
            <div class="product-description">{{ $product->name }}</div>
            <div class="price-cart">
                <div class="product-price">{{$product->code .' '.$product->price }}</div>
                @if(function_exists('salesOrderRenderView'))
                {{ salesOrderRenderView('product_list_hover_web', $product) }}
                @endif
                @if(function_exists('salesOrderRenderView'))
                {{ salesOrderRenderView('product_list_cart_mobile', $product) }}
                @endif
            </div>
        </div>
    </a>
@endforeach