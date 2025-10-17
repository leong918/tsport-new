@props(['match'])

@php
    // Determine if this match has a live stream
    $hasLive = isset($match['has_live']) && $match['has_live'];
    $liveMatchId = $match['live_match_id'] ?? null;
    $isStreaming = isset($match['is_streaming']) && $match['is_streaming'];
@endphp

<div class="match-item {{ $hasLive ? 'has-live' : '' }}">
    @if($hasLive && $liveMatchId)
        <a href="{{ route('web.live', ['id' => $liveMatchId]) }}" class="match-item-link">
    @endif
    
    <div class="match-item__img">
        @if(isset($match['image']) && $match['image'])
            <img src="{{ $match['image'] }}" class="img-fluid" alt="{{ $match['title'] ?? 'Match' }}">
        @else
            <div class="placeholder-img d-flex align-items-center justify-content-center">
                <span class="text-muted">暂无图片</span>
            </div>
        @endif
    </div>
    <div class="match-item__info">
        <h5 class="match-teams">{{ $match['title'] }}</h5>
        <p class="match-league p2">{{ $match['league'] }}</p>
    </div>
    
    @if($hasLive && $liveMatchId)
        </a>
    @endif
</div>

