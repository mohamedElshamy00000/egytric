@if ($paginator->hasPages())
    <div class="pagination-container">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @php
                    $start = $paginator->currentPage() - 2; // show 2 pages before current
                    $end = $paginator->currentPage() + 2;   // show 2 pages after current
                    if($start < 1) {
                        $start = 1;
                        $end = min(5, $paginator->lastPage());
                    }
                    if($end > $paginator->lastPage()) {
                        $end = $paginator->lastPage();
                        $start = max(1, $end - 4);
                    }
                @endphp

                {{-- Pagination Elements --}}
                @for ($i = $end; $i >= $start; $i--)
                    @if ($i == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $i }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        </li>
                    @endif
                @endfor

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
