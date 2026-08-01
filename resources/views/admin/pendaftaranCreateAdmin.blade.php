@extends('admin.layouts.main')

@section('contaner')

<div class="md:w-9/12 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
    <div class="flex justify-between items-center border-b pb-4 mb-6">
        <div>
            <h2 class="text-2xl font-black text-gray-800">Tambah Data Pendaftar Manual</h2>
            <p class="text-sm text-gray-500">Input formulir pendaftaran siswa baru secara manual oleh panitia admin.</p>
        </div>
        <a href="{{ route('pendaftar.admin') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-xl text-sm font-bold transition">
            &larr; Kembali
        </a>
    </div>

    <div class="max-w-2xl mx-auto bg-gray-50 p-6 rounded-2xl border border-gray-200">
        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="bg-white p-4 rounded-xl border mb-6">
                <h4 class="font-bold text-blue-600 mb-3 text-sm uppercase tracking-wider">A. Data Calon Siswa</h4>
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap Anak *</label>
                    <input type="text" name="nama_anak" required class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Nama lengkap siswa">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Jenis Kelamin *</label>
                        <select name="jenis_kelamin" required class="w-full px-3 py-2 border rounded-lg text-sm">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Agama *</label>
                        <input type="text" name="agama" value="Islam" required class="w-full px-3 py-2 border rounded-lg text-sm">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Tempat, Tanggal Lahir *</label>
                    <input type="text" name="ttl" required class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Contoh: Tangerang, 10 Mei 2021">
                </div>

                <div class="mb-2">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Alamat Lengkap *</label>
                    <textarea name="alamat" rows="2" required class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Alamat domisili lengkap"></textarea>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border mb-6">
                <h4 class="font-bold text-amber-600 mb-3 text-sm uppercase tracking-wider">B. Data Orang Tua / Wali</h4>
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Orang Tua / Wali *</label>
                    <input type="text" name="nama_ortu" required class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Nama Ibu/Ayah">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Pekerjaan *</label>
                        <input type="text" name="pekerjaan" required class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Pekerjaan ortu">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">No WhatsApp / HP *</label>
                        <input type="text" name="no_hp" required class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Nomor kontak HP">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" required class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Alamat email ortu">
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border mb-6">
                <h4 class="font-bold text-purple-600 mb-3 text-sm uppercase tracking-wider">C. Status Pendaftaran</h4>
                
                <div class="mb-2">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Status Awal *</label>
                    <select name="status" required class="w-full px-3 py-2 border rounded-lg text-sm font-semibold">
                        <option value="pending">Pending (Menunggu Verifikasi)</option>
                        <option value="diterima">Langsung Diterima</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border mb-6">
                <h4 class="font-bold text-gray-700 mb-3 text-sm uppercase tracking-wider">D. Upload Berkas Syarat</h4>
                
                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Pas Foto Anak *</label>
                        <input type="file" name="foto" required class="w-full text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Akta Kelahiran *</label>
                        <input type="file" name="akta" required class="w-full text-xs">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Kartu Keluarga *</label>
                        <input type="file" name="kk" required class="w-full text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Surat Kesehatan (Opsional)</label>
                        <input type="file" name="kesehatan" class="w-full text-xs">
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('pendaftar.admin') }}" class="w-1/2 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2.5 rounded-xl transition">
                    Batal
                </a>
                <button type="submit" class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 rounded-xl transition shadow-md">
                    Simpan Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>

@endsection