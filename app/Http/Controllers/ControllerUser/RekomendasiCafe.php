<?php

namespace App\Http\Controllers\ControllerUser;

use App\Http\Controllers\Controller;
use App\Models\Bobot;
use App\Models\Produk;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class RekomendasiCafe extends Controller
{
    //
    public function rekomendasi()
    {

        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        $produk = Produk::all();
        $columns1 = Schema::getColumnListing('pembobotan');
        $excludeColumns1 = ['id', 'created_at', 'updated_at', 'users_id'];
        $BobotColumns = array_diff($columns1, $excludeColumns1);
        $cafe = Produk::paginate(5);
        $columns = Schema::getColumnListing('table_product');
        $exclude = ['id', 'created_at', 'updated_at'];
        $columnsCafe = array_diff($columns, $exclude);
        $exclude1 = ['id', 'created_at', 'updated_at', 'nama'];
        $CafeColumns = array_diff($columns, $exclude1);
        $latestBobot = Bobot::where('users_id', Auth::id())->latest()->first();
        return view('user.section.rekomendasi-cafe', compact('produk', 'CafeColumns', 'latestBobot','logoBase64', 'sites', 'BobotColumns', 'cafe', 'columnsCafe', 'columns'));
    }
}
