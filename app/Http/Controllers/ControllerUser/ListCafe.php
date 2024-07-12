<?php

namespace App\Http\Controllers\ControllerUser;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Site;

class ListCafe extends Controller
{
    //
    public function cafe()
    {
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        $products = Produk::all();
        return view('user.section.list-cafe', compact('products', 'logoBase64', 'sites'));
    }
}
