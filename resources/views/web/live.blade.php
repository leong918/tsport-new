@extends('web.layout.app')

@php
    // Check if match is upcoming (only based on time)
    $hasStartAt = isset($match['start_at']);
    $isFuture = $hasStartAt ? \Carbon\Carbon::parse($match['start_at'])->isFuture() : false;
    $obsStatus = $match['obs_status'] ?? 'not set';
    
    // Show fixture image if time hasn't arrived yet, regardless of obs_status
    $isUpcoming = $hasStartAt && $isFuture;
    $bodyClass = 'bg-1 no-footer' . ($isUpcoming ? ' live-upcoming' : '');
@endphp

@section('body-class', $bodyClass)

@section('content')
    <div id="page-live" class="screen" data-match-id="{{ $match['url_id'] ?? ($match['id'] ?? '') }}">

        @if ($isUpcoming)
            <!-- Match Fixture Section (Before Match Starts) -->
            <section id="section-prediction-top">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- Fixture Image -->
                            @if (isset($match['fixture_image']) && $match['fixture_image'])
                                <img src="{{ $match['fixture_image'] }}" alt="Match Fixture"
                                    class="img-fluid">
                            @elseif(isset($match['thumbnail']) && $match['thumbnail'])
                                <img src="{{ $match['thumbnail'] }}" alt="Match Thumbnail"
                                    class="img-fluid">
                            @else
                                <img src="{{ asset('assets/web/images/live/sample-video.jpg') }}" alt="Placeholder"
                                    class="img-fluid">
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @else
            <!-- Live Video Section -->
            <section id="section-live-video">
                <div class="video-container">
                    <!-- Video Player -->
                    <div class="video-player" style="position: relative;">
                        @if ($match['obs_status'] == 2 && !empty($match['obs_stream_key']))
                            <!-- HLS Video Player for Live Stream -->
                            <video id="live-stream-player" class="video-js vjs-default-skin" autoplay muted playsinline
                                preload="auto"
                                data-setup='{"fluid": true, "responsive": true, "controls": false, "autoplay": true, "muted": true}'
                                data-stream-key="{{ $match['obs_stream_key'] }}"
                                data-is-live="{{ $match['obs_status'] == 2 ? 'true' : 'false' }}"
                                poster="{{ asset('assets/web/images/live/sample-video.jpg') }}">
                                <p class="vjs-no-js">
                                    To view this video please enable JavaScript, and consider upgrading to a web browser
                                    that
                                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5
                                        video</a>.
                                </p>
                            </video>

                            <!-- Live Stream Indicators -->
                            <div class="live-indicator-hls">
                                <span style="animation: pulse 2s infinite;">●</span> LIVE
                            </div>
                            <div class="viewer-count-hls">
                                <span id="live-viewer-count">{{ number_format($match['viewers']) }}</span>
                            </div>
                        @elseif ($match['obs_status'] == 0 && !empty($match['dvr_recordings']))
                            <!-- Replay Video Player (Stream Ended with Recordings) -->
                            <video id="replay-player" controls playsinline preload="auto"
                                style="width: 100%; height: auto; background: #000;"
                                data-recordings="{{ json_encode($match['dvr_recordings']) }}"
                                poster="{{ asset('assets/web/images/live/sample-video.jpg') }}">
                                您的浏览器不支持视频播放，请使用最新版 Chrome、Edge 或 Firefox 浏览器。
                            </video>

                            <!-- Replay Badge -->
                            <div class="live-indicator-hls" style="background: rgba(108, 117, 125, 0.9);">
                                <i class="fas fa-history me-1"></i> REPLAY
                            </div>
                            
                            <!-- Recording Info -->
                            @if (count($match['dvr_recordings']) > 1)
                                <div class="viewer-count-hls" style="background: rgba(108, 117, 125, 0.9);">
                                    {{ count($match['dvr_recordings']) }} 段录制
                                </div>
                            @endif
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
                                <img src="{{ asset('assets/web/images/live/sample-video.jpg') }}"
                                    alt="Live Video Placeholder" class="img-fluid w-100"
                                    style="height: 100%; object-fit: cover;">
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
                    </div>
                </div>
            </section>
        @endif

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
                            @elseif(isset($match['start_at']) && \Carbon\Carbon::parse($match['start_at'])->isFuture())
                                <span class="badge bg-info ms-2">未开赛</span>
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
                                <button class="nav-link" id="more-tab" data-bs-toggle="pill"
                                    data-bs-target="#tab-betting" type="button" role="tab"
                                    aria-controls="tab-betting" aria-selected="false">
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
                                @if (isset($predictions) && $predictions->count() > 0)
                                    @foreach ($predictions as $prediction)
                                        <div class="col-12">
                                            <a href="{{ route('web.predict.detail', ['id' => $prediction['id']]) }}"
                                                class="upcoming-match-item">
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

@push('scripts')
    <script>
        // Streaming configuration from Laravel config
        window.streamingConfig = {
            flvEndpoint: '{{ config('streaming.flv_endpoint') }}',
            hlsEndpoint: '{{ config('streaming.hls_endpoint') }}',
            rtmpServer: '{{ config('streaming.rtmp_server') }}'
        };
        
        let flvPlayer = null;
        
        // Prevent live.js from handling replay (we handle it here)
        window.replayPlayerInitialized = true;
        
        // Wait for flvjs to be loaded (it's loaded by live.js via Vite)
        function waitForFlvjs(callback, maxAttempts = 50) {
            let attempts = 0;
            const interval = setInterval(() => {
                attempts++;
                if (typeof flvjs !== 'undefined') {
                    console.log('✅ flv.js loaded after', attempts * 100, 'ms');
                    clearInterval(interval);
                    callback();
                } else if (attempts >= maxAttempts) {
                    console.error('❌ Timeout waiting for flv.js');
                    clearInterval(interval);
                    showReplayError('播放器加载超时，请刷新页面重试');
                }
            }, 100);
        }
        
        // Replay player setup with pure flv.js
        document.addEventListener('DOMContentLoaded', function() {
            const replayPlayerElement = document.getElementById('replay-player');
            
            if (replayPlayerElement) {
                console.log('🎬 Replay player element found, waiting for flv.js...');
                
                // Wait for flvjs to be available
                waitForFlvjs(function() {
                    initReplayPlayer(replayPlayerElement);
                });
            }
        });
        
        function initReplayPlayer(replayPlayerElement) {
            const recordingsData = replayPlayerElement.getAttribute('data-recordings');
            
            try {
                const recordings = JSON.parse(recordingsData || '[]');
                console.log('📼 Found recordings:', recordings.length);
                
                if (recordings.length === 0) {
                    showReplayError('没有可播放的录制文件');
                    return;
                }
                
                const recording = recordings[0];
                const videoUrl = recording.file_url || recording.url; // Support both field names
                console.log('🎥 Loading recording:', videoUrl);
                
                if (!videoUrl) {
                    showReplayError('录制文件URL无效');
                    return;
                }
                
                if (!flvjs.isSupported()) {
                    showReplayError('您的浏览器不支持视频播放，请使用最新版 Chrome、Edge 或 Firefox');
                    return;
                }
                
                // Create FLV player
                flvPlayer = flvjs.createPlayer({
                    type: 'flv',
                    url: videoUrl,
                    isLive: false,
                    hasAudio: true,
                    hasVideo: true
                });
                
                // Attach to video element
                flvPlayer.attachMediaElement(replayPlayerElement);
                
                // Event listeners
                flvPlayer.on(flvjs.Events.LOADING_COMPLETE, () => {
                    console.log('✅ Replay loaded successfully');
                });
                
                flvPlayer.on(flvjs.Events.MEDIA_INFO, (info) => {
                    console.log('📊 Media info:', {
                        duration: Math.round(info.duration) + 's',
                        resolution: info.width + 'x' + info.height,
                        videoCodec: info.videoCodec,
                        audioCodec: info.audioCodec
                    });
                });
                
                flvPlayer.on(flvjs.Events.ERROR, (errorType, errorDetail, errorInfo) => {
                    console.error('❌ Playback error:', errorType, errorDetail);
                    
                    let errorMessage = '播放出错';
                    if (errorType === 'NetworkError') {
                        errorMessage = '网络错误，无法加载视频';
                    } else if (errorType === 'MediaError') {
                        errorMessage = '视频格式错误';
                    }
                    
                    showReplayError(errorMessage);
                });
                
                // Load the video
                flvPlayer.load();
                console.log('▶️ Starting playback...');
                
                // Store globally for cleanup
                window.flvPlayer = flvPlayer;
                
            } catch (e) {
                console.error('Error setting up replay:', e);
                showReplayError('录制数据解析失败');
            }
        }
        
        // Cleanup on page unload
        window.addEventListener('beforeunload', function() {
            if (flvPlayer) {
                try {
                    flvPlayer.pause();
                    flvPlayer.unload();
                    flvPlayer.detachMediaElement();
                    flvPlayer.destroy();
                } catch (e) {
                    console.error('Cleanup error:', e);
                }
            }
        });
        
        function showReplayError(message) {
            const videoContainer = document.querySelector('.video-player');
            if (videoContainer) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-warning mt-3';
                errorDiv.style.margin = '20px';
                errorDiv.innerHTML = `
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    ${message}
                `;
                videoContainer.appendChild(errorDiv);
            }
        }
    </script>
@endpush
