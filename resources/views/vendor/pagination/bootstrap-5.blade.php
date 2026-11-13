@if ($paginator->hasPages())
    <div class="pagination-container-custom">
        <!-- Pagination Nav Pills -->
        <nav aria-label="Page navigation" class="pagination-pill-nav">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="page-btn disabled" aria-disabled="true">
                    <i class="bi bi-chevron-left me-1"></i>
                    <span class="d-none d-sm-inline">{{ app()->getLocale() === 'en' ? 'Prev' : 'முந்தைய' }}</span>
                </span>
            @else
                <a class="page-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <i class="bi bi-chevron-left me-1"></i>
                    <span class="d-none d-sm-inline">{{ app()->getLocale() === 'en' ? 'Prev' : 'முந்தைய' }}</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="page-dots">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="page-btn active" aria-current="page">{{ $page }}</span>
                        @else
                            <a class="page-btn" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="page-btn" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <span class="d-none d-sm-inline">{{ app()->getLocale() === 'en' ? 'Next' : 'அடுத்தது' }}</span>
                    <i class="bi bi-chevron-right ms-1"></i>
                </a>
            @else
                <span class="page-btn disabled" aria-disabled="true">
                    <span class="d-none d-sm-inline">{{ app()->getLocale() === 'en' ? 'Next' : 'அடுத்தது' }}</span>
                    <i class="bi bi-chevron-right ms-1"></i>
                </span>
            @endif
        </nav>

        <!-- Showing X of Y Results Pill -->
        <div class="pagination-result-pill">
            <i class="bi bi-view-list text-primary"></i>
            @if(app()->getLocale() === 'en')
                <span>Showing <strong>{{ $paginator->firstItem() }}</strong> to <strong>{{ $paginator->lastItem() }}</strong> of <strong>{{ $paginator->total() }}</strong> results</span>
            @else
                <span>மொத்தம் <strong>{{ $paginator->total() }}</strong> செய்திகளில் <strong>{{ $paginator->firstItem() }} - {{ $paginator->lastItem() }}</strong> காட்டப்படுகிறது</span>
            @endif
        </div>
    </div>
@endif
