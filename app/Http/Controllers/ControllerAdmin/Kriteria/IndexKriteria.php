<?php

namespace App\Http\Controllers\ControllerAdmin\Kriteria;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\TipeKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class IndexKriteria extends Controller
{
    //
    public function index()
    {
        $tipe = TipeKriteria::all();
        $columns = Schema::getColumnListing('table_product');
        $exclude = ['id', 'created_at', 'updated_at', 'nama'];
        $columnsOrder = array_diff($columns, $exclude);

        // Gabungkan tipe kriteria dengan kolom berdasarkan nama yang sama
        $kriteria = [];
        foreach ($columnsOrder as $column) {
            $nama_kriteria = ucfirst(str_replace('_', ' ', $column));
            $tipe_kriteria = $tipe->firstWhere('nama', $column);
            $kriteria[] = [
                'nama' => $column,
                'tipe' => $tipe_kriteria ? $tipe_kriteria->tipe : 'Tidak ada'
            ];
        }

        $site = Site::all();
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);

        return view('admin.kriteria', compact('kriteria', 'sites','logoBase64'));
    }
}
