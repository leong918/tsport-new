@extends('web.layout.app')
@section('content')
<div id="my-acc" class="margin-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="forgot-password-title">My Account</div>
                <div class="nav-acc"><a href="#">Home</a> > <a href="#"> My Account </a> > <a href="#"> Account Details </a></div>
            </div>
            @include('web.account.account_nav')
            <div class="col-xl-9 col-12">
                <div class="forgot-password-wrapper">
                    <div class="forgot-password-container">
                        <div class="title">
                            Membership: {{ $user->level->name }}
                        </div>
                        <div class="title">
                            Account Details
                        </div>
                        {{ html()->model($user)->form('PUT', route("account.updateUser", ["id" => $user->id]))->id('update_user_form')->open() }}
                        <div class="all-form-wrap">
                            <div class="row">
                                 <div class="col-6">
                                    <div class="form-wrapper">
                                        <div class="input-container">
                                            {{ html()->text('last_name')->placeholder('Enter last name')->class('disabled-txt')->required() }}
                                            {{ html()->label('Last Name *')->class('placeholder-label') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-wrapper">
                                        <div class="input-container">
                                            {{ html()->text('first_name')->placeholder('Enter first name')->class('disabled-txt')->required() }}
                                            {{ html()->label('First Name *')->class('placeholder-label') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->text('username')->placeholder('Enter username')->class('disabled-txt')->required() }}
                                    {{ html()->label('Display Name *')->class('placeholder-label') }}
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->email('email')->placeholder('Enter email')->class('disabled-txt')->attributes(['readonly' => true])->required() }}
                                    {{ html()->label('Email')->class('placeholder-label') }}
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->number('phone_no')->placeholder('Enter phone no')->class('disabled-txt')->attributes(['readonly' => true])->required() }}
                                    {{ html()->label('Phone No.')->class('placeholder-label') }}
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->hidden('birth_month')->placeholder('')->id('birth-month')->required() }}
                                    {{ html()->text()->class('disabled-txt birth-input')->value($user->birth_month)->attributes(['readonly' => true])->required() }}
                                    {{ html()->label('Birth month')->class('placeholder-label') }}
                                </div>
                            </div>
                            <div class="title">
                                Password Change
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->password('current_password')->placeholder('')->class('')}}
                                    {{ html()->label('Current Password')->class('placeholder-label') }}
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->password('password')->placeholder('')->class('') }}
                                    {{ html()->label('New Password')->class('placeholder-label') }}
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    {{ html()->password('password_confirmation')->placeholder('')->class('') }}
                                    {{ html()->label('Confirm New Password')->class('placeholder-label') }}
                                </div>
                            </div>
                        </div>
                        <div class="button-wrapper">
                            <button type="submit" class="login-button">SAVE CHANGE</button>
                        </div>
                        {{ html()->form()->close() }}
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
        var parentElement = document.getElementsByClassName('forgot-password-container')[0];
        $("#update_user_form").submit(function(e) {
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
                swal.fire({
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
                            swal.close();
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
                swal.fire({
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
                            swal.close();
                        });
                    }
                })

                $(this).find('button[type="submit"]').removeAttr('disabled')
            });
        });
    });
</script>
@endpush