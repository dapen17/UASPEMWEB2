<?php

namespace App\Http\Controllers\ControllerAdmin\Nilai;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class DeleteNilai extends Controller
{
    //
    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
