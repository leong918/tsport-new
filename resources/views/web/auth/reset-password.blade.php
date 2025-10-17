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
                                        <h1 class="text-brown">更改密碼</h1>
                                    @else
                                        <h1 class="text-brown">重置密碼</h1>
                                    @endauth
                                </div>

                                {{-- Display alerts for success/error messages --}}
                                <x-alert />

                                {{ html()->form('POST', route('web.do-reset-password'))->open() }}
                                @csrf
                                @auth('user')
                                    <x-text-input name="current_password" label="密碼" type="password" placeholder="Current Password"
                                        required="true" />
                                @endauth
                                <x-text-input name="password" label="重置密碼" type="password" placeholder="New Password"
                                    required="true" />
                                <x-text-input name="password_confirmation" label="確認密碼" type="password" placeholder="Confirm Password"
                                    required="true" />

                                <!-- Separator Line -->
                                <hr class="password-separator">

                                <div class="password-requirements mt-3 mb-3">
                                    <ul class="info-wrapper">
                                        <li class="info p2 fw-bold">
                                            <i class="fa-solid fa-check"></i>用戶名必須為6至12字母或數字字符
                                        </li>
                                        <li class="info p2 fw-bold">
                                            <i class="fa-solid fa-check"></i>密碼必須至少為8個字符
                                        </li>
                                        <li class="info p2 fw-bold">
                                            <i class="fa-solid fa-check"></i>密碼不能包含空格
                                        </li>
                                        <li class="info p2 fw-bold">
                                            <i class="fa-solid fa-check"></i>密碼一致
                                        </li>
                                    </ul>
                                </div>
                                <div class="submit-btn-wrapper col-12 text-center">
                                    @auth('user')
                                        <input type="image" src="{{ asset('assets/web/images/button/btn-save.png') }}"
                                            alt="更改密碼" class="img-button" style="max-width: 200px; cursor: pointer;" />
                                    @else
                                        <input type="image" src="{{ asset('assets/web/images/button/btn-save.png') }}"
                                            alt="重置密碼" class="img-button" style="max-width: 200px; cursor: pointer;" />
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
