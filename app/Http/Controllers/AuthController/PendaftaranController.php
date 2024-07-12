<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifikasiEmail;
use App\Models\Site;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    //
    public function showRegistrationForm()
    {
        $site = Site::all();
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        return view('auth.register', compact('logoBase64', 'sites')); // Make sure this path is correct according to your view structure
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $rememberToken = Str::random(10);

        try {
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'remember_token' => $rememberToken,
                'role' => 'User', // This sets the role to 'User'
                'email_verified_at' => null, // Set email_verified_at to null initially
            ]);

            // Generate verification token
            $token = sha1(time());

            // Save token to database
            $user->email_verification_token = $token;
            $user->save();

            // Send verification email
            $verificationUrl = url('/verify-email?token=' . $token);
            Mail::to($user->email)->send(new VerifikasiEmail($user->name, $verificationUrl));

            return redirect()->route('login')->with('Registrasi Berhasil', 'Silahkan Cek Email Untuk Verifikasi');
        } catch (\Exception $e) {
            // If there is an error, redirect with a failure message
            return redirect()->route('login')->with('Registrasi Gagal', 'Your registration failed. Please try again.');
        }
    }

    public function verifyEmail(Request $request)
    {
        $token = $request->query('token');
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Token verifikasi tidak valid.');
        }

        $user->email_verified_at = now();
        $user->email_verification_token = $token;
        $user->save();

        return redirect()->route('login')->with('success', 'Email berhasil diverifikasi. Silakan login.');
    }
}
