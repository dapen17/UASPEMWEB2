<?php

namespace App\Http\Controllers\ControllerAdmin\Kriteria;

use App\Http\Controllers\Controller;
use App\Models\TipeKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class StoreKriteria extends Controller
{
    //
    public function store(Request $request)
    {
        $nama = $request->input('nama');
        $tipe = $request->input('tipe');

        TipeKriteria::create([
            'nama' => $nama,
            'tipe' => $tipe,
        ]);

        // Lakukan validasi jika nama tidak boleh kosong

        // Tambahkan kolom baru dengan tipe data decimal ke dalam tabel nilai
        Schema::table('table_product', function ($table) use ($nama) {
            $table->decimal($nama, 8, 2)->nullable();
        });

        // Perbarui kolom 'w' pada tabel pembobotan
        $this->updatePembobotanTable();

        // Redirect atau kembali ke halaman yang diinginkan setelah proses penambahan
        return redirect()->back()->with('success', 'Kriteria berhasil ditambahkan.');
    }
}
