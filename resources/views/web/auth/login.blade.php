@extends('web.layout.app')
@section('content')
<div id="login" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="login-wrapper">
                <div class="login-title">Login</div>
                @include('components.alert')
                {{ Form::open(["url" => route("web.doLogin"), "method" => "POST"]) }}
                @csrf
                <div class="login-container">
                    <div>
                        <div class="mb-40 input-container">
                            {{ Form::text('phone_no', null, array('required' => true)) }}
                            <label class="placeholder-label">Phone no. *</label>
                        </div>
                        <div class="input-container">
                            {{ Form::password('password', null, array('required' => true)) }}
                            <label class="placeholder-label">Password *</label>
                        </div>
                        <a href="{{route('web.forgot_password')}}" class="forgot-password">Forgot your password?</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="login-button" type="submit">LOGIN</button>
                    </div>
                </div>
                {{ Form::close() }}
                <div class="register-wrapper">
                    <div class="register-desc">註冊裝戶可獲得10積分，首次下單即可快用。 </div>
                    <div class="d-flex justify-content-center">
                        <a class="register-button" href="{{route('web.register')}}">CREATE ACCOUNT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush