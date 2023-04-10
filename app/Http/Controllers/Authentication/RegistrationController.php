<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    public function index() {
      return view('authentication.registrasi');
    }

    public function register(Request $request) {
      $dataValidate = $request->validate([
        'name' => 'required|max:25',
        'email' => 'required|email:dns',
        'password' => ['required', Password::min(6)->letters()->mixedCase()->numbers()->symbols()]
      ]);

      $dataValidate['password'] = Hash::make($dataValidate['password']);
      $dataValidate['role'] = 'Staff';
      $dataValidate['verified'] = false;

      User::create($dataValidate);

      return redirect()->route('login')->with('success', 'Registrasi berhasil, silahkan login!');
    }
}
