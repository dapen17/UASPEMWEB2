<?php

namespace App\Http\Controllers\ControllerAdmin\Bobot;

use App\Http\Controllers\Controller;
use App\Models\Bobot;
use Illuminate\Http\Request;

class UpdateBobot extends Controller
{
    //
    public function update(Request $request, Bobot $bobot)
    {
        $request->validate([
            'users_id' => 'required',
            // sesuaikan validasi untuk kolom lainnya
        ]);

        $input = $request->all();
        $input['updated_at'] = now(); // atur updated_at saat edit
        $bobot->update($input);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
}
