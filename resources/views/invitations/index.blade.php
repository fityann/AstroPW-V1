<x-app-layout>
    <div class="w-full min-h-screen pl-56 mt-6">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-semibold text-app">Manajemen Tamu Undangan</h1>
                    <p class="text-sm text-muted mt-1">Kelola daftar tamu, status VIP, dan informasi kontak secara efisien.</p>
                </div>

                <a href="{{ route('admin.invitations.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-sm transition-all duration-200 text-sm font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Undangan
                </a>
            </div>

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show"
                    class="mb-6 flex items-center justify-between p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-600">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="hover:opacity-70">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" /></svg>
                    </button>
                </div>
            @endif

            <div class="panel overflow-hidden rounded-xl border border-gray-500/10 shadow-sm">

                <div class="p-5 border-b border-gray-500/10 flex flex-col sm:flex-row justify-between items-center gap-4 ">
                    <div class="relative w-full max-w-xs">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-muted">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </span>
                        <input type="text"
                            class="block w-full pl-10 pr-4 py-2 text-sm panel border-gray-500/10 rounded-lg focus:ring-indigo-500 text-app"
                            placeholder="Cari nama atau email...">
                    </div>
                    <div class="text-sm text-muted">
                        Total: <span class="font-bold text-app">{{ $invitations->total() ?? 0 }}</span> Tamu
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-500/10">
                        <thead class="bg-gray-50 panel">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-muted uppercase tracking-wider">Nama Tamu</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-muted uppercase tracking-wider">Kontak</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-muted uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-muted uppercase tracking-wider">Terdaftar</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-muted uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-500/10 bg-transparent">
                            @forelse($invitations as $invitation)
                                <tr class="hover:bg-indigo-500/[0.02] transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-9 w-9 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-600 font-bold text-sm border border-indigo-500/20">
                                                {{ substr($invitation->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-app">{{ $invitation->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-app">{{ $invitation->email }}</div>
                                        <div class="text-xs text-muted">{{ $invitation->phone ?: '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($invitation->category == 'vip')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 border border-amber-200 uppercase tracking-wider">
                                                <span class="w-1 h-1 rounded-full bg-amber-500 mr-1.5"></span> VIP
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-cyan-300 text-white border border-gray-200 uppercase tracking-wider">
                                                Regular
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-muted">
                                        {{ $invitation->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('admin.invitations.show', $invitation) }}"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Detail">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2"/></svg>
                                            </a>
                                            <a href="{{ route('admin.invitations.edit', $invitation) }}"
                                                class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="Edit">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2"/></svg>
                                            </a>
                                            <form action="{{ route('admin.invitations.destroy', $invitation) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-full mb-4">
                                                <svg class="h-10 w-10 text-muted/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="1.5"/></svg>
                                            </div>
                                            <p class="text-app font-semibold">Belum ada undangan</p>
                                            <p class="text-sm text-muted mt-1">Data tamu yang Anda tambahkan akan muncul di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($invitations->hasPages())
                    <div class="px-6 py-4 border-t border-gray-500/10">
                        {{ $invitations->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
