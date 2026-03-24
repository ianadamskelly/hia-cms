@if (!empty($items) && count($items))
    <nav class="text-sm text-gray-500 mb-6" aria-label="Breadcrumb">
        <ol class="flex flex-wrap items-center gap-2">
            <li>
                <a href="{{ url('/') }}" class="hover:text-blue-700">Home</a>
            </li>

            @foreach($items as $item)
                <li>/</li>
                <li>
                    @if(!empty($item['url']))
                        <a href="{{ $item['url'] }}" class="hover:text-blue-700">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="text-gray-700">{{ $item['label'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif