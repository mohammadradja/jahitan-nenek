@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-50 text-gray-300 cursor-not-allowed transition-all">
                <i class="fas fa-chevron-left text-xs"></i>
            </span>
        @else
            <button @click="category = '{{ request('category') }}'; search = '{{ request('search') }}'; window.location.href = '{{ $paginator->previousPageUrl() }}'" 
                    class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-gray-100 text-dark-wool hover:bg-soft-rose hover:text-white hover:border-soft-rose transition-all shadow-sm active:scale-95">
                <i class="fas fa-chevron-left text-xs"></i>
            </button>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="w-12 h-12 flex items-center justify-center text-gray-400">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-soft-rose text-white font-bold shadow-lg shadow-soft-rose/20">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" 
                           class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-gray-100 text-dark-wool font-bold hover:bg-soft-rose hover:text-white hover:border-soft-rose transition-all shadow-sm active:scale-95">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" 
               class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-gray-100 text-dark-wool hover:bg-soft-rose hover:text-white hover:border-soft-rose transition-all shadow-sm active:scale-95">
                <i class="fas fa-chevron-right text-xs"></i>
            </a>
        @else
            <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-50 text-gray-300 cursor-not-allowed transition-all">
                <i class="fas fa-chevron-right text-xs"></i>
            </span>
        @endif
    </nav>
@endif
