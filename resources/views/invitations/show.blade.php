<x-app-layout>
    <div class="w-full min-h-screen pl-56 mt-6">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-app">Detail Undangan</h1>
                <a href="{{ route('admin.invitations.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Kembali</a>
            </div>

            <div class="panel rounded-lg shadow p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label value="Name" />
                        <p class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">{{ $invitation->name }}</p>
                    </div>

                    <div>
                        <x-input-label value="Email" />
                        <p class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">{{ $invitation->email }}</p>
                    </div>

                    <div>
                        <x-input-label value="Phone" />
                        <p class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">{{ $invitation->phone ?: 'N/A' }}</p>
                    </div>

                    <div>
                        <x-input-label value="Category" />
                        <p class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">{{ $invitation->category === 'vip' ? 'VIP' : 'Regular' }}</p>
                    </div>

                    <div>
                        <x-input-label value="Created At" />
                        <p class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">{{ $invitation->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <div>
                        <x-input-label value="Updated At" />
                        <p class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">{{ $invitation->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('admin.invitations.edit', $invitation) }}" class="mr-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
