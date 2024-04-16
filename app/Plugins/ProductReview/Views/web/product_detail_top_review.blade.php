@if($avgRating > 0)
<div class="col-12 d-flex reviews-wrapper">
    <div class="star-wrapper d-flex justify-content-start">
        @for ($i = 0; $i < 5; $i++)
        @if ($i < round($avgRating))
        <div class="d-flex flex-column justify-content-center"><img src="{{asset('assets/web/assets/img/product_details/star_1.png')}}"></div>
        @else
        <div class="d-flex flex-column justify-content-center"><img src="{{asset('assets/web/assets/img/product_details/star_2.png')}}"></div>
        @endif
        @endfor
    </div>
    <div class="d-flex flex-column align-center justify-content-center total-reviews-title"><span>{{ $review_total }} customer reviews</span></div>
</div>
@endif