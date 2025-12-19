
<x-app-layout>

    <div class="w-full min-h-screen pl-56 mt-1">
        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold mb-6 text-app">Statistik Acara</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="p-6 panel rounded-lg shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-muted">Jumlah Pengantin</p>
                        <p class="text-3xl font-bold mt-2">{{ $pengantinCount ?? '2' }}</p>
                    </div>
                    <div class="ml-4 text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4.418 0-8 1.79-8 4v1h16v-1c0-2.21-3.582-4-8-4z" />
                        </svg>
                    </div>
                </div>

                <div class="p-6 panel rounded-lg shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-300">Jumlah Vendor</p>
                        <p class="text-3xl font-bold mt-2">{{ $vendorCount ?? '10' }}</p>
                    </div>
                    <div class="ml-4 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3 7l6 6-6 6" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 7l-6 6 6 6" />
                        </svg>
                    </div>
                </div>

                <div class="p-6 panel rounded-lg shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-300">Tamu VIP</p>
                        <p class="text-3xl font-bold mt-2">{{ $vipCount ?? '20' }}</p>
                    </div>
                    <div class="ml-4 text-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.95a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.455a1 1 0 00-.364 1.118l1.287 3.95c.3.921-.755 1.688-1.54 1.118l-3.37-2.455a1 1 0 00-1.176 0l-3.37 2.455c-.785.57-1.84-.197-1.54-1.118l1.287-3.95a1 1 0 00-.364-1.118L2.063 9.377c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.95z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="p-6 panel rounded-lg shadow">
                    <p class="text-sm text-muted">Tamu Reguler</p>
                    <p class="text-2xl font-bold mt-2">{{ $regulerCount ?? '120' }}</p>
                </div>

                <div class="p-6 panel rounded-lg shadow">
                    <p class="text-sm text-muted">Jumlah Undangan</p>
                    <p class="text-2xl font-bold mt-2">{{ $undanganCount ?? '150' }}</p>
                </div>
            </div>

            <div class="mt-6">
                <div class="p-6 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg shadow text-white">
                    <p class="text-sm opacity-90">Tanggal Acara</p>
                    <p class="text-2xl font-bold mt-2">{{ $eventDate ?? '17 Desember 2025' }}</p>
                </div>
            </div>

            <p class="mt-6 text-sm text-muted">Catatan: Ini hanya tampilan statis. Gunakan variabel Blade (`$pengantinCount`, `$vendorCount`, `$vipCount`, `$regulerCount`, `$undanganCount`, `$eventDate`) untuk mengganti data dengan nilai dinamis dari controller.</p>
        </div>
    </div>
</x-app-layout>
