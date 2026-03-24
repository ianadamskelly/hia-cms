<header class="border-b bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4 grid grid-cols-3 items-center gap-6">
        <div class="flex items-center">
            <a href="/" class="text-2xl font-bold text-blue-700">
                {{ $siteSettings['site_name'] ?? 'HIA CMS' }}
            </a>
        </div>

        <nav class="hidden md:flex items-center justify-center gap-6 text-sm font-medium">
            @foreach(($mainNavigationMenu?->items ?? collect())->whereNull('parent_id')->where('is_active', true)->sortBy('sort_order') as $item)
                <a href="{{ $item->url }}" target="{{ $item->target }}" class="hover:text-blue-700">
                    {{ $item->label }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center justify-end gap-4">
            @php
                $actions = ($headerActionsMenu?->items ?? collect())->whereNull('parent_id')->where('is_active', true)->sortBy('sort_order')->values();
            @endphp
            
            @foreach($actions as $index => $item)
                @if($index === $actions->count() - 1)
                    <a href="{{ $item->url }}" target="{{ $item->target }}" 
                        class="hidden md:inline-flex items-center rounded-lg bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">
                        {{ $item->label }}
                    </a>
                @else
                    <a href="{{ $item->url }}" target="{{ $item->target }}" class="text-sm font-medium hover:text-blue-700">
                        {{ $item->label }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</header>