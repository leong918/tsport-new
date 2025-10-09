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
                                <x-text-input name="username" label="用户名" placeholder="Username" required="true" />
                                <x-password-input name="password" label="密码" placeholder="Password" :showForgotPassword="true"
                                    required="true" />
                                <div class="submit-btn-wrapper col-12 text-center">
                                    <button class="btn btn-primary px-4" type="submit">登入</button>
                                </div>
                                <div class="register-btn">还没有账户？马上
                                    <a href="{{ route('web.register') }}">
                                        创建账户
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
