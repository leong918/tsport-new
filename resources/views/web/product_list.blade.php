@foreach($product_list as $product)
    <div class="product-container col product-img">
        <div class="product-image position-relative">
            <img class="show" src="{{$product->productImage()->first()->url}}">
            <div class="wishlist-cart-container">
                <div class="row text-center">
                    <div class="col-md-6"> 
                        <div class="wishlist-container">
                            <img class="wishlist-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-1.png')}}">
                            <img class="wishlist-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!--cart-->
                        <div class="cart-container">
                            <img class="cart-hide" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-1.png')}}">
                            <img class="cart-hover-show" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-info">
            <div class="rating-wishlist">
                @if(function_exists('reviewRenderView'))
                {{ reviewRenderView('common_star_rating') }}
                @endif
                <img class="wishlist-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-wishlist-2.png')}}">
            </div>
            <div class="product-description">{{ $product->name }}</div>
            <div class="price-cart">
                <div class="product-price">{{$product->code .' '.$product->price }}</div>
                <img class="cart-mobile" type="button" src="{{asset('assets/web/assets/img/homepage/add-cart-2.png')}}">
            </div>
        </div>
    </div>
@endforeach