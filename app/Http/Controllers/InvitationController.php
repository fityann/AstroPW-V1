<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Ensure only admin users can access this controller
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if (! $user || ! method_exists($user, 'isAdmin') || ! $user->isAdmin()) {
                abort(403);
            }
            return $next($request);
        });
    }

    /** Display a listing of the invitations. */
    public function index()
    {
        $invitations = Invitation::orderBy('created_at', 'desc')->paginate(15);
        return view('invitations.index', compact('invitations'));
    }

    /** Show the form for creating a new invitation. */
    public function create()
    {
        $categories = [Invitation::CATEGORY_VIP => 'VIP', Invitation::CATEGORY_REGULAR => 'Regular'];
        $themes = \App\Models\InvitationTemplate::all();
        return view('invitations.create', compact('categories', 'themes'));
    }

    /** Store a newly created invitation in storage. */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:invitations,email',
            'phone' => 'nullable|string|max:20',
            'category' => 'required|in:vip,regular',
        ]);

        Invitation::create($data);

        return redirect()->route('invitations.index')->with('success', 'Undangan berhasil ditambahkan.');
    }

    /** Display the specified invitation. */
    public function show(Invitation $invitation)
    {
        return view('invitations.show', compact('invitation'));
    }

    /** Show the form for editing the specified invitation. */
    public function edit(Invitation $invitation)
    {
        $categories = [Invitation::CATEGORY_VIP => 'VIP', Invitation::CATEGORY_REGULAR => 'Regular'];
        $themes = \App\Models\InvitationTemplate::all();
        return view('invitations.edit', compact('invitation', 'categories', 'themes'));
    }

    /** Update the specified invitation in storage. */
    public function update(Request $request, Invitation $invitation)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:invitations,email,' . $invitation->id,
            'phone' => 'nullable|string|max:20',
            'category' => 'required|in:vip,regular',
            'theme_id' => 'nullable|exists:invitation_templates,id',
        ]);

        $invitation->update($data);

        return redirect()->route('admin.invitations.index')->with('success', 'Undangan berhasil diperbarui.');
    }

    /** Remove the specified invitation from storage. */
    public function destroy(Invitation $invitation)
    {
        $invitation->delete();
        return redirect()->route('invitations.index')->with('success', 'Undangan berhasil dihapus.');
    }
}
