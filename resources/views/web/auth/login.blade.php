@extends('web.layout.app')

@section('content')
    <div id="page-auth" class="screen">
        <section class="section-form">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="frame frame__login">
                            <div class="frame__content">
                                <div class="text-center">
                                    <h1 class="text-brown">登入</h1>
                                </div>

                                {{-- Display alerts for success/error messages --}}
                                <x-alert />

                                {{ html()->form('POST', route('web.do-login'))->open() }}
                                @csrf
                                <x-text-input name="username" label="用戶名" placeholder="Username" required="true" />
                                <x-text-input name="password" label="密碼" type="password" placeholder="Password" :showForgotPassword="true"
                                    required="true" />
                                <div class="submit-btn-wrapper col-12 text-center">
                                    <input type="image" src="{{ asset('assets/web/images/button/btn-login.png') }}"
                                        alt="登入" class="img-button" style="max-width: 200px; cursor: pointer;" />
                                </div>
                                <div class="register-btn">還沒有賬戶？馬上
                                    <a href="{{ route('web.register') }}">
                                        創建賬戶
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
