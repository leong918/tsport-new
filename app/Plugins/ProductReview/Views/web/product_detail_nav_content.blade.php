<div class="tab-pane fade {{ isset($_GET['page']) ? 'show active' : '' }}" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
    @if ($review_list->isNotEmpty())
    <div class="content-wrapper reviews-title">{{ $review_total }} Reviews</div>
    @foreach ($review_list as $review)
    <div class="content-wrapper">
        <div class="d-flex justify-content-between">
            <div class="star-wrapper d-flex justify-content-center">
                @for ($i = 0; $i < 5; $i++)
                @if ($i < $review->rate)
                <div class="d-flex flex-column justify-content-center"><img src="{{asset('assets/web/assets/img/product_details/star_1.png')}}"></div>
                @else
                <div class="d-flex flex-column justify-content-center"><img src="{{asset('assets/web/assets/img/product_details/star_2.png')}}"></div>
                @endif
                @endfor
            </div>
            <div class="reviews-date">
                {{ Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}
            </div>
        </div>
        <div class="customer-wrapper">
            <div><span class="customer-name">{{ $review->last_name }}****</span><span class="owner-title"> (Verified Owner)</span></div>
        </div>
        <div class="customer-comment">
            {{ $review->comment }}
        </div>
    </div>
    @endforeach
    @endif
    <div class="product_review_pagination">
        {{ $review_list->links() }}
    </div>
    <div class="content-wrapper leave-review-wrapper">
        {{ html()->form('POST', route("product_review.post_review", ['id' => $product->id]))->id('postReviewForm')->open()}}

        <div class="leave-review-title"><strong>Leave A Review</strong></div>
        <div class="star-wrapper d-flex justify-content-start">
            <div class="d-flex flex-column align-center justify-content-center review-star-control" data-number="1"><img src="{{asset('assets/web/assets/img/product_details/star_2.png')}}"></div>
            <div class="d-flex flex-column align-center justify-content-center review-star-control" data-number="2"><img src="{{asset('assets/web/assets/img/product_details/star_2.png')}}"></div>
            <div class="d-flex flex-column align-center justify-content-center review-star-control" data-number="3"><img src="{{asset('assets/web/assets/img/product_details/star_2.png')}}"></div>
            <div class="d-flex flex-column align-center justify-content-center review-star-control" data-number="4"><img src="{{asset('assets/web/assets/img/product_details/star_2.png')}}"></div>
            <div class="d-flex flex-column align-center justify-content-center review-star-control" data-number="5"><img src="{{asset('assets/web/assets/img/product_details/star_2.png')}}"></div>
            <input type="number" name="rate" id="rate" hidden value="0">
        </div>
        <div>
            {{ html()->textarea('comment')->class('review-textarea')->minlength(40)->placeholder('Comment')->required() }}
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="review-submit-button">POST</button>
        </div>

        {{ html()->form()->close() }}
    </div>
</div>