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
                                    <img src="{{ asset('assets/web/images/profile/background-shirt.png') }}"
                                        class="img img-fluid background">
                                    <button type="button" class="edit" data-bs-toggle="modal"
                                        data-bs-target="#edit-profile-modal">
                                        <img src="{{ asset('assets/web/images/profile/icon-edit.png') }}" class="img-fluid">
                                    </button>
                                </div>
                            </div>
                            <div class="shirt-wrapper position-absolute">
                                @php
                                    $user = auth()->user();
                                    $mainColor = $user->jersey_main_color ?? 10;
                                    $secColor = $user->jersey_sec_color ?? 0;
                                    $shirtImage = "shirt/{$mainColor}/{$secColor}.png";
                                @endphp
                                <img src="{{ asset('assets/web/images/profile/' . $shirtImage) }}"
                                    class="img img-fluid shirt">
                            </div>
                            <!-- Jersey Info Overlay -->
                            <div class="jersey-info position-absolute">
                                <div class="jersey-name">{{ $user->jersey_name ?? 'E神' }}</div>
                                <div class="jersey-number">{{ str_pad($user->jersey_number ?? '10', 2, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <h1 class="name">
                            {{ $user->jersey_name ?? 'E神' }}
                        </h1>
                    </div>
                    <div class="col-12">
                        <div class="frame frame__profile">
                            <div class="frame__content">
                                <div class="option-wrapper">
                                    <a href="{{ route('web.personal-info') }}" class="input-field-wrapper">
                                        <div class="label">個人資料</div>
                                        <div class="arrow">
                                            <img src="{{ asset('assets/web/images/profile/bbtn-arrow.png') }}"
                                                class="img img-fluid">
                                        </div>
                                    </a>
                                    <a href="{{ route('web.reset-password') }}" class="input-field-wrapper">
                                        <div class="label">密碼</div>
                                        <div class="arrow">
                                            <img src="{{ asset('assets/web/images/profile/btn-arrow.png') }}"
                                                class="img img-fluid">
                                        </div>
                                    </a>
                                    <div class="input-field-wrapper">
                                        <div class="label">兌換碼</div>
                                        <div class="arrow">
                                            <img src="{{ asset('assets/web/images/profile/btn-arrow.png') }}"
                                                class="img img-fluid">
                                        </div>
                                    </div>
                                    <div class="input-field-wrapper">
                                        <div class="label">客服</div>
                                        <div class="arrow">
                                            <img src="{{ asset('assets/web/images/profile/btn-arrow.png') }}"
                                                class="img img-fluid">
                                        </div>
                                    </div>
                                    <div class="input-field-wrapper" onclick="logout()">
                                        <div class="label">登出</div>
                                        <div class="arrow">
                                            <img src="{{ asset('assets/web/images/profile/btn-arrow.png') }}"
                                                class="img img-fluid">
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

@push('modals')
    <!-- Avatar/Jersey Editor Modal -->
    <div class="modal fade" id="edit-profile-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/web/images/profile/icon-close.png') }}" alt="Close">
                </button>

                <div class="container-fluid px-0">
                    <div class="row gx-0">
                        <div class="col-4">
                            <ul class="nav nav-pills flex-column" id="profileTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="name-tab" data-bs-toggle="pill"
                                        data-bs-target="#name-pane" type="button" role="tab" aria-controls="name-pane"
                                        aria-selected="true">
                                        <img src="{{ asset('assets/web/images/profile/name-active.png') }}"
                                            class="tab-img img-fluid" alt="名称">
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="number-tab" data-bs-toggle="pill"
                                        data-bs-target="#number-pane" type="button" role="tab"
                                        aria-controls="number-pane" aria-selected="false">
                                        <img src="{{ asset('assets/web/images/profile/number-inactive.png') }}"
                                            class="tab-img img-fluid" alt="号码">
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="main-color-tab" data-bs-toggle="pill"
                                        data-bs-target="#main-color-pane" type="button" role="tab"
                                        aria-controls="main-color-pane" aria-selected="false">
                                        <img src="{{ asset('assets/web/images/profile/main-color-inactive.png') }}"
                                            class="tab-img img-fluid" alt="主色">
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="sec-color-tab" data-bs-toggle="pill"
                                        data-bs-target="#sec-color-pane" type="button" role="tab"
                                        aria-controls="sec-color-pane" aria-selected="false">
                                        <img src="{{ asset('assets/web/images/profile/sec-color-inactive.png') }}"
                                            class="tab-img img-fluid" alt="副色">
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-8">
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
                                <!-- Jersey Info Overlay -->
                                <div class="jersey-info position-absolute">
                                    <div class="jersey-name" id="preview-name">E神</div>
                                    <div class="jersey-number" id="preview-number">10</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content bottom-content" id="profileTabContent">
                    <!-- Name Tab -->
                    <div class="tab-pane fade show active" id="name-pane" role="tabpanel" aria-labelledby="name-tab"
                        tabindex="0">
                        <div class="form-section name-input-section">
                            <div class="name-frame-wrapper position-relative">
                                <div class="name-frame-bg"></div>
                                <input type="text" class="form-control jersey-name-input" placeholder="E神"
                                    value="E神" maxlength="3">
                            </div>
                        </div>
                    </div>

                    <!-- Number Tab -->
                    <div class="tab-pane fade" id="number-pane" role="tabpanel" aria-labelledby="number-tab"
                        tabindex="0">
                        <div class="form-section number-picker">
                            <div class="number-frame-wrapper position-relative">
                                <div class="number-controls">
                                    <div class="number-digit">
                                        <button type="button" class="number-up">
                                            <img src="{{ asset('assets/web/images/profile/icon-up.png') }}"
                                                alt="Up">
                                        </button>
                                        <div class="digit-display">
                                            <span class="digit-text">1</span>
                                        </div>
                                        <button type="button" class="number-down">
                                            <img src="{{ asset('assets/web/images/profile/icon-down.png') }}"
                                                alt="Down">
                                        </button>
                                    </div>
                                    <div class="number-digit">
                                        <button type="button" class="number-up">
                                            <img src="{{ asset('assets/web/images/profile/icon-up.png') }}"
                                                alt="Up">
                                        </button>
                                        <div class="digit-display">
                                            <span class="digit-text">0</span>
                                        </div>
                                        <button type="button" class="number-down">
                                            <img src="{{ asset('assets/web/images/profile/icon-down.png') }}"
                                                alt="Down">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="jersey-number-input" value="10">
                        </div>
                    </div>

                    <!-- Main Color Tab -->
                    <div class="tab-pane fade" id="main-color-pane" role="tabpanel" aria-labelledby="main-color-tab"
                        tabindex="0">
                        <div class="form-section">
                            <div class="color-grid">
                                <div class="color-option" data-color-number="0" style="background-color: #DC143C;"></div>
                                <div class="color-option" data-color-number="1" style="background-color: #FFA500;"></div>
                                <div class="color-option" data-color-number="2" style="background-color: #228B22;"></div>
                                <div class="color-option" data-color-number="3" style="background-color: #00CED1;"></div>
                                <div class="color-option" data-color-number="4" style="background-color: #FF1493;"></div>
                                <div class="color-option" data-color-number="5" style="background-color: #FF8C00;"></div>
                                <div class="color-option" data-color-number="6" style="background-color: #1E90FF;"></div>
                                <div class="color-option" data-color-number="7" style="background-color: #9370DB;"></div>
                                <div class="color-option" data-color-number="8" style="background-color: #8B4513;"></div>
                                <div class="color-option" data-color-number="9" style="background-color: #00FF00;"></div>
                                <div class="color-option selected" data-color-number="10"
                                    style="background-color: #FFFFFF; border: 2px solid #ccc;"></div>
                                <div class="color-option" data-color-number="11" style="background-color: #000000;">
                                </div>
                            </div>
                            <input type="hidden" class="main-color-input" value="10">
                        </div>
                    </div>

                    <!-- Secondary Color Tab -->
                    <div class="tab-pane fade" id="sec-color-pane" role="tabpanel" aria-labelledby="sec-color-tab"
                        tabindex="0">
                        <div class="form-section">
                            <div class="color-grid">
                                <div class="color-option selected" data-color-number="0"
                                    style="background-color: #DC143C;"></div>
                                <div class="color-option" data-color-number="1" style="background-color: #FFA500;"></div>
                                <div class="color-option" data-color-number="2" style="background-color: #228B22;"></div>
                                <div class="color-option" data-color-number="3" style="background-color: #00CED1;"></div>
                                <div class="color-option" data-color-number="4" style="background-color: #FF1493;"></div>
                                <div class="color-option" data-color-number="5" style="background-color: #FF8C00;"></div>
                                <div class="color-option" data-color-number="6" style="background-color: #1E90FF;"></div>
                                <div class="color-option" data-color-number="7" style="background-color: #9370DB;"></div>
                                <div class="color-option" data-color-number="8" style="background-color: #8B4513;"></div>
                                <div class="color-option" data-color-number="9" style="background-color: #00FF00;"></div>
                                <div class="color-option" data-color-number="10"
                                    style="background-color: #FFFFFF; border: 2px solid #ccc;"></div>
                                <div class="color-option" data-color-number="11" style="background-color: #000000;">
                                </div>
                            </div>
                            <input type="hidden" class="sec-color-input" value="0">
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="save-button-wrapper">
                    <button type="button" class="btn-save-image">
                        <img src="{{ asset('assets/web/images/profile/btn-save.png') }}" alt="保存"
                            class="img-fluid">
                    </button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        // Set logout route for use in external JS
        window.logoutRoute = '{{ route('web.logout') }}';
    </script>
@endpush
