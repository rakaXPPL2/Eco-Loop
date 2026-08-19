@props(['items' => []])

@if(count($items) > 0)
<nav class="flex items-center gap-2 text-sm mb-6">
    <a href="{{ route('home') }}" class="text-emerald-600 hover:text-emerald-700">
        <i class="fas fa-home"></i>
    </a>
    @foreach($items as $index => $item)
        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
        @if($loop->last)
            <span class="text-gray-600 font-medium">{{ $item['label'] }}</span>
        @else
            <a href="{{ $item['url'] }}" class="text-emerald-600 hover:text-emerald-700">{{ $item['label'] }}</a>
        @endif
    @endforeach
</nav>
@endif
