<x-app-layout>
    <div class="w-full min-h-screen pl-56 mt-6">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            @php
                $isAdmin = auth()->check() && method_exists(auth()->user(), 'isAdmin') && auth()->user()->isAdmin();

                $catIcons = [
                    'wo' => '💼',
                    'venue' => '🏛️',
                    'catering' => '🍽️',
                    'dekorasi' => '🎀',
                    'mua' => '💄',
                    'dokumentasi' => '📸',
                    'busana' => '👗',
                    'hiburan' => '🎶',
                    'kue' => '🍰',
                    'undangan' => '✉️',
                    'cincin' => '💍',
                ];

                $allRoute = $isAdmin ? route('admin.vendors.index') : route('vendors.catalog.index');
            @endphp

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-semibold text-app">Vendors</h1>
                    <p class="text-sm text-muted mt-1">Temukan dan kelola mitra vendor terbaik untuk acara Anda.</p>
                </div>

                @if ($isAdmin)
                    <a href="{{ route('admin.vendors.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 shadow-sm transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                        Create Vendor
                    </a>
                @endif
            </div>

            <div class="mb-10 overflow-hidden">
                <div class="overflow-x-auto scrollbar-hide">
                    <div class="flex items-center gap-3 py-2 min-w-max">

                        <a href="{{ $allRoute }}"
                            class="inline-flex items-center justify-center gap-2 px-5 h-11 rounded-full text-sm font-semibold transition duration-200 shadow-sm
               {{ empty($category) ? 'bg-indigo-600 text-white' : 'panel text-app border border-gray-500/10 hover:border-indigo-500' }}">
                            <span class="text-base">🔍</span>
                            <span>All Categories</span>
                        </a>

                        @foreach ($categories as $key => $label)
                            @php
                                $cleanLabel = str_replace([' (WO)', ' (Foto/Video)', ' (MC, Band/D.'], '', $label);
                            @endphp

                            <a href="{{ $isAdmin ? route('admin.vendors.index', ['category' => $key]) : route('vendors.catalog.index', ['category' => $key]) }}"
                                class="inline-flex items-center justify-center gap-2 px-5 h-11 rounded-full text-sm font-semibold whitespace-nowrap transition duration-200 shadow-sm
                   {{ isset($category) && $category === $key
                       ? 'bg-indigo-600 text-white'
                       : 'panel text-app border border-gray-500/10 hover:border-indigo-500' }}">
                                <span class="text-lg leading-none">{!! $catIcons[$key] ?? '🔹' !!}</span>
                                <span>{{ $cleanLabel }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($vendors as $vendor)
                    <article
                        class="panel group rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col border border-transparent hover:border-indigo-500/20">
                        <div class="relative h-56 bg-gray-200 dark:bg-gray-700 overflow-hidden">
                            @if ($vendor->image)
                                <img src="{{ asset('storage/' . $vendor->image) }}" alt="{{ $vendor->name }}"
                                    class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500" />
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-muted">
                                    <svg class="w-12 h-12 mb-2 opacity-20" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <span class="text-xs uppercase tracking-widest">No Image</span>
                                </div>
                            @endif

                            <div class="absolute inset-x-0 top-0 p-3 flex justify-between items-start">
                                <span
                                    class="bg-black/50 backdrop-blur-md text-white text-[10px] uppercase font-bold px-2 py-1 rounded-md tracking-wider">
                                    {{ $vendor->category_label }}
                                </span>
                                @if ($vendor->price)
                                    <span
                                        class="bg-white/95 dark:bg-gray-900/95 text-indigo-600 dark:text-indigo-400 text-xs font-bold px-2.5 py-1.5 rounded-lg shadow-sm">
                                        Rp {{ number_format($vendor->price, 0, ',', '.') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="p-5 flex flex-col flex-1">
                            <h3
                                class="font-bold text-app text-lg leading-snug group-hover:text-indigo-600 transition-colors">
                                {{ $vendor->name }}
                            </h3>

                            <p class="mt-2 text-sm text-muted line-clamp-2 flex-1 leading-relaxed">
                                {{ \Illuminate\Support\Str::limit(strip_tags($vendor->description ?? ''), 140) }}
                            </p>

                            <div class="mt-6 pt-4 border-t border-gray-500/10 flex items-center justify-between">
                                <div class="flex flex-col">
                                    @if ($vendor->contact)
                                        <span
                                            class="text-[10px] uppercase font-bold text-muted tracking-tight">Contact</span>
                                        <span class="text-sm font-semibold text-app">{{ $vendor->contact }}</span>
                                    @endif
                                </div>

                                <div class="flex items-center gap-1">
                                    @if ($isAdmin)
                                        <a href="{{ route('admin.vendors.edit', $vendor) }}"
                                            class="p-2 text-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition"
                                            title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.vendors.destroy', $vendor) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Hapus vendor ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition"
                                                title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('vendors.catalog.show', $vendor) }}"
                                            class="inline-flex items-center px-4 py-2 text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition">
                                            View Details
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-10 text-app">
                {{ $vendors->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
