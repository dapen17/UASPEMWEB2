<?php

namespace App\Http\Controllers\ControllerAdmin\Alternatif;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Site;
use Illuminate\Http\Request;

class IndexAlternatif extends Controller
{
    //
    public function alternatif()
    {
        $produk = Produk::paginate(5);
        $site = Site::all();
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        return view('admin.alternatif', compact('produk', 'sites', 'logoBase64'));
    }
}
