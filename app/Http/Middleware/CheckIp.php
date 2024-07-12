<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        if ($ip == '127.0.0.1' || $ip == '::1') {
            // Get the real public IP address using ipinfo.io
            $ip = file_get_contents('https://ipinfo.io/ip');
        }

        $request->merge(['real_ip' => trim($ip)]);

        return $next($request);
    }
}
