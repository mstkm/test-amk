<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index () {
      return view('authentication.login');
    }

    public function authenticate(Request $request) {
      $credentials = $request->validate([
        'email' => 'required|email:dns',
        'password' => 'required'
      ]);

      $user = User::select('*')->where('email', $request->email)->get()[0];

      if ($user->verified == 0) {
        return back()->with('loginError', 'Email belum terverifikasi oleh admin. Mohon tunggu!');
      }

      if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
      }

      return back()->with('loginError', 'Wrong username or password');
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
