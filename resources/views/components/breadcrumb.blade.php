@props(['items'])

<nav class="flex items-center mb-2">
    @foreach($items as $index => $item)
        @if($index > 0)
            <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        @endif
        
        @if(isset($item['url']))
            <a href="{{ $item['url'] }}" 
               class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 transition-colors">
                {{ $item['title'] }}
            </a>
        @else
            <span class="text-sm text-gray-900 font-medium">{{ $item['title'] }}</span>
        @endif
    @endforeach
</nav>