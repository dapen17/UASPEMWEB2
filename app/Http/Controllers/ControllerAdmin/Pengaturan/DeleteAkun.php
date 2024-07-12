<?php

namespace App\Http\Controllers\ControllerAdmin\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteAkun extends Controller
{
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus baris terkait di tabel pembobotan
        DB::table('pembobotan')->where('users_id', $id)->delete();
        DB::table('message')->where('users_id', $id)->delete();

        $user->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        // Hapus baris terkait di tabel pembobotan
        DB::table('pembobotan')->where('users_id', $id)->delete();
        DB::table('message')->where('users_id', $id)->delete();

        $user->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
