<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // allow only admin to manage vendors
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if (! $user || ! method_exists($user, 'isAdmin') || ! $user->isAdmin()) {
                abort(403);
            }
            return $next($request);
        })->except(['publicIndex','show']);
    }

    // Public listing for couples (optional) - not registered in routes by default
    public function publicIndex(Request $request)
    {
        $category = $request->query('category');
        $query = Vendor::query();
        if ($category) {
            $query->where('category', $category);
        }
        $vendors = $query->paginate(12);
        $categories = Vendor::CATEGORIES;
        return view('vendors.index', compact('vendors','categories','category'));
    }

    // Admin index (management)
    public function index(Request $request)
    {
        $category = $request->query('category');
        $query = Vendor::query();
        if ($category) {
            $query->where('category', $category);
        }
        $vendors = $query->orderBy('created_at','desc')->paginate(12);
        $categories = Vendor::CATEGORIES;
        return view('vendors.index', compact('vendors','categories','category'));
    }

    public function create()
    {
        $categories = Vendor::CATEGORIES;
        return view('vendors.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'contact' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('vendors','public');
            $data['image'] = $path;
        }

        Vendor::create($data);
        return redirect()->route('admin.vendors.index')->with('success','Vendor dibuat.');
    }

    public function show(Vendor $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }

    public function edit(Vendor $vendor)
    {
        $categories = Vendor::CATEGORIES;
        return view('vendors.edit', compact('vendor','categories'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'contact' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // delete old
            if ($vendor->image) {
                Storage::disk('public')->delete($vendor->image);
            }
            $path = $request->file('image')->store('vendors','public');
            $data['image'] = $path;
        }

        $vendor->update($data);
        return redirect()->route('admin.vendors.index')->with('success','Vendor diperbarui.');
    }

    public function destroy(Vendor $vendor)
    {
        if ($vendor->image) {
            Storage::disk('public')->delete($vendor->image);
        }
        $vendor->delete();
        return redirect()->route('admin.vendors.index')->with('success','Vendor dihapus.');
    }
}
