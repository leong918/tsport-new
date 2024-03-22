@extends('web.layout.app')
@section('content')
<div id="payment" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="payment-wrapper">
                <div class="payment-title">Payment Method</div>
                {{ html()->form()->id('payment-form')->open()}}
                    <div class="row justify-content-center payment-content">
                        <div class="col-md-12 col-lg-8 payment-details">
                            <div class="payment-details-wrapper">
                                <div class="payment-details-title">Choose Your Payment Method</div>
                                <div class="d-md-flex justify-content-center justify-content-md-start payment-method-wrapper">
                                    <div class="payment-method-selector">
                                        <input type="radio" id="option1" name="payment-method" value="stripe" checked data-toggle="stripe-section">
                                        <label for="option1">CREDIT CARD (STRIPE)</label>
                                    </div>
                                    <div class="payment-method-selector">
                                        <input type="radio" id="option2" name="payment-method" value="alipay" data-toggle="alipay-section">
                                        <label for="option2">ALIPAY HK</label>
                                    </div>
                                    <div class="payment-method-selector">
                                        <input type="radio" id="option3" name="payment-method" value="fps" data-toggle="fps-section">
                                        <label for="option3">DIRECT BANK TRANSFER (FPS)</label>
                                    </div>
                                </div>
                                <div class="stripe-section payment-section">
                                    <div class="payment-desc">
                                        使用信用卡付款後，如果真面出現"Bad/Wrong/Error Gateway"字眼，而購物車亦已清空，
                                        請立即向我們查詢是否已成功透過信用卡付款，切勿自行再次下單付款，以免造成二次過數交易的情況。
                                        如有重複下單，恕我們只能扣減Stripe約2.5%手續費後才會安排退款。
                                    </div>
                                    <div id="payment-element" data-code="{{ $intentSecret }}"></div>
                                </div>
                                <div class="alipay-section payment-section d-none">
                                    <div class="payment-desc">
                                        Make your payment directly into our Alipay HK account or bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                        <br/><br/>
                                        Please note that only one payment method is accepted for one order. If your order exceeds the amount of the consumption voucher, please top up your Alipay HK account OR link your bank account / credit card to your account first. We do not accept more than one payment method for an order.
                                        <br/><br/>
                                        由於AlipayHK對每一次收款所設定的上限為HK$5000，如客人的訂單金額超過HK$5000而選擇使用AlipayHK付款，請先付$5000，然後再付餘額。如有疑問，請whatsapp 54425298查詢。
                                    </div>
                                </div>
                                <div class="fps-section payment-section d-none"></div>
                                <div class="personal-data">
                                    Your personal data will be used to process your order, 
                                    support your experience throughout this website, and for other purposes described in our <span class="bold-text">"Privacy Policy"</span>
                                </div>
                                <div class="tnc">
                                    <label class="container">I have read and agree to the website <span class="bold-text">"Terms & Conditions"</span>.
                                        <input type="checkbox" name="tnc" id="tnc" required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 mt-lg-0 col-md-12 col-lg-4">
                            <div class="order-summary">
                                <div class="order-summary-title">Order Summary</div>
                                <div class="subtotal">
                                    <div class="d-flex justify-content-between data-content-wrapper">
                                        <div class="label">Subtotal</div>
                                        <div class="data-label">
                                            <div class="price">$980</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="discount">
                                    <div class="label">Discount</div>
                                    <div class="d-flex justify-content-between data-content-wrapper">
                                        <div class="inner-label">Member discount</div>
                                        <div class="data-label">
                                            <div class="price">-$49</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="coupon">
                                    <div class="label">Coupon</div>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex justify-content-between data-content-wrapper">
                                            <div class="inner-label">IOTH-JM-VO-D12</div>
                                            <div class="data-label">
                                                <div class="price">-$98</div>
                                            </div>
                                        </div>
                                        <div class="btn-remove-wrapper"><button class="remove-button">remove</button></div>
                                    </div>
                                </div>
                                <div class="point-redemption">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex justify-content-between data-content-wrapper">
                                            <div class="label">Point redemption</div>
                                            <div class="data-label">
                                                <div class="price">$10</div>
                                            </div>
                                        </div>
                                        <div class="btn-remove-wrapper"><button class="remove-button">remove</button></div>
                                    </div>
                                </div>
                                <div class="shipping-fee">
                                    <div class="d-flex justify-content-between data-content-wrapper">
                                        <div class="label">Shipping Fee</div>
                                        <div class="data-label">
                                            <div class="price">SF EXPRESS : $30</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="shipping-fee-inner">
                                    <div class="data-content-wrapper">
                                        <div class="inner-label">Shipping To:</div>
                                        <div class="inner-label">
                                            {{ $address['address'].', '.$address['postcode'].', '.$address['city'].', '.$address['state'].', '.$address['country'] }}
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="total">
                                    <div class="d-flex justify-content-between data-content-wrapper">
                                        <div class="label">Total</div>
                                        <div class="data-label">
                                            <div class="price">$853</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="payment">
                                    <button id="payment-button" data-return-url="{{ route('cart.complete') }}">Complete Payment</button>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <a href="{{ route('cart.checkout') }}">Back To Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function() {
        const stripe = Stripe("{{ env('STRIPE_PUBISHABLE_KEY') }}");
        const paymentElementOptions = {
            layout: "tabs",
        };

        let elements = stripe.elements($('#payment-element').data('code'));
        const paymentElement = elements.create("payment", paymentElementOptions);
        paymentElement.mount("#payment-element");

        $('input[name="payment-method"]').on('change', function() {
            var selected_section = $('input[name="payment-method"]:checked').data('toggle');
            $('.payment-section').addClass('d-none');
            $('.' + selected_section).removeClass('d-none');
        })

        $('.text-input').focus(function() {
            $(this).parent().parent().children('.text-input-label').addClass('active-color');
        }).blur(function() {
            $(this).parent().parent().children('.text-input-label').removeClass('active-color');
        });

        $('#payment-button').on('click', function(e) {
            e.preventDefault();

            if (!$('#tnc').is(":checked")) {
                showSwal('error', 'Fail!', 'Please tick the T&C checkbox to proceed!');
            } else {
                $(this).attr('disabled', true);
                var payment_method = $('input[name="payment-method"]:checked').val();

                axios({
                    method: "post",
                    url: "{{ route('cart.create_order') }}",
                    data: {
                        payment_method: payment_method,
                        stripe_payment_intent_id: $('#payment-element').data('code'),
                        cart_total: "{{ json_encode($cartTotal) }}"
                    }
                })
                .then(response => {
                    if (response.data.order.payment_method === 'stripe') {
                        const { error } = stripe.confirmPayment({
                            elements,
                            confirmParams: {
                                return_url: $(this).data('return-url') + '?order_id=' + response.data.order.sales_order_id,
                            },
                        });

                        if (error.type === "card_error" || error.type === "validation_error") {
                            showSwal('error', 'Fail!', error.message);
                        } else {
                            showSwal('error', 'Fail!', 'An unexpected error occurred.');
                        }
                    } else {
                        window.location.replace("{{ route('cart.complete') }}" + "?order_id=" + response.data.order.sales_order_id);
                    }
                })
                .catch(error => {
                    if (error.redirect == true) {
                        window.location.reload();
                    } else {
                        $(this).attr('disabled', false);
                        showSwal('error', 'Fail!', error.msg);
                    }
                });
            }
        })
    });
  </script>
@endpush
