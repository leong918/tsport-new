@extends('web.layout.app')

@section('body-class', 'bg-1 no-footer')

@push('styles')
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet">
    <style>
        .video-js {
            width: 100%;
            height: 100%;
        }

        .live-indicator-hls {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(255, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            z-index: 10;
        }

        .viewer-count-hls {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            z-index: 10;
            transition: all 0.3s ease;
        }
        
        /* Viewer count animation effects */
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .viewer-increase {
            animation: pulse 0.5s ease-in-out;
            color: #28a745 !important;
        }
        
        .viewer-decrease {
            animation: pulse 0.5s ease-in-out;
            color: #dc3545 !important;
        }
    </style>
@endpush

@section('content')
    <div id="page-live" class="screen" data-match-id="{{ $match['id'] ?? '' }}">
        <!-- Live Video Section -->
        <section id="section-live-video">
            <div class="video-container">
                <!-- Video Player -->
                <div class="video-player" style="position: relative;">
                    @if ($match['obs_status'] == 2 && $match['obs_stream_key'])
                        <!-- HLS Video Player for Live Stream -->
                        <video id="live-stream-player" class="video-js vjs-default-skin" controls preload="auto"
                            data-setup='{"fluid": true, "responsive": true}'
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
                            <span id="live-viewer-count">{{ number_format($match['viewers']) }}</span> viewers
                        </div>
                    @elseif (isset($match['video_url']) && $match['video_url'])
                        <!-- Regular Video -->
                        <video id="live-video" controls autoplay muted>
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
                        <div style="position: relative; height: 300px;">
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
                                    <p class="mb-0 opacity-75">The stream will appear here when live</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Video Controls Overlay -->
                    <div class="video-controls">
                        <button class="fullscreen-btn" onclick="toggleFullscreen()">
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

                <!-- Tab 2: Upcoming Matches -->
                <div class="tab-pane fade" id="tab-matches" role="tabpanel" aria-labelledby="prediction-tab">
                    <div class="upcoming-matches-container">
                        <div class="container">
                            <div class="row g-3">
                                <div class="col-12">
                                    <a href="#" class="upcoming-match-item">
                                        <img src="{{ asset('assets/web/images/live/sample.png') }}" alt="Sample Image"
                                            class="img-fluid w-100">
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="#" class="upcoming-match-item">
                                        <img src="{{ asset('assets/web/images/live/sample.png') }}" alt="Sample Image"
                                            class="img-fluid w-100">
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="#" class="upcoming-match-item">
                                        <img src="{{ asset('assets/web/images/live/sample.png') }}" alt="Sample Image"
                                            class="img-fluid w-100">
                                    </a>
                                </div>
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
                                <button class="action-btn other-events-btn" data-action="other-events">
                                    <img src="{{ asset('assets/web/images/live/more/button-otherevents-live.png') }}"
                                        alt="其他活动" class="action-btn-image no-styling">
                                </button>
                            </div>
                            <div class="action-button">
                                <button class="action-btn" data-action="goto-bet">
                                    <img src="{{ asset('assets/web/images/live/more/button-gotobet.png') }}"
                                        alt="进入投注" class="action-btn-image">
                                </button>
                            </div>
                            <div class="action-button">
                                <button class="action-btn" data-action="goto-activity">
                                    <img src="{{ asset('assets/web/images/live/more/button-gotoactivity.png') }}"
                                        alt="进入活动" class="action-btn-image">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://vjs.zencdn.net/8.6.1/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flv.js/dist/flv.min.js"></script>
    <!-- Live Viewer Tracker -->
    <script src="{{ asset('assets/web/js/live-viewer-tracker.js') }}"></script>
    <script>
        let player = null;

        document.addEventListener('DOMContentLoaded', function() {
            initializePlayer();
            initializeStatusUpdates();
        });

        function initializePlayer() {
            const streamKey = '{{ $match['obs_stream_key'] ?? '' }}';
            const isLive = {{ $match['obs_status'] == 2 ? 'true' : 'false' }};

            if (isLive && streamKey) {
                // Use FLV stream for live broadcasting
                const flvUrl = `http://localhost:8889/live/${streamKey}.flv`;

                if (typeof videojs !== 'undefined' && document.getElementById('live-stream-player')) {
                    player = videojs('live-stream-player', {
                        controls: true,
                        fluid: true,
                        responsive: true,
                        liveui: true,
                        html5: {
                            vhs: {
                                overrideNative: true
                            }
                        }
                    });

                    // Try to load FLV stream first
                    console.log('Attempting to load FLV stream:', flvUrl);
                    
                    // Use FLV.js for better FLV support
                    if (typeof flvjs !== 'undefined' && flvjs.isSupported()) {
                        console.log('Using FLV.js for stream playback');
                        
                        const videoElement = player.tech().el();
                        const flvPlayer = flvjs.createPlayer({
                            type: 'flv',
                            url: flvUrl,
                            isLive: true
                        });
                        
                        flvPlayer.attachMediaElement(videoElement);
                        flvPlayer.load();
                        
                        flvPlayer.on(flvjs.Events.LOADING_COMPLETE, () => {
                            console.log('FLV stream loaded successfully');
                            flvPlayer.play().catch(e => console.log('Auto-play prevented:', e));
                        });
                        
                        flvPlayer.on(flvjs.Events.ERROR, (errorType, errorDetail) => {
                            console.error('FLV player error:', errorType, errorDetail);
                            // Show error message to user
                            showStreamError('Stream connection failed. Please refresh the page.');
                        });
                        
                        // Store flv player for cleanup
                        player.flvPlayer = flvPlayer;
                    } else {
                        // Fallback: Test if stream is available via fetch
                        console.log('FLV.js not supported, testing stream availability...');
                        fetch(flvUrl, { method: 'HEAD' })
                            .then(response => {
                                if (response.ok) {
                                    console.log('FLV stream available, trying direct video source...');
                                    player.src({
                                        src: flvUrl,
                                        type: 'video/x-flv'
                                    });
                                    player.play().catch(e => console.log('Auto-play prevented:', e));
                                } else {
                                    console.log('FLV stream not available');
                                    showStreamError('Stream is currently offline.');
                                }
                            })
                            .catch(error => {
                                console.log('FLV test failed:', error);
                                showStreamError('Unable to connect to stream.');
                            });
                    }

                    player.on('error', function(e) {
                        console.error('Player error:', e);
                        setTimeout(function() {
                            console.log('Attempting to reload stream...');
                            location.reload();
                        }, 5000);
                    });
                }
            }
        }

        function showStreamError(message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-warning mt-3';
            errorDiv.innerHTML = `
                <i class="fas fa-exclamation-triangle me-2"></i>
                ${message}
                <button class="btn btn-sm btn-outline-primary ms-3" onclick="location.reload()">
                    Refresh Page
                </button>
            `;
            
            const videoContainer = document.querySelector('.video-player');
            if (videoContainer) {
                videoContainer.appendChild(errorDiv);
            }
        }

        function initializeStatusUpdates() {
            const matchId = '{{ $match['id'] ?? '' }}';
            if (matchId) {
                // Poll for status updates every 15 seconds
                setInterval(function() {
                    updateViewerCount(matchId);
                }, 15000);
            }
        }

        function updateViewerCount(matchId) {
            if (!matchId) return;

            fetch(`/live/${matchId}/viewer-count`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const viewerCountElement = document.getElementById('live-viewer-count');
                        if (viewerCountElement) {
                            viewerCountElement.textContent = data.viewer_count.toLocaleString();
                        }
                    }
                })
                .catch(error => console.error('Error updating viewer count:', error));
        }

        function toggleFullscreen() {
            if (player) {
                if (player.isFullscreen()) {
                    player.exitFullscreen();
                } else {
                    player.requestFullscreen();
                }
            }
        }

        // Cleanup on page unload
        window.addEventListener('beforeunload', function() {
            if (player && player.flvPlayer) {
                player.flvPlayer.destroy();
            }
        });
    </script>
@endpush

@push('fixed-bottom')
    @auth('user')
        <section id="section-input-comment">
            <!-- Comment Input Section -->
            <div class="comment-input-section">
                <div class="container">
                    <form class="comment-form">
                        @csrf
                        <div class="input-group">
                            <textarea class="form-control comment-input" name="content" placeholder="留言" rows="1" required></textarea>
                            <button type="submit" class="btn btn-follow submit-button">
                                发表评论
                            </button>
                        </div>
                    </form>
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
