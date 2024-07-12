<?php

namespace App\Http\Controllers\ControllerUser\Produks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class UpdateProduk extends Controller
{
    public function updateProduk(Request $request, $produkID)
    {
        $columns = Schema::getColumnListing('table_product');
        $exclude = ['id', 'created_at', 'updated_at'];
        $columnsCafe = array_diff($columns, $exclude);
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            // Tambahkan validasi untuk setiap kolom yang ingin Anda update
        ]);

        // Ambil produk dari session (jika ada)
        $produks = $request->session()->get('produks', []);

        // Cari produk yang akan diupdate berdasarkan ID
        foreach ($produks as $produk) {
            if ($produk->id == $produkID) {
                // Update kolom-kolom produk sesuai dengan input
                $produk->nama = $request->nama;
                // Tambahkan update untuk setiap kolom yang ada di columnsCafe
                foreach ($request->only($columnsCafe) as $key => $value) {
                    if ($key != 'id' && $key != 'created_at' && $key != 'updated_at') {
                        $produk->$key = $value;
                    }
                }
                break;
            }
        }

        // Simpan kembali ke session
        $request->session()->put('produks', $produks);

        // Redirect kembali ke halaman rekomendasi atau halaman lain yang sesuai
        return redirect()->route('user.rekomendasi')->withSuccess('Produk berhasil diperbarui.');
    }
}
