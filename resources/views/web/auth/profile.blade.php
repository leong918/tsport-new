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

@push('modals')
    <!-- Avatar/Jersey Editor Modal -->
    <div class="modal fade" id="edit-profile-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/web/images/profile/icon-close.png') }}" alt="Close">
                </button>
                
                <div class="content-wrapper">
                    <div class="top-content">
                        <div class="left">
                            <div class="tab-button" data-tab="name-tab" onclick="switchProfileTab('name-tab')" style="cursor: pointer;">
                                <img src="{{ asset('assets/web/images/profile/name-active.png') }}"
                                    class="img img-fluid tab-img active" style="pointer-events: none;">
                            </div>

                            <div class="tab-button" data-tab="number-tab" onclick="switchProfileTab('number-tab')" style="cursor: pointer;">
                                <img src="{{ asset('assets/web/images/profile/number-inactive.png') }}"
                                    class="img img-fluid tab-img" style="pointer-events: none;">
                            </div>

                            <div class="tab-button" data-tab="main-color-tab" onclick="switchProfileTab('main-color-tab')" style="cursor: pointer;">
                                <img src="{{ asset('assets/web/images/profile/main-color-inactive.png') }}"
                                    class="img img-fluid tab-img" style="pointer-events: none;">
                            </div>

                            <div class="tab-button" data-tab="sec-color-tab" onclick="switchProfileTab('sec-color-tab')" style="cursor: pointer;">
                                <img src="{{ asset('assets/web/images/profile/sec-color-inactive.png') }}"
                                    class="img img-fluid tab-img" style="pointer-events: none;">
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
                        <!-- Name Tab -->
                        <div class="tab-pane active" id="name-tab">
                            <div class="form-section">
                                <input type="text" class="form-control jersey-name-input" 
                                       placeholder="E神" value="E神" maxlength="10">
                            </div>
                        </div>

                        <!-- Number Tab -->
                        <div class="tab-pane" id="number-tab" style="display: none;">
                            <div class="form-section number-picker">
                                <div class="number-controls">
                                    <div class="number-digit">
                                        <button type="button" class="number-up">
                                            <img src="{{ asset('assets/web/images/profile/icon-up.png') }}" alt="Up">
                                        </button>
                                        <div class="digit-display">1</div>
                                        <button type="button" class="number-down">
                                            <img src="{{ asset('assets/web/images/profile/icon-down.png') }}" alt="Down">
                                        </button>
                                    </div>
                                    <div class="number-digit">
                                        <button type="button" class="number-up">
                                            <img src="{{ asset('assets/web/images/profile/icon-up.png') }}" alt="Up">
                                        </button>
                                        <div class="digit-display">0</div>
                                        <button type="button" class="number-down">
                                            <img src="{{ asset('assets/web/images/profile/icon-down.png') }}" alt="Down">
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" class="jersey-number-input" value="10">
                            </div>
                        </div>

                        <!-- Main Color Tab -->
                        <div class="tab-pane" id="main-color-tab" style="display: none;">
                            <div class="form-section">
                                <div class="color-grid">
                                    <div class="color-option selected" data-color="#DC143C" style="background-color: #DC143C;"></div>
                                    <div class="color-option" data-color="#FFA500" style="background-color: #FFA500;"></div>
                                    <div class="color-option" data-color="#228B22" style="background-color: #228B22;"></div>
                                    <div class="color-option" data-color="#00CED1" style="background-color: #00CED1;"></div>
                                    <div class="color-option" data-color="#FF1493" style="background-color: #FF1493;"></div>
                                    <div class="color-option" data-color="#FF8C00" style="background-color: #FF8C00;"></div>
                                    <div class="color-option" data-color="#1E90FF" style="background-color: #1E90FF;"></div>
                                    <div class="color-option" data-color="#9370DB" style="background-color: #9370DB;"></div>
                                    <div class="color-option" data-color="#8B4513" style="background-color: #8B4513;"></div>
                                    <div class="color-option" data-color="#00FF00" style="background-color: #00FF00;"></div>
                                    <div class="color-option" data-color="#FFFFFF" style="background-color: #FFFFFF; border: 2px solid #ccc;"></div>
                                    <div class="color-option" data-color="#000000" style="background-color: #000000;"></div>
                                </div>
                                <input type="hidden" class="main-color-input" value="#DC143C">
                            </div>
                        </div>

                        <!-- Secondary Color Tab -->
                        <div class="tab-pane" id="sec-color-tab" style="display: none;">
                            <div class="form-section">
                                <div class="color-grid">
                                    <div class="color-option selected" data-color="#DC143C" style="background-color: #DC143C;"></div>
                                    <div class="color-option" data-color="#FFA500" style="background-color: #FFA500;"></div>
                                    <div class="color-option" data-color="#228B22" style="background-color: #228B22;"></div>
                                    <div class="color-option" data-color="#00CED1" style="background-color: #00CED1;"></div>
                                    <div class="color-option" data-color="#FF1493" style="background-color: #FF1493;"></div>
                                    <div class="color-option" data-color="#FF8C00" style="background-color: #FF8C00;"></div>
                                    <div class="color-option" data-color="#1E90FF" style="background-color: #1E90FF;"></div>
                                    <div class="color-option" data-color="#9370DB" style="background-color: #9370DB;"></div>
                                    <div class="color-option" data-color="#8B4513" style="background-color: #8B4513;"></div>
                                    <div class="color-option" data-color="#00FF00" style="background-color: #00FF00;"></div>
                                    <div class="color-option" data-color="#FFFFFF" style="background-color: #FFFFFF; border: 2px solid #ccc;"></div>
                                    <div class="color-option" data-color="#000000" style="background-color: #000000;"></div>
                                </div>
                                <input type="hidden" class="sec-color-input" value="#228B22">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Save Button -->
                    <div class="save-button-wrapper">
                        <button type="button" class="btn-save-image">
                            <img src="{{ asset('assets/web/images/profile/btn-save.png') }}" alt="保存">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        // Set logout route for use in external JS
        window.logoutRoute = '{{ route('web.logout') }}';
        
        // Define tab switching function immediately
        window.switchProfileTab = function(tabId) {
            console.log('🔄 Switching to tab:', tabId);
            const modal = document.getElementById('edit-profile-modal');
            if (!modal) {
                console.error('Modal not found');
                return;
            }
            
            // Hide all tab panes
            const allPanes = modal.querySelectorAll('.tab-pane');
            allPanes.forEach(pane => {
                pane.style.display = 'none';
                pane.classList.remove('active');
            });

            // Show target tab pane
            const targetPane = modal.querySelector('#' + tabId);
            if (targetPane) {
                targetPane.style.display = 'block';
                targetPane.classList.add('active');
                console.log('✅ Showing pane:', tabId);
            }

            // Update tab button images
            const clickedButton = modal.querySelector('[data-tab="' + tabId + '"]');
            modal.querySelectorAll('.tab-button').forEach(btn => {
                const img = btn.querySelector('.tab-img');
                const tab = btn.dataset.tab;
                
                // Determine image name from tab id (lowercase with dash)
                let imageName = '';
                if (tab === 'name-tab') imageName = 'name';
                else if (tab === 'number-tab') imageName = 'number';
                else if (tab === 'main-color-tab') imageName = 'main-color';
                else if (tab === 'sec-color-tab') imageName = 'sec-color';
                
                // Set active/inactive image
                if (btn === clickedButton) {
                    img.src = '/assets/web/images/profile/' + imageName + '-active.png';
                    img.classList.add('active');
                } else {
                    img.src = '/assets/web/images/profile/' + imageName + '-inactive.png';
                    img.classList.remove('active');
                }
            });
        };
        
        // Initialize color selection when modal is shown
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('edit-profile-modal');
            if (modal) {
                modal.addEventListener('shown.bs.modal', function() {
                    console.log('✨ Modal shown, initializing color selection...');
                    
                    // Main color selection
                    const mainColorOptions = modal.querySelectorAll('#main-color-tab .color-option');
                    mainColorOptions.forEach(option => {
                        option.addEventListener('click', function() {
                            console.log('Main color clicked:', this.dataset.color);
                            mainColorOptions.forEach(opt => opt.classList.remove('selected'));
                            this.classList.add('selected');
                        });
                    });

                    // Secondary color selection
                    const secColorOptions = modal.querySelectorAll('#sec-color-tab .color-option');
                    secColorOptions.forEach(option => {
                        option.addEventListener('click', function() {
                            console.log('Secondary color clicked:', this.dataset.color);
                            secColorOptions.forEach(opt => opt.classList.remove('selected'));
                            this.classList.add('selected');
                        });
                    });
                    
                    console.log('✅ Color selection initialized');
                });
            }
        });
    </script>
    {{-- Page-specific scripts now loaded via app.js imports --}}
@endpush
