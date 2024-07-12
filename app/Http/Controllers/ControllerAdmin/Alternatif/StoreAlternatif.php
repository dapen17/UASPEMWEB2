<?php

namespace App\Http\Controllers\ControllerAdmin\Alternatif;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class StoreAlternatif extends Controller
{
    //
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);
    
        $produk = new Produk();
        $produk->nama = $request->nama;
        $produk->created_at = now();
        $produk->save();
    
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }
    
}
