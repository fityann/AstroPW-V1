<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-app leading-tight">User Detail</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="panel rounded-lg shadow p-6">
            <dl class="grid grid-cols-1 gap-4">
                <div>
                    <dt class="text-sm text-muted">Name</dt>
                    <dd class="text-app font-medium">{{ $user->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-muted">Email</dt>
                    <dd class="text-muted">{{ $user->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-muted">Role</dt>
                    <dd class="text-muted">{{ $user->role }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-muted">Registered</dt>
                    <dd class="text-muted">{{ $user->created_at->format('Y-m-d') }}</dd>
                </div>
            </dl>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md me-3">Edit</a>
                <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border rounded-md">Back</a>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="w-full min-h-screen pl-56 mt-6">
        <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-gray-100 mb-4">Detail User</h2>

            <div class="bg-gray-800 rounded-lg p-6 text-gray-100">
                <p><span class="text-gray-400">Nama:</span> {{ $user->name }}</p>
                <p class="mt-2"><span class="text-gray-400">Email:</span> {{ $user->email }}</p>
                <p class="mt-2"><span class="text-gray-400">Dibuat:</span> {{ $user->created_at->format('Y-m-d H:i') }}</p>

                <div class="mt-6">
                    <a href="{{ route('users.edit', $user) }}" class="px-4 py-2 bg-yellow-500 rounded text-gray-900">Edit</a>
                    <a href="{{ route('users.index') }}" class="ml-2 text-gray-300">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
