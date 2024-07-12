<?php

namespace App\Http\Controllers\ControllerAdmin\Bobot;

use App\Http\Controllers\Controller;
use App\Models\Bobot;
use Illuminate\Http\Request;

class StoreBobot extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required',
            // sesuaikan validasi untuk kolom lainnya
        ]);

        $input = $request->all();
        $input['created_at'] = now(); // atur created_at saat tambah
        Bobot::create($input);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }
}
