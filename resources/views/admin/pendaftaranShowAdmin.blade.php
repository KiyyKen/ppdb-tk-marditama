@extends('admin.layouts.main')

@section('contaner')

<div class="md:w-9/12 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b pb-4 mb-6 gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <h2 class="text-2xl font-black text-gray-800">Detail Pendaftaran {{ $pendaftaran->nama_anak }}</h2>
                {!! $pendaftaran->status_badge !!}
            </div>
            <p class="text-sm font-mono text-blue-600 font-bold">KODE: {{ $pendaftaran->kode_pendaftaran }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('pendaftar.admin') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-xl text-sm font-bold transition">
                &larr; Kembali
            </a>
            <a href="{{ route('pendaftaran.cetak', $pendaftaran->id) }}" target="_blank" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-md transition flex items-center gap-1">
                <i class="ri-printer-line"></i> Cetak Bukti PDF
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl mb-6">
            <i class="ri-checkbox-circle-fill me-1"></i> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Data Anak -->
        <div class="bg-blue-50/50 p-5 rounded-2xl border border-blue-100 shadow-sm">
            <h3 class="font-bold text-base text-blue-900 border-b border-blue-200 pb-2 mb-3 flex items-center gap-2">
                <i class="ri-user-smile-line text-blue-600"></i> A. Data Calon Siswa
            </h3>
            <div class="space-y-2 text-sm">
                <div>
                    <span class="text-gray-500 text-xs block">Nama Lengkap</span>
                    <strong class="text-gray-900">{{ $pendaftaran->nama_anak }}</strong>
                </div>
                <div>
                    <span class="text-gray-500 text-xs block">Jenis Kelamin</span>
                    <strong class="text-gray-900">{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</strong>
                </div>
                <div>
                    <span class="text-gray-500 text-xs block">Tempat, Tanggal Lahir</span>
                    <strong class="text-gray-900">{{ $pendaftaran->ttl }}</strong>
                </div>
                <div>
                    <span class="text-gray-500 text-xs block">Agama</span>
                    <strong class="text-gray-900">{{ $pendaftaran->agama }}</strong>
                </div>
                <div>
                    <span class="text-gray-500 text-xs block">Alamat Rumah</span>
                    <strong class="text-gray-900">{{ $pendaftaran->alamat }}</strong>
                </div>
            </div>
        </div>

        <!-- Data Ortu -->
        <div class="bg-amber-50/50 p-5 rounded-2xl border border-amber-100 shadow-sm">
            <h3 class="font-bold text-base text-amber-900 border-b border-amber-200 pb-2 mb-3 flex items-center gap-2">
                <i class="ri-parent-line text-amber-600"></i> B. Data Orang Tua / Wali
            </h3>
            <div class="space-y-2 text-sm">
                <div>
                    <span class="text-gray-500 text-xs block">Nama Orang Tua / Wali</span>
                    <strong class="text-gray-900">{{ $pendaftaran->nama_ortu }}</strong>
                </div>
                <div>
                    <span class="text-gray-500 text-xs block">Pekerjaan</span>
                    <strong class="text-gray-900">{{ $pendaftaran->pekerjaan }}</strong>
                </div>
                <div>
                    <span class="text-gray-500 text-xs block">Nomor WhatsApp / HP</span>
                    <strong class="text-gray-900 text-green-700 flex items-center gap-1">
                        <i class="ri-whatsapp-line"></i> {{ $pendaftaran->no_hp }}
                    </strong>
                </div>
                <div>
                    <span class="text-gray-500 text-xs block">Email</span>
                    <strong class="text-gray-900">{{ $pendaftaran->email }}</strong>
                </div>
            </div>
        </div>

        <!-- Status & Verifikasi -->
        <div class="bg-purple-50/50 p-5 rounded-2xl border border-purple-100 shadow-sm">
            <h3 class="font-bold text-base text-purple-900 border-b border-purple-200 pb-2 mb-3 flex items-center gap-2">
                <i class="ri-verified-badge-line text-purple-600"></i> C. Update Status Pendaftaran
            </h3>
            <form action="{{ route('pendaftaran.updateStatus', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Status Kelulusan</label>
                    <select name="status" class="w-full bg-white border border-gray-300 rounded-xl px-3 py-2 text-sm font-semibold focus:ring-2 focus:ring-purple-500">
                        <option value="pending" {{ $pendaftaran->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                        <option value="diterima" {{ $pendaftaran->status == 'diterima' ? 'selected' : '' }}>Diterima (Lulus)</option>
                        <option value="ditolak" {{ $pendaftaran->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Catatan Panitia (Opsional)</label>
                    <textarea name="catatan_admin" rows="3" placeholder="Catatan untuk pendaftar..." class="w-full bg-white border border-gray-300 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-purple-500">{{ $pendaftaran->catatan_admin }}</textarea>
                </div>
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2.5 rounded-xl text-sm transition shadow-md">
                    Simpan Perubahan Status
                </button>
            </form>
        </div>
    </div>

    <!-- Berkas Yang Diunggah -->
    <div class="border rounded-2xl p-6 bg-gray-50/50">
        <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
            <i class="ri-folder-open-line text-blue-600"></i> Berkas Lampiran Syarat
        </h3>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Foto -->
            <div class="bg-white p-3 rounded-xl border text-center">
                <span class="text-xs font-bold text-gray-500 block mb-2">Pas Foto</span>
                @if($pendaftaran->foto)
                    <img src="{{ asset('storage/' . $pendaftaran->foto) }}" class="w-full h-32 object-cover rounded-lg mb-2 border">
                    <a href="{{ asset('storage/' . $pendaftaran->foto) }}" target="_blank" class="text-xs text-blue-600 font-semibold hover:underline">
                        Lihat Berkas Ukuran Penuh
                    </a>
                @else
                    <span class="text-xs text-gray-400">Tidak ada foto</span>
                @endif
            </div>

            <!-- Akta -->
            <div class="bg-white p-3 rounded-xl border text-center flex flex-col justify-between">
                <span class="text-xs font-bold text-gray-500 block mb-2">Akta Kelahiran</span>
                <div class="my-auto py-4 text-blue-600 text-3xl">
                    <i class="ri-file-text-line"></i>
                </div>
                @if($pendaftaran->akta)
                    <a href="{{ asset('storage/' . $pendaftaran->akta) }}" target="_blank" class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-blue-100">
                        Buka Dokumen Akta
                    </a>
                @endif
            </div>

            <!-- KK -->
            <div class="bg-white p-3 rounded-xl border text-center flex flex-col justify-between">
                <span class="text-xs font-bold text-gray-500 block mb-2">Kartu Keluarga (KK)</span>
                <div class="my-auto py-4 text-emerald-600 text-3xl">
                    <i class="ri-file-text-line"></i>
                </div>
                @if($pendaftaran->kk)
                    <a href="{{ asset('storage/' . $pendaftaran->kk) }}" target="_blank" class="bg-emerald-50 text-emerald-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-emerald-100">
                        Buka Dokumen KK
                    </a>
                @endif
            </div>

            <!-- Kesehatan -->
            <div class="bg-white p-3 rounded-xl border text-center flex flex-col justify-between">
                <span class="text-xs font-bold text-gray-500 block mb-2">Surat Kesehatan</span>
                <div class="my-auto py-4 text-purple-600 text-3xl">
                    <i class="ri-heart-pulse-line"></i>
                </div>
                @if($pendaftaran->kesehatan)
                    <a href="{{ asset('storage/' . $pendaftaran->kesehatan) }}" target="_blank" class="bg-purple-50 text-purple-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-purple-100">
                        Buka Dokumen Kesehatan
                    </a>
                @else
                    <span class="text-xs text-gray-400 my-auto">Tidak diunggah</span>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection