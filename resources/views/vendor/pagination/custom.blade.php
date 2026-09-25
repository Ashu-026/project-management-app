@if ($paginator->hasPages())
    <nav class="d-flex justify-content-center mt-4">
        <div class="d-flex align-items-center gap-3 px-4 py-2 bg-white rounded-pill shadow-sm">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="text-muted" style="opacity: 0.4;">
                    <i class="bi bi-chevron-left"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="text-decoration-none" style="color: #4c1d95;">
                    <i class="bi bi-chevron-left"></i>
                </a>
            @endif
            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="text-muted">{{ $element }}</span>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
                                style="width: 36px; height: 36px; background: linear-gradient(135deg, #7c3aed 0%, #4c1d95 100%); box-shadow: 0 0 0 4px rgba(124,58,237,0.15);">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="text-decoration-none fw-medium" style="color: #495057;">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="text-decoration-none" style="color: #4c1d95;">
                    <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span class="text-muted" style="opacity: 0.4;">
                    <i class="bi bi-chevron-right"></i>
                </span>
            @endif

        </div>
    </nav>
@endif