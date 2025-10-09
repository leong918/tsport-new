@props(['match'])

<div class="swiper-slide match-slide" 
     data-title="{{ $match['title'] }}"
     data-league="{{ $match['league'] }}"
     data-status="{{ $match['status'] ?? '' }}">
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
</div>
