@extends('layouts.main')

@section('contaner')

    <!-- POP-UP POSTER (jika ada) -->
    <div id="popupPoster" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50">
        <div class="relative bg-white p-4 rounded-lg max-w-sm w-[90%] shadow-2xl">
            <button onclick="closePopup()" class="absolute top-2 right-2 text-white bg-red-500 hover:bg-red-600 rounded-full w-8 h-8 flex items-center justify-center font-bold">
                &times;
            </button>
            <img src="{{ asset('assets/img/poster2.png') }}" alt="Poster TK" class="w-full h-auto rounded-md">
        </div>
    </div>

    <!-- NOTIFIKASI SUKSES PENDAFTARAN (MODAL) -->
    @if(session('successPendaftaran'))
    <div id="successModal" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full text-center shadow-2xl animate-bounce-short">
            <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                <i class="ri-checkbox-circle-fill"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Pendaftaran Berhasil!</h3>
            <p class="text-gray-600 mb-4">
                Terima kasih, pendaftaran calon siswa <strong>{{ session('successPendaftaran')['nama_anak'] }}</strong> telah kami terima.
            </p>
            <div class="bg-blue-50 border-2 border-dashed border-blue-400 p-4 rounded-xl mb-6">
                <span class="text-xs text-blue-600 font-semibold uppercase tracking-wider block">Kode Pendaftaran Anda</span>
                <span class="text-2xl font-black text-blue-700 tracking-widest block select-all">{{ session('successPendaftaran')['kode_pendaftaran'] }}</span>
                <small class="text-gray-500 text-xs mt-1 block">Simpan kode ini untuk mengecek status pendaftaran.</small>
            </div>
            <div class="flex gap-3">
                <button onclick="document.getElementById('successModal').remove()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition">
                    Mengerti & Tutup
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Hero Section -->
    <section id="beranda" class="hero-section relative min-h-[600px] flex items-center">
        <div class="absolute inset-0 bg-gradient-to-r from-[#E3F2FD]/90 to-transparent"></div>
        <div class="container mx-auto px-4 py-16 relative z-10">
            <div class="max-w-xl">
                <h1 class="text-4xl md:text-5xl font-bold text-[#333] mb-4">Selamat Datang Di TK Mardi Tama</h1>
                <p class="text-lg md:text-xl text-[#555] mb-8">Tempat di mana anak-anak belajar, bermain, dan tumbuh bersama dalam suasana yang menyenangkan dan penuh kasih sayang.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="#pendaftaran">
                        <button class="bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-button text-lg font-semibold shadow-lg transition-all hover:shadow-xl whitespace-nowrap">
                            <i class="ri-user-add-line mr-2"></i> Daftar Sekarang
                        </button>
                    </a>
                    <a href="#cek-status">
                        <button class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-button text-lg font-semibold shadow-md transition-all hover:shadow-lg whitespace-nowrap">
                            <i class="ri-search-eye-line mr-2"></i> Cek Status Pendaftaran
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Sekolah -->
    <section id="profil" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-[#333] mb-4">Profil TK Mardi Tama</h2>
                <p class="text-lg text-[#666] max-w-3xl mx-auto">Mengenal lebih dekat dengan TK Mardi Tama, tempat terbaik untuk pendidikan anak usia dini.</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="{{ asset('assets/img/menggambar bersama.jpeg') }}" alt="Ruang Kelas TK Mardi Tama" class="rounded-2xl shadow-lg w-full h-auto object-cover">
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-[#333] mb-6">Visi & Misi</h3>
                    
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold text-primary mb-3">Visi</h4>
                        <p class="text-[#555] mb-4">Terbentuknya lembaga pendidikan yang dapat menumbuh kembangkan peserta didik sesuai potensinya yang sehat, cerdas, ceria, dan berakhlak mulia.</p>
                    </div>
                    
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold text-primary mb-3">Misi</h4>
                        <ul class="space-y-3 text-[#555]">
                            <li class="flex items-start">
                                <div class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-[#E3F2FD] rounded-full mt-1 mr-3">
                                    <i class="ri-check-line text-primary text-sm"></i>
                                </div>
                                <span>Melaksanakan pembiasaan yang baik dalam kegiatan sehari-hari.</span>
                            </li>
                            <li class="flex items-start">
                                <div class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-[#E3F2FD] rounded-full mt-1 mr-3">
                                    <i class="ri-check-line text-primary text-sm"></i>
                                </div>
                                <span>Melaksanakan proses pembelajaran secara teratur yang dapat mengembangkan potensi anak.</span>
                            </li>
                            <li class="flex items-start">
                                <div class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-[#E3F2FD] rounded-full mt-1 mr-3">
                                    <i class="ri-check-line text-primary text-sm"></i>
                                </div>
                                <span>Meningkatkan mutu pendidikan sesuai tuntutan masyarakat dan perkembangan IPTEK.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-[#333] text-center mb-10">Fasilitas Kami</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 mx-auto flex items-center justify-center bg-[#E3F2FD] rounded-full mb-4">
                            <i class="ri-building-4-line text-primary text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-[#333] mb-2">Ruang Kelas Nyaman</h4>
                        <p class="text-sm text-[#666]">Ruang kelas yang luas dengan suasana yang menyenangkan</p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 mx-auto flex items-center justify-center bg-[#E3F2FD] rounded-full mb-4">
                            <i class="ri-gamepad-line text-primary text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-[#333] mb-2">Area Bermain</h4>
                        <p class="text-sm text-[#666]">Area bermain indoor dan outdoor yang aman dan edukatif</p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 mx-auto flex items-center justify-center bg-[#E3F2FD] rounded-full mb-4">
                            <i class="ri-book-open-line text-primary text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-[#333] mb-2">Perpustakaan Mini</h4>
                        <p class="text-sm text-[#666]">Koleksi buku cerita dan pengetahuan untuk anak-anak</p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 mx-auto flex items-center justify-center bg-[#E3F2FD] rounded-full mb-4">
                            <i class="ri-first-aid-kit-line text-primary text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-[#333] mb-2">UKS</h4>
                        <p class="text-sm text-[#666]">Ruang kesehatan untuk penanganan pertama jika diperlukan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Kegiatan -->
    <section id="galeri" class="py-16 bg-[#F8F9FA]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-[#333] mb-4">Galeri Kegiatan</h2>
                <p class="text-lg text-[#666] max-w-3xl mx-auto">Lihat berbagai kegiatan menarik yang dilakukan oleh anak-anak di TK Mardi Tama.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="gallery-item relative rounded-xl overflow-hidden shadow-xl group">
                    <img src="{{ asset('assets/img/menggambar pelangi.png') }}" alt="Kegiatan Melukis" class="w-full h-64 object-cover object-top">
                    <div class="gallery-overlay absolute inset-0 bg-primary/70 flex items-center justify-center opacity-0 transition-opacity duration-300">
                        <div class="text-center text-white p-4">
                            <h3 class="text-xl font-bold mb-2">Kegiatan Menggambar</h3>
                            <p class="text-sm">Anak-anak mengekspresikan kreativitas mereka melalui lukisan warna-warni</p>
                        </div>
                    </div>
                </div>
                
                <div class="gallery-item relative rounded-xl overflow-hidden shadow-md group">
                    <img src="{{ asset('assets/img/bermain_ditaman.jpeg') }}" alt="Bermain di Taman" class="w-full h-64 object-cover object-top">
                    <div class="gallery-overlay absolute inset-0 bg-primary/70 flex items-center justify-center opacity-0 transition-opacity duration-300">
                        <div class="text-center text-white p-4">
                            <h3 class="text-xl font-bold mb-2">Bermain di Taman</h3>
                            <p class="text-sm">Aktivitas bermain di luar ruangan yang menyenangkan dan menyehatkan</p>
                        </div>
                    </div>
                </div>
                <div class="gallery-item relative rounded-xl overflow-hidden shadow-md group">
                    <img src="{{ asset('assets/img/tk-haji.jpeg') }}" alt="Manasik Haji" class="w-full h-64 object-cover object-top">
                    <div class="gallery-overlay absolute inset-0 bg-primary/70 flex items-center justify-center opacity-0 transition-opacity duration-300">
                        <div class="text-center text-white p-4">
                            <h3 class="text-xl font-bold mb-2">Kegiatan Manasik Haji</h3>
                            <p class="text-sm">Anak-anak belajar mengenal rukun haji melalui kegiatan manasik yang edukatif</p>
                        </div>
                    </div>
                </div>
                <div class="gallery-item relative rounded-xl overflow-hidden shadow-xl group">
                    <img src="{{ asset('assets/img/belajar menari.png') }}" alt="Belajar Menari" class="w-full h-64 object-cover object-top">
                    <div class="gallery-overlay absolute inset-0 bg-primary/70 flex items-center justify-center opacity-0 transition-opacity duration-300">
                        <div class="text-center text-white p-4">    
                            <h3 class="text-xl font-bold mb-2">Kegiatan Menari</h3>
                            <p class="text-sm">Anak-anak mengekspresikan diri dan melatih koordinasi tubuh melalui gerakan tari</p>
                        </div>
                    </div>
                </div>
                
                <div class="gallery-item relative rounded-xl overflow-hidden shadow-md group">
                    <img src="{{ asset('assets/img/tk-pentas3.jpeg') }}" alt="Pentas Seni" class="w-full h-64 object-cover object-top">
                    <div class="gallery-overlay absolute inset-0 bg-primary/70 flex items-center justify-center opacity-0 transition-opacity duration-300">
                        <div class="text-center text-white p-4">
                            <h3 class="text-xl font-bold mb-2">Pentas Seni</h3>
                            <p class="text-sm">Anak-anak menampilkan bakat seni mereka dalam acara pentas seni</p>
                        </div>
                    </div>
                </div>

                <div class="gallery-item relative rounded-xl overflow-hidden shadow-md group">
                    <img src="{{ asset('assets/img/kegiatan memasak.jpeg') }}" alt="Kegiatan Memasak" class="w-full h-64 object-cover object-top">
                    <div class="gallery-overlay absolute inset-0 bg-primary/70 flex items-center justify-center opacity-0 transition-opacity duration-300">
                        <div class="text-center text-white p-4">
                            <h3 class="text-xl font-bold mb-2">Kegiatan Memasak</h3>
                            <p class="text-sm">Anak-anak belajar mengenal bahan makanan dan melatih motorik halus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION FITUR BARU: CEK STATUS PENDAFTARAN -->
    <section id="cek-status" class="py-16 bg-gradient-to-br from-purple-50 to-blue-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Fitur Pencarian</span>
                <h2 class="text-3xl md:text-4xl font-bold text-[#333] mt-2 mb-2">Cek Status Pendaftaran Siswa</h2>
                <p class="text-gray-600 max-w-xl mx-auto">Masukkan Kode Pendaftaran (contoh: <code>PPDB-2026-XXXX</code>), Nama Anak, atau No HP untuk melihat status pengajuan.</p>
            </div>

            <div class="max-w-xl mx-auto bg-white p-6 rounded-2xl shadow-xl border border-purple-100 mb-8">
                <form action="{{ route('pendaftaran.cekStatus') }}#cek-status" method="POST" class="flex gap-2">
                    @csrf
                    <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="Cari Kode Pendaftaran / Nama Anak / No HP..." required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:outline-none">
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-bold transition flex items-center gap-2 whitespace-nowrap">
                        <i class="ri-search-line"></i> Cari
                    </button>
                </form>

                @if(session('errorCek'))
                    <div class="mt-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm flex items-center gap-2">
                        <i class="ri-error-warning-line text-lg"></i> {{ session('errorCek') }}
                    </div>
                @endif

                @if(session('hasilCek'))
                    @php $hasil = session('hasilCek'); @endphp
                    <div class="mt-6 border border-gray-200 rounded-2xl p-6 bg-white shadow-sm">
                        <div class="flex items-center justify-between border-b pb-3 mb-4">
                            <div>
                                <span class="text-xs text-gray-500 font-semibold uppercase">Kode Pendaftaran</span>
                                <h4 class="text-xl font-bold text-gray-800">{{ $hasil->kode_pendaftaran }}</h4>
                            </div>
                            <div>
                                @if($hasil->status == 'diterima')
                                    <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full uppercase flex items-center gap-1">
                                        <i class="ri-checkbox-circle-fill"></i> Diterima
                                    </span>
                                @elseif($hasil->status == 'ditolak')
                                    <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full uppercase flex items-center gap-1">
                                        <i class="ri-close-circle-fill"></i> Ditolak
                                    </span>
                                @else
                                    <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full uppercase flex items-center gap-1">
                                        <i class="ri-time-fill"></i> Sedang Diproses (Pending)
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                            <div>
                                <span class="text-gray-500 block text-xs">Nama Calon Siswa</span>
                                <strong class="text-gray-800">{{ $hasil->nama_anak }}</strong>
                            </div>
                            <div>
                                <span class="text-gray-500 block text-xs">Orang Tua / Wali</span>
                                <strong class="text-gray-800">{{ $hasil->nama_ortu }}</strong>
                            </div>
                            <div>
                                <span class="text-gray-500 block text-xs">Tanggal Daftar</span>
                                <strong class="text-gray-800">{{ $hasil->created_at ? $hasil->created_at->format('d/m/Y') : '-' }}</strong>
                            </div>
                            <div>
                                <span class="text-gray-500 block text-xs">No HP</span>
                                <strong class="text-gray-800">{{ $hasil->no_hp }}</strong>
                            </div>
                        </div>

                        @if($hasil->catatan_admin)
                            <div class="p-3 bg-gray-50 rounded-xl border text-xs text-gray-700 mb-4">
                                <strong>Catatan Panitia:</strong> {{ $hasil->catatan_admin }}
                            </div>
                        @endif

                        @if($hasil->status == 'diterima')
                            <div class="mt-4 pt-3 border-t text-center">
                                <p class="text-xs text-green-700 mb-2">Selamat! Silakan hubungi panitia sekolah atau cetak bukti pendaftaran.</p>
                                <a href="https://wa.me/6281318986448?text=Halo%20Panitia%20TK%20Mardi%20Tama,%20saya%20orang%20tua%20dari%20{{ urlencode($hasil->nama_anak) }}%20(Kode:%20{{ $hasil->kode_pendaftaran }})%20ingin%20mengonfirmasi%20kelulusan." target="_blank"
                                   class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-xl text-sm transition">
                                    <i class="ri-whatsapp-line"></i> Konfirmasi via WhatsApp
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Pendaftaran Form Section -->
    <section id="pendaftaran" class="py-16 bg-white" style="background-image: url('{{ asset('assets/img/pendaftaran.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 bg-white/80 backdrop-blur-md p-6 rounded-2xl max-w-3xl mx-auto shadow-sm">
                <h2 class="text-3xl md:text-4xl font-bold text-[#333] mb-2">Formulir Pendaftaran Siswa Baru</h2>
                <p class="text-base text-[#555]">Lengkapi formulir 3 langkah di bawah ini untuk mengajukan pendaftaran ke TK Mardi Tama.</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Form Box -->
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="flex items-center justify-between mb-8 pb-4 border-b">
                        <div class="flex items-center" id="progress">
                            <div id="dot-1" class="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm">1</div>
                            <div id="line-1" class="h-1 w-10 bg-gray-300 mx-2"></div>

                            <div id="dot-2" class="w-9 h-9 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold text-sm">2</div>
                            <div id="line-2" class="h-1 w-10 bg-gray-300 mx-2"></div>

                            <div id="dot-3" class="w-9 h-9 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold text-sm">3</div>
                        </div>
                        <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Form 3 Langkah</span>
                    </div>

                    <form method="POST" action="{{ route('pendaftaran.create') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- STEP 1 --}}
                        <div id="step-1" class="step">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="ri-user-smile-line text-blue-600"></i> Langkah 1: Data Calon Siswa
                            </h3>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap Anak *</label>
                                <input type="text" name="nama_anak" required placeholder="Contoh: Muhammad Al-Fatih" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin *</label>
                                <select name="jenis_kelamin" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Tempat, Tanggal Lahir *</label>
                                <input type="text" name="ttl" required placeholder="Contoh: Tangerang, 12 Mei 2021" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Agama *</label>
                                <select name="agama" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap Rumah *</label>
                                <textarea name="alamat" rows="3" required placeholder="Masukkan alamat domisili lengkap..." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                            </div>
                            <button type="button" onclick="nextStep(2)" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition flex items-center justify-center gap-2">
                                Lanjut ke Langkah 2 &rarr;
                            </button>
                        </div>

                        {{-- STEP 2 --}}
                        <div id="step-2" class="step hidden">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="ri-parent-line text-blue-600"></i> Langkah 2: Data Orang Tua / Wali
                            </h3>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Orang Tua / Wali *</label>
                                <input type="text" name="nama_ortu" required placeholder="Nama lengkap Ibu/Ayah/Wali" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Pekerjaan Orang Tua *</label>
                                <input type="text" name="pekerjaan" required placeholder="Contoh: Karyawan Swasta / PNS / Wiraswasta" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor WhatsApp / HP *</label>
                                <input type="tel" name="no_hp" required placeholder="Contoh: 081234567890" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email *</label>
                                <input type="email" name="email" required placeholder="email@domain.com" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                            <div class="flex justify-between gap-3">
                                <button type="button" onclick="nextStep(1)" class="w-1/2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 rounded-xl transition">
                                    &larr; Kembali
                                </button>
                                <button type="button" onclick="nextStep(3)" class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition">
                                    Lanjut ke Langkah 3 &rarr;
                                </button>
                            </div>
                        </div>

                        {{-- STEP 3 --}}
                        <div id="step-3" class="step hidden">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="ri-file-upload-line text-blue-600"></i> Langkah 3: Upload Berkas Syarat
                            </h3>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Pas Foto Anak (Maks 2MB, JPG/PNG) *</label>
                                <input type="file" name="foto" required accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-xl text-sm">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Scan Akta Kelahiran (PDF/Gambar) *</label>
                                <input type="file" name="akta" required class="w-full px-3 py-2 border border-gray-300 rounded-xl text-sm">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Scan Kartu Keluarga (PDF/Gambar) *</label>
                                <input type="file" name="kk" required class="w-full px-3 py-2 border border-gray-300 rounded-xl text-sm">
                            </div>
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Surat Keterangan Kesehatan (Opsional)</label>
                                <input type="file" name="kesehatan" class="w-full px-3 py-2 border border-gray-300 rounded-xl text-sm">
                            </div>
                            <div class="flex justify-between gap-3">
                                <button type="button" onclick="nextStep(2)" class="w-1/2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 rounded-xl transition">
                                    &larr; Kembali
                                </button>
                                <button type="submit" class="w-1/2 bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition shadow-lg flex items-center justify-center gap-2">
                                    <i class="ri-send-plane-fill"></i> Kirim Pendaftaran
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Info Box -->
                <div>
                    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-[#333] mb-6 flex items-center gap-2">
                            <i class="ri-money-dollar-circle-line text-green-600"></i> Informasi Biaya Pendaftaran
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center pb-3 border-b border-[#E5E7EB]">
                                <div>
                                    <h4 class="font-semibold text-[#333]">Biaya Masuk (Uang Pangkal)</h4>
                                    <p class="text-xs text-[#666]">Termasuk seragam, buku aktivitas, dan uang gedung</p>
                                </div>
                                <span class="font-bold text-green-700 text-lg">Rp {{ number_format((float) ($settings['biaya_masuk'] ?? 2500000), 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center pb-3 border-b border-[#E5E7EB]">
                                <div>
                                    <h4 class="font-semibold text-[#333]">SPP Bulanan</h4>
                                    <p class="text-xs text-[#666]">Dibayarkan setiap bulan</p>
                                </div>
                                <span class="font-bold text-blue-600">Rp {{ number_format((float) ($settings['biaya_spp'] ?? 150000), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-[#E5E7EB]">
                                <div>
                                    <h4 class="font-semibold text-[#333]">Formulir Pendaftaran</h4>
                                    <p class="text-xs text-[#666]">Buku panduan dan registrasi</p>
                                </div>
                                <span class="font-bold text-[#333]">Rp {{ number_format((float) ($settings['biaya_formulir'] ?? 50000), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-[#333] mb-6 flex items-center gap-2">
                            <i class="ri-calendar-event-line text-blue-600"></i> Jadwal Gelombang PPDB
                        </h3>
                        <div class="flex items-start">
                            <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-[#E3F2FD] rounded-full mt-1 mr-4">
                                <i class="ri-calendar-check-line text-primary"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[#333]">{{ $settings['gelombang_nama'] ?? 'Gelombang I' }} (Tahun Ajaran {{ date('Y') }})</h4>
                                <p class="text-sm text-[#666]">{{ $settings['gelombang_jadwal'] ?? '1 Januari - 30 Juni' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-16 bg-[#F8F9FA]" style="background-image: url('{{ asset('assets/img/kontak.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 bg-white/80 backdrop-blur-md p-6 rounded-2xl max-w-3xl mx-auto shadow-sm">
                <h2 class="text-3xl md:text-4xl font-bold text-[#333] mb-2">Hubungi Kami</h2>
                <p class="text-base text-[#666]">Ada pertanyaan seputar PPDB TK Mardi Tama? Kirimkan pesan atau kunjungi kami langsung.</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12">
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <h3 class="text-2xl font-bold text-[#333] mb-6">Kirim Pesan WhatsApp</h3>
                    <form id="whatsappForm">
                        <div class="mb-4">
                            <label for="nama" class="block text-[#333] font-medium mb-1 text-sm">Nama Lengkap</label>
                            <input type="text" id="nama" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama lengkap Anda">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-[#333] font-medium mb-1 text-sm">Email</label>
                            <input type="email" id="email" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan alamat email Anda">
                        </div>
                        <div class="mb-4">
                            <label for="telepon" class="block text-[#333] font-medium mb-1 text-sm">Nomor Telepon</label>
                            <input type="tel" id="telepon" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nomor WhatsApp Anda">
                        </div>
                        <div class="mb-6">
                            <label for="pesan" class="block text-[#333] font-medium mb-1 text-sm">Pesan</label>
                            <textarea id="pesan" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis pertanyaan Anda..."></textarea>
                        </div>
                        <button type="button" id="kirimWhatsapp" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl text-lg font-semibold shadow-lg transition flex items-center justify-center gap-2 w-full">
                            <i class="ri-whatsapp-line text-2xl"></i> Kirim Pesan via WhatsApp
                        </button>
                    </form>
                </div>
                
                <div>
                    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-[#333] mb-6">Informasi Kontak</h3>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-[#E3F2FD] rounded-full mt-1 mr-4">
                                    <i class="ri-map-pin-line text-primary text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-[#333] mb-1">Alamat</h4>
                                    <p class="text-[#666] text-sm">Kp. Curug, Rt 04/ Rw 01, Kel. Babakan, Kec. Setu, Tangerang Selatan</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-[#E3F2FD] rounded-full mt-1 mr-4">
                                    <i class="ri-phone-line text-primary text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-[#333] mb-1">WhatsApp Panitia</h4>
                                    <p class="text-[#666] text-sm">0813-1898-6448</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-[#E3F2FD] rounded-full mt-1 mr-4">
                                    <i class="ri-mail-line text-primary text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-[#333] mb-1">Email</h4>
                                    <p class="text-[#666] text-sm">tkkmarditama@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-[#333]">Lokasi TK Mardi Tama</h3>
                            <a href="https://www.google.com/maps/place/TK+Mardi+Tama/" target="_blank" class="text-blue-600 font-semibold text-sm hover:underline">
                                Buka di Maps &rarr;
                            </a>
                        </div>
                        <div class="w-full h-[220px] overflow-hidden rounded-xl">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1983.7386596289317!2d106.829519!3d-6.200875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3c2a7c6e091%3A0xabcdef1234567890!2sTK%20Mardi%20Tama!5e0!3m2!1sen!2sid!4v1717590000000"
                                    width="100%" height="100%" class="border-0 w-full h-full" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCRIPT FORM MULTI-STEP -->
    <script>
        function nextStep(step) {
            document.querySelectorAll('.step').forEach(function(el) {
                el.classList.add('hidden');
            });

            const currentStep = document.getElementById('step-' + step);
            if (currentStep) currentStep.classList.remove('hidden');

            for (let i = 1; i <= 3; i++) {
                const dot = document.getElementById('dot-' + i);
                dot.classList.remove('bg-primary', 'text-white');
                dot.classList.add('bg-gray-300', 'text-gray-600');

                const line = document.getElementById('line-' + (i - 1));
                if (line) {
                    line.classList.remove('bg-primary');
                    line.classList.add('bg-gray-300');
                }
            }

            for (let i = 1; i <= step; i++) {
                const dot = document.getElementById('dot-' + i);
                dot.classList.add('bg-primary', 'text-white');
                dot.classList.remove('bg-gray-300', 'text-gray-600');

                const line = document.getElementById('line-' + (i - 1));
                if (line) {
                    line.classList.add('bg-primary');
                    line.classList.remove('bg-gray-300');
                }
            }
        }

        document.getElementById('kirimWhatsapp')?.addEventListener('click', function () {
            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const telepon = document.getElementById('telepon').value;
            const pesan = document.getElementById('pesan').value;

            const url = `https://wa.me/6281318986448?text=` + 
                encodeURIComponent(
                    `Halo Panitia TK Mardi Tama,\nSaya ingin menanyakan sesuatu:\n\nNama: ${nama}\nEmail: ${email}\nNo HP: ${telepon}\nPesan: ${pesan}`
                );

            window.open(url, '_blank');
        });

        function closePopup() {
            document.getElementById("popupPoster").style.display = "none";
        }
    </script>

@endsection