<x-app-layout>
    <div class="w-full min-h-screen pl-56 mt-6">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-semibold text-app">{{ __('Pustaka Template') }}</h1>
                    <p class="text-sm text-muted mt-1">Kelola desain undangan digital Anda.</p>
                </div>

                <a href="{{ route('admin.invitation-templates.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 shadow-sm transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.5v15m7.5-7.5h-15"></path>
                    </svg>
                    Buat Template Baru
                </a>
            </div>

            <div class="mb-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="relative w-full sm:max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <input type="text" id="search-input" placeholder="Cari nama template..."
                        class="panel block w-full pl-10 pr-20 py-2.5 rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-app focus:ring-indigo-500 shadow-sm transition">

                    <button id="search-btn"
                        class="absolute inset-y-0 right-0 px-4 flex items-center font-semibold text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 border-l border-gray-300 dark:border-gray-700 transition">
                        Cari
                    </button>
                </div>

                <button id="category-btn"
                    class="panel inline-flex items-center px-4 py-2.5 rounded-lg font-medium text-app shadow-sm hover:opacity-80 transition border border-gray-300 dark:border-gray-700">
                    <svg class="mr-2 h-5 w-5 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter Kategori
                </button>
            </div>
            <div id="templates-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($templates as $template)
                    <div
                        class="panel group rounded-xl shadow-sm hover:shadow-md overflow-hidden transition-all duration-300 flex flex-col h-full border border-transparent hover:border-indigo-500/30">

                        <div class="relative aspect-[4/3] overflow-hidden bg-gray-200 dark:bg-gray-700">
                            <img src="{{ $template->image ? asset('storage/' . $template->image) : asset('images/placeholder.jpg') }}"
                                alt="{{ $template->title }}"
                                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">

                            <div class="absolute top-3 right-3 bg-black/50 backdrop-blur-md px-2.5 py-1 rounded-md">
                                <span class="text-sm font-bold text-white">
                                    Rp {{ number_format($template->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5 flex-1 flex flex-col">
                            <div class="flex-1">
                                <h3
                                    class="font-bold text-lg text-app mb-1 group-hover:text-indigo-500 transition-colors">
                                    {{ $template->title }}
                                </h3>
                                <p class="text-muted text-sm line-clamp-2 leading-relaxed">
                                    {{ $template->description }}
                                </p>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-500/10 flex items-center justify-between">
                                <a href="{{ route('admin.invitation-templates.edit', $template) }}"
                                    class="text-sm font-medium text-blue-600 hover:underline flex items-center">
                                    Edit
                                </a>

                                <form action="{{ route('admin.invitation-templates.destroy', $template) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-medium text-red-600 hover:underline"
                                        onclick="return confirm('Hapus template ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full panel py-16 px-4 rounded-xl border-2 border-dashed border-gray-500/20 text-center">
                        <p class="text-muted">Tidak ada template ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8 text-app">
                {{ $templates->links() }}
            </div>
        </div>
    </div>

    <div id="category-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="fixed inset-0 bg-black/60 transition-opacity"></div>
            <div class="panel relative w-full max-w-lg rounded-lg shadow-xl p-6">
                <h3 class="text-lg font-medium text-app mb-4">Filter Kategori</h3>
                <div class="grid grid-cols-2 gap-3">
                    @foreach (['wedding', 'birthday', 'business', ''] as $cat)
                        <button
                            class="category-filter p-3 border border-gray-500/20 rounded hover:bg-indigo-600 hover:text-white text-app transition"
                            data-category="{{ $cat }}">
                            {{ $cat ?: 'Semua' }}
                        </button>
                    @endforeach
                </div>
                <div class="mt-6 flex justify-end">
                    <button id="close-modal" class="px-4 py-2 text-muted hover:text-app">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const searchBtn = document.getElementById('search-btn');
            const categoryBtn = document.getElementById('category-btn');
            const categoryModal = document.getElementById('category-modal');
            const closeModal = document.getElementById('close-modal');
            const categoryFilters = document.querySelectorAll('.category-filter');

            // Search functionality
            searchBtn.addEventListener('click', function() {
                const searchTerm = searchInput.value;
                const url = new URL(window.location);
                url.searchParams.set('search', searchTerm);
                url.searchParams.delete('type');
                window.location.href = url.toString();
            });

            // Enter key support for search
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchBtn.click();
                }
            });

            // Category modal logic
            if (categoryBtn && categoryModal) {
                categoryBtn.addEventListener('click', function() {
                    categoryModal.classList.remove('hidden');
                });

                closeModal.addEventListener('click', function() {
                    categoryModal.classList.add('hidden');
                });

                categoryModal.addEventListener('click', function(e) {
                    // Check if clicked exactly on the overlay (not the content)
                    if (e.target.classList.contains('bg-opacity-75')) {
                        categoryModal.classList.add('hidden');
                    }
                });
            }

            // Category filters
            categoryFilters.forEach(filter => {
                filter.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    const url = new URL(window.location);
                    if (category) {
                        url.searchParams.set('type', category);
                    } else {
                        url.searchParams.delete('type');
                    }
                    url.searchParams.delete('search');
                    window.location.href = url.toString();
                });
            });
        });
    </script>
</x-app-layout>
