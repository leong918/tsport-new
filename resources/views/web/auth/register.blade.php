@extends('web.layout.app')
@section('content')
<div id="register" class="margin-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="register-wrapper">
                <div class="register-title">Create Account</div>
                <div class="register-container">
                    <div>
                        <div class="mb-40 input-container">
                            <input type="text" placeholder=" " required/>
                            <label class="placeholder-label">First Name *</label>
                        </div>
                        <div class="mb-40 input-container">
                            <input type="text" placeholder=" " required/>
                            <label class="placeholder-label">Last Name *</label>
                        </div>
                        <div class="mb-20 input-container">
                            <input type="text" placeholder=" " required/>
                            <label class="placeholder-label">Email *</label>
                            <div class="input-desc">cannot be changed after becoming a member</div>
                        </div>
                        <div class="mb-20 input-container">
                            <input type="text" placeholder=" " required/>
                            <label class="placeholder-label">Phone no. *</label>
                            <div class="input-desc">cannot be changed after becoming a member</div>
                        </div>
                        <div class="mb-20 input-container">
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
                            <input type="password" placeholder=" " required/>
                            <label class="placeholder-label">Password *</label>
                        </div>
                        <div class="mb-40 input-container">
                            <input type="password" placeholder=" " required/>
                            <label class="placeholder-label">Confirm Password *</label>
                        </div>
                        <div class="mb-40 input-container">
                            <input type="text" placeholder=" "/>
                            <label class="placeholder-label">Referrer email</label>
                        </div>
                        <div class="mb-40 input-container">
                            <input type="text" placeholder=" "/>
                            <label class="placeholder-label">Referrer phone no.</label>
                        </div>
                        <div class="tnc-wrapper">
                            <div class="tnc-desc">Your personal data will be used to support your experience throughout this website, 
                                to manage access to your account , and for other purposes described in our privacy policy.
                            </div>
                            <div class="tnc">
                                <label class="container">*Please accept our Terms & Conditions
                                    <input type="checkbox" name="checkbox" required>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="register-button">CREATE ACCOUNT</button>
                    </div>
                </div>
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
@endpush