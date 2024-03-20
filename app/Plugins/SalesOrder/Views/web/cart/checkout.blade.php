@extends('web.layout.app')
@section('content')
<div id="checkout" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="checkout-wrapper">
                <div class="checkout-title">Checkout</div>
                {{ html()->form('POST', route("web.doRegister"))->id('register_form')->open()}}
                    <div class="row justify-content-center checkout-content">
                        <div class="col-md-12 col-lg-8 checkout-details">
                            <div class="shipping-details-wrapper">
                                <div class="shipping-details-title">Shipping Details</div>
                                <div class="shipping-details-container">
                                    <div class="contacts-container">
                                        <div class="contacts-title">Contacts</div>
                                        <div class="mb-40 d-flex justify-content-between gap-5">
                                            <div class="input-container" style="width:47%">
                                                {{ html()->text('last_name')->placeholder('')->class('')->required() }}
                                                <label class="placeholder-label">Last Name</label>
                                            </div>
                                            <div class="input-container" style="width:47%">
                                                {{ html()->text('first_name')->placeholder('')->class('')->required() }}
                                                <label class="placeholder-label">First Name</label>
                                            </div>
                                        </div>
                                        <div class="mb-40 d-flex justify-content-between">
                                            <div class="input-container col-12">
                                                {{ html()->text('company_name')->placeholder('')->class('') }}
                                                <label class="placeholder-label">Company Name (optional)</label>
                                            </div>
                                        </div>
                                        <div class="mb-40 d-flex justify-content-between">
                                            <div class="input-container col-12">
                                                {{ html()->text('phone_no')->placeholder('')->class('')->required() }}
                                                <label class="placeholder-label">Phone no.</label>
                                            </div>
                                        </div>
                                        <div class="mb-40 d-flex justify-content-between">
                                            <div class="input-container col-12">
                                                {{ html()->email('email')->placeholder('')->class('')->required() }}
                                                <label class="placeholder-label">Email</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="shipping-address-container">
                                    <div class="address-container">
                                        <div class="address-title">Shipping Address</div>
                                        <div class="mb-40 d-flex justify-content-between gap-5">
                                            <div class="input-container" style="width:47%">
                                                <input type="text" placeholder=" " required/>
                                                <label class="placeholder-label">Country / Region</label>
                                            </div>
                                            <div class="input-container" style="width:47%">
                                                {{ html()->text('postcode')->placeholder('')->class('')->required() }}
                                                <label class="placeholder-label">Postcode / ZIP</label>
                                            </div>
                                        </div>
                                        <div class="mb-40 d-flex justify-content-between">
                                            <div class="input-container col-12">
                                                {{ html()->text('state')->placeholder('')->class('')->required() }}
                                                <label class="placeholder-label">Region</label>
                                            </div>
                                        </div>
                                        <div class="mb-40 d-flex justify-content-between">
                                            <div class="input-container col-12">
                                                {{ html()->text('city')->placeholder('')->class('')->required() }}
                                                <label class="placeholder-label">Town / City</label>
                                            </div>
                                        </div>
                                        <div class="mb-40 d-flex justify-content-between">
                                            <div class="input-container col-12">
                                                {{ html()->text('address')->placeholder('')->class('')->required() }}
                                                <label class="placeholder-label">Street Address</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="different-address-container">
                                    <label class="container">*Ship to a different address
                                        <input type="checkbox" name="checkbox" id="shipping-checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> --}}
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
                                    <button type="submit">Payment</button>
                                </div>
                                <div class="back-shopping-cart">
                                    <a href="{{ route('cart.shopping_cart') }}">Back To Shopping Cart</a>
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
<script>
$(document).ready(function() {
    $('#shipping-checkbox').change(function() {
        var isChecked = $(this).is(':checked');
        var details = document.getElementsByClassName('shipping-details-container');
        var address = document.getElementsByClassName('shipping-address-container');
        if(isChecked){
            var contact_content = details[0].outerHTML;
            var address_content = address[0].outerHTML;
            $(this).parents('.shipping-details-wrapper').append(contact_content,address_content);
        }else{
            if(details.length > 0 && address.length > 0){
                var last_details = details[details.length - 1];
                var last_address = address[address.length - 1];

                last_details.parentNode.removeChild(last_details);
                last_address.parentNode.removeChild(last_address);
            }
        }
    })
}); 
</script>
@endpush