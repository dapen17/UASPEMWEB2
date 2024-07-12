<?php

namespace App\Http\Controllers\ControllerAdmin\Website;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;

class IndexWebsite extends Controller
{
    public function settingSite(){
        $site = Site::all();
        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        return view('admin.site', compact('sites', 'site', 'logoBase64'));
    }
}
