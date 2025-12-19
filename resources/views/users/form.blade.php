<div class="space-y-4">
    <div>
        <label class="block text-sm text-gray-200">Name</label>
        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white p-2" required>
        @error('name') <p class="text-xs text-red-400">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-gray-200">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white p-2" required>
        @error('email') <p class="text-xs text-red-400">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-gray-200">Password {{ isset($user) ? '(biarkan kosong untuk tidak mengganti)' : '' }}</label>
        <input type="password" name="password" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white p-2" {{ isset($user) ? '' : 'required' }}>
        @error('password') <p class="text-xs text-red-400">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-gray-200">Confirm Password</label>
        <input type="password" name="password_confirmation" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white p-2">
    </div>

    <div class="pt-4">
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Simpan</button>
        <a href="{{ route('users.index') }}" class="ml-2 text-sm text-gray-300">Batal</a>
    </div>
</div>
