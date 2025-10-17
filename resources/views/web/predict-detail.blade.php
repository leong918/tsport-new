@extends('web.layout.app')

@section('body-class', 'bg-1 no-footer predict-detail-page')

@section('content')
    <div id="page-predict-detail" class="screen" data-predict-id="{{ $prediction['id'] }}">
        <section id="section-prediction-top">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Prediction Image -->
                        @if ($prediction['image'])
                            <img src="{{ $prediction['image'] }}"
                                alt="Prediction by {{ $prediction['character_name'] }}" class="img-fluid">
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section id="section-prediction-detail">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="prediction-description">
                            {!! nl2br($prediction['description']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Comments Section -->
        <section id="section-comments">
            <div class="comments-header">
                <div class="stats-bar">
                    <div class="stat-item">
                        @auth('user')
                            <button class="like-prediction-btn predict-like-btn{{ isset($prediction['user_liked']) && $prediction['user_liked'] ? ' liked' : '' }}" 
                                    data-predict-id="{{ $prediction['id'] }}"
                                    onclick="window.PredictDetail?.likePredict && window.PredictDetail.likePredict(event, {{ $prediction['id'] }})">
                                <img src="{{ asset(isset($prediction['user_liked']) && $prediction['user_liked'] ? 'assets/web/images/chat/like-title-active.png' : 'assets/web/images/chat/like-title-inactive.png') }}" alt="Like">
                                <span class="like-count">{{ $prediction['likes_count'] ?? 0 }}</span>
                            </button>
                        @else
                            <div class="stat-item-display">
                                <img src="{{ asset('assets/web/images/chat/like-title-inactive.png') }}" alt="Like">
                                <span id="likes-count">{{ $prediction['likes_count'] ?? 0 }}</span>
                            </div>
                        @endauth
                    </div>
                    <div class="stat-item">
                        <img src="{{ asset('assets/web/images/chat/btn-comment.png') }}" alt="Comment">
                        <span>{{ $prediction['comments_count'] ?? 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <button class="share-btn" 
                                data-url="{{ url()->current() }}"
                                data-title="{{ $prediction['character_display_name'] ?? $prediction['character_name'] }}的预测"
                                onclick="window.PredictDetail?.copyLink && window.PredictDetail.copyLink(event)"
                                title="复制链接">
                            <img src="{{ asset('assets/web/images/chat/btn-share.png') }}" alt="Share">
                        </button>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <x-comment-list 
                            :comments="$prediction['comments'] ?? []"
                            entity-id="{{ $prediction['id'] }}"
                            entity-type="predict"
                            container-class="comments-list predict-comments"
                            container-id="comments-list"
                            no-comments-message="还没有评论，快来抢沙发吧！"
                        />

                        <!-- Padding for fixed comment input -->
                        <div class="comments-bottom-padding"></div>

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
                <div class="container">
                    <form class="comment-form" data-predict-id="{{ $prediction['id'] }}">
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
