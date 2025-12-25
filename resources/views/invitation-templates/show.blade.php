<x-app-layout>
    <div class="w-full min-h-screen pl-56 mt-6">
        <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-app">{{ $template->title }}</h1>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image -->
                    <div>
                        <img src="{{ $template->image ? asset('storage/' . $template->image) : asset('images/placeholder.jpg') }}" alt="{{ $template->title }}" class="w-full h-64 object-cover rounded-lg">
                    </div>

                    <!-- Details -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Detail Template</h2>
                        <div class="space-y-3">
                            <div>
                                <strong class="text-gray-700">Judul:</strong>
                                <p>{{ $template->title }}</p>
                            </div>
                            <div>
                                <strong class="text-gray-700">Deskripsi:</strong>
                                <p>{{ $template->description }}</p>
                            </div>
                            <div>
                                <strong class="text-gray-700">Harga:</strong>
                                <p class="text-green-600 font-semibold">Rp {{ number_format($template->price, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <strong class="text-gray-700">Kategori:</strong>
                                <p>{{ $template->category }}</p>
                            </div>
                            <div>
                                <strong class="text-gray-700">Tipe:</strong>
                                <p>{{ ucfirst(str_replace('_', ' ', $template->type)) }}</p>
                            </div>
                            <div>
                                <strong class="text-gray-700">Dibuat:</strong>
                                <p>{{ $template->created_at->format('d M Y') }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex space-x-4">
                            <a href="{{ route('admin.invitation-templates.edit', $template) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.invitation-templates.destroy', $template) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus template ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="mt-6">
                    <a href="{{ route('admin.invitation-templates.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        ← Kembali ke Daftar Template
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
