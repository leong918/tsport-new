@if($product->getAvgRating() > 0)
<div class="d-flex justify-content-between">
    @for ($i = 0; $i < 5; $i++)
    @if ($i < $product->getAvgRating())
    <img class="star-rating" src="{{ asset('assets/web/assets/img/product_details/star_1.png') }}">
    @else
    <img class="star-rating" src="{{ asset('assets/web/assets/img/product_details/star_2.png') }}">
    @endif
    @endfor
</div>
@endif