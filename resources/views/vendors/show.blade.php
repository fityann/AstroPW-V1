<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-app leading-tight">Vendor Detail</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="panel rounded-lg shadow p-6">
            @if($vendor->image)
                <img src="{{ asset('storage/'.$vendor->image) }}" class="w-full h-64 object-cover rounded-md" />
            @endif

            <h3 class="mt-4 text-2xl font-bold text-app">{{ $vendor->name }}</h3>
            <div class="text-muted">{{ $vendor->category_label }}</div>
            <div class="mt-3 text-lg font-semibold">@if($vendor->price) Rp {{ number_format($vendor->price,0,',','.') }} @else - @endif</div>

            <p class="mt-4 text-muted">{{ $vendor->description }}</p>

            @php $isAdmin = auth()->check() && method_exists(auth()->user(), 'isAdmin') && auth()->user()->isAdmin(); @endphp
            <div class="mt-6 flex justify-end">
                @if($isAdmin)
                    <a href="{{ route('admin.vendors.edit', $vendor) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md me-3">Edit</a>
                    <a href="{{ route('admin.vendors.index') }}" class="inline-flex items-center px-4 py-2 border rounded-md">Back</a>
                @else
                    <a href="{{ route('vendors.catalog.index') }}" class="inline-flex items-center px-4 py-2 border rounded-md">Back</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
