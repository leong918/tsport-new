@props(['match'])

@php
    $hasLive = isset($match['has_live']) && $match['has_live'];
    $liveMatchId = $match['live_match_id'] ?? null;
    $isStreaming = isset($match['is_streaming']) && $match['is_streaming'];
@endphp

<div class="swiper-slide match-slide {{ $hasLive ? 'has-live' : '' }}" 
     data-title="{{ $match['title'] }}"
     data-league="{{ $match['league'] }}"
     data-status="{{ $match['status'] ?? '' }}"
     data-has-live="{{ $hasLive ? 'true' : 'false' }}"
     data-live-id="{{ $liveMatchId ?? '' }}">
    
    @if($hasLive && $liveMatchId)
        <a href="{{ route('web.live', ['id' => $liveMatchId]) }}" class="slide-link">
    @endif
    
    <div class="slide">
        <div class="slide__content">
            <div class="slide__img">
                @if(isset($match['image']) && $match['image'])
                    <img src="{{ $match['image'] }}" class="img-fluid" alt="{{ $match['title'] ?? 'Match' }}">
                @else
                    <img src="https://placehold.co/600x400" class="img-fluid" alt="{{ $match['title'] ?? 'Match' }}">
                @endif
            </div>
        </div>
    </div>
    
    @if($hasLive && $liveMatchId)
        </a>
    @endif
</div>
