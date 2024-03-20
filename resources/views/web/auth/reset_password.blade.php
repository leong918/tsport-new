@extends('web.layout.app')
@section('content')
<div id="forgot-password" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="forgot-password-wrapper">
                <div class="forgot-password-title">Reset Password</div>
                @include('components.alert')
                {{ html()->form('POST', route("web.do_reset_password"))->id('reset_password')->open()  }}
                {{ html()->hidden('id')->value($id)}}
                {{ html()->hidden('token')->value(request('token')) }}
                <div class="forgot-password-container">
                    <div id="reset-password">
                        <div class="input-container">
                            {{ html()->password('password')->placeholder('')->class('') }}
                            <label class="placeholder-label">Password</label>
                        </div>
                        <div class="input-container">
                            {{ html()->password('password_confirmation')->placeholder('')->class('') }}
                            <label class="placeholder-label">Confirm Password</label>
                        </div>
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
        var parentElement = document.getElementsByClassName('forgot-password-wrapper')[0];

        $("#reset_password").submit(function(e) {
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
                    title: '<button type="button" id="custom-close-button"></button><p class="swal-register-title">Password Reset Succefully</p>',
                    html: '<p class="swal-register-content-1">Your password has been reseted.</p>',
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
                })
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
            });
        });

    });
</script>
@endpush