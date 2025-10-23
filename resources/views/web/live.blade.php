@extends('web.layout.app')

@section('body-class', 'bg-1 no-footer')

@section('content')
    <div id="page-live" class="screen" data-match-id="{{ $match['url_id'] ?? $match['id'] ?? '' }}">
        <!-- Live Video Section -->
        <section id="section-live-video">
            <div class="video-container">
                <!-- Video Player -->
                <div class="video-player" style="position: relative;">
                    @if ($match['obs_status'] == 2 && $match['obs_stream_key'])
                        <!-- HLS Video Player for Live Stream -->
                        <video id="live-stream-player" class="video-js vjs-default-skin" 
                            autoplay muted playsinline preload="auto"
                            data-setup='{"fluid": true, "responsive": true, "controls": false, "autoplay": true, "muted": true}'
                            data-stream-key="{{ $match['obs_stream_key'] }}"
                            data-is-live="{{ $match['obs_status'] == 2 ? 'true' : 'false' }}"
                            poster="{{ asset('assets/web/images/live/sample-video.jpg') }}">
                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a web browser that
                                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>.
                            </p>
                        </video>

                        <!-- Live Stream Indicators -->
                        <div class="live-indicator-hls">
                            <span style="animation: pulse 2s infinite;">●</span> LIVE
                        </div>
                        <div class="viewer-count-hls">
                            <span id="live-viewer-count">{{ number_format($match['viewers']) }}</span>
                        </div>
                    @elseif (isset($match['video_url']) && $match['video_url'])
                        <!-- Regular Video -->
                        <video id="live-video" autoplay muted>
                            <source src="{{ $match['video_url'] }}" type="video/mp4">
                            您的浏览器不支持视频播放。
                        </video>

                        <!-- Live Badge -->
                        <div class="live-badge">
                            <span class="live-indicator"></span>
                            <span class="live-text">LIVE</span>
                            <span class="viewer-count">{{ $match['viewers'] ?? '292' }}</span>
                        </div>
                    @else
                        <!-- Stream Offline -->
                        <div style="position: relative; height: 250px;">
                            <img src="{{ asset('assets/web/images/live/sample-video.jpg') }}" alt="Live Video Placeholder"
                                class="img-fluid w-100" style="height: 100%; object-fit: cover;">
                            <div
                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white; background: rgba(0,0,0,0.7); padding: 20px; border-radius: 8px;">
                                @if ($match['obs_status'] == 1)
                                    <div class="spinner-border mb-3" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="h5 mb-2">Stream Starting...</p>
                                    <p class="mb-0 opacity-75">Please wait while the stream initializes</p>
                                @else
                                    <i class="fas fa-video-slash fa-3x mb-3 opacity-50"></i>
                                    <p class="h5 mb-2">Stream Offline</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Video Controls Overlay -->
                    <div class="video-controls">
                        <button class="mute-btn" onclick="toggleMute()" title="点击取消静音">
                            <i class="fas fa-volume-mute"></i>
                        </button>
                        <button class="fullscreen-btn" onclick="toggleFullscreen()" title="全屏">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Match Info Section -->
        <section id="section-match-info">
            <div class="container">
                <div class="match-header">
                    <!-- Match Title -->
                    <div class="match-title">
                        <h3>{{ $match['match_title'] ?? $match['home_team'] . ' vs ' . $match['away_team'] }}</h3>
                        <p class="match-info">
                            {{ $match['league'] ?? '英超联赛' }}
                            @if ($match['start_at'])
                                {{ \Carbon\Carbon::parse($match['start_at'])->format('Y/m/d') }} ·
                            @else
                                2024/12 ·
                            @endif
                            {{ $match['round'] ?? '第22轮' }}

                            <!-- Match Status Badge -->
                            @if ($match['obs_status'] == 2)
                                <span class="badge bg-danger ms-2">
                                    <i class="fas fa-circle me-1" style="animation: pulse 2s infinite;"></i>
                                    LIVE
                                </span>
                            @elseif($match['obs_status'] == 1)
                                <span class="badge bg-warning ms-2">STARTING</span>
                            @elseif($match['obs_status'] == 3)
                                <span class="badge bg-secondary ms-2">STOPPING</span>
                            @else
                                <span class="badge bg-dark ms-2">OFFLINE</span>
                            @endif
                        </p>
                    </div>

                    <!-- Bootstrap 5 Nav Pills -->
                    <div class="right-actions">
                        <ul class="nav nav-pills" id="live-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="live-chat-tab" data-bs-toggle="pill"
                                    data-bs-target="#tab-live" type="button" role="tab" aria-controls="tab-live"
                                    aria-selected="true">
                                    <img src="{{ asset('assets/web/images/live/actions/btn-live-chat-active.png') }}"
                                        alt="直播聊天" class="btn-active">
                                    <img src="{{ asset('assets/web/images/live/actions/btn-live-chat-inactive.png') }}"
                                        alt="直播聊天" class="btn-inactive">
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="prediction-tab" data-bs-toggle="pill"
                                    data-bs-target="#tab-matches" type="button" role="tab" aria-controls="tab-matches"
                                    aria-selected="false">
                                    <img src="{{ asset('assets/web/images/live/actions/btn-prediction-active.png') }}"
                                        alt="预测" class="btn-active">
                                    <img src="{{ asset('assets/web/images/live/actions/btn-prediction-inactive.png') }}"
                                        alt="预测" class="btn-inactive">
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="more-tab" data-bs-toggle="pill" data-bs-target="#tab-betting"
                                    type="button" role="tab" aria-controls="tab-betting" aria-selected="false">
                                    <img src="{{ asset('assets/web/images/live/actions/btn-more-active.png') }}"
                                        alt="更多" class="btn-active">
                                    <img src="{{ asset('assets/web/images/live/actions/btn-more-inactive.png') }}"
                                        alt="更多" class="btn-inactive">
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section> <!-- Live Chat Section -->
        <section id="section-live-chat">
            <div class="tab-content" id="live-tab-content">
                <!-- Tab 1: Live Chat -->
                <div class="tab-pane fade show active" id="tab-live" role="tabpanel" aria-labelledby="live-chat-tab">
                    <x-comment-list :comments="$comments ?? []" entity-id="{{ $match['id'] ?? '' }}" entity-type="match"
                        container-class="comments-list live-chat-comments" container-id="live-chat-comments" />
                </div>

                <!-- Tab 2: Match Predictions -->
                <div class="tab-pane fade" id="tab-matches" role="tabpanel" aria-labelledby="prediction-tab">
                    <div class="upcoming-matches-container">
                        <div class="container">
                            <div class="row g-3">
                                @if(isset($predictions) && $predictions->count() > 0)
                                    @foreach($predictions as $prediction)
                                        <div class="col-12">
                                            <a href="{{ route('web.predict.detail', ['id' => $prediction['id']]) }}" class="upcoming-match-item">
                                                <img src="{{ $prediction['image'] }}" 
                                                     alt="{{ $prediction['character_display_name'] }} - 预测"
                                                     class="img-fluid w-100">
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="text-center py-5" style="color: #666;">
                                            <i class="fas fa-chart-line fa-3x mb-3 opacity-50"></i>
                                            <p class="h5 mb-2">暂无预测</p>
                                            <p class="mb-0 opacity-75">这场比赛还没有专家预测</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Betting Options -->
                <div class="tab-pane fade" id="tab-betting" role="tabpanel" aria-labelledby="more-tab">
                    <div class="betting-container">
                        <!-- Action Buttons with Images -->
                        <div class="action-buttons">
                            <div class="action-button">
                                <button class="action-btn other-events-btn" data-action="other-events" 
                                        data-matches-url="{{ route('web.matches') }}">
                                    <img src="{{ asset('assets/web/images/live/more/button-otherevents-live.png') }}"
                                        alt="其他赛事直播" class="action-btn-image no-styling">
                                </button>
                            </div>
                            <div class="action-button">
                                <button class="action-btn" data-action="goto-bet">
                                    <img src="{{ asset('assets/web/images/live/more/button-gotobet.png') }}"
                                        alt="进入投注" class="action-btn-image">
                                </button>
                            </div>
                            <div class="action-button">
                                <button class="action-btn" data-action="goto-activity"
                                        data-events-url="{{ route('web.events') }}">
                                    <img src="{{ asset('assets/web/images/live/more/button-gotoactivity.png') }}"
                                        alt="前往活动" class="action-btn-image">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('fixed-bottom')
    @auth('user')
        <section id="section-input-comment">
            <!-- Comment Input Section -->
            <div class="comment-input-section">
                <div class="container-fluid px-3">
                    <div class="live-comment-wrapper">
                        <!-- Left: Comment Form with Icon -->
                        <form class="comment-form">
                            @csrf
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <img src="{{ asset('assets/web/images/chat/icon-comment.png') }}" alt="Comment">
                                </span>
                                <textarea class="form-control comment-input" name="content" placeholder="留言" rows="1" required></textarea>
                                <button type="submit" class="btn-send">
                                    <img src="{{ asset('assets/web/images/chat/button-send.png') }}" alt="Send">
                                </button>
                            </div>
                        </form>
                        
                        <!-- Right: Bet Button -->
                        <button type="button" class="btn-bet">
                            <img src="{{ asset('assets/web/images/chat/btn-bet.png') }}" alt="去下注">
                        </button>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section id="section-login-prompt">
            <div class="login-prompt-section">
                <div class="container">
                    <div class="login-prompt">
                        <a href="{{ route('web.login') }}" class="btn btn-follow">
                            登录后发表评论
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endauth
@endpush
