@props(['comment', 'actions' => ''])

<div class="comment-item" data-comment-id="{{ $comment['id'] ?? '' }}">
    <div class="comment-avatar">
        <div class="avatar-img">
            <img src="{{ $comment['avatar'] ?? asset('assets/web/images/chat/avatar-default.png') }}" alt="{{ $comment['user_name'] ?? 'User' }}">
        </div>
    </div>
    <div class="comment-content">
        <div class="comment-meta">
            <span class="comment-author">{{ $comment['user_name'] ?? 'Anonymous' }}</span>
            <span class="comment-time">{{ $comment['created_at_human'] ?? '' }}</span>
        </div>
        <div class="comment-bubble">
            {{ $comment['comment'] ?? '' }}
        </div>
    </div>
    <div class="comment-actions">
        @auth('user')
            <button class="like-btn{{ isset($comment['user_liked']) && $comment['user_liked'] ? ' liked' : '' }}" data-comment-id="{{ $comment['id'] ?? '' }}">
                <img src="{{ asset(isset($comment['user_liked']) && $comment['user_liked'] ? 'assets/web/images/chat/like-active.png' : 'assets/web/images/chat/like-inactive.png') }}" alt="Like">
                <span class="like-count">{{ $comment['likes_count'] ?? 0 }}</span>
            </button>
        @endauth
        @if(!empty($actions))
            {!! $actions !!}
        @endif
    </div>
</div>
