<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-app leading-tight">Create User</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="panel rounded-lg shadow p-6">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-muted">Name</label>
                    <input name="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    @error('name')<p class="text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-muted">Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    @error('email')<p class="text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-muted">Role</label>
                    <select name="role" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @foreach($roles as $value => $label)
                            <option value="{{ $value }}" {{ old('role') === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('role')<p class="text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-muted">Password</label>
                    <input name="password" type="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    @error('password')<p class="text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-muted">Confirm Password</label>
                    <input name="password_confirmation" type="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('users.index') }}" class="me-3 inline-flex items-center px-4 py-2 border rounded-md">Cancel</a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="w-full min-h-screen pl-56 mt-6">
        <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-gray-100 mb-4">Tambah User</h2>

            <div class="bg-gray-800 rounded-lg p-6">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    @include('users.form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
