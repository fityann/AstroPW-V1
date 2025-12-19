<x-app-layout>
    <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-app leading-tight">Edit Vendor</h2>
        <div class="panel rounded-lg shadow p-6">
            <form action="{{ route('admin.vendors.update', $vendor) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm text-muted">Name</label>
                    <input name="name" value="{{ old('name', $vendor->name) }}" required class="mt-1 block w-full rounded-md border-gray-300" />
                </div>

                <div>
                    <label class="block text-sm text-muted">Category</label>
                    <select name="category" required class="mt-1 block w-full rounded-md border-gray-300">
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" {{ $vendor->category === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm text-muted">Price</label>
                    <input name="price" type="number" step="0.01" value="{{ old('price', $vendor->price) }}" class="mt-1 block w-full rounded-md border-gray-300" />
                </div>

                <div>
                    <label class="block text-sm text-muted">Contact</label>
                    <input name="contact" value="{{ old('contact', $vendor->contact) }}" class="mt-1 block w-full rounded-md border-gray-300" />
                </div>

                <div>
                    <label class="block text-sm text-muted">Image</label>
                    @if($vendor->image)
                        <div class="mb-2"><img src="{{ asset('storage/'.$vendor->image) }}" class="h-28 object-cover"/></div>
                    @endif
                    <input name="image" type="file" accept="image/*" class="mt-1 block w-full" />
                </div>

                <div>
                    <label class="block text-sm text-muted">Description</label>
                    <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300">{{ old('description', $vendor->description) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('admin.vendors.index') }}" class="me-3 inline-flex items-center px-4 py-2 border rounded-md">Cancel</a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
