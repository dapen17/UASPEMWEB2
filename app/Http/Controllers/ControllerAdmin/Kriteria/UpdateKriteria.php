<?php

namespace App\Http\Controllers\ControllerAdmin\Kriteria;

use App\Http\Controllers\Controller;
use App\Models\TipeKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateKriteria extends Controller
{
    //
    public function update(Request $request, $column)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|string|in:Benefit,Cost',
        ]);

        $namaKolom = str_replace(' ', '_', strtolower($request->input('nama')));
        $tipe = $request->input('tipe');

        // Perbarui nama kolom dalam tabel nilai
        DB::statement("ALTER TABLE `table_product` CHANGE `$column` `$namaKolom` VARCHAR(255)");


        // Perbarui nama dan tipe dalam tabel TipeKriteria
        TipeKriteria::where('nama', $column)->update([
            'nama' => $namaKolom,
            'tipe' => $tipe,
        ]);

        // Redirect atau kembali ke halaman yang diinginkan setelah proses update
        return redirect()->back()->with('success', 'Kriteria berhasil diperbarui.');
    }
}
