@extends('web.layout.app')
@section('content')
<div id="my-addr" class="margin-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="forgot-password-title">My Account</div>
                <div class="nav-acc"><a href="#">Home</a> > <a href="#"> My Account </a> > <a href="#"> Addresses </a></div>
                <div>

                </div>
            </div>
            @include('web.account.account_nav')
            <div class="col-xl-9 col-12">
                <div class="forgot-password-wrapper">
                    <div class="forgot-password-container">
                        <div class="title">
                            Shipping Address
                        </div>
                        <div class="titlev2">
                            Contacts
                        </div>
                        <div class="all-form-wrap">
                            {{ html()->model($user)->form('PUT', route("account.updateAddress", ["id" => $user->id]))->id('update_user_address_form')->open() }}
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-wrapper">
                                        <div class="input-container">
                                            {{ html()->text('address_first_name')->class('disabled-txt')->required() }}
                                            {{ html()->label('First Name *')->class('placeholder-label') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-wrapper">
                                        <div class="input-container">
                                            {{ html()->text('address_last_name')->class('disabled-txt')->required() }}
                                            {{ html()->label('Last Name *')->class('placeholder-label') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <div class="input-container">
                                        {{ html()->text('company_name')->class('disabled-txt')->required() }}
                                        {{ html()->label('Company Name (optional)')->class('placeholder-label') }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->text('address_phone_no')->class('disabled-txt')->required() }}
                                    {{ html()->label('Phone No *')->class('placeholder-label') }}
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->email('address_email')->class('disabled-txt')->required() }}
                                    {{ html()->label('Email *')->class('placeholder-label') }}
                                </div>
                            </div>
                            <div class="titlev2">
                                Address
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container dropdown">
                                    {{ html()->hidden('country_id')->placeholder('')->id('country-id')->required() }}
                                    {{ html()->text()->class('disabled-txt country-input')->value($user->country)->attributes(['readonly' => true])->required() }}
                                    <ul id="country-dropdown">
                                        @foreach($countryDropdown as $key => $value)
                                        <li data-country-id = {{ $key }}>{{ $value }}</li>
                                        @endforeach
                                    </ul>
                                    {{ html()->label('Country / Region *')->class('placeholder-label') }}
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->text('state')->class('disabled-txt')->required() }}
                                    {{ html()->label('Region *')->class('placeholder-label') }}
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->text('city')->class('disabled-txt')->required() }}
                                    {{ html()->label('Town / City *')->class('placeholder-label') }}
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->text('postcode')->class('disabled-txt')->required() }}
                                    {{ html()->label('Postal Code *')->class('placeholder-label') }}
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->text('address')->class('disabled-txt')->required() }}
                                    {{ html()->label('Street Address *')->class('placeholder-label') }}
                                </div>
                            </div>
                        </div>
                        <div class="button-wrapper">
                            <button type="submit" class="login-button">SAVE ADDRESS</button>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.input-container input.country-input').focus(function() {
            $('#country-dropdown').addClass('visible');
        });
    
        $("#country-dropdown li").click(function() {
            $('#country-id').val($(this).data('country-id'));
            $('.country-input').val($(this).text());
           $('#country-dropdown').removeClass('visible');
        });
        
        $('.input-container input.country-input').on('blur', function() {
            setTimeout(function() {
                if (!$('.input-container input.country-input').is(':focus') && !$('#country-dropdown').is(':focus')) {
                    $('#country-dropdown').removeClass('visible');
                }
            }, 100);
        });

        var parentElement = document.getElementsByClassName('forgot-password-container')[0];
        $("#update_user_address_form").submit(function(e) {
            $(this).find('button[type="submit"]').attr('disabled','disabled');

            e.preventDefault();

            var url = $(this).attr('action');
            let formData = new FormData(this);


            axios({
                method: "post",
                url: url,
                data: formData,
            })
            .then(response => {
                Swal.fire({
                    title: '<button type="button" id="custom-close-button"></button><p class="swal-register-title">Success</p>',
                    html: '<p class="swal-register-content-1">User Info Edited Successfully</p>',
                    showConfirmButton: false,
                    backdrop: false,
                    customClass: {
                        container: 'custom-register-swal'
                    },
                    didOpen: () => {
                        // Set the width of the SweetAlert dialog to match its parent container
                        var parentWidth = parentElement.offsetWidth;
                        var swalDialog = document.querySelector('.swal2-popup');
                        swalDialog.style.width = parentWidth + 'px';

                        $('#custom-close-button').click(function() {
                            Swal.close();
                        });
                    }
                }).then((result) => {
                    window.location.href = "{{ route('web.home') }}";
                });
            })
            .catch(error => {
                let errorMessage = '';
                if (typeof error.response.data.msg === 'object') {
                    Object.keys(error.response.data.msg).forEach(key => {
                            errorMessage += `${error.response.data.msg[key]}<br>`;
                    });
                } else if(error.response.data.msg){
                    errorMessage = error.response.data.msg;
                } else if(error.response.data.message){
                    errorMessage = error.response.data.message;
                }
                Swal.fire({
                    title: '<button type="button" id="custom-close-button"></button><p class="swal-register-title">Error</p>',
                    html: '<p class="swal-register-content-1">' + errorMessage + '</p>',
                    showConfirmButton: false,
                    backdrop: false,
                    customClass: {
                        container: 'custom-register-swal'
                    },
                    didOpen: () => {
                        // Set the width of the SweetAlert dialog to match its parent container
                        var parentWidth = parentElement.offsetWidth;
                        var swalDialog = document.querySelector('.swal2-popup');
                        swalDialog.style.width = parentWidth + 'px';

                        $('#custom-close-button').click(function() {
                            Swal.close();
                        });
                    }
                })

                $(this).find('button[type="submit"]').removeAttr('disabled')
            });
        });
    });
</script>
@endpush