@extends('web.layout.app')
@section('content')
<div id="forgot-password" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="forgot-password-wrapper">
                <div class="forgot-password-title">Forgot Password</div>
                {{ html()->form('POST', route("web.do_forgot_password"))->acceptsFiles()->id('forgotPassword')->open()  }}
                <div class="forgot-password-container">
                    <div>
                        <div class="input-container">
                            {{ html()->email('email')->placeholder('')->class('')->required() }}
                            <label class="placeholder-label">Email</label>
                        </div>
                        <div class="email-desc">enter your email to reset your password</div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="login-button" type="submit">RESET YOUR PASSWORD</button>
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
        var parentElement = document.getElementsByClassName('forgot-password-container')[0];

        $("#forgotPassword").submit(function(e) {
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
                    title: '<button type="button" id="custom-close-button"></button><p class="swal-register-title">Email Sent</p>',
                    html: '<p class="swal-register-content-1">We have sent email to ' + response.data.email + ' to confirm the validity of our email address. After receiving the email follow the link provided to complete the password reseting process.</p><p class="swal-register-content-2">If you not got any mail <b>RESEND</b> confirmation mail</p>',
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
                    window.location.href = "{{ route('web.login') }}";
                });
            })
            .catch(error => {
                let errorMessage = '';
                if(error.response.data.msg){
                    if (typeof error.response.data.msg === 'object') {
                        Object.keys(error.response.data.msg).forEach(key => {
                            errorMessage += `${error.response.data.msg[key]}<br>`;
                        });
                    } else {
                        errorMessage = error.response.data.msg;
                    }
                }else{
                    errorMessage = error.response.data.error;
                }

                Swal.fire({
                    title: '<button type="button" id="custom-close-button"></button><p class="swal-register-title">Failed</p>',
                    html: '<p class="swal-register-content-1">'+ errorMessage ?? 'Some errors occurs.' +'</p>',
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
                });
                $(this).find('button[type="submit"]').attr('disabled','disabled');
            });
        });

    });
</script>
@endpush