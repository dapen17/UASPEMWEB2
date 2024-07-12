<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrackOnlineUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mendapatkan ID pengguna aktif
        $userId = auth()->id();

        // Menyimpan status online pengguna dalam cache selama 5 menit
        $expiresAt = now()->addMinutes(5);
        Cache::put('user-online-' . $userId, true, $expiresAt);

        // Mendapatkan semua kunci cache yang cocok dengan pola 'user-online-*'
        $onlineUserKeys = Cache::get('user-online-*');

        // Memeriksa jika $onlineUserKeys adalah null atau array kosong
        if ($onlineUserKeys === null || !is_array($onlineUserKeys)) {
            $onlineUserKeys = [];
        }

        // Mendapatkan jumlah pengguna yang sedang online
        $activeUsers = Cache::many(array_keys($onlineUserKeys));

        // Menyimpan jumlah pengguna online dalam cache
        Cache::put('user-online-count', count($activeUsers), $expiresAt);

        return $next($request);
    }
}
