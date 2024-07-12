<?php

namespace App\Http\Controllers\ControllerAdmin\Nilai;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class UpdateNilai extends Controller
{
    //
    public function update(Request $request, Produk $produk)
    {
        foreach ($request->except('_token', '_method') as $key => $value) {
            // Jika kolom 'harga', hilangkan semua karakter non-numeric
            if ($key == 'harga') {
                $value = preg_replace("/[^0-9]/", "", $value);
            }
            $produk->$key = $value;
        }
        $produk->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
}
