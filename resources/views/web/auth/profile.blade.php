@extends('web.layout.app')

@section('content')
    <div id="page-profile" class="screen">
        <section>
            <div class="container">
                <div class="row gy-3">
                    <div class="col-12">
                        <div class="avatar-wrapper position-relative">
                            <div class="background-wrapper position-absolute">
                                <div class="background-inner-wrapper">
                                    <img src="{{ asset('assets/web/images/profile/Background_Shirt.png') }}" class="img img-fluid background">
                                    <img src="{{ asset('assets/web/images/profile/Icon_Edit.png') }}" class="img img-fluid edit"
                                        data-bs-toggle="modal" data-bs-target="#edit-profile-modal" style="cursor: pointer;">
                                </div>
                            </div>
                            <div class="shirt-wrapper position-absolute">
                                <img src="{{ asset('assets/web/images/profile/User_Avatar.png') }}" class="img img-fluid shirt">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <h1 class="name">
                            E神
                        </h1>
                    </div>
                    <div class="col-12">
                        <div class="frame frame__profile">
                            <div class="frame__content">
                                <div class="option-wrapper">
                                    <a href="{{ route('web.personal-info') }}" class="input-field-wrapper">
                                        <div class="label">個人資料</div>
                                        <div class="arrow">
                                            <img src="{{ asset('assets/web/images/profile/Button_Enter.png') }}" class="img img-fluid">
                                        </div>
                                    </a>
                                    <a href="{{ route('web.reset-password') }}" class="input-field-wrapper">
                                        <div class="label">密碼</div>
                                        <div class="arrow">
                                            <img src="{{ asset('assets/web/images/profile/Button_Enter.png') }}" class="img img-fluid">
                                        </div>
                                    </a>
                                    <div class="input-field-wrapper" data-bs-toggle="modal" data-bs-target="#redeem-code-modal" style="cursor: pointer;">
                                        <div class="label">兌換碼</div>
                                        <div class="arrow">
                                            <img src="{{ asset('assets/web/images/profile/Button_Enter.png') }}" class="img img-fluid">
                                        </div>
                                    </div>
                                    <div class="input-field-wrapper">
                                        <div class="label">客服</div>
                                        <div class="arrow">
                                            <img src="{{ asset('assets/web/images/profile/Button_Enter.png') }}" class="img img-fluid">
                                        </div>
                                    </div>
                                    <div class="input-field-wrapper" onclick="logout()" style="cursor: pointer;">
                                        <div class="label">登出</div>
                                        <div class="arrow">
                                            <img src="{{ asset('assets/web/images/profile/Button_Enter.png') }}" class="img img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('modal')
    <!-- Avatar/Jersey Editor Modal -->
    <div class="modal fade" id="edit-profile-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content position-relative">
                <div class="background-img">
                    <img src="{{ asset('assets/web/images/profile/Wooden_Frame.png') }}" class="img img-fluid">
                </div>
                <div class="content-wrapper position-absolute">
                    <div class="top-content">
                        <div class="left">
                            <div class="tab-content">
                                <img src="{{ asset('assets/web/images/profile/Main_Color_Inactive.png') }}"
                                    class="img img-fluid tab-img" id="main-color"
                                    data-active="{{ asset('assets/web/images/profile/Main_Color_Active.png') }}"
                                    data-inactive="{{ asset('assets/web/images/profile/Main_Color_Inactive.png') }}">
                            </div>

                            <div class="tab-content">
                                <img src="{{ asset('assets/web/images/profile/Sec_Color_Inactive.png') }}"
                                    class="img img-fluid tab-img" id="sec-color"
                                    data-active="{{ asset('assets/web/images/profile/Sec_Color_Active.png') }}"
                                    data-inactive="{{ asset('assets/web/images/profile/Sec_Color_Inactive.png') }}">
                            </div>

                            <div class="tab-content">
                                <img src="{{ asset('assets/web/images/profile/Number_Inactive.png') }}"
                                    class="img img-fluid tab-img" id="number"
                                    data-active="{{ asset('assets/web/images/profile/Number_Active.png') }}"
                                    data-inactive="{{ asset('assets/web/images/profile/Number_Inactive.png') }}">
                            </div>

                            <div class="tab-content">
                                <img src="{{ asset('assets/web/images/profile/Name_Inactive.png') }}"
                                    class="img img-fluid tab-img" id="name"
                                    data-active="{{ asset('assets/web/images/profile/Name_Active.png') }}"
                                    data-inactive="{{ asset('assets/web/images/profile/Name_Inactive.png') }}">
                            </div>
                        </div>
                        <div class="right">
                            <div class="avatar-wrapper position-relative">
                                <div class="background-wrapper position-absolute">
                                    <div class="background-inner-wrapper">
                                        <img src="{{ asset('assets/web/images/profile/Background_Shirt.png') }}"
                                            class="img img-fluid background">
                                    </div>
                                </div>
                                <div class="shirt-wrapper position-absolute">
                                    <img src="{{ asset('assets/web/images/profile/User_Avatar.png') }}"
                                        class="img img-fluid shirt">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <div id="main-color" style="display: none;">
                            <div class="form-section">
                                <h6 class="mb-3">選擇主色調</h6>
                                <div class="color-grid">
                                    <div class="color-option" data-color="#FF0000" style="background-color: #FF0000;">
                                    </div>
                                    <div class="color-option" data-color="#00FF00" style="background-color: #00FF00;">
                                    </div>
                                    <div class="color-option" data-color="#0000FF" style="background-color: #0000FF;">
                                    </div>
                                    <div class="color-option" data-color="#FFFF00" style="background-color: #FFFF00;">
                                    </div>
                                    <div class="color-option" data-color="#FF00FF" style="background-color: #FF00FF;">
                                    </div>
                                    <div class="color-option" data-color="#00FFFF" style="background-color: #00FFFF;">
                                    </div>
                                </div>
                                <input type="hidden" id="main-color-input" name="main_color" value="">
                            </div>
                        </div>

                        <div id="sec-color" style="display: none;">
                            <div class="form-section">
                                <h6 class="mb-3">選擇副色調</h6>
                                <div class="color-grid">
                                    <div class="color-option" data-color="#800000" style="background-color: #800000;">
                                    </div>
                                    <div class="color-option" data-color="#008000" style="background-color: #008000;">
                                    </div>
                                    <div class="color-option" data-color="#000080" style="background-color: #000080;">
                                    </div>
                                    <div class="color-option" data-color="#808000" style="background-color: #808000;">
                                    </div>
                                    <div class="color-option" data-color="#800080" style="background-color: #800080;">
                                    </div>
                                    <div class="color-option" data-color="#008080" style="background-color: #008080;">
                                    </div>
                                </div>
                                <input type="hidden" id="sec-color-input" name="sec_color" value="">
                            </div>
                        </div>

                        <div id="number" style="display: none;">
                            <div class="form-section">
                                <h6 class="mb-3">球衣號碼</h6>
                                <x-text-input name="jersey_number" label="號碼" placeholder="輸入1-99" type="number"
                                    required="true" />
                            </div>
                        </div>

                        <div id="name" style="display: none;">
                            <div class="form-section">
                                <h6 class="mb-3">球衣姓名</h6>
                                <x-text-input name="jersey_name" label="姓名" placeholder="輸入姓名" required="true" />
                                <div class="mt-3">
                                    <img src="{{ asset('assets/web/images/button/btn-save.png') }}" 
                                         alt="保存更改" class="img-button save-profile-btn" 
                                         style="max-width: 150px; cursor: pointer;" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Set logout route for use in external JS
        window.logoutRoute = '{{ route('web.logout') }}';
    </script>
    {{-- Page-specific scripts now loaded via app.js imports --}}
@endpush
