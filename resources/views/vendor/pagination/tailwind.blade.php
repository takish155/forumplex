@if ($paginator->hasPages())
    <div class="flex justify-between items-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="btn btn-primary btn-disabled" disabled>
                {{ __('pagination.previous') }}
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-primary">
                {{ __('pagination.previous') }}
            </a>
        @endif

        {{-- Pagination Links --}}
        <div class="flex space-x-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="btn btn-primary btn-disabled">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="btn btn-primary btn-disabled">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="btn btn-primary">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-primary">
                {{ __('pagination.next') }}
            </a>
        @else
            <button class="btn btn-primary btn-disabled" disabled>
                {{ __('pagination.next') }}
            </button>
        @endif
    </div>
@endif
