<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffRegisterController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.staff-register'); // your Blade for staff registration
    }

    // Handle registration
    public function register(Request $request)
    {
                $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phonenumber' => 'required|string|max:15',
            'password' => 'required|string|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'password' => Hash::make($request->password),
            'role' => 'staff',
            'status' => 'pending',
        ]);

        return redirect()->back()->with('pending_approval', true);
    }
}
