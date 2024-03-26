@extends('web.layout.app')
@section('content')
<div id="checkout" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="checkout-wrapper">
                <div class="checkout-title">Checkout</div>
                {{ html()->form('POST', route("cart.process_checkout"))->open()}}
                    <div class="row justify-content-center checkout-content">
                        <div class="col-md-12 col-lg-8 checkout-details">
                            <div class="shipping-details-wrapper">
                                <div class="shipping-details-title">Shipping Details</div>
                                <div class="shipping-details-container">
                                    <div class="contacts-container">
                                        <div class="contacts-title">Contacts</div>
                                        <div class="mb-40 d-flex justify-content-between gap-5">
                                            <div class="input-container" style="width:47%">
                                                {{ html()->text('last_name')->placeholder('')->value(old('last_name', $addressData['last_name']))->required() }}
                                                <label class="placeholder-label">Last Name</label>
                                            </div>
                                            <div class="input-container" style="width:47%">
                                                {{ html()->text('first_name')->placeholder('')->value(old('first_name', $addressData['first_name']))->required() }}
                                                <label class="placeholder-label">First Name</label>
                                            </div>
                                        </div>
                                        <div class="mb-40 d-flex justify-content-between">
                                            <div class="input-container col-12">
                                                {{ html()->text('company_name')->placeholder('')->value(old('company_name', $addressData['company_name'])) }}
                                                <label class="placeholder-label">Company Name (optional)</label>
                                            </div>
                                        </div>
                                        <div class="mb-40 d-flex justify-content-between">
                                            <div class="input-container col-12">
                                                {{ html()->text('phone_no')->placeholder('')->value(old('phone_no', $addressData['phone_no']))->required() }}
                                                <label class="placeholder-label">Phone no.</label>
                                            </div>
                                        </div>
                                        <div class="mb-40 d-flex justify-content-between">
                                            <div class="input-container col-12">
                                                {{ html()->email('email')->placeholder('')->value(old('email', $addressData['email']))->required() }}
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
                                                {{ html()->hidden('country_id')->value(old('country_id', $addressData['country_id']))->required() }}
                                                {{ html()->text('country')->placeholder('')->class('address-input')->value(old('country', $addressData['country']))->required()->isReadonly() }}
                                                <ul id="country-dropdown">
                                                    @foreach($countryList as $country)
                                                    <li data-value="{{ $country->id }}">{{ $country->name }}</li>
                                                    @endforeach
                                                </ul>
                                                <label class="placeholder-label">Country / Region</label>
                                            </div>
                                            <div class="input-container" style="width:47%">
                                                {{ html()->text('postcode')->placeholder('')->class('address-input')->value(old('postcode', $addressData['postcode']))->required() }}
                                                <label class="placeholder-label">Postcode / ZIP</label>
                                            </div>
                                        </div>
                                        <div class="mb-40 d-flex justify-content-between">
                                            <div class="input-container col-12">
                                                {{ html()->text('state')->placeholder('')->class('address-input')->value(old('state', $addressData['state']))->required() }}
                                                <label class="placeholder-label">Region</label>
                                            </div>
                                        </div>
                                        <div class="mb-40 d-flex justify-content-between">
                                            <div class="input-container col-12">
                                                {{ html()->text('city')->placeholder('')->class('address-input')->value(old('city', $addressData['city']))->required() }}
                                                <label class="placeholder-label">Town / City</label>
                                            </div>
                                        </div>
                                        <div class="mb-40 d-flex justify-content-between">
                                            <div class="input-container col-12">
                                                {{ html()->text('address')->placeholder('')->class('address-input')->value(old('address', $addressData['address']))->required() }}
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
                                @include('sales_order::web.cart.total')
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
    $('.input-container input#country').focus(function() {
        $('#country-dropdown').addClass('visible');
    });

    $("#country-dropdown li").click(function() {
        console.log($(this).text());
        $('#country').val($(this).text());
        $('#country_id').val($(this).data('value'));
        $('#country-dropdown').removeClass('visible');
        $('#country').trigger('paste');
    });
    
    $('.input-container input#country').on('blur', function() {
        setTimeout(function() {
            if (!$('.input-container input#country').is(':focus') && !$('#country-dropdown').is(':focus')) {
                $('#country-dropdown').removeClass('visible');
            }
        }, 100);
    });

    $('.address-input').on('change paste keyup', function () {
        var address = $('#address').val();
        var city = $('#city').val();
        var state = $('#state').val();
        var postcode = $('#postcode').val();
        var country = $('#country').val();

        $('#shipping_address').html(address + ', ' + postcode + ', ' + city + ', ' + state + ', ' + country);
    })
}); 
</script>
@endpush