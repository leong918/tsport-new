@if ($paginator->hasPages())
    <div class="custom-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="pagination-prev disabled">
                <img src="{{ asset('assets/web/images/pagination/page-prev-unavailable.png') }}" alt="Previous" />
            </div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-prev" rel="prev">
                <img src="{{ asset('assets/web/images/pagination/page-prev-available.png') }}" alt="Previous" />
            </a>
        @endif

        {{-- Page Numbers --}}
        <div class="pagination-numbers">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="pagination-dots">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pagination-number active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pagination-number">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next" rel="next">
                <img src="{{ asset('assets/web/images/pagination/page-next-available.png') }}" alt="Next" />
            </a>
        @else
            <div class="pagination-next disabled">
                <img src="{{ asset('assets/web/images/pagination/page-next-unavailable.png') }}" alt="Next" />
            </div>
        @endif
    </div>
@endif
