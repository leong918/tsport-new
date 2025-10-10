@extends('web.layout.app')

@section('body-class', 'bg-1')

@section('content')
    <div id="page-predict-detail" class="screen">
        <!-- Predict Detail Section -->
        <section id="section-predict-detail" class="py-4">
            <div class="container">
                <div class="row">
                    <!-- Back Button -->
                    <div class="col-12 mb-3">
                        <a href="{{ route('web.predict') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>返回预测列表
                        </a>
                    </div>

                    <!-- Main Prediction Content -->
                    <div class="col-lg-8">
                        <div class="prediction-detail-card">
                            <!-- Character Info -->
                            <div class="character-info mb-4">
                                <div class="character-badge-large">
                                    <span class="expert-name">{{ $prediction['character_display_name'] }}</span>
                                    @if($prediction['match'])
                                        <span class="prediction-match">{{ $prediction['match']['title'] }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Prediction Image -->
                            @if($prediction['image'])
                                <div class="prediction-image-large mb-4">
                                    <img src="{{ asset('storage/' . $prediction['image']) }}" 
                                         alt="Prediction by {{ $prediction['character_name'] }}" 
                                         class="img-fluid rounded">
                                </div>
                            @endif

                            <!-- Match Information -->
                            @if($prediction['match'])
                                <div class="match-info-detail mb-4">
                                    <h3>比赛信息</h3>
                                    <div class="match-details">
                                        <h4>{{ $prediction['match']['title'] }}</h4>
                                        @if($prediction['match']['start_at'])
                                            @php
                                                $matchDate = \Carbon\Carbon::parse($prediction['match']['start_at']);
                                            @endphp
                                            <p class="match-time">
                                                <i class="fas fa-calendar me-2"></i>
                                                {{ $matchDate->format('Y年m月d日 H:i') }}
                                            </p>
                                        @endif
                                        @if($prediction['match']['short_content'])
                                            <p class="match-league">
                                                <i class="fas fa-trophy me-2"></i>
                                                {{ $prediction['match']['short_content'] }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Prediction Content -->
                            <div class="prediction-content-detail mb-4">
                                <h3>预测内容</h3>
                                <div class="prediction-text">
                                    {!! nl2br(e($prediction['description'])) !!}
                                </div>
                            </div>

                            <!-- Stats -->
                            <div class="prediction-stats-detail mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="stat-card">
                                            <i class="fas fa-heart text-danger"></i>
                                            <span class="stat-number">{{ $prediction['likes_count'] }}</span>
                                            <span class="stat-label">喜欢</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="stat-card">
                                            <i class="fas fa-comment text-primary"></i>
                                            <span class="stat-number">{{ $prediction['comments_count'] }}</span>
                                            <span class="stat-label">评论</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Comments Section -->
                            @if($prediction['comments']->count() > 0)
                                <div class="comments-section">
                                    <h3>用户评论</h3>
                                    <div class="comments-list">
                                        @foreach($prediction['comments'] as $comment)
                                            <div class="comment-item">
                                                <div class="comment-header">
                                                    <strong>{{ $comment['user_name'] }}</strong>
                                                    <small class="text-muted">{{ $comment['created_at'] }}</small>
                                                </div>
                                                <div class="comment-content">
                                                    {{ $comment['comment'] }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Related Predictions -->
                        @if($relatedPredictions->count() > 0)
                            <div class="related-predictions-sidebar">
                                <h4>相关预测</h4>
                                @foreach($relatedPredictions as $related)
                                    <div class="related-prediction-item">
                                        <a href="{{ route('web.predict.detail', ['id' => $related['id']]) }}" class="related-link">
                                            @if($related['image'])
                                                <div class="related-image">
                                                    <img src="{{ asset('storage/' . $related['image']) }}" 
                                                         alt="Related Prediction" 
                                                         class="img-fluid rounded">
                                                </div>
                                            @endif
                                            <div class="related-content">
                                                <h6>{{ $related['character_display_name'] }}</h6>
                                                <p class="related-match">{{ $related['match_title'] }}</p>
                                                <p class="related-description">{{ Str::limit($related['description'], 100) }}</p>
                                                <div class="related-stats">
                                                    <small>
                                                        <i class="fas fa-heart"></i> {{ $related['likes_count'] }}
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('style')
<style>
.prediction-detail-card {
    background: #fff;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.character-badge-large {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 15px;
    text-align: center;
}

.character-badge-large .expert-name {
    display: block;
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.character-badge-large .prediction-match {
    display: block;
    font-size: 1rem;
    opacity: 0.9;
}

.prediction-image-large img {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: cover;
}

.match-info-detail {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
}

.match-info-detail h4 {
    color: #333;
    margin-bottom: 1rem;
}

.match-time, .match-league {
    margin-bottom: 0.5rem;
    color: #666;
}

.prediction-content-detail {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
}

.prediction-text {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #333;
}

.stat-card {
    background: #fff;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 1rem;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    border-color: #007bff;
    transform: translateY(-2px);
}

.stat-card i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

.stat-label {
    display: block;
    font-size: 0.9rem;
    color: #666;
}

.comments-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
}

.comment-item {
    background: #fff;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    border-left: 3px solid #007bff;
}

.comment-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.related-predictions-sidebar {
    background: #fff;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.related-prediction-item {
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 1rem;
    margin-bottom: 1rem;
}

.related-prediction-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.related-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.related-link:hover {
    text-decoration: none;
    color: inherit;
}

.related-image img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    margin-bottom: 0.5rem;
}

.related-content h6 {
    color: #007bff;
    margin-bottom: 0.25rem;
}

.related-match {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.related-description {
    font-size: 0.85rem;
    color: #333;
    margin-bottom: 0.5rem;
}

.related-stats {
    font-size: 0.8rem;
    color: #666;
}
</style>
@endsection
