<?php

namespace App\Http\Controllers\ControllerUser;

use App\Http\Controllers\Controller;
use App\Models\Bobot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class BobotUser extends Controller
{
    //
    public function addData(Request $request)
    {
        // Mendapatkan daftar kolom dari tabel pembobotan
        $columns1 = Schema::getColumnListing('pembobotan');
        $excludeColumns1 = ['id', 'created_at', 'updated_at', 'users_id'];
        $BobotColumns = array_diff($columns1, $excludeColumns1);

        // Validasi input untuk setiap kolom bobot
        foreach ($BobotColumns as $column) {
            $request->validate([
                $column => 'required|numeric',
            ]);
        }

        $data = [
            'users_id' => Auth::id(),
            'created_at' => now(),
        ];

        // Masukkan nilai dari request ke dalam data
        foreach ($BobotColumns as $column) {
            $data[$column] = $request->input($column);
        }

        // Simpan data ke database
        Bobot::create($data);

        // Redirect atau lakukan hal lain setelah data disimpan
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }
}
