@props(['paginator'])

@if ($paginator->hasPages())
    @php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        $start = max(2, $current - 1);
        $end = min($last - 1, $current + 1);
    @endphp

    <div class="flex justify-center mt-6 space-x-1 flex-wrap">
        {{-- Prev --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-400 cursor-not-allowed">Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-lg text-sm hover:border-black transition shadow">Prev</a>
        @endif

        {{-- Halaman 1 --}}
        @if ($current === 1)
            <span class="px-3 py-1 border border-black bg-black text-white text-sm rounded-lg shadow">1</span>
        @else
            <a href="{{ $paginator->url(1) }}" class="px-3 py-1 border border-gray-300 rounded-lg hover:border-black text-sm transition shadow">1</a>
        @endif

        {{-- Ellipsis setelah halaman 1 --}}
        @if ($start > 2)
            <span class="px-3 py-1 text-gray-400">…</span>
        @endif

        {{-- Halaman tengah --}}
        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $current)
                <span class="px-3 py-1 border border-black bg-black text-white text-sm rounded-lg shadow">{{ $i }}</span>
            @else
                <a href="{{ $paginator->url($i) }}" class="px-3 py-1 border border-gray-300 rounded-lg hover:border-black text-sm transition shadow">{{ $i }}</a>
            @endif
        @endfor

        {{-- Ellipsis sebelum halaman terakhir --}}
        @if ($end < $last - 1)
            <span class="px-3 py-1 text-gray-400">…</span>
        @endif

        {{-- Halaman terakhir --}}
        @if ($last > 1)
            @if ($current === $last)
                <span class="px-3 py-1 border border-black bg-black text-white text-sm rounded-lg shadow">{{ $last }}</span>
            @else
                <a href="{{ $paginator->url($last) }}" class="px-3 py-1 border border-gray-300 rounded-lg hover:border-black text-sm transition shadow">{{ $last }}</a>
            @endif
        @endif

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-lg text-sm hover:border-black transition shadow">Next</a>
        @else
            <span class="px-3 py-1 border border-gray-300 rounded-lg text-sm text-gray-400 cursor-not-allowed">Next</span>
        @endif
    </div>
@endif