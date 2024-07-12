<?php

namespace App\Http\Controllers\ControllerAdmin\Website;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;

class UpdateWebsite extends Controller
{
    public function updateSite(Request $request)
    {
        $sites = Site::firstOrFail(); // Ambil data site

        // Validasi input jika diperlukan
        $request->validate([
            'namasite' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data sesuai dengan input form
        $sites->namasite = $request->input('namasite');
        $sites->slogan = $request->input('slogan');

        // Proses upload logo jika ada
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $sites->logo = file_get_contents($file); // Simpan file ke dalam kolom logo dengan tipe longblob
        }

        $sites->save();

        return redirect()->route('admin.site'); // Redirect ke halaman home setelah berhasil menyimpan
    }
}
