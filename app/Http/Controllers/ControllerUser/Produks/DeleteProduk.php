<?php

namespace App\Http\Controllers\ControllerUser\Produks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteProduk extends Controller
{
    //
    public function deleteProduk(Request $request, $produkID)
    {
        // Ambil daftar produk dari session
        $produks = $request->session()->get('produks', []);

        // Cari index produk berdasarkan ID
        foreach ($produks as $index => $produk) {
            if ($produk->id == $produkID) {
                // Hapus produk dari array
                unset($produks[$index]);
                break;
            }
        }

        // Reindex array dan simpan kembali ke session
        $produks = array_values($produks);
        $request->session()->put('produks', $produks);

        // Redirect kembali ke halaman rekomendasi
        return redirect()->route('user.rekomendasi');
    }
}
