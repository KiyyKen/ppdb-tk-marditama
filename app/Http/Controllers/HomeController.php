<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan Halaman Utama PPDB TK Mardi Tama
     */
    public function Dashboard()
    {
        $settings = [
            'biaya_masuk' => Setting::getByKey('biaya_masuk', '2500000'),
            'biaya_spp' => Setting::getByKey('biaya_spp', '150000'),
            'biaya_formulir' => Setting::getByKey('biaya_formulir', '50000'),
            'gelombang_nama' => Setting::getByKey('gelombang_nama', 'Gelombang I'),
            'gelombang_jadwal' => Setting::getByKey('gelombang_jadwal', '1 Januari - 30 Juni'),
        ];

        return view('pendaftaran', compact('settings'));
    }

    /**
     * Cek Status Pendaftaran Siswa
     */
    public function cekStatus(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string',
        ]);

        $keyword = trim($request->keyword);

        $pendaftaran = Pendaftaran::where('kode_pendaftaran', $keyword)
            ->orWhere('nama_anak', 'LIKE', "%{$keyword}%")
            ->orWhere('no_hp', $keyword)
            ->orWhere('email', $keyword)
            ->first();

        if (!$pendaftaran) {
            return back()->with('errorCek', "Data pendaftaran dengan kata kunci \"{$keyword}\" tidak ditemukan. Pastikan Kode Pendaftaran atau Nama Anak benar.")
                ->withInput();
        }

        return back()->with('hasilCek', $pendaftaran)->withInput();
    }
}
