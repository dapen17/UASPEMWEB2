<?php

namespace App\Http\Controllers\ControllerUser\Perhitungan;

use App\Http\Controllers\Controller;
use App\Models\Bobot;
use App\Models\Produk;
use App\Models\Site;
use App\Models\TipeKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class PerhitunganWP extends Controller
{
    //
    public function showPerhitunganWP(Request $request)
    {

        $sites = Site::firstOrFail();
        $logoBase64 = base64_encode($sites->logo);
        $cafe = Produk::paginate(5);
        $columns = Schema::getColumnListing('table_product');
        $exclude = ['id', 'created_at', 'updated_at'];
        $columnsCafe = array_diff($columns, $exclude);
        $exclude1 = ['id', 'created_at', 'updated_at', 'nama'];
        $CafeColumns = array_diff($columns, $exclude1);

        $produks = $request->session()->get('produks', []);

        $excludeColumnsProduk = ['id', 'created_at', 'updated_at', 'nama'];
        $filteredProduks = [];

        // Filter kolom yang tidak diperlukan dari produk
        foreach ($produks as $produk) {
            $filteredProduk = new \stdClass();
            foreach ($produk->getAttributes() as $key => $value) {
                if (!in_array($key, $excludeColumnsProduk)) {
                    $filteredProduk->{$key} = $value;
                }
            }
            $filteredProduks[] = $filteredProduk;
        }

        // Mendapatkan kolom kriteria
        $columns = Schema::getColumnListing('table_product');
        $excludeColumns = ['id', 'created_at', 'updated_at', 'nama'];
        $kriteriaColumns = array_diff($columns, $excludeColumns);

        // Mendapatkan bobot untuk setiap kriteria
        $bobot = Bobot::where('users_id', Auth::id())->latest()->first();
        if (!$bobot) {
            return back()->withErrors(['error' => 'Bobot tidak ditemukan untuk pengguna saat ini.']);
        }

        $columns1 = Schema::getColumnListing('pembobotan');
        $excludeColumns1 = ['id', 'created_at', 'updated_at', 'users_id'];
        $BobotColumns = array_diff($columns1, $excludeColumns1);

        $sumBobot = 0;

        // Menghitung jumlah bobot
        foreach ($BobotColumns as $bobot1) {
            $sumBobot += $bobot->$bobot1;
        }

        $normalizedWeights = [];
        // Menormalkan bobot
        foreach ($BobotColumns as $bobot2) {
            $nilaiBobot = $bobot->$bobot2;
            if ($sumBobot != 0) {
                $normalizedWeights[$bobot1] = $nilaiBobot / $sumBobot;
            } else {
                $normalizedWeights[$bobot1] = 0;
            }
            $hasilNormalWeights[] = $normalizedWeights[$bobot1];
        }

        $S = [];
        $index = 0; // Indeks untuk mengakses $hasilNormalWeights

        // Menghitung vektor S
        foreach ($filteredProduks as $item) {
            $Si = 1;

            // Reset indeks untuk setiap produk
            $index = 0;

            foreach ($kriteriaColumns as $kriteria) {
                // Ambil bobot dari $hasilNormalWeights sesuai dengan indeks saat ini
                $nilaiBobot = isset($hasilNormalWeights[$index]) ? $hasilNormalWeights[$index] : 1;

                $nilaiProduk = $item->$kriteria;

                $tipeKriteria = TipeKriteria::where('nama', $kriteria)->first();

                if ($tipeKriteria && $tipeKriteria->tipe == 'Cost') {
                    // Menghitung untuk tipe Cost
                    $Si *= pow($nilaiProduk, -$nilaiBobot);
                } else {
                    // Menghitung untuk tipe Benefit
                    $Si *= pow($nilaiProduk, $nilaiBobot);
                }
                // Pindah ke indeks berikutnya di $hasilNormalWeights
                $index++;
            }

            $S[] = $Si;
        }

        $totalS = array_sum($S);

        // Menghitung vektor V
        $V = [];
        foreach ($S as $Si) {
            $V[] = $Si / $totalS;
        }

        $hasilWP = [];
        foreach ($produks as $index => $item) {
            $hasilWP[] = [
                'nama' => $item->nama,
                'nilai' => $V[$index] ?? 0,
            ];
        }

        // Mengurutkan hasil berdasarkan vektor V
        usort($hasilWP, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        // Menambahkan peringkat ke hasil
        foreach ($hasilWP as $index => $hasil) {
            $hasilWP[$index]['rank'] = $index + 1;
        }

        $latestBobot = Bobot::where('users_id', Auth::id())->latest()->first();

        return view('user.section.rekomendasi-cafe', compact('hasilWP', 'latestBobot', 'CafeColumns', 'logoBase64', 'sites', 'BobotColumns', 'hasilNormalWeights', 'S', 'V', 'produks', 'cafe', 'columnsCafe', 'columns'));

    }
}