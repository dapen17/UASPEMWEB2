<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\Site;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SandiController extends Controller
{
    //
    public function forgot_password()
    {
        $site = Site::all();
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        return view('auth.forgot-password', compact('logoBase64', 'sites'));
    }

    public function forgot_password_act(Request $request)
    {
        $customMessage = [
            'email.required'    => 'Email tidak boleh kosong',
            'email.email'       => 'Email tidak valid',
            'email.exists'      => 'Email tidak terdaftar di database',
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], $customMessage);

        $token = Str::random(60);

        PasswordResetToken::updateOrCreate(
            [
                'email' => $request->email
            ],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]
        );

        $email = $request->email;

        Mail::to($request->email)->send(new ResetPasswordMail($token, $email));

        return redirect()->route('forgot-password')->with('success', 'Kami telah mengirimkan link reset password ke email anda');
    }
    public function validasi_forgot_password_act(Request $request, $email)
    {
        $customMessage = [
            'password.required' => 'Password tidak boleh kosong',
            'password.min'      => 'Password minimal 6 karakter',
        ];

        $request->validate([
            'password' => 'required|min:6'
        ], $customMessage);

        $token = PasswordResetToken::where('token', $request->token)->first();

        if (!$token) {
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login')->with('failed', 'Email tidak terdaftar di database');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $token->delete();

        return redirect()->route('login')->with('success', 'Password berhasil direset');
    }

    public function validasi_forgot_password(Request $request, $token, $email)
    {
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        $getToken = PasswordResetToken::where('token', $token)->where('email', $email)->first();

        if (!$getToken) {
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }
        return view('auth.validasi-token', compact('token', 'email', 'sites', 'logoBase64'));
    }
}
