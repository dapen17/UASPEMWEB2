<?php

namespace App\Http\Controllers\ControllerAdmin\Alternatif;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class UpdateAlternatif extends Controller
{
    //
    public function update(Request $request, Produk $produk)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $produk->nama = $request->nama;
        $produk->updated_at = now();
        $produk->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
}
