<?php

namespace App\Http\Controllers\ControllerAdmin\Nilai;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class IndexNilai extends Controller
{
    //
    public function index()
    {
        $site = Site::all();
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        $nilai = Produk::paginate(5);
        $columns = Schema::getColumnListing('table_product');
        $exclude = ['id', 'created_at', 'updated_at'];
        $columnsPenilaian = array_diff($columns, $exclude);
        return view('admin.penilaian', compact('nilai', 'columns', 'columnsPenilaian', 'logoBase64', 'sites'));
    }
}
