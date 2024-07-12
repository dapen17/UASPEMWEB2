<?php

namespace App\Http\Controllers\ControllerAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\VerifikasiEmail;
use App\Models\Message;
use App\Models\Produk;
use App\Models\Site;
use App\Models\TipeKriteria;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        $tipe = TipeKriteria::count();
        $produk = Produk::count();
        $admin = User::where('role', 'Administrator')->count();
        $user = User::where('role', 'User')->count();
        $selesai = Message::where('status', 'Selesai')->count();
        $unread = Message::where('status', 'Belum Dibaca')->count();
        $dibaca = Message::where('status', 'Dibaca')->count();
        $diproses = Message::where('status', 'Diproses')->count();
        $pending = Message::where('status', 'Pending')->count();
        $tindaklanjut = Message::where('status', 'Di Tindak Lanjuti')->count();
        $hapus = Message::where('status', 'Hapus')->count();
        $site = Site::all();
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        return view('admin.dashboard', compact('produk', 'logoBase64', 'sites', 'tipe', 'admin', 'user', 'selesai', 'hapus', 'pending', 'tindaklanjut', 'diproses', 'dibaca', 'unread'));
    }

}
