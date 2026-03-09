<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Show only pending staff or guest for approval
    public function pending()
    {
        $users = User::whereIn('role', ['staff', 'guest'])
                     ->where('status', 'pending')
                     ->get();

        return view('admin.users.index', compact('users'));
    }

    // Show create user form
    public function create()
    {
        return view('admin.users.create');
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:admin,staff,guest',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'status'   => $request->role === 'admin' ? 'approved' : 'pending',
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * APPROVE pending user
     * Route: PATCH /admin/users/{id}/approve
     */
    public function approve($id)
    {
        $user = User::findOrFail($id);

        if (in_array($user->role, ['staff', 'guest']) && $user->status === 'pending') {
            $user->status = 'approved';

            // Promote guest to staff upon approval
            if ($user->role === 'guest') {
                $user->role = 'staff';
            }

            $user->save();

            return redirect()
                ->back()
                ->with('success', $user->name . ' approved successfully.');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid operation.');
    }

    // Generic approve / reject logic (can still be reused)
    public function updateStatus($id, $status)
    {
        $user = User::findOrFail($id);

        if (
            in_array($user->role, ['staff', 'guest']) &&
            $user->status === 'pending' &&
            in_array($status, ['approved', 'rejected'])
        ) {
            $user->status = $status;

            if ($user->role === 'guest' && $status === 'approved') {
                $user->role = 'staff';
            }

            $user->save();

            return redirect()
                ->back()
                ->with('success', $user->name . ' ' . $status . '.');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid operation.');
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->back()
            ->with('success', 'User deleted successfully.');
    }
}
