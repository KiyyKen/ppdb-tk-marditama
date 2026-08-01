@extends('admin.layouts.main')

@section('contaner')

<div class="md:w-9/12 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
    <div class="flex justify-between items-center border-b pb-4 mb-6">
        <div>
            <h2 class="text-2xl font-black text-gray-800">Pengaturan Biaya & Gelombang PPDB</h2>
            <p class="text-sm text-gray-500">Kelola rincian biaya pendaftaran dan jadwal gelombang yang tampil di website utama.</p>
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

    <div class="max-w-2xl mx-auto bg-gray-50 p-6 rounded-2xl border border-gray-200">
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-white p-5 rounded-xl border mb-6">
                <h4 class="font-bold text-green-700 mb-4 text-sm uppercase tracking-wider flex items-center gap-2">
                    <i class="ri-money-dollar-circle-line"></i> A. Rincian Biaya Pendaftaran (Rp)
                </h4>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Biaya Masuk / Uang Pangkal (Rp) *</label>
                    <input type="number" name="biaya_masuk" value="{{ old('biaya_masuk', $settings['biaya_masuk']) }}" required class="w-full px-3 py-2 border rounded-lg text-sm">
                    <span class="text-[11px] text-gray-500">Termasuk seragam, buku aktivitas, dan uang gedung.</span>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">SPP Bulanan (Rp) *</label>
                    <input type="number" name="biaya_spp" value="{{ old('biaya_spp', $settings['biaya_spp']) }}" required class="w-full px-3 py-2 border rounded-lg text-sm">
                    <span class="text-[11px] text-gray-500">Dibayarkan setiap bulan.</span>
                </div>

                <div class="mb-2">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Formulir Pendaftaran (Rp) *</label>
                    <input type="number" name="biaya_formulir" value="{{ old('biaya_formulir', $settings['biaya_formulir']) }}" required class="w-full px-3 py-2 border rounded-lg text-sm">
                    <span class="text-[11px] text-gray-500">Buku panduan dan registrasi pendaftaran.</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border mb-6">
                <h4 class="font-bold text-blue-600 mb-4 text-sm uppercase tracking-wider flex items-center gap-2">
                    <i class="ri-calendar-event-line"></i> B. Jadwal Gelombang PPDB
                </h4>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Gelombang *</label>
                    <input type="text" name="gelombang_nama" value="{{ old('gelombang_nama', $settings['gelombang_nama']) }}" required class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Contoh: Gelombang I">
                </div>

                <div class="mb-2">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Jadwal Tanggal / Keterangan *</label>
                    <input type="text" name="gelombang_jadwal" value="{{ old('gelombang_jadwal', $settings['gelombang_jadwal']) }}" required class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Contoh: 1 Januari - 30 Juni 2026">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-md flex items-center justify-center gap-2">
                <i class="ri-save-line"></i> Simpan Pengaturan
            </button>
        </form>
    </div>
</div>

@endsection
