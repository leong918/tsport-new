<div class="total-section">
    <div class="subtotal">
        <div class="d-flex justify-content-between data-content-wrapper">
            <div class="label">Subtotal</div>
            <div class="data-label">
                <div class="price subtotal-price">${{ number_format($cartTotal['subtotal'], 2) }}</div>
            </div>
        </div>
    </div>
    <div class="discount {{ isset($cartTotal['discount']) ? '' : 'd-none' }}" id="discount">
        <div class="label">Discount</div>
        <div class="discount-content-wrapper">
            @if(isset($cartTotal['discount']))
            @foreach($cartTotal['discount'] as $discount)
            <div class="d-flex justify-content-between data-content-wrapper">
                <div class="inner-label">{{ $discount['name'] }}</div>
                <div class="data-label">
                    <div class="price">-${{ number_format($discount['discount_amount'], 2) }}</div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="coupon {{ isset($cartTotal['coupon']) ? '' : 'd-none' }}" id="coupon">
        <div class="label">Coupon</div>
        <div class="coupon-content-wrapper">
            @if(isset($cartTotal['coupon']))
            @foreach($cartTotal['coupon'] as $coupon)
            <div class="d-flex">
                <div class="d-flex justify-content-between data-content-wrapper">
                    <div class="inner-label">{{ $coupon['name'] }}</div>
                    <div class="data-label">
                        <div class="price">-${{ number_format($coupon['discount_amount'], 2) }}</div>
                    </div>
                </div>
                <div class="btn-remove-wrapper">
                    <button type="button" class="remove-coupon-button" data-id="{{ $coupon['id'] }}">remove</button>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="point-redemption">
        <div class="d-flex">
            <div class="d-flex justify-content-between data-content-wrapper">
                <div class="label">Point redemption</div>
                <div class="data-label">
                    <div class="price point-price">-${{ number_format($cartTotal['point_redemption'], 2) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="shipping-fee-section {{ isset($addressData) && $addressData['country_id'] ? '' : 'd-none' }}">
        <div class="shipping-fee">
            <div class="d-flex justify-content-between data-content-wrapper">
                <div class="label">Shipping Fee</div>
                <div class="data-label">
                    <div class="price shipping-price">
                        @if(isset($cartTotal['delivery_partner']))
                        {{ $cartTotal['delivery_partner'] }} : ${{ number_format($cartTotal['shipping_fee'], 2) }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="shipping-fee-inner">
            <div class="data-content-wrapper">
                <div class="inner-label">Shipping To:</div>
                <div class="inner-label" id="shipping_address">
                    @if(isset($addressData))
                    {{ $addressData['address'].', '.$addressData['postcode'].', '.$addressData['city'].', '.$addressData['state'].', '.$addressData['country'] }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="total">
        <div class="d-flex justify-content-between data-content-wrapper">
            <div class="label">Total</div>
            <div class="data-label">
                <div class="price order-total-price">${{ number_format($cartTotal['total'], 2) }}</div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script id="discountLayout" type="x-tmpl-mustache">
    <div class="d-flex justify-content-between data-content-wrapper">
        <div class="inner-label">@{{ name }}</div>
        <div class="data-label">
            <div class="price">-$@{{ price }}</div>
        </div>
    </div>
</script>
<script id="couponLayout" type="x-tmpl-mustache">
    <div class="d-flex">
        <div class="d-flex justify-content-between data-content-wrapper">
            <div class="inner-label">@{{ name }}</div>
            <div class="data-label">
                <div class="price">-$@{{ price }}</div>
            </div>
        </div>
        <div class="btn-remove-wrapper">
            <button class="remove-coupon-button" data-id="@{{ id }}">remove</button>
        </div>
    </div>
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.remove-coupon-button', function() {
            var id = $(this).data('id');

            $('.action-button').prop('disabled', true);
            $('.btn-checkout').prop('disabled', true);
            $('#apply-coupon-btn').prop('disabled', true);

            axios({
                method: "post",
                url: "{{ route('cart.remove_coupon') }}",
                data: {
                    coupon_id: id
                }
            })
            .then(response => {
                $('.action-button').prop('disabled', false);
                $('.btn-checkout').prop('disabled', false);
                $('#apply-coupon-btn').prop('disabled', false);
                updateColumnValue(response.data.cartTotal);
            })
            .catch(error => {
                $('.action-button').prop('disabled', false);
                $('.btn-checkout').prop('disabled', false);
                $('#apply-coupon-btn').prop('disabled', false);
                showSwal('Fail!', error.response.data.msg);
            });
        })
    })
</script>
@endpush