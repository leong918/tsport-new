@extends('web.layout.app')
@section('content')
<div id="my-acc" class="margin-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="forgot-password-title">My Account</div>
                <div class="nav-acc"><a href="#">Home</a> > <a href="#"> My Account </a> > <a href="#"> Account Details </a></div>
                <div>

                </div>
            </div>
            @include('web.account.account_nav')
            <div class="col-xl-9 col-12">
                <div class="forgot-password-wrapper">
                    <div class="forgot-password-container">
                        <div class="title">
                            Membership: Just Member
                        </div>
                        <div class="title">
                            Account Details
                        </div>
                        <div class="all-form-wrap">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-wrapper">
                                        <div class="input-container">
                                            <input type="text" class="disabled-txt" required/>
                                            <label class="placeholder-label">First Name *</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-wrapper">
                                        <div class="input-container">
                                            <input type="text" class="disabled-txt" required/>
                                            <label class="placeholder-label">Last Name *</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="text" class="disabled-txt" required/>
                                    <label class="placeholder-label">Display Name *</label>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="text" required/>
                                    <label class="placeholder-label">Email</label>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="text" required/>
                                    <label class="placeholder-label">Phone no.</label>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="text" required/>
                                    <label class="placeholder-label">Birth month</label>
                                </div>
                            </div>
                            <div class="title">
                                Password Change
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="password" required/>
                                    <label class="placeholder-label">Current Password</label>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="password" required/>
                                    <label class="placeholder-label">New Password</label>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="password" required/>
                                    <label class="placeholder-label">Confirm New Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="button-wrapper">
                            <button class="login-button">SAVE CHANGE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush