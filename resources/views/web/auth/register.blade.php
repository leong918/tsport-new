@extends('web.layout.app')

@section('content')
    <div id="page-auth" class="screen">
        <section class="section-form">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="frame frame__signup">
                            <div class="frame__content">
                                <div class="text-center">
                                    <h1 class="text-brown">創建賬戶</h1>
                                </div>
                                
                                {{-- Display alerts for success/error messages --}}
                                <x-alert />
                                
                                {{ html()->form('POST', route('web.do-register'))->open() }}
                                @csrf

                                <x-text-input name="username" label="用戶名" placeholder="Username" required="true" />

                                <div class="col-12 mb-3 input-field-section">
                                    <div class="col-12 label">電話號碼</div>
                                    <div class="phone-wrapper">
                                        <div class="input-field-wrapper region">
                                            <input class="input-field" name="phone_region" type="text" placeholder="+60">
                                        </div>
                                        <div class="input-field-wrapper number">
                                            <input class="input-field" name="phone_no" type="text"
                                                placeholder="123456789">
                                        </div>
                                    </div>
                                    @error('phone_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <x-text-input name="email" label="郵件" placeholder="Email" type="email"
                                    required="true" />

                                <x-text-input name="password" label="密碼" type="password" placeholder="Password" required="true" />

                                <div class="row">
                                    <div class="col-6">
                                        <x-text-input name="referral_code" label="推薦碼" placeholder="Referral Code" />
                                    </div>
                                    <div class="col-6">
                                        <x-text-input name="verification_code" label="認證碼"
                                            placeholder="Verification Code" />
                                    </div>
                                </div>

                                <div class="submit-btn-wrapper col-12 text-center">
                                    <input type="image" src="{{ asset('assets/web/images/button/btn-signup.png') }}" 
                                           alt="創建賬戶" class="img-button" style="max-width: 200px; cursor: pointer;" />
                                </div>

                                <div class="login-btn">已有賬戶？馬上
                                    <a href="{{ route('web.login') }}">
                                        登入
                                    </a>
                                </div>

                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

{{-- Page-specific scripts now loaded via app.js imports --}}
