@extends('web.layout.app')
@section('content')
<div id="forgot-password" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="forgot-password-wrapper">
                <div class="forgot-password-title">Reset Password</div>
                {{ html()->form('POST', route("web.do_reset_password"))->acceptsFiles()->id('')->open()  }}
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
@endpush