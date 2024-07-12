<?php

namespace App\Http\Controllers\ControllerAdmin\Nilai;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class StoreNilai extends Controller
{
    //
    public function store(Request $request)
    {
        $produk = new Produk();
        foreach ($request->except('_token') as $key => $value) {
            $produk->$key = $value;
        }
        $produk->save();

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }
}
