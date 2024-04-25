@extends('admin.layout.app')

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <x-alert />
                <div class="row">
                    <div class="col-sm-6">
                        {{ html()->model($setting_model)->form('POST', route('admin.setting.updateGlobalSetting.post'))->acceptsFiles()->open() }}
                        <div class="card mb-3">
                            <div class="card-header"><strong>Global Setting</strong></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    {{ html()->label('Point Redemption Ratio (1 Point : $ XX)') }}
                                    {{ html()->text('point_redemption_ratio')->placeholder('Enter Point Redemption Ratio')->class('form-control')->required() }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Point Earned By Review') }}
                                    {{ html()->text('review_point')->placeholder('Enter Point Earned By Review')->class('form-control')->required() }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('New Order Email Image') }}
                                    {{ html()->file('new_order_email_image')->accept('image/*')->class('form-control') }}
                                    <br>
                                    @if(isset($setting_model['new_order_email_image']) && $setting_model['new_order_email_image'] != null)
                                        <img class="img-fluid" src="{{ $setting_model['new_order_email_image'] }}" />
                                    @else
                                        <span>No image</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Order Received Email Image') }}
                                    {{ html()->file('order_received_email_image')->accept('image/*')->class('form-control') }}
                                    <br>
                                    @if(isset($setting_model['order_received_email_image']) && $setting_model['order_received_email_image'] != null)
                                        <img class="img-fluid" src="{{ $setting_model['order_received_email_image'] }}" />
                                    @else
                                        <span>No image</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Tracking Number Email Image') }}
                                    {{ html()->file('tracking_number_email_image')->accept('image/*')->class('form-control') }}
                                    <br>
                                    @if(isset($setting_model['tracking_number_email_image']) && $setting_model['tracking_number_email_image'] != null)
                                        <img class="img-fluid" src="{{ $setting_model['tracking_number_email_image'] }}" />
                                    @else
                                        <span>No image</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Shipping Fee Email Image') }}
                                    {{ html()->file('shipping_fee_email_image')->accept('image/*')->class('form-control') }}
                                    <br>
                                    @if(isset($setting_model['shipping_fee_email_image']) && $setting_model['shipping_fee_email_image'] != null)
                                        <img class="img-fluid" src="{{ $setting_model['shipping_fee_email_image'] }}" />
                                    @else
                                        <span>No image</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Sales Order Status Email Image') }}
                                    {{ html()->file('sales_order_status_image')->accept('image/*')->class('form-control') }}
                                    <br>
                                    @if(isset($setting_model['sales_order_status_image']) && $setting_model['sales_order_status_image'] != null)
                                        <img class="img-fluid" src="{{ $setting_model['sales_order_status_image'] }}" />
                                    @else
                                        <span>No image</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Customer Note Email Image') }}
                                    {{ html()->file('customer_note_email_image')->accept('image/*')->class('form-control') }}
                                    <br>
                                    @if(isset($setting_model['customer_note_email_image']) && $setting_model['customer_note_email_image'] != null)
                                        <img class="img-fluid" src="{{ $setting_model['customer_note_email_image'] }}" />
                                    @else
                                        <span>No image</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Shopping Cart Banner') }}
                                    {{ html()->file('shopping_cart_banner')->accept('image/*')->class('form-control') }}
                                    <br>
                                    @if(isset($setting_model['shopping_cart_banner']) && $setting_model['shopping_cart_banner'] != null)
                                        <img class="img-fluid" src="{{ $setting_model['shopping_cart_banner'] }}" />
                                    @else
                                        <span>No image</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Shopping Cart Banner Product') }}
                                    <select class="form-select" id="shopping-cart-banner-product-select"
                                        name="shopping_cart_banner_product" data-placeholder="Choose product" required>
                                        @foreach ($productDropdown as $product_id => $product_name)
                                            @php
                                                $isSelected = isset($setting_model['shopping_cart_banner_product']) && $setting_model['shopping_cart_banner_product'] == $product_id;
                                            @endphp
                                            <option value="{{ $product_id }}" {{ $isSelected ? 'selected' : '' }}>
                                                {{ $product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                    <div class="col-sm-6">
                        {{ html()->model($setting_model)->form('POST', route('admin.setting.updateGlobalSetting.post'))->open() }}
                        <div class="card mb-3">
                            <div class="card-header"><strong>Sender Details</strong></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    {{ html()->label('First Name') }}
                                    {{ html()->text('sender_first_name')->placeholder('Enter Sender First Name')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Last Name') }}
                                    {{ html()->text('sender_last_name')->placeholder('Enter Sender Last Name')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Phone No') }}
                                    {{ html()->text('sender_phone_no')->placeholder('Enter Sender Phone No')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Address') }}
                                    {{ html()->text('sender_address')->placeholder('Enter Sender Address')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('City') }}
                                    {{ html()->text('sender_city')->placeholder('Enter Sender City')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('State') }}
                                    {{ html()->text('sender_state')->placeholder('Enter Sender State')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Country') }}
                                    <select name="sender_country" class="form-control">                         
                                        @foreach($countryDropdown as $key => $country)
                                            <option value="{{ $key }}" {{ isset($setting_model['sender_country']) && $key == $setting_model['sender_country'] ? 'selected' : '' }}>{{ $country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Postcode') }}
                                    {{ html()->text('sender_postcode')->placeholder('Enter Sender Postcode')->class('form-control') }}
                                </div>
                                <div class="mb-3">
                                    {{ html()->label('Email') }}
                                    {{ html()->text('sender_email')->placeholder('Enter Sender Email')->class('form-control') }}
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
@parent
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function() {
        $('#shopping-cart-banner-product-select').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            allowClear: true,
        });
    });
</script>
@endsection