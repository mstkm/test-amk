<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as Pwd;

class ForgotPasswordController extends Controller
{
    public function index() {
      return view('authentication.forgot-password');
    }

    public function requestLink(Request $request) {
      $request->validate(['email' => 'required|email:dns']);

      $status = Password::sendResetLink(
          $request->only('email')
      );

      return $status === Password::RESET_LINK_SENT
                  ? back()->with(['status' => 'Kami sudah kirimkan link reset password ke emailmu'])
                  : back()->withErrors(['email' => 'Gagal mengirimkan link reset password!']);
  }

  public function resetPassword(Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => ['required', 'confirmed', Pwd::min(6)->letters()->mixedCase()->numbers()->symbols()]
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('success', 'Password berhasil diperbaharui.Coba login kembali!')
                : back()->withErrors(['email' => 'Gagal!']);
  }
}
