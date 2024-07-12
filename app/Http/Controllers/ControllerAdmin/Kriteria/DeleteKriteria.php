<?php

namespace App\Http\Controllers\ControllerAdmin\Kriteria;

use App\Http\Controllers\Controller;
use App\Models\TipeKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DeleteKriteria extends Controller
{
    //
    public function delete(Request $request, $column)
    {
        try {
            // Validasi apakah kolom yang ingin dihapus memang ada dalam tabel
            if (!Schema::hasColumn('table_product', $column)) {
                throw new \Exception('Kolom tidak ditemukan.');
            }

            // Dapatkan kolom 'w' yang terkait dengan kolom yang akan dihapus
            $lastWColumn = DB::table('information_schema.columns')
                ->select('column_name')
                ->where('table_schema', env('DB_DATABASE'))
                ->where('table_name', 'pembobotan')
                ->where('column_name', 'like', 'w%')
                ->orderBy('ordinal_position', 'desc')
                ->first();

            if (!$lastWColumn) {
                throw new \Exception('Kolom W tidak ditemukan di tabel pembobotan.');
            }

            // Proses penghapusan kolom dari tabel menggunakan Schema Builder
            Schema::table('table_product', function ($table) use ($column) {
                $table->dropColumn($column);
            });

            // Hapus kolom 'w' terkait dari tabel pembobotan
            Schema::table('pembobotan', function ($table) use ($lastWColumn) {
                $table->dropColumn($lastWColumn->column_name);
            });

            TipeKriteria::where('nama', $column)->delete();

            // Redirect dengan pesan sukses jika penghapusan berhasil
            return redirect()->back()->with('success', 'Kolom berhasil dihapus.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
