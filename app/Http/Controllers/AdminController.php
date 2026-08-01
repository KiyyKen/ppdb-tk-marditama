<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $totalPendaftar = Pendaftaran::count();
        $pendingPendaftar = Pendaftaran::where('status', 'pending')->count();
        $diterimaPendaftar = Pendaftaran::where('status', 'diterima')->count();
        $ditolakPendaftar = Pendaftaran::where('status', 'ditolak')->count();
        $totalAdmin = User::where('role', 'admin')->count();

        $lakiCount = Pendaftaran::where('jenis_kelamin', 'L')->orWhere('jenis_kelamin', 'laki-laki')->count();
        $perempuanCount = Pendaftaran::where('jenis_kelamin', 'P')->orWhere('jenis_kelamin', 'perempuan')->count();

        $recentPendaftar = Pendaftaran::latest()->take(5)->get();

        return view('admin.admin', [
            'actives' => 'admin-dashboard',
            'totalPendaftar' => $totalPendaftar,
            'pendingPendaftar' => $pendingPendaftar,
            'diterimaPendaftar' => $diterimaPendaftar,
            'ditolakPendaftar' => $ditolakPendaftar,
            'totalAdmin' => $totalAdmin,
            'lakiCount' => $lakiCount,
            'perempuanCount' => $perempuanCount,
            'recentPendaftar' => $recentPendaftar,
        ]);
    }

    /* =========================================================
       EXPORT DATA PENDAFTAR KE CSV/EXCEL
       ========================================================= */

    public function exportCsv()
    {
        $filename = "data-pendaftaran-ppdb-" . date('Y-m-d-His') . ".csv";
        $pendaftarans = Pendaftaran::latest()->get();

        $headers = array(
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('No', 'Kode Pendaftaran', 'Nama Anak', 'Jenis Kelamin', 'TTL', 'Agama', 'Alamat', 'Nama Ortu', 'Pekerjaan', 'No HP', 'Email', 'Status', 'Catatan Admin', 'Tanggal Daftar');

        $callback = function () use ($pendaftarans, $columns) {
            $file = fopen('php://output', 'w');
            // Add UTF-8 BOM for Excel compatibility
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, $columns);

            $no = 1;
            foreach ($pendaftarans as $p) {
                $row['No'] = $no++;
                $row['Kode Pendaftaran'] = $p->kode_pendaftaran;
                $row['Nama Anak'] = $p->nama_anak;
                $row['Jenis Kelamin'] = ($p->jenis_kelamin == 'L' || $p->jenis_kelamin == 'laki-laki') ? 'Laki-laki' : 'Perempuan';
                $row['TTL'] = $p->ttl;
                $row['Agama'] = $p->agama;
                $row['Alamat'] = $p->alamat;
                $row['Nama Ortu'] = $p->nama_ortu;
                $row['Pekerjaan'] = $p->pekerjaan;
                $row['No HP'] = $p->no_hp;
                $row['Email'] = $p->email;
                $row['Status'] = strtoupper($p->status);
                $row['Catatan Admin'] = $p->catatan_admin ?? '-';
                $row['Tanggal Daftar'] = $p->created_at ? $p->created_at->format('d/m/Y H:i') : '-';

                fputcsv($file, array(
                    $row['No'],
                    $row['Kode Pendaftaran'],
                    $row['Nama Anak'],
                    $row['Jenis Kelamin'],
                    $row['TTL'],
                    $row['Agama'],
                    $row['Alamat'],
                    $row['Nama Ortu'],
                    $row['Pekerjaan'],
                    $row['No HP'],
                    $row['Email'],
                    $row['Status'],
                    $row['Catatan Admin'],
                    $row['Tanggal Daftar']
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /* =========================================================
       PENGATURAN BIAYA & GELOMBANG PPDB
       ========================================================= */

    public function settingsIndex()
    {
        $settings = [
            'biaya_masuk' => Setting::getByKey('biaya_masuk', '2500000'),
            'biaya_spp' => Setting::getByKey('biaya_spp', '150000'),
            'biaya_formulir' => Setting::getByKey('biaya_formulir', '50000'),
            'gelombang_nama' => Setting::getByKey('gelombang_nama', 'Gelombang I'),
            'gelombang_jadwal' => Setting::getByKey('gelombang_jadwal', '1 Januari - 30 Juni'),
        ];

        return view('admin.settings', [
            'actives' => 'settings-admin',
            'settings' => $settings
        ]);
    }

    public function settingsUpdate(Request $request)
    {
        $request->validate([
            'biaya_masuk' => 'required|numeric|min:0',
            'biaya_spp' => 'required|numeric|min:0',
            'biaya_formulir' => 'required|numeric|min:0',
            'gelombang_nama' => 'required|string|max:255',
            'gelombang_jadwal' => 'required|string|max:255',
        ]);

        Setting::setByKey('biaya_masuk', $request->biaya_masuk, 'Biaya Masuk (Uang Pangkal)');
        Setting::setByKey('biaya_spp', $request->biaya_spp, 'SPP Bulanan');
        Setting::setByKey('biaya_formulir', $request->biaya_formulir, 'Formulir Pendaftaran');
        Setting::setByKey('gelombang_nama', $request->gelombang_nama, 'Nama Gelombang');
        Setting::setByKey('gelombang_jadwal', $request->gelombang_jadwal, 'Jadwal Gelombang');

        return redirect()->back()->with('success', 'Pengaturan biaya dan gelombang PPDB berhasil disimpan.');
    }

    /* =========================================================
       PROFIL & GANTI PASSWORD ADMIN
       ========================================================= */

    public function profileEdit()
    {
        return view('admin.profile', [
            'actives' => 'profile-admin',
            'user' => Auth::user()
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'current_password' => 'required',
            'new_password' => 'nullable|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini yang Anda masukkan salah.');
        }

        $user->username = $request->username;

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil dan password Anda berhasil diperbarui!');
    }

    /* =========================================================
       MANAGEMENT DATA ADMIN
       ========================================================= */

    public function dataAdmin()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.dataAdmin', [
            'admins' => $admins,
            'actives' => 'data-admin',
        ]);
    }

    public function adminCreate()
    {
        return view('admin.dataAdminCreate', [
            'actives' => 'data-admin',
        ]);
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('data.admin')->with('success', 'Data admin berhasil ditambahkan!');
    }

    public function adminEdit($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.dataAdminEdit', [
            'admin' => $admin,
            'actives' => 'data-admin',
        ]);
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $admin = User::findOrFail($id);
        $admin->username = $request->username;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('data.admin')->with('success', 'Data admin berhasil diperbarui.');
    }

    public function adminDestroy($id)
    {
        $admin = User::findOrFail($id);

        if (auth()->user()->id == $admin->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        $admin->delete();
        return redirect()->back()->with('success', 'Data admin berhasil dihapus.');
    }

    /* =========================================================
       MANAGEMENT DATA PENDAFTARAN
       ========================================================= */

    public function pendaftaranAdmin(Request $request)
    {
        $query = Pendaftaran::query();

        if ($request->has('status') && in_array($request->status, ['pending', 'diterima', 'ditolak'])) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_anak', 'LIKE', "%{$search}%")
                    ->orWhere('kode_pendaftaran', 'LIKE', "%{$search}%")
                    ->orWhere('nama_ortu', 'LIKE', "%{$search}%")
                    ->orWhere('no_hp', 'LIKE', "%{$search}%");
            });
        }

        $pendaftarans = $query->latest()->get();

        return view('admin.pendaftaranAdmin', [
            'actives' => 'pendaftaran-admin',
            'pendaftarans' => $pendaftarans,
            'selectedStatus' => $request->status ?? '',
            'searchKeyword' => $request->search ?? '',
        ]);
    }

    public function pendaftaranShow($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pendaftaranShowAdmin', [
            'pendaftaran' => $pendaftaran,
            'actives' => 'pendaftaran-admin'
        ]);
    }

    public function pendaftaranCetak($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pendaftaranCetak', [
            'pendaftaran' => $pendaftaran,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->back()->with('success', "Status pendaftaran {$pendaftaran->nama_anak} berhasil diperbarui menjadi: " . strtoupper($request->status));
    }

    public function pendaftaranCreate()
    {
        return view('admin.pendaftaranCreateAdmin', [
            'actives' => 'pendaftaran-admin'
        ]);
    }

    public function pendaftaranStore(Request $request)
    {
        $validated = $request->validate([
            'nama_anak' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'ttl' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'nama_ortu' => 'required|string',
            'pekerjaan' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|email',
            'foto' => 'required|file|image|max:2048',
            'akta' => 'required|file|max:5120',
            'kk' => 'required|file|max:5120',
            'kesehatan' => 'nullable|file|max:5120',
            'status' => 'nullable|in:pending,diterima,ditolak',
        ]);

        $foto = $request->file('foto')->store('uploads/foto', 'public');
        $akta = $request->file('akta')->store('uploads/akta', 'public');
        $kk = $request->file('kk')->store('uploads/kk', 'public');
        $kesehatan = $request->file('kesehatan')?->store('uploads/kesehatan', 'public');

        Pendaftaran::create([
            ...$validated,
            'foto' => $foto,
            'akta' => $akta,
            'kk' => $kk,
            'kesehatan' => $kesehatan,
            'status' => $request->status ?? 'pending',
        ]);

        return redirect()->route('pendaftar.admin')->with('success', 'Pendaftaran baru berhasil ditambahkan!');
    }

    public function pendaftaranEdit($id)
    {
        $data = Pendaftaran::findOrFail($id);
        return view('admin.pendaftaranEditAdmin', [
            'data' => $data,
            'actives' => 'pendaftaran-admin'
        ]);
    }

    public function pendaftaranUpdate(Request $request, $id)
    {
        $data = Pendaftaran::findOrFail($id);

        $request->validate([
            'nama_anak' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'ttl' => 'required|string',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'nama_ortu' => 'required|string',
            'pekerjaan' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|email',
            'foto' => 'nullable|file|image|max:2048',
            'akta' => 'nullable|file|max:5120',
            'kk' => 'nullable|file|max:5120',
            'kesehatan' => 'nullable|file|max:5120',
            'status' => 'required|in:pending,diterima,ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $data->update([
            'nama_anak' => $request->nama_anak,
            'jenis_kelamin' => $request->jenis_kelamin,
            'ttl' => $request->ttl,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'nama_ortu' => $request->nama_ortu,
            'pekerjaan' => $request->pekerjaan,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        if ($request->hasFile('foto')) {
            if ($data->foto && Storage::disk('public')->exists($data->foto)) {
                Storage::disk('public')->delete($data->foto);
            }
            $data->foto = $request->file('foto')->store('uploads/foto', 'public');
        }

        if ($request->hasFile('akta')) {
            if ($data->akta && Storage::disk('public')->exists($data->akta)) {
                Storage::disk('public')->delete($data->akta);
            }
            $data->akta = $request->file('akta')->store('uploads/akta', 'public');
        }

        if ($request->hasFile('kk')) {
            if ($data->kk && Storage::disk('public')->exists($data->kk)) {
                Storage::disk('public')->delete($data->kk);
            }
            $data->kk = $request->file('kk')->store('uploads/kk', 'public');
        }

        if ($request->hasFile('kesehatan')) {
            if ($data->kesehatan && Storage::disk('public')->exists($data->kesehatan)) {
                Storage::disk('public')->delete($data->kesehatan);
            }
            $data->kesehatan = $request->file('kesehatan')->store('uploads/kesehatan', 'public');
        }

        $data->save();

        return redirect()->route('pendaftar.admin')->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    public function pendaftaranDestroy($id)
    {
        $data = Pendaftaran::findOrFail($id);

        if ($data->foto && Storage::disk('public')->exists($data->foto)) {
            Storage::disk('public')->delete($data->foto);
        }
        if ($data->akta && Storage::disk('public')->exists($data->akta)) {
            Storage::disk('public')->delete($data->akta);
        }
        if ($data->kk && Storage::disk('public')->exists($data->kk)) {
            Storage::disk('public')->delete($data->kk);
        }
        if ($data->kesehatan && Storage::disk('public')->exists($data->kesehatan)) {
            Storage::disk('public')->delete($data->kesehatan);
        }

        $data->delete();

        return redirect()->route('pendaftar.admin')->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
