@extends('admin.layouts.main')

@section('contaner')

<div class="md:w-9/12 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
    <div class="flex justify-between items-center border-b pb-4 mb-6">
        <div>
            <h2 class="text-2xl font-black text-gray-800">Edit Data Pendaftar</h2>
            <p class="text-sm text-gray-500">Perbarui data siswa, orang tua, status kelulusan, dan berkas pendaftar {{ $data->nama_anak }}.</p>
        </div>
        <a href="{{ route('pendaftar.admin') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-xl text-sm font-bold transition">
            &larr; Kembali
        </a>
    </div>

    <div class="max-w-2xl mx-auto bg-gray-50 p-6 rounded-2xl border border-gray-200">
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pendaftaran.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white p-4 rounded-xl border mb-6">
                <h4 class="font-bold text-blue-600 mb-3 text-sm uppercase tracking-wider">A. Data Calon Siswa</h4>
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap Anak *</label>
                    <input type="text" name="nama_anak" value="{{ old('nama_anak', $data->nama_anak) }}" required class="w-full px-3 py-2 border rounded-lg text-sm">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Jenis Kelamin *</label>
                        <select name="jenis_kelamin" required class="w-full px-3 py-2 border rounded-lg text-sm">
                            <option value="L" {{ $data->jenis_kelamin == 'L' || $data->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $data->jenis_kelamin == 'P' || $data->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Agama *</label>
                        <input type="text" name="agama" value="{{ old('agama', $data->agama) }}" required class="w-full px-3 py-2 border rounded-lg text-sm">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Tempat, Tanggal Lahir *</label>
                    <input type="text" name="ttl" value="{{ old('ttl', $data->ttl) }}" required class="w-full px-3 py-2 border rounded-lg text-sm">
                </div>

                <div class="mb-2">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Alamat Lengkap *</label>
                    <textarea name="alamat" rows="2" required class="w-full px-3 py-2 border rounded-lg text-sm">{{ old('alamat', $data->alamat) }}</textarea>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border mb-6">
                <h4 class="font-bold text-amber-600 mb-3 text-sm uppercase tracking-wider">B. Data Orang Tua / Wali</h4>
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Orang Tua / Wali *</label>
                    <input type="text" name="nama_ortu" value="{{ old('nama_ortu', $data->nama_ortu) }}" required class="w-full px-3 py-2 border rounded-lg text-sm">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Pekerjaan *</label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $data->pekerjaan) }}" required class="w-full px-3 py-2 border rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">No WhatsApp / HP *</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $data->no_hp) }}" required class="w-full px-3 py-2 border rounded-lg text-sm">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $data->email) }}" required class="w-full px-3 py-2 border rounded-lg text-sm">
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border mb-6">
                <h4 class="font-bold text-purple-600 mb-3 text-sm uppercase tracking-wider">C. Status & Catatan Panitia</h4>
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Status Kelulusan *</label>
                    <select name="status" required class="w-full px-3 py-2 border rounded-lg text-sm font-semibold">
                        <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                        <option value="diterima" {{ $data->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ $data->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Catatan Panitia</label>
                    <textarea name="catatan_admin" rows="2" class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Catatan opsional untuk pendaftar...">{{ old('catatan_admin', $data->catatan_admin) }}</textarea>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border mb-6">
                <h4 class="font-bold text-gray-700 mb-3 text-sm uppercase tracking-wider">D. Ganti Berkas (Opsional)</h4>
                
                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Pas Foto Baru</label>
                        <input type="file" name="foto" class="w-full text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Akta Kelahiran Baru</label>
                        <input type="file" name="akta" class="w-full text-xs">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Kartu Keluarga Baru</label>
                        <input type="file" name="kk" class="w-full text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Surat Kesehatan Baru</label>
                        <input type="file" name="kesehatan" class="w-full text-xs">
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('pendaftar.admin') }}" class="w-1/2 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2.5 rounded-xl transition">
                    Batal
                </a>
                <button type="submit" class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 rounded-xl transition shadow-md">
                    Perbarui Data Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>

@endsection