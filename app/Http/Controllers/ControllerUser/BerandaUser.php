<?php

namespace App\Http\Controllers\ControllerUser;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Site;
use App\Models\TipeKriteria;
use App\Models\User;
use App\Services\IpInfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BerandaUser extends Controller
{
    //
    protected $ipInfoService;

    public function __construct(IpInfoService $ipInfoService)
    {
        $this->ipInfoService = $ipInfoService;
    }
    public function home(Request $request)
    {

        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        $tipekriteria = TipeKriteria::all();
        $products = Produk::all();
        $user = User::all();
        $onlineUsersCount = $this->getOnlineUserCount();
        return view('user.user-beranda', compact('tipekriteria', 'products', 'user', 'onlineUsersCount', 'logoBase64', 'sites')); // Mengirim kedua variabel ke tampilan
    }

    private function getOnlineUserCount()
    {
        // Mendapatkan semua kunci cache yang cocok dengan pola 'user-online-*'
        $onlineUserKeys = Cache::get('user-online-*');

        // Memeriksa jika $onlineUserKeys adalah null atau array kosong
        if ($onlineUserKeys === null || !is_array($onlineUserKeys)) {
            return 0; // Jika tidak ada yang online, kembalikan 0
        }

        // Mendapatkan jumlah pengguna yang sedang online
        $activeUsers = Cache::many(array_keys($onlineUserKeys));

        return count($activeUsers);
    }
}
