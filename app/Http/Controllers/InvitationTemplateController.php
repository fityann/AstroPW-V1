<?php

namespace App\Http\Controllers;

use App\Models\InvitationTemplate;
use Illuminate\Http\Request;

class InvitationTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->get('type');
        $search = $request->get('search');

        $query = InvitationTemplate::query();

        if ($type) {
            $query->where('type', $type);
        }

        if ($search) {
            $query->where('category', 'like', '%' . $search . '%');
        }

        $templates = $query->paginate(12);

        return view('invitation-templates.index', compact('templates', 'type', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invitation-templates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'type' => 'required|in:website,print,video_3d,video_greeting',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('invitation-templates', 'public');
        }

        InvitationTemplate::create($data);

        return redirect()->route('admin.invitation-templates.index')->with('success', 'Template created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $template = InvitationTemplate::findOrFail($id);
        return view('invitation-templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $template = InvitationTemplate::findOrFail($id);
        return view('invitation-templates.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'type' => 'required|in:website,print,video_3d,video_greeting',
        ]);

        $template = InvitationTemplate::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('invitation-templates', 'public');
        }

        $template->update($data);

        return redirect()->route('admin.invitation-templates.index')->with('success', 'Template updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $template = InvitationTemplate::findOrFail($id);
        $template->delete();

        return redirect()->route('admin.invitation-templates.index')->with('success', 'Template deleted successfully.');
    }
}
