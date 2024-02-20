@extends('web.layout.app')
@section('content')
<div id="register" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="register-wrapper">
                <div class="register-title">Create Account</div>
                {{ html()->form('POST', route("web.doRegister"))->acceptsFiles()->id('')->open()  }}
                <div class="register-container">
                    @include('components.alert')
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
                            {{ html()->hidden('birth_month')->placeholder('')->class('')->required() }}
                            <button type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expended="true" class="dropdown-months"></button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li class="dropdown-item" data-value="January">January</li>
                                <li class="dropdown-item" data-value="February">February</li>
                                <li class="dropdown-item" data-value="March">March</li>
                                <li class="dropdown-item" data-value="April">April</li>
                                <li class="dropdown-item" data-value="May">May</li>
                                <li class="dropdown-item" data-value="June">June</li>
                                <li class="dropdown-item" data-value="July">July</li>
                                <li class="dropdown-item" data-value="August">August</li>
                                <li class="dropdown-item" data-value="September">September</li>
                                <li class="dropdown-item" data-value="October">October</li>
                                <li class="dropdown-item" data-value="November">November</li>
                                <li class="dropdown-item" data-value="December">December</li>
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
                            {{ html()->email('ref_email')->placeholder('')->class('') }}
                            <label class="placeholder-label">Referrer email</label>
                        </div>
                        <div class="mb-40 input-container">
                            {{ html()->text('ref_phone_no')->placeholder('')->class('') }}
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
                        <button class="register-button">CREATE ACCOUNT</button>
                    </div>
                </div>
                {{ html()->form()->close() }}
                <div class="login-wrapper">
                    <div class="login-desc">Already have an account?</div>
                    <div class="d-flex justify-content-center">
                        <button class="login-button">LOGIN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $('.dropdown-item').on('click', function(){
        value = $(this).attr('data-value');
        console.log(value);
        $('.dropdown-months').text(value);
        $('.dropdown-months').css('margin', '0');
        console.log($(this).parent().parent());
        $(this).parent().parent().find('input[type=hidden]').val(value);
    })
</script>
@endpush