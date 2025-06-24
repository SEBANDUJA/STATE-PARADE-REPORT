<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('welcome');
    }

    public function loginto(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid email or password');
        }

        // Store user ID in session
        session(['user_id' => $user->id]);

        return redirect('/admin/dashboard');
    }

    public function dashboard()
    {
        if (!session('user_id')) {
            return redirect('/login');
        }

        return view('dashboard'); // Create a blade view or return text
    }

    public function logout()
    {
        session()->forget('user_id');
        return redirect('/login');
    }
}

