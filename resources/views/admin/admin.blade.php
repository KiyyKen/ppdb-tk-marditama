@extends('admin.layouts.main')

@section('contaner')

<div class="md:w-9/12 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b pb-4 mb-6 gap-2">
        <div>
            <h2 class="text-2xl font-black text-gray-800">Dashboard Administrator</h2>
            <p class="text-sm text-gray-500">Selamat datang kembali, <strong>{{ auth()->user()->username ?? 'Admin' }}</strong>!</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('pendaftaran.exportCsv') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-bold transition flex items-center gap-2 shadow-md">
                <i class="ri-file-excel-line text-lg"></i> Export CSV / Excel
            </a>
            <div class="bg-blue-50 text-blue-700 px-4 py-2 rounded-xl text-sm font-semibold border border-blue-100">
                <i class="ri-calendar-event-line mr-1"></i> <span id="tanggal-hari-ini"></span>
            </div>
        </div>
    </div>

    <!-- Ringkasan Statistik -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-5 rounded-2xl text-white shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-xs uppercase font-bold tracking-wider text-blue-100">Total Pendaftar</span>
                    <h3 class="text-3xl font-black mt-1">{{ $totalPendaftar }}</h3>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center text-2xl">
                    <i class="ri-user-follow-line"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-amber-400 to-amber-500 p-5 rounded-2xl text-white shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-xs uppercase font-bold tracking-wider text-amber-100">Menunggu (Pending)</span>
                    <h3 class="text-3xl font-black mt-1">{{ $pendingPendaftar }}</h3>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center text-2xl">
                    <i class="ri-time-line"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-5 rounded-2xl text-white shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-xs uppercase font-bold tracking-wider text-emerald-100">Diterima</span>
                    <h3 class="text-3xl font-black mt-1">{{ $diterimaPendaftar }}</h3>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center text-2xl">
                    <i class="ri-checkbox-circle-line"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-rose-500 to-rose-600 p-5 rounded-2xl text-white shadow-lg">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-xs uppercase font-bold tracking-wider text-rose-100">Ditolak</span>
                    <h3 class="text-3xl font-black mt-1">{{ $ditolakPendaftar }}</h3>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center text-2xl">
                    <i class="ri-close-circle-line"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-gray-50 p-5 rounded-2xl border border-gray-200">
            <h4 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                <i class="ri-pie-chart-line text-blue-600"></i> Distribusi Status Kelulusan
            </h4>
            <div class="h-60 flex justify-center">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        <div class="bg-gray-50 p-5 rounded-2xl border border-gray-200">
            <h4 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                <i class="ri-genderless-line text-purple-600"></i> Perbandingan Gender Siswa
            </h4>
            <div class="h-60 flex justify-center">
                <canvas id="genderChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Tabel Pendaftar Terbaru -->
    <div class="border rounded-2xl overflow-hidden shadow-sm">
        <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
            <h4 class="font-bold text-gray-800 flex items-center gap-2">
                <i class="ri-history-line text-blue-600"></i> Pendaftar Terbaru
            </h4>
            <a href="{{ route('pendaftar.admin') }}" class="text-blue-600 text-xs font-bold hover:underline">
                Lihat Semua &rarr;
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-100 text-xs uppercase text-gray-700 font-bold border-b">
                    <tr>
                        <th class="px-6 py-3">Kode</th>
                        <th class="px-6 py-3">Nama Anak</th>
                        <th class="px-6 py-3">Orang Tua</th>
                        <th class="px-6 py-3">No HP</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($recentPendaftar as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-mono font-bold text-blue-600">{{ $p->kode_pendaftaran }}</td>
                            <td class="px-6 py-4 font-bold text-gray-800">{{ $p->nama_anak }}</td>
                            <td class="px-6 py-4">{{ $p->nama_ortu }}</td>
                            <td class="px-6 py-4">{{ $p->no_hp }}</td>
                            <td class="px-6 py-4">
                                {!! $p->status_badge !!}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('pendaftaran.show', $p->id) }}" class="inline-flex items-center gap-1 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-blue-100 transition">
                                    <i class="ri-eye-line"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-400">Belum ada data pendaftar baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Formatter Tanggal
        const tanggal = new Date();
        const namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                           'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        const hari = namaHari[tanggal.getDay()];
        const tanggalHari = tanggal.getDate();
        const bulan = namaBulan[tanggal.getMonth()];
        const tahun = tanggal.getFullYear();
      
        document.getElementById("tanggal-hari-ini").textContent = `${hari}, ${tanggalHari} ${bulan} ${tahun}`;

        // Status Chart
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Diterima', 'Ditolak'],
                datasets: [{
                    data: [{{ $pendingPendaftar }}, {{ $diterimaPendaftar }}, {{ $ditolakPendaftar }}],
                    backgroundColor: ['#f59e0b', '#10b981', '#f43f5e']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Gender Chart
        const ctxGender = document.getElementById('genderChart').getContext('2d');
        new Chart(ctxGender, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [{{ $lakiCount }}, {{ $perempuanCount }}],
                    backgroundColor: ['#3b82f6', '#ec4899']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    });
</script>

@endsection