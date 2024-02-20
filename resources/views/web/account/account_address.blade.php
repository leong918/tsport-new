@extends('web.layout.app')
@section('content')
<div id="my-addr" class="margin-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="forgot-password-title">My Account</div>
                <div class="nav-acc"><a href="#">Home</a> > <a href="#"> My Account </a> > <a href="#"> Addresses </a></div>
                <div>

                </div>
            </div>
            @include('web.account.account_nav')
            <div class="col-xl-9 col-12">
                <div class="forgot-password-wrapper">
                    <div class="forgot-password-container">
                        <div class="title">
                            Shipping Address
                        </div>
                        <div class="titlev2">
                            Contacts
                        </div>
                        <div class="all-form-wrap">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-wrapper">
                                        <div class="input-container">
                                            <input type="text" required/>
                                            <label class="placeholder-label">First Name *</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-wrapper">
                                        <div class="input-container">
                                            <input type="text" required/>
                                            <label class="placeholder-label">Last Name *</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="text" required/>
                                    <label class="placeholder-label">Company Name (optional)</label>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="text" required/>
                                    <label class="placeholder-label">Phone no.*</label>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="text" required/>
                                    <label class="placeholder-label">Email *</label>
                                </div>
                            </div>
                            <div class="titlev2">
                                Address
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="text" required/>
                                    <label class="placeholder-label">Country / Region *</label>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="text" required/>
                                    <label class="placeholder-label">Region *</label>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="text" required/>
                                    <label class="placeholder-label">Town / City *</label>
                                </div>
                            </div>
                            <div class="form-wrapper">
                                <div class="input-container">
                                    <input type="text" required/>
                                    <label class="placeholder-label">Street Address *</label>
                                </div>
                            </div>
                        </div>
                        <div class="button-wrapper">
                            <button class="login-button">SAVE ADDRESS</button>
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