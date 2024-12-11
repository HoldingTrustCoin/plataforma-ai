<div class="w-full">
    <div class="w-full flex justify-between items-center">
        <div>
            <!-- Previous Page Link -->
            @if ($paginator->onFirstPage())
                <div class="disabled"><span>&laquo;</span></div>
            @else
                <div><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></div>
            @endif
        </div>

        <div class="w-full md:w-3/4 flex justify-center space-x-1 overflow-hidden">
            <!-- Pagination Links -->
            @php
                $pageCount = $paginator->lastPage();
                $currentPage = $paginator->currentPage();
                $startIndex = $currentPage <= 2 ? 1 : max($currentPage - 2, 1);
                $endIndex = $currentPage <= 2 ? min($pageCount, 6) : min($currentPage + 2, $pageCount);
            @endphp

            

            @for ($i = $startIndex; $i <= $endIndex; $i++)
                @if ($i == $currentPage)
                    <div
                        class="bg-purple-500 px-3 rounded border border-slate-800 hover:border-slate-600 cursor-pointer hover:scale-110 transition-all paginator-link">
                        <span>{{ $i }}</span>
                    </div>
                @else
                    <a class="px-3 rounded border border-slate-800 hover:border-slate-600 cursor-pointer hover:scale-110 transition-all paginator-link"
                        href="{{ $paginator->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($currentPage < $pageCount - 1)
                <div class="disabled"><span>...</span></div>
                <a href="{{ $paginator->url($pageCount) }}"
                    class="px-3 rounded border border-slate-800 hover:border-slate-600 cursor-pointer hover:scale-110 transition-all paginator-link">
                    {{ $pageCount }}
                </a>
            @endif
        </div>

        <div>
            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <div><a href="{{ $paginator->nextPageUrl() }}" rel="next" class="paginator-link">&raquo;</a></div>
            @else
                <div class="disabled"><span>&raquo;</span></div>
            @endif
        </div>
    </div>
</div>
