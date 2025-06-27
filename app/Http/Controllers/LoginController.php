<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('welcome');
    }

    public function loginto(Request $request)
    {
        //  $request->validate([
        //      'email' => 'required|email',
        //      'password' => 'required'
        //  ]);

        //  $user = DB::table('users')->where('email', $request->email)->first();

        //  if (!$user || !Hash::check($request->password, $user->password)) {
        //      return back()->with('error', 'Invalid email or password');
        //  }

        // // // Store user ID in session
        // session(['user_id' => $user->id]);
        //  //dd($user->id);
        //  return redirect('/admin/dashboard',compact('user'));

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function dashboard()
    {
        if (!session('user_id')) {
            return redirect('/login');
        }

        return view('dashboard'); // Create a blade view or return text
    }

    // public function logout()
    // {
    //     session()->forget('user_id');
    //     return redirect('/login');
    // }

    public function logout()
{
    session()->flush(); // Clears entire session
    return redirect('/login');
}

}

