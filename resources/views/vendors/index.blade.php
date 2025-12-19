<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-app ">Vendors</h2>
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

        {{-- CATEGORY FILTER (HORIZONTAL SCROLL ONLY HERE) --}}
        <div class="mb-6">
            <div class="overflow-x-auto scrollbar-hide scroll-smooth">
                <div class="flex items-center gap-3 whitespace-nowrap py-1">
                    <a href="{{ $allRoute }}"
                        class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-medium transition
                       {{ empty($category) ? 'bg-gradient-to-r from-indigo-600 to-sky-500 text-white shadow' : 'bg-panel text-app hover:bg-indigo-50' }}">
                        🔍 All
                    </a>

                    @foreach ($categories as $key => $label)
                        <a href="{{ $isAdmin
                            ? route('admin.vendors.index', ['category' => $key])
                            : route('vendors.catalog.index', ['category' => $key]) }}"
                            class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-medium transition
                           {{ isset($category) && $category === $key
                               ? 'bg-gradient-to-r from-indigo-600 to-sky-500 text-white shadow'
                               : 'bg-panel text-app hover:bg-indigo-50' }}">
                            {!! $catIcons[$key] ?? '🔹' !!} {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            @if ($isAdmin)
                <div class="mt-4">
                    <a href="{{ route('admin.vendors.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                        Create Vendor
                    </a>
                </div>
            @endif
        </div>

        {{-- VENDOR GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($vendors as $vendor)
                <article class="panel rounded-lg overflow-hidden shadow hover:shadow-lg transition-shadow">
                    <div class="relative h-48 bg-gray-100">
                        @if ($vendor->image)
                            <img src="{{ asset('storage/' . $vendor->image) }}" alt="{{ $vendor->name }}"
                                class="object-cover w-full h-full" />
                        @else
                            <div class="w-full h-full flex items-center justify-center text-muted">
                                No image
                            </div>
                        @endif

                        <span class="absolute left-3 top-3 bg-black/60 text-white text-xs px-2 py-1 rounded">
                            {{ $vendor->category_label }}
                        </span>

                        @if ($vendor->price)
                            <span class="absolute right-3 top-3 bg-white/90 text-sm font-semibold px-2 py-1 rounded">
                                Rp {{ number_format($vendor->price, 0, ',', '.') }}
                            </span>
                        @endif
                    </div>

                    <div class="p-4 flex flex-col h-40">
                        <h3 class="font-semibold text-app text-lg leading-snug">
                            {{ $vendor->name }}
                        </h3>

                        <p class="mt-2 text-sm text-muted flex-1">
                            {{ \Illuminate\Support\Str::limit(strip_tags($vendor->description ?? ''), 140) }}
                        </p>

                        <div class="mt-3 flex items-center justify-between">
                            <div>
                                @if ($vendor->contact)
                                    <div class="text-xs text-muted">Contact</div>
                                    <div class="text-sm font-medium text-app">
                                        {{ $vendor->contact }}
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                @if ($isAdmin)
                                    <a href="{{ route('admin.vendors.show', $vendor) }}"
                                        class="px-3 py-1.5 text-sm bg-blue-50 text-blue-700 rounded">
                                        Detail
                                    </a>

                                    <a href="{{ route('admin.vendors.edit', $vendor) }}"
                                        class="px-3 py-1.5 text-sm bg-yellow-50 text-yellow-700 rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.vendors.destroy', $vendor) }}" method="POST"
                                        onsubmit="return confirm('Hapus vendor ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1.5 text-sm bg-red-50 text-red-700 rounded">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('vendors.catalog.show', $vendor) }}"
                                        class="px-3 py-1.5 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                        View
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $vendors->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
