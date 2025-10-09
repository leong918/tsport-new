@props(['title', 'image', 'timer'])

<div class="event">
    <div class="event__body">
        <div class="event__banner">
            @if($image)
                <img src="{{ $image }}" alt="{{ $title }}" class="img-fluid" />
            @else
                <div class="img-fluid d-flex align-items-center justify-content-center bg-secondary text-white" style="height: 150px;">
                    <span>{{ $title }}</span>
                </div>
            @endif
        </div>
    </div>
    <div class="event__footer">
        <h4 class="event__title text-white">{{ $title }}</h4>
        <h4 class="event__timer text-white">{{ $timer }}</h4>
    </div>
</div>
