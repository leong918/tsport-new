@extends('web.layout.app')
@section('content')
<div id="register" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="register-wrapper">
                <div class="register-title">Create Account</div>
                {{ html()->form('POST', route("web.doRegister"))->id('register_form')->open()}}
                <div class="register-container">
                    <div>
                        <div class="mb-40 input-container">
                            {{ html()->text('first_name')->placeholder('')->class('')->required() }}
                            <label class="placeholder-label">First Name *</label>
                        </div>
                        <div class="mb-40 input-container">
                            {{ html()->text('last_name')->placeholder('')->class('')->required() }}
                            <label class="placeholder-label">Last Name *</label>
                        </div>
                        <div class="mb-20 input-container">
                            {{ html()->email('email')->placeholder('')->class('')->required() }}
                            <label class="placeholder-label">Email *</label>
                            <div class="input-desc">cannot be changed after becoming a member</div>
                        </div>
                        <div class="mb-20 input-container">
                            {{ html()->number('phone_no')->placeholder('')->class('')->required() }}
                            <label class="placeholder-label">Phone no. *</label>
                            <div class="input-desc">cannot be changed after becoming a member</div>
                        </div>
                        <div class="mb-20 input-container dropdown">
                            {{ html()->hidden('birth_month')->placeholder('')->id('birth-month')->required() }}
                            <input type="text" placeholder=" " class="birth-input" required readonly/>
                            <ul id="month-dropdown">
                                <li>January</li>
                                <li>February</li>
                                <li>March</li>
                                <li>April</li>
                                <li>May</li>
                                <li>June</li>
                                <li>July</li>
                                <li>August</li>
                                <li>September</li>
                                <li>October</li>
                                <li>November</li>
                                <li>December</li>
                            </ul>
                            <label class="placeholder-label" required>Birth Month *</label>
                            <div class="input-desc">cannot be changed after becoming a member</div>
                        </div>
                        <div class="mb-40 input-container">
                            {{ html()->password('password')->placeholder('')->class('')->required() }}
                            <label class="placeholder-label">Password *</label>
                        </div>
                        <div class="mb-40 input-container">
                            {{ html()->password('password_confirmation')->placeholder('')->class('')->required() }}
                            <label class="placeholder-label">Confirm Password *</label>
                        </div>
                        <div class="mb-40 input-container">
                            {{ html()->email('referral_email')->placeholder('')->class('') }}
                            <label class="placeholder-label">Referrer email</label>
                        </div>
                        <div class="mb-40 input-container">
                            {{ html()->text('referral_phone_no')->placeholder('')->class('') }}
                            <label class="placeholder-label">Referrer phone no.</label>
                        </div>
                        <div class="tnc-wrapper">
                            <div class="tnc-desc">Your personal data will be used to support your experience throughout this website, 
                                to manage access to your account , and for other purposes described in our privacy policy.
                            </div>
                            <div class="tnc">
                                <label class="container">*Please accept our Terms & Conditions
                                    {{ html()->checkbox('accept_tnc')->placeholder('')->class('')->required() }}
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="register-button">CREATE ACCOUNT</button>
                    </div>
                </div>
                {{ html()->form()->close() }}
                <div class="login-wrapper">
                    <div class="login-desc">Already have an account?</div>
                    <div class="d-flex justify-content-center">
                        <a class="login-button" href="{{route('web.login')}}">LOGIN</a>
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
        $('.input-container input.birth-input').focus(function() {
            $('#month-dropdown').addClass('visible');
        });
    
        $("#month-dropdown li").click(function() {
            $('#birth-month').val($(this).text());
            $('.birth-input').val($(this).text());
           $('#month-dropdown').removeClass('visible');
        });
        
        $('.input-container input.birth-input').on('blur', function() {
            setTimeout(function() {
                if (!$('.input-container input.birth-input').is(':focus') && !$('#month-dropdown').is(':focus')) {
                    $('#month-dropdown').removeClass('visible');
                }
            }, 100);
        });
        
        var parentElement = document.getElementsByClassName('register-container')[0];
        $("#register_form").submit(function(e) {
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
                    title: '<button type="button" id="custom-close-button"></button><p class="swal-register-title">Thank you for <br>your registration</p>',
                    html: '<p class="swal-register-content-1">We have sent email to ' + response.data.email + ' to confirm the validity of our email address. After receiving the email follow the link provided to complete you registration.</p><p class="swal-register-content-2">If you not got any mail <b>RESEND</b> confirmation mail</p>',
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
                    window.location.href = "{{ route('web.login') }}";
                });
            })
            .catch(error => {
                let errorMessage = '';
                if (typeof error.response.data.msg === 'object') {
                    Object.keys(error.response.data.msg).forEach(key => {
                            errorMessage += `${error.response.data.msg[key]}<br>`;
                    });
                } else if (error.response.data.msg){
                    errorMessage = error.response.data.msg;
                } else if(error.response.data.error){
                    errorMessage = error.response.data.error;
                }
                swal.fire({
                    title: '<button type="button" id="custom-close-button"></button><p class="swal-register-title">Failed to Register</p>',
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