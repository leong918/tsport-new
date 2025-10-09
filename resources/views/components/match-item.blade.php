@props(['match'])

<div class="match-item">
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
</div>
