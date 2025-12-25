<x-app-layout>
    <div class="w-full min-h-screen pl-56 mt-6">
        <div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-app">Tambah Template Undangan</h1>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('admin.invitation-templates.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Judul Template')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Deskripsi')" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <x-input-label for="price" :value="__('Harga')" />
                        <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('price')" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <x-input-label for="category" :value="__('Kategori')" />
                        <x-text-input id="category" name="category" type="text" class="mt-1 block w-full" :value="old('category')" required />
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <!-- Type -->
                    <div class="mb-4">
                        <x-input-label for="type" :value="__('Tipe Undangan')" />
                        <select id="type" name="type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">Pilih Tipe</option>
                            <option value="website" {{ old('type') == 'website' ? 'selected' : '' }}>Undangan Website</option>
                            <option value="print" {{ old('type') == 'print' ? 'selected' : '' }}>Undangan Cetak</option>
                            <option value="video_3d" {{ old('type') == 'video_3d' ? 'selected' : '' }}>Undangan Video 3D</option>
                            <option value="video_greeting" {{ old('type') == 'video_greeting' ? 'selected' : '' }}>Video Ucapan 3D</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <!-- Image -->
                    <div class="mb-6">
                        <x-input-label for="image" :value="__('Gambar Template')" />
                        <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full" />
                        <p class="mt-1 text-sm text-gray-500">Upload gambar template (JPEG, PNG, JPG, GIF, max 2MB)</p>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end">
                        <a href="{{ route('admin.invitation-templates.index') }}" class="mr-4 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Batal</a>
                        <x-primary-button>Simpan Template</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
