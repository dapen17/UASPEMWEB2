<?php

namespace App\Http\Controllers\ControllerAdmin\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;

class IndexAkun extends Controller
{
    public function userAll()
    {
        // Filter users based on their roles
        $adminUsers = User::where('role', 'Administrator')->get();
        $userUsers = User::where('role', 'User')->get();
        $site = Site::all();
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);

        // Return the view with filtered users
        return view('admin.akun', compact('adminUsers', 'userUsers', 'sites', 'logoBase64'));
    }
    public function akunUser()
    {
        // Filter users based on their roles
        $adminUsers = User::where('role', 'Administrator')->get();
        $userUsers = User::where('role', 'User')->get();
        $site = Site::all();
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);

        // Return the view with filtered users
        return view('admin.akun-user', compact('adminUsers', 'userUsers', 'sites', 'logoBase64'));
    }
}
