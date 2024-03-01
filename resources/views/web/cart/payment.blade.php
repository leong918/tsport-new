@extends('web.layout.app')
@section('content')
<div id="payment" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="payment-wrapper">
                <div class="payment-title">Payment Method</div>
                <div class="row justify-content-center payment-content">
                    <div class="col-md-12 col-lg-8 payment-details">
                        <div class="payment-details-wrapper">
                            <div class="payment-details-title">Choose Your Payment Method</div>
                            <div class="d-md-flex justify-content-center justify-content-md-start payment-method-wrapper">
                                <div class="payment-method-selector">
                                    <input type="radio" id="option1" name="paymet-method" value="credit_card" checked>
                                    <label for="option1">CREDIT CARD (STRIPE)</label>
                                </div>
                                <div class="payment-method-selector">
                                    <input type="radio" id="option2" name="paymet-method" value="alipay">
                                    <label for="option2">ALIPAY HK</label>
                                </div>
                                <div class="payment-method-selector">
                                    <input type="radio" id="option3" name="paymet-method" value="fps">
                                    <label for="option3">DIRECT BANK TRANSFER (FPS)</label>
                                </div>
                            </div>
                            <div class="payment-desc">
                                使用信用卡付款後，如果真面出現"Bad/Wrong/Error Gateway"字眼，而購物車亦已清空，
                                請立即向我們查詢是否已成功透過信用卡付款，切勿自行再次下單付款，以免造成二次過數交易的情況。
                                如有重複下單，恕我們只能扣減Suripe約2.5%手續費後才會安排退款。
                            </div>
                            <div class="payment-container">
                                <div>
                                    <div class="text-input-label 123">Card number</div>
                                    <div><input type="text" class="text-input" placeholder="1111 2222 3333 4444"/></div>
                                </div>
                                <div class="d-flex justify-content-between gap-5">
                                    <div style="width:47%;">
                                        <div class="text-input-label">Expiry date</div>
                                        <div><input type="text" class="text-input" placeholder="mm/yy"/></div>
                                    </div>
                                    <div style="width:47%;">
                                        <div class="text-input-label">Card code (cvc)</div>
                                        <div><input type="text" class="text-input" placeholder="cvc"/></div>
                                    </div>
                                </div>
                            </div>
                            <div class="save-payment">
                                <!-- <div class="checkbox-input"><input type="checkbox" required/></div>
                                <div class="checkbox-desc">Save payment information to my account for future purchases.</div> -->
                                <label class="container">Save payment information to my account for future purchases.
                                    <input type="checkbox" name="checkbox" required>
                                    <span class="checkmark"></span>
                                </label>
                            </div>  
                            <div class="personal-data">
                                Your personal data will be used to process your order, 
                                support your experience throughout this website, and for other purposes described in our <span class="bold-text">"Privacy Policy"</span>
                            </div>
                            <div class="tnc">
                                <label class="container">I have read and agree to the website <span class="bold-text">"Terms & Conditions"</span>.
                                    <input type="checkbox" name="checkbox" required>
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
                                    <div class="price">SF EXPRESS:$30</div>
                                </div>
                            </div>
                        </div>
                        <div class="shipping-fee-inner">
                            <div class="data-content-wrapper">
                                <div class="inner-label">Shipping To:</div>
                                <div class="inner-label">
                                    ABC XXXXXXXXXX HONG KONG ISLAND.
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="total">
                            <div class="d-flex justify-content-between data-content-wrapper">
                                <div class="label">Total</div>
                                    <div class="data-label">
                                    <div class="price">$980</div>
                                </div>
                            </div>
                        </div>
                        <div class="payment">
                            <button>Complete Payment</button>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <a href="#">Back To Checkout</a>
                        </div>
                        </div>
                    </div>
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
      $('.text-input').focus(function() {
        $(this).parent().parent().children('.text-input-label').addClass('active-color');
      }).blur(function() {
        $(this).parent().parent().children('.text-input-label').removeClass('active-color');
      });
    });
  </script>
@endpush
