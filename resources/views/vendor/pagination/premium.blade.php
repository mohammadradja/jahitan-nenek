@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center space-x-2 mt-16">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-50 text-gray-300 border border-gray-100 cursor-not-allowed transition-all">
                <i class="fas fa-chevron-left text-[10px]"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" 
               class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-gray-100 text-dark-wool hover:bg-soft-rose hover:text-white hover:border-soft-rose hover:-translate-y-1 transition-all duration-300 shadow-sm shadow-dark-wool/5 active:scale-95 group">
                <i class="fas fa-chevron-left text-[10px] group-hover:scale-110 transition-transform"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex items-center space-x-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w-12 h-12 flex items-center justify-center text-gray-400 font-bold tracking-widest">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-soft-rose text-white font-bold shadow-xl shadow-soft-rose/30 transition-all scale-110 z-10">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" 
                               class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-gray-100 text-dark-wool font-bold hover:bg-soft-rose hover:text-white hover:border-soft-rose hover:-translate-y-1 transition-all duration-300 shadow-sm shadow-dark-wool/5 active:scale-95">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" 
               class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-gray-100 text-dark-wool hover:bg-soft-rose hover:text-white hover:border-soft-rose hover:-translate-y-1 transition-all duration-300 shadow-sm shadow-dark-wool/5 active:scale-95 group">
                <i class="fas fa-chevron-right text-[10px] group-hover:scale-110 transition-transform"></i>
            </a>
        @else
            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-50 text-gray-300 border border-gray-100 cursor-not-allowed transition-all">
                <i class="fas fa-chevron-right text-[10px]"></i>
            </span>
        @endif
    </nav>
@endif
