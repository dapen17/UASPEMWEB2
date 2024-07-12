<?php

namespace App\Http\Controllers\ControllerAdmin\Bobot;

use App\Http\Controllers\Controller;
use App\Models\Bobot;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class IndexBobot extends Controller
{
    public function index()
    {
        $site = Site::all();
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        $bobot = Bobot::with('user')->paginate(5);
        $users = User::all();
        $columns = Schema::getColumnListing('pembobotan');
        $exclude = ['id', 'created_at', 'updated_at'];
        $columnsBobot = array_diff($columns, $exclude);
        return view('admin.pembobotan', compact('bobot', 'columnsBobot', 'users', 'logoBase64', 'sites'));
    }
}
