<x-app-layout>
    <div class="w-full min-h-screen pl-56 mt-6">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-app">User Management</h1>
                <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Tambah User</a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-3 rounded bg-green-600 text-white">{{ session('success') }}</div>
            @endif

            <div class="panel rounded-lg shadow p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y" style="border-color:rgba(148,163,184,.12)">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-muted">Registered</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="border-color:rgba(148,163,184,.08)">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-app">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-muted">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-sm text-muted">{{ $user->role }}</td>
                                    <td class="px-6 py-4 text-sm text-muted">{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <a href="{{ route('users.show', $user) }}" class="text-sm text-blue-600 hover:underline">View</a>
                                        <a href="{{ route('users.edit', $user) }}" class="text-sm text-yellow-600 hover:underline">Edit</a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
