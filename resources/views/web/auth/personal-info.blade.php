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
                                    <h1 class="text-brown">個人資料</h1>
                                </div>

                                {{-- Display alerts for success/error messages --}}
                                <x-alert />

                                {{ html()->form('POST', route('web.update-profile'))->open() }}
                                @csrf

                                <x-text-input name="name" label="姓名" placeholder="Full Name"
                                    value="{{ old('name', auth('user')->user()->name ?? '') }}" required="true" />

                                <x-text-input name="username" label="用戶名" placeholder="Username"
                                    value="{{ old('username', auth('user')->user()->username ?? '') }}" required="true">
                                    <div class="edit-icon">
                                        <img src="{{ asset('assets/web/images/input/icon-edit.png') }}" alt="Edit" class="edit-icon-img">
                                    </div>
                                </x-text-input>

                                @php
                                    $phoneNo = old('phone_no', auth('user')->user()->phone_no ?? '');
                                    $phoneRegion = '+60'; // Default
                                    $phoneNumber = $phoneNo;
                                    
                                    // Split phone code and number if phone starts with +
                                    if (str_starts_with($phoneNo, '+')) {
                                        // Try to match common country codes
                                        $codes = ['+60', '+86', '+65', '+1'];
                                        foreach ($codes as $code) {
                                            if (str_starts_with($phoneNo, $code)) {
                                                $phoneRegion = $code;
                                                $phoneNumber = substr($phoneNo, strlen($code));
                                                break;
                                            }
                                        }
                                    }
                                @endphp
                                
                                <div class="input-field-section phone mb-3 col-12">
                                    <div class="label">電話號碼</div>
                                    <div class="phone-input-wrapper">
                                        <div class="country-code-wrapper">
                                            <select name="phone_region" class="country-code">
                                                <option value="+60" {{ $phoneRegion === '+60' ? 'selected' : '' }}>+60</option>
                                                <option value="+86" {{ $phoneRegion === '+86' ? 'selected' : '' }}>+86</option>
                                                <option value="+65" {{ $phoneRegion === '+65' ? 'selected' : '' }}>+65</option>
                                                <option value="+1" {{ $phoneRegion === '+1' ? 'selected' : '' }}>+1</option>
                                            </select>
                                        </div>
                                        <div class="input-field-wrapper flex-1">
                                            <input class="input-field" name="phone_no" type="tel"
                                                placeholder="Phone Number"
                                                value="{{ $phoneNumber }}"
                                                required>
                                            <div class="edit-icon">
                                                <img src="{{ asset('assets/web/images/input/icon-edit.png') }}" alt="Edit" class="edit-icon-img">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <x-text-input name="email" label="郵件" placeholder="Email"
                                    value="{{ old('email', auth('user')->user()->email ?? '') }}" required="true"
                                    type="email">
                                    <div class="edit-icon">
                                        <img src="{{ asset('assets/web/images/input/icon-edit.png') }}" alt="Edit" class="edit-icon-img">
                                    </div>
                                </x-text-input>

                                <x-text-input name="dob" label="生日日期" placeholder="YYYY/MM/DD"
                                    value="{{ old('dob', auth('user')->user()->dob ?? '1997/10/01') }}" required="true" class="datepicker dob">
                                    <div class="edit-icon">
                                        <img src="{{ asset('assets/web/images/input/icon-edit.png') }}" alt="Edit" class="edit-icon-img">
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
