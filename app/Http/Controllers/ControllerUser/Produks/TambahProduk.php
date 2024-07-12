<?php

namespace App\Http\Controllers\ControllerUser\Produks;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class TambahProduk extends Controller
{
    //
    public function addProduk(Request $request)
    {
        // Validasi input
        $request->validate([
            'produk.*' => 'required|exists:table_product,id'
        ]);

        $produk = Produk::find($request->produk);

        $produks = $request->session()->get('produks', []);

        $produks[] = $produk;

        $request->session()->put('produks', $produks);

        return redirect()->route('user.rekomendasi');
    }
}
