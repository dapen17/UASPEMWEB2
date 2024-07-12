<?php

namespace App\Http\Controllers\ControllerAdmin\Kriteria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateTableBobot extends Controller
{
    //
    public function updatePembobotanTable()
    {
        // Dapatkan kolom 'w' terakhir dari tabel pembobotan
        $lastWColumn = DB::table('information_schema.columns')
            ->select('column_name')
            ->where('table_schema', env('DB_DATABASE')) // Tambahkan ini untuk memastikan bahwa kita bekerja di database yang benar
            ->where('table_name', 'pembobotan')
            ->where('column_name', 'like', 'w%')
            ->orderBy('ordinal_position', 'desc') // Pastikan urutan kolom benar berdasarkan posisinya
            ->first();

        if ($lastWColumn) {
            // Extract nomor 'w' terakhir
            $lastWNumber = intval(substr($lastWColumn->column_name, 1));
        } else {
            // Jika tidak ada kolom 'w' sebelumnya, atur nomor 'w' awal
            $lastWNumber = 0;
        }

        // Tambahkan kolom 'w' berikutnya pada tabel pembobotan
        $newWColumn = 'w' . ($lastWNumber + 1);

        // Cek apakah kolom sudah ada sebelum menambahkan
        if (!Schema::hasColumn('pembobotan', $newWColumn)) {
            Schema::table('pembobotan', function ($table) use ($newWColumn) {
                $table->decimal($newWColumn, 8, 2)->nullable();
            });
        } else {
        }
    }
}
