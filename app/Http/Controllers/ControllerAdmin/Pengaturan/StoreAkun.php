<?php

namespace App\Http\Controllers\ControllerAdmin\Pengaturan;

use App\Http\Controllers\Controller;
use App\Mail\VerifikasiEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StoreAkun extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);

        $token = Str::random(32); // Generate email verification token

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(10), // Generate remember token (optional)
            'email_verified_at' => null, // Initial email verification status
            'role' => $request->role,
            'email_verification_token' => $token, // Store email verification token
        ]);

        // Send verification email
        $verificationUrl = url('/verify-email?token=' . $token);
        Mail::to($user->email)->send(new VerifikasiEmail($user->name, $verificationUrl));

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);

        $token = Str::random(32); // Generate email verification token

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(10), // Generate remember token (optional)
            'email_verified_at' => null, // Initial email verification status
            'role' => $request->role,
            'email_verification_token' => $token, // Store email verification token
        ]);

        // Send verification email
        $verificationUrl = url('/verify-email?token=' . $token);
        Mail::to($user->email)->send(new VerifikasiEmail($user->name, $verificationUrl));

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }
}
