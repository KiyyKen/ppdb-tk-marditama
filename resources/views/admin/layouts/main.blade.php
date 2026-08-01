<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PPDB TK MARDI TAMA</title>
    <link href="{{ asset('assets/img/logoTk.png') }}" rel="icon">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
        tailwind.config={
            theme:{
                extend:{
                    colors:{primary:'#4F86F7',secondary:'#FFB6C1'},
                    borderRadius:{DEFAULT:'12px','2xl':'16px'}
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <!-- Chart.js for analytics charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Nunito', sans-serif; }
        .actives {
            background-color: #4F86F7 !important;
            color: white !important;
            font-weight: 700;
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">

    <!-- Header Navigation -->
    <header class="bg-white border-b sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/img/logoTk.png') }}" style="max-height: 45px;" alt="Logo TK">
                <div>
                    <h1 class="text-base font-bold text-gray-800 leading-tight">TK MARDI TAMA</h1>
                    <span class="text-xs text-blue-600 font-semibold bg-blue-50 px-2 py-0.5 rounded-full">Panel Administrator</span>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('Dashboard') }}" target="_blank" class="hidden md:flex items-center gap-1.5 text-xs text-gray-600 hover:text-blue-600 font-semibold bg-gray-100 px-3 py-2 rounded-xl transition">
                    <i class="ri-external-link-line"></i> Lihat Web Publik
                </a>
                
                <a href="{{ route('profile.admin') }}" class="flex items-center gap-2 border-l pl-4 hover:opacity-80 transition">
                    <div class="w-9 h-9 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr(auth()->user()->username ?? 'A', 0, 1)) }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <span class="text-xs font-bold text-gray-800 block">{{ auth()->user()->username ?? 'Admin' }}</span>
                        <span class="text-[10px] text-gray-400 block uppercase font-bold">{{ auth()->user()->role ?? 'Admin' }}</span>
                    </div>
                </a>

                <a href="{{ route('logout') }}" class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white px-3 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1">
                    <i class="ri-logout-box-r-line"></i> <span class="hidden sm:inline">Keluar</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Content Area -->
    <main class="flex-grow py-8">
        <div class="container mx-auto px-4">
            <div class="md:flex md:gap-6">
                <!-- Sidebar Menu Admin (Left Column) -->
                <div class="md:w-3/12 bg-white p-5 rounded-2xl shadow-xl border border-gray-100 mb-6 md:mb-0 h-fit">
                    <div class="flex flex-col space-y-2">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider px-3 mb-2">Navigasi Utama</span>
                        
                        <a href="{{ route('admin') }}" class="w-full px-4 py-3 rounded-xl flex items-center gap-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition {{ ($actives === 'admin-dashboard') ? 'actives shadow-md' : '' }}">
                            <i class="ri-dashboard-3-line text-lg"></i> Dashboard Admin
                        </a>

                        <a href="{{ route('pendaftar.admin') }}" class="w-full px-4 py-3 rounded-xl flex items-center gap-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition {{ ($actives === 'pendaftaran-admin') ? 'actives shadow-md' : '' }}">
                            <i class="ri-user-add-line text-lg"></i> Data Pendaftaran
                        </a>

                        <a href="{{ route('settings.admin') }}" class="w-full px-4 py-3 rounded-xl flex items-center gap-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition {{ ($actives === 'settings-admin') ? 'actives shadow-md' : '' }}">
                            <i class="ri-settings-3-line text-lg"></i> Pengaturan Biaya & Wave
                        </a>

                        <a href="{{ route('data.admin') }}" class="w-full px-4 py-3 rounded-xl flex items-center gap-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition {{ ($actives === 'data-admin') ? 'actives shadow-md' : '' }}">
                            <i class="ri-shield-user-line text-lg"></i> Kelola User Admin
                        </a>

                        <a href="{{ route('profile.admin') }}" class="w-full px-4 py-3 rounded-xl flex items-center gap-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition {{ ($actives === 'profile-admin') ? 'actives shadow-md' : '' }}">
                            <i class="ri-user-settings-line text-lg"></i> Profil & Ganti Password
                        </a>

                        <div class="border-t pt-3 mt-3">
                            <a href="{{ route('Dashboard') }}" class="w-full px-4 py-2.5 rounded-xl flex items-center gap-3 text-sm text-gray-600 hover:bg-gray-100 transition">
                                <i class="ri-arrow-left-line text-lg"></i> Ke Halaman Beranda
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content View (Right Column) -->
                @yield('contaner')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t py-4 text-center text-xs text-gray-500">
        <p>&copy; {{ date('Y') }} PPDB TK Mardi Tama. Panel Administrator.</p>
    </footer>

</body>
</html>
