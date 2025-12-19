<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

    /** Display a listing of the users. */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('users.index', compact('users'));
    }

    /** Show the form for creating a new user. */
    public function create()
    {
        $roles = [User::ROLE_ADMIN => 'Admin', User::ROLE_CATIN => 'Catin', User::ROLE_VENDOR => 'Vendor'];
        return view('users.create', compact('roles'));
    }

    /** Store a newly created user in storage. */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,catin,vendor',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /** Display the specified user. */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /** Show the form for editing the specified user. */
    public function edit(User $user)
    {
        $roles = [User::ROLE_ADMIN => 'Admin', User::ROLE_CATIN => 'Catin', User::ROLE_VENDOR => 'Vendor'];
        return view('users.edit', compact('user', 'roles'));
    }

    /** Update the specified user in storage. */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,catin,vendor',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    /** Remove the specified user from storage. */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
