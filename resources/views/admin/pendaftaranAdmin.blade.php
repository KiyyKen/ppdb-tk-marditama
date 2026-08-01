@extends('admin.layouts.main')

@section('contaner')

<div class="md:w-9/12 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b pb-4 mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-black text-gray-800">Manajemen Data Pendaftaran</h2>
            <p class="text-sm text-gray-500">Kelola formulir pendaftaran, verifikasi berkas, dan perbarui status kelulusan.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('pendaftaran.exportCsv') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl font-bold text-sm shadow-md transition flex items-center gap-2">
                <i class="ri-file-excel-line"></i> Export CSV
            </a>
            <a href="{{ route('pendaftaran.admin.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl font-bold text-sm shadow-md transition flex items-center gap-2">
                <i class="ri-user-add-line"></i> + Tambah Manual
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="ri-checkbox-circle-fill text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-800 font-bold">&times;</button>
        </div>
    @endif

    <!-- Filter & Search Bar -->
    <form method="GET" action="{{ route('pendaftar.admin') }}" class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-6 bg-gray-50 p-4 rounded-xl border border-gray-200">
        <div>
            <label class="block text-xs font-bold text-gray-600 mb-1">Filter Status</label>
            <select name="status" onchange="this.form.submit()" class="w-full bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Semua Status --</option>
                <option value="pending" {{ $selectedStatus == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                <option value="diterima" {{ $selectedStatus == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ $selectedStatus == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-xs font-bold text-gray-600 mb-1">Cari Data</label>
            <div class="flex gap-2">
                <input type="text" name="search" value="{{ $searchKeyword }}" placeholder="Cari Kode Pendaftaran, Nama Anak, Nama Ortu, No HP..." class="w-full bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-black transition">
                    <i class="ri-search-line"></i> Cari
                </button>
                @if($selectedStatus || $searchKeyword)
                    <a href="{{ route('pendaftar.admin') }}" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-semibold hover:bg-gray-300 transition flex items-center">
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    <!-- Tabel Data Pendaftaran -->
    <div class="overflow-x-auto border rounded-xl shadow-sm">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-100 text-xs uppercase text-gray-700 font-bold border-b">
                <tr>
                    <th class="py-3.5 px-4 text-center">No</th>
                    <th class="py-3.5 px-4">Info Pendaftar</th>
                    <th class="py-3.5 px-4">Orang Tua / Kontak</th>
                    <th class="py-3.5 px-4">Status & Action</th>
                    <th class="py-3.5 px-4 text-center">Aksi Data</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($pendaftarans as $index => $data)
                    @php
                        $cleanHp = preg_replace('/[^0-9]/', '', $data->no_hp);
                        if (str_starts_with($cleanHp, '0')) {
                            $cleanHp = '62' . substr($cleanHp, 1);
                        }
                        $waText = urlencode("Halo Bpk/Ibu {$data->nama_ortu}, kami dari Panitia PPDB TK Mardi Tama menyampaikan update pendaftaran putra/putri Anda ({$data->nama_anak} - Kode: {$data->kode_pendaftaran}). Status pendaftaran Anda saat ini: " . strtoupper($data->status) . ".");
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 text-center font-bold text-gray-500">{{ $index + 1 }}</td>
                        <td class="py-3 px-4">
                            <span class="font-mono text-xs font-bold text-blue-600 block">{{ $data->kode_pendaftaran }}</span>
                            <strong class="text-gray-900 text-base block">{{ $data->nama_anak }}</strong>
                            <small class="text-gray-500">{{ $data->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }} | {{ $data->ttl }}</small>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-gray-800 block">{{ $data->nama_ortu }}</span>
                            <div class="flex items-center gap-1 mt-0.5">
                                <span class="text-gray-600 text-xs">{{ $data->no_hp }}</span>
                                <a href="https://wa.me/{{ $cleanHp }}?text={{ $waText }}" target="_blank" class="bg-green-100 hover:bg-green-200 text-green-700 px-2 py-0.5 rounded text-[11px] font-bold flex items-center gap-0.5" title="Kirim Pesan WA ke Ortu">
                                    <i class="ri-whatsapp-line"></i> Chat WA
                                </a>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="mb-2">
                                {!! $data->status_badge !!}
                            </div>
                            
                            <!-- Form Quick Status Update -->
                            <form action="{{ route('pendaftaran.updateStatus', $data->id) }}" method="POST" class="flex gap-1">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" class="text-xs bg-gray-50 border border-gray-300 rounded px-2 py-1 focus:outline-none">
                                    <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Set Pending</option>
                                    <option value="diterima" {{ $data->status == 'diterima' ? 'selected' : '' }}>Set Diterima</option>
                                    <option value="ditolak" {{ $data->status == 'ditolak' ? 'selected' : '' }}>Set Ditolak</option>
                                </select>
                            </form>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('pendaftaran.show', $data->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2.5 py-1.5 rounded-lg text-xs font-semibold" title="Detail">
                                    <i class="ri-eye-line"></i>
                                </a>
                                <a href="{{ route('pendaftaran.cetak', $data->id) }}" target="_blank" class="bg-purple-600 hover:bg-purple-700 text-white px-2.5 py-1.5 rounded-lg text-xs font-semibold" title="Cetak Bukti">
                                    <i class="ri-printer-line"></i>
                                </a>
                                <a href="{{ route('pendaftaran.edit', $data->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-2.5 py-1.5 rounded-lg text-xs font-semibold" title="Edit">
                                    <i class="ri-pencil-line"></i>
                                </a>
                                <form action="{{ route('pendaftaran.destroy', $data->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data pendaftaran {{ $data->nama_anak }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white px-2.5 py-1.5 rounded-lg text-xs font-semibold" title="Hapus">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-400">
                            <i class="ri-inbox-line text-4xl block mb-2"></i>
                            Tidak ada data pendaftaran yang sesuai pencarian/filter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection