<div class="flex items-center" x-data="{}">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="mr-2 px-2 py-1 rounded bg-gray-300 text-gray-600">Previous</span>
    @else
        <button class="mr-2 px-2 py-1 rounded bg-blue-500 text-white" wire:click="previousPage">Previous</button>
    @endif

    {{-- Page Number Links --}}
    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <button class="mr-2 px-2 py-1 rounded bg-blue-500 text-white">{{ $page }}</button>
                @else
                    <button class="mr-2 px-2 py-1 rounded bg-gray-300 text-gray-600" wire:click="gotoPage({{ $page }})">{{ $page }}</button>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <button class="px-2 py-1 rounded bg-blue-500 text-white" wire:click="nextPage">Next</button>
    @else
        <span class="px-2 py-1 rounded bg-gray-300 text-gray-600">Next</span>
    @endif
</div>
