<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    public function pendaftaranCreate(Request $request)
    {
        $validated = $request->validate([
            'nama_anak' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'ttl' => 'required|string|max:255',
            'agama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'nama_ortu' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'foto' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'akta' => 'required|file|mimes:pdf,jpeg,png,jpg|max:5120',
            'kk' => 'required|file|mimes:pdf,jpeg,png,jpg|max:5120',
            'kesehatan' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:5120',
        ]);

        // Simpan berkas ke storage/app/public/uploads/...
        $foto = $request->file('foto')->store('uploads/foto', 'public');
        $akta = $request->file('akta')->store('uploads/akta', 'public');
        $kk = $request->file('kk')->store('uploads/kk', 'public');
        $kesehatan = $request->file('kesehatan')?->store('uploads/kesehatan', 'public');

        // Simpan pendaftaran ke database
        $pendaftaran = Pendaftaran::create([
            'nama_anak' => $validated['nama_anak'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'ttl' => $validated['ttl'],
            'agama' => $validated['agama'],
            'alamat' => $validated['alamat'],
            'nama_ortu' => $validated['nama_ortu'],
            'pekerjaan' => $validated['pekerjaan'],
            'no_hp' => $validated['no_hp'],
            'email' => $validated['email'],
            'foto' => $foto,
            'akta' => $akta,
            'kk' => $kk,
            'kesehatan' => $kesehatan,
            'status' => 'pending',
        ]);

        return redirect()->route('Dashboard')->with('successPendaftaran', [
            'nama_anak' => $pendaftaran->nama_anak,
            'kode_pendaftaran' => $pendaftaran->kode_pendaftaran,
        ]);
    }
}
