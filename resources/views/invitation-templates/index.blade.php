<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manajemen Undangan') }}
            </h2>
            <a href="{{ route('admin.invitation-templates.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Template
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Search Section -->
                    <div class="mb-6 flex justify-center">
                        <div class="flex items-center space-x-4 w-full max-w-md">
                            <div class="relative flex-1">
                                <input type="text" id="search-input" placeholder="Cari template undangan..." class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
                                <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <button id="search-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-200 flex items-center">
                                Cari
                            </button>
                        </div>
                    </div>

                    <!-- Templates Grid -->
                    <div id="templates-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @forelse($templates as $template)
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-600">
                                <img src="{{ $template->image ? asset('storage/' . $template->image) : asset('images/placeholder.jpg') }}" alt="{{ $template->title }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2 text-gray-900 dark:text-gray-100">{{ $template->title }}</h3>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">{{ Str::limit($template->description, 100) }}</p>
                                    <p class="text-green-600 font-semibold mb-2">Rp {{ number_format($template->price, 0, ',', '.') }}</p>
                                    <div class="flex justify-between items-center">
                                        <a href="{{ route('admin.invitation-templates.edit', $template) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">Edit</a>
                                        <form action="{{ route('admin.invitation-templates.destroy', $template) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus template ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8">
                                <p class="text-gray-500 dark:text-gray-400">Tidak ada template ditemukan.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $templates->appends(request()->query())->links() }}
                    </div>
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
                url.searchParams.delete('type'); // Remove type filter when searching
                window.location.href = url.toString();
            });

            // Enter key support for search
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchBtn.click();
                }
            });

            // Category modal
            categoryBtn.addEventListener('click', function() {
                categoryModal.classList.remove('hidden');
            });

            closeModal.addEventListener('click', function() {
                categoryModal.classList.add('hidden');
            });

            // Close modal when clicking outside
            categoryModal.addEventListener('click', function(e) {
                if (e.target === categoryModal) {
                    categoryModal.classList.add('hidden');
                }
            });

            // Category filters
            categoryFilters.forEach(filter => {
                filter.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    const url = new URL(window.location);
                    url.searchParams.set('type', category);
                    url.searchParams.delete('search'); // Remove search when filtering by type
                    window.location.href = url.toString();
                });
            });
        });
    </script>
</x-app-layout>
