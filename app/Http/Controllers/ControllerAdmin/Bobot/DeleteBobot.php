<?php

namespace App\Http\Controllers\ControllerAdmin\Bobot;

use App\Http\Controllers\Controller;
use App\Models\Bobot;
use Illuminate\Http\Request;

class DeleteBobot extends Controller
{
    public function destroy(Bobot $bobot)
    {
        $bobot->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
