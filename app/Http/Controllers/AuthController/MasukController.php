<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MasukController extends Controller
{
    //
    public function login()
    {
        $site = Site::all();
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        return view('auth.login', compact('logoBase64', 'sites'));
    }
    public function login_proses(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        // Get the credentials from the request
        $credentials = $request->only('email', 'password');

        // Attempt to log in with the provided credentials
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user's email has been verified
            if ($user->email_verified_at !== null) {
                // Show success alert and redirect based on user role
                Alert::success('Login berhasil', 'Anda berhasil login.');
                if ($user->role === 'Administrator') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('user.home');
                }
            } else {
                // Show error alert for unverified email and logout the user
                Auth::logout();
                Alert::error('Email belum diverifikasi', 'Silakan periksa email Anda.');
                return redirect()->route('login');
            }
        } else {
            // Show error alert for incorrect credentials
            Alert::error('Login gagal', 'Email atau Password Salah');
            return redirect()->route('login');
        }
    }


    public function logout()
    {
        Auth::logout(); // Lakukan proses logout

        return redirect()->route('login'); // Redirect kembali ke halaman login
    }
}
