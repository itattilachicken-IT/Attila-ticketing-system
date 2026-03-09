<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('guests.login'); // your login Blade
    }

    // Handle login
    public function login(Request $request)
    {
        // 1️⃣ Validate login form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // 2️⃣ Attempt login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            // 3️⃣ Block pending users (staff or guest)
            if ($user->role !== 'admin' && $user->status !== 'approved') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account is pending admin approval. Please wait until an admin approves it.',
                ]);
            }

            // 4️⃣ Redirect by role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'staff':
                    return redirect()->route('staff.dashboard');
                default:
                    return redirect()->route('guest.home');
            }
        }

        // 5️⃣ Invalid credentials
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
