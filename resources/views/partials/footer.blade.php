<footer class="bg-slate-950 text-white mt-12">
    <div class="max-w-7xl mx-auto px-4 py-16 grid md:grid-cols-4 gap-10">
        <div>
            <h3 class="font-bold text-2xl">
                {{ $siteSettings['site_name'] ?? 'Hilal International Academy' }}
            </h3>
            <p class="text-sm text-slate-300 mt-4 leading-7">
                {{ $siteSettings['site_description'] ?? 'A modern learning community committed to academic excellence, character development, and global mindedness.' }}
            </p>
        </div>

        <div>
            <h4 class="font-semibold text-lg mb-4">Quick Links</h4>
            <ul class="space-y-3 text-sm text-slate-300">
                @foreach(($footerQuickLinksMenu?->items ?? collect())->whereNull('parent_id')->where('is_active', true)->sortBy('sort_order') as $item)
                    <li>
                        <a href="{{ $item->url }}" target="{{ $item->target }}" class="hover:text-white">
                            {{ $item->label }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h4 class="font-semibold text-lg mb-4">Company</h4>
            <ul class="space-y-3 text-sm text-slate-300">
                @foreach(($footerCompanyMenu?->items ?? collect())->whereNull('parent_id')->where('is_active', true)->sortBy('sort_order') as $item)
                    <li>
                        <a href="{{ $item->url }}" target="{{ $item->target }}" class="hover:text-white">
                            {{ $item->label }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h4 class="font-semibold text-lg mb-4">Contact</h4>
            <div class="space-y-2 text-sm text-slate-300">
                <p>{{ $siteSettings['address'] ?? '' }}</p>
                <p>{{ $siteSettings['contact_email'] ?? '' }}</p>
                <p>{{ $siteSettings['phone_primary'] ?? '' }}</p>
                @if(!empty($siteSettings['phone_secondary']))
                    <p>{{ $siteSettings['phone_secondary'] }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 py-6 text-sm text-slate-400">
            &copy; {{ date('Y') }}
            {{ $siteSettings['footer_text'] ?? 'Hilal International Academy. All rights reserved.' }}
        </div>
    </div>
</footer>