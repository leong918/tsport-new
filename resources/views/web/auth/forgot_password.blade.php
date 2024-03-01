@extends('web.layout.app')
@section('content')
<div id="forgot-password" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="forgot-password-wrapper">
                <div class="forgot-password-title">Forgot Password</div>
                {{ html()->form('POST', route("web.do_forgot_password"))->acceptsFiles()->id('')->open()  }}
                <div class="forgot-password-container">
                    <div>
                        <div class="input-container">
                            {{ html()->email('email')->placeholder('')->class('') }}
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
@endpush