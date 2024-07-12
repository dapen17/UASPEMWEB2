<?php

namespace App\Http\Controllers\ControllerAdmin\Alternatif;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class DeleteAlternatif extends Controller
{
    //
    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
