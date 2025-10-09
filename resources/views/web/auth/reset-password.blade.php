@extends('web.layout.app')

@section('content')
    <div id="page-auth" class="screen">
        <section class="section-form">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="frame frame__reset-password">
                            <div class="frame__content">
                                <div class="text-center">
                                    @auth('user')
                                        <h1 class="text-brown">更改密码</h1>
                                    @else
                                        <h1 class="text-brown">重置密码</h1>
                                    @endauth
                                </div>
                                
                                {{-- Display alerts for success/error messages --}}
                                <x-alert />
                                
                                {{ html()->form('POST', route('web.do-reset-password'))->open() }}
                                @csrf
                                @auth('user')
                                    <x-password-input name="current_password" label="密码" placeholder="Current Password" required="true" />
                                @endauth
                                <x-password-input name="password" label="重置密码" placeholder="New Password" required="true" />
                                <x-password-input name="password_confirmation" label="确认密码" placeholder="Confirm Password" required="true" />
                                
                                <div class="password-requirements mt-3 mb-3">
                                    <div class="info-wrapper">
                                        <div class="info">
                                            <i class="fa-solid fa-check"></i>用户名必须为6至12字母或数字字符
                                        </div>
                                        <div class="info">
                                            <i class="fa-solid fa-check"></i>密码必须至少为8个字符
                                        </div>
                                        <div class="info">
                                            <i class="fa-solid fa-check"></i>密码不能包含空格
                                        </div>
                                        <div class="info">
                                            <i class="fa-solid fa-check"></i>密码一致
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="submit-btn-wrapper col-12 text-center">
                                    @auth('user')
                                        <button class="btn btn-primary px-4" type="submit">更改密码</button>
                                    @else
                                        <button class="btn btn-primary px-4" type="submit">重置密码</button>
                                    @endauth
                                </div>
                                <div class="register-btn">
                                    @auth('user')
                                        不想更改？
                                        <a href="{{ route('web.profile') }}">
                                            返回个人资料
                                        </a>
                                    @else
                                        记起密码了？
                                        <a href="{{ route('web.login') }}">
                                            返回登入
                                        </a>
                                    @endauth
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
