@extends('web.layout.app')

@section('content')
    <div id="page-auth" class="screen">
        <section class="section-form">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="frame frame__profile">
                            <div class="frame__content">
                                <div class="text-center">
                                    <h1 class="text-brown">个人资料</h1>
                                </div>

                                {{-- Display alerts for success/error messages --}}
                                <x-alert />

                                {{ html()->form('POST', route('web.update-profile'))->open() }}
                                @csrf

                                <x-text-input name="name" label="姓名" placeholder="Full Name"
                                    value="{{ old('name', auth('user')->user()->name ?? '') }}" required="true" />

                                <x-text-input name="username" label="用户名" placeholder="Username"
                                    value="{{ old('username', auth('user')->user()->username ?? '') }}" required="true">
                                    <div class="edit-icon">
                                        <i class="fa-solid fa-pencil"></i>
                                    </div>
                                </x-text-input>

                                <div class="input-field-section phone mb-3 col-12">
                                    <div class="label">电话号码</div>
                                    <div class="phone-input-wrapper">
                                        <div class="country-code-wrapper">
                                            <select name="phone_region" class="country-code">
                                                <option value="+60">+60</option>
                                                <option value="+86">+86</option>
                                                <option value="+65">+65</option>
                                                <option value="+1">+1</option>
                                            </select>
                                        </div>
                                        <div class="input-field-wrapper flex-1">
                                            <input class="input-field" name="phone_no" type="tel"
                                                placeholder="Phone Number"
                                                value="{{ old('phone_no', auth('user')->user()->phone_no ?? '') }}"
                                                required>
                                            <div class="edit-icon">
                                                <i class="fa-solid fa-pencil"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <x-text-input name="email" label="邮件" placeholder="Email"
                                    value="{{ old('email', auth('user')->user()->email ?? '') }}" required="true"
                                    type="email">
                                    <div class="edit-icon">
                                        <i class="fa-solid fa-pencil"></i>
                                    </div>
                                </x-text-input>

                                <x-text-input name="birthdate" label="生日日期" placeholder="YYYY/MM/DD"
                                    value="{{ old('birthdate', '1997/10/01') }}" required="true" type="date">
                                    <div class="edit-icon">
                                        <i class="fa-solid fa-pencil"></i>
                                    </div>
                                </x-text-input>

                                <div class="submit-btn-wrapper col-12 text-center">
                                    <input type="image" src="{{ asset('assets/web/images/button/btn-save.png') }}" 
                                           alt="保存" class="img-button" style="max-width: 200px; cursor: pointer;" />
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
