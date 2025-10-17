@props([
    'comments' => [],
    'entityId' => null,
    'entityType' => 'predict', // 'predict', 'match', etc.
    'showSampleComments' => false,
    'noCommentsMessage' => '还没有评论，快来抢沙发吧！',
    'containerClass' => 'comments-list',
    'containerId' => 'comments-list'
])

<div class="comment-list-component">
    <div class="{{ $containerClass }}" id="{{ $containerId }}">
        @if(isset($comments) && count($comments) > 0)
            @foreach($comments as $comment)
                <x-comment-item :comment="$comment" />
            @endforeach
        @elseif($showSampleComments)
            <!-- Sample Comments for Demo -->
            @php
                $sampleComments = [
                    [
                        'id' => 'demo-1',
                        'user_name' => 'PorkGuy',
                        'comment' => '曼联这套在做什么啊',
                        'likes_count' => 5,
                        'user_liked' => false,
                        'created_at_human' => '2分钟前',
                        'avatar' => asset('assets/web/images/chat/avatar-1.png')
                    ],
                    [
                        'id' => 'demo-2', 
                        'user_name' => 'LalaGuy',
                        'comment' => '要进球只能靠自发发力',
                        'likes_count' => 3,
                        'user_liked' => false,
                        'created_at_human' => '3分钟前',
                        'avatar' => asset('assets/web/images/chat/avatar-2.png')
                    ],
                    [
                        'id' => 'demo-3',
                        'user_name' => 'Huat888', 
                        'comment' => '真想吐你给我稍等一点！',
                        'likes_count' => 2,
                        'user_liked' => false,
                        'created_at_human' => '5分钟前',
                        'avatar' => asset('assets/web/images/chat/avatar-3.png')
                    ],
                    [
                        'id' => 'demo-4',
                        'user_name' => 'fquinf',
                        'comment' => '别告，哈兰德给出手',
                        'likes_count' => 1,
                        'user_liked' => false,
                        'created_at_human' => '7分钟前',
                        'avatar' => asset('assets/web/images/chat/avatar-4.png')
                    ],
                    [
                        'id' => 'demo-5',
                        'user_name' => 'ahbengg',
                        'comment' => '五五开局面，曼联小优',
                        'likes_count' => 0,
                        'user_liked' => false,
                        'created_at_human' => '10分钟前',
                        'avatar' => asset('assets/web/images/chat/avatar-5.png')
                    ]
                ]
            @endphp
            
            @foreach($sampleComments as $comment)
                <x-comment-item :comment="$comment" />
            @endforeach
        @else
            <div class="no-comments">
                <p class="text-center text-muted">{{ $noCommentsMessage }}</p>
            </div>
        @endif
    </div>
    
    <!-- Optional slot for additional content -->
    @if($slot->isNotEmpty())
        {{ $slot }}
    @endif
</div>
