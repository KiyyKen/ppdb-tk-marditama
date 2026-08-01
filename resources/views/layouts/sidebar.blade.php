<!-- Header & Navigation -->
<header class="bg-[#E3F2FD] shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center">
            <a href="{{ route('Dashboard') }}">
                <img src="{{ asset('assets/img/logoTk.png') }}" style="max-height: 50px; width: auto;" alt="Logo TK Mardi Tama">
            </a>
        </div>
        
        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-6">
            <a href="{{ route('Dashboard') }}#beranda" class="flex flex-col items-center text-[#333] hover:text-primary transition-colors">
                <div class="w-10 h-10 flex items-center justify-center rounded-full shadow-sm mb-1" style="background-color: #e42690 !important;">
                    <i class="ri-home-5-line text-white"></i>
                </div>
                <span class="text-sm font-semibold">Beranda</span>
            </a>

            <a href="{{ route('Dashboard') }}#profil" class="flex flex-col items-center text-[#333] hover:text-primary transition-colors">
                <div class="w-10 h-10 flex items-center justify-center rounded-full shadow-sm mb-1" style="background-color: #f6d200 !important;">
                    <i class="ri-school-line text-white"></i>
                </div>
                <span class="text-sm font-semibold">Profil</span>
            </a>
            <a href="{{ route('Dashboard') }}#galeri" class="flex flex-col items-center text-[#333] hover:text-primary transition-colors">
                <div class="w-10 h-10 flex items-center justify-center rounded-full shadow-sm mb-1" style="background-color: #00b0f6 !important;">
                    <i class="ri-gallery-line text-white"></i>
                </div>
                <span class="text-sm font-semibold">Galeri</span>
            </a>
            <a href="{{ route('Dashboard') }}#pendaftaran" class="flex flex-col items-center text-[#333] hover:text-primary transition-colors">
                <div class="w-10 h-10 flex items-center justify-center rounded-full shadow-sm mb-1" style="background-color: #00a14b !important;">
                    <i class="ri-user-add-line text-white"></i>
                </div>
                <span class="text-sm font-semibold">Pendaftaran</span>
            </a>
            <a href="{{ route('Dashboard') }}#cek-status" class="flex flex-col items-center text-[#333] hover:text-primary transition-colors">
                <div class="w-10 h-10 flex items-center justify-center rounded-full shadow-sm mb-1" style="background-color: #9c27b0 !important;">
                    <i class="ri-search-eye-line text-white"></i>
                </div>
                <span class="text-sm font-semibold">Cek Status</span>
            </a>
            <a href="{{ route('Dashboard') }}#kontak" class="flex flex-col items-center text-[#333] hover:text-primary transition-colors">
                <div class="w-10 h-10 flex items-center justify-center rounded-full shadow-sm mb-1" style="background-color: #f68000 !important;">
                    <i class="ri-contacts-line text-white"></i>
                </div>
                <span class="text-sm font-semibold">Kontak</span>
            </a>
            @auth
            <a href="{{ route('admin') }}" class="flex flex-col items-center text-[#333] hover:text-primary transition-colors">
                <div class="w-10 h-10 flex items-center justify-center rounded-full shadow-sm mb-1" style="background-color: #e42690 !important;">
                    <i class="ri-shield-user-line text-white"></i>
                </div>
                <span class="text-sm font-semibold">Admin</span>
            </a>
            <a href="{{ route('logout') }}" class="flex flex-col items-center text-[#333] hover:text-primary transition-colors">
                <div class="w-10 h-10 flex items-center justify-center rounded-full shadow-sm mb-1" style="background-color: #00b0f6 !important;">
                    <i class="ri-logout-box-r-line text-white"></i>
                </div>
                <span class="text-sm font-semibold">Logout</span>
            </a>
            @else
            <a href="{{ route('login') }}" class="flex flex-col items-center text-[#333] hover:text-primary transition-colors">
                <div class="w-10 h-10 flex items-center justify-center rounded-full shadow-sm mb-1" style="background-color: #e42690 !important;">
                    <i class="ri-login-box-line text-white"></i>
                </div>
                <span class="text-sm font-semibold">Login Admin</span>
            </a>
            @endauth
        </nav>
        
        <!-- Mobile Menu Button -->
        <button id="menuButton" class="md:hidden w-10 h-10 flex items-center justify-center bg-white rounded-full shadow-sm">
            <i class="ri-menu-line text-primary"></i>
        </button>
    </div>
    
    <!-- Mobile Navigation -->
    <div id="mobileMenu" class="hidden md:hidden bg-white shadow-md absolute w-full z-50">
        <div class="container mx-auto px-4 py-2 flex flex-col">
            <a href="{{ route('Dashboard') }}#beranda" class="flex items-center py-3 border-b border-gray-100 text-[#333] hover:text-primary transition-colors">
                <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3" style="background-color: #e42690 !important;">
                    <i class="ri-home-5-line text-white"></i>
                </div>
                <span class="font-semibold">Beranda</span>
            </a>
            <a href="{{ route('Dashboard') }}#profil" class="flex items-center py-3 border-b border-gray-100 text-[#333] hover:text-primary transition-colors">
                <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3" style="background-color: #f6d200 !important;">
                    <i class="ri-school-line text-white"></i>
                </div>
                <span class="font-semibold">Profil</span>
            </a>
            <a href="{{ route('Dashboard') }}#galeri" class="flex items-center py-3 border-b border-gray-100 text-[#333] hover:text-primary transition-colors">
                <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3" style="background-color: #00b0f6 !important;">
                    <i class="ri-gallery-line text-white"></i>
                </div>
                <span class="font-semibold">Galeri</span>
            </a>
            <a href="{{ route('Dashboard') }}#pendaftaran" class="flex items-center py-3 border-b border-gray-100 text-[#333] hover:text-primary transition-colors">
                <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3" style="background-color: #00a14b !important;">
                    <i class="ri-user-add-line text-white"></i>
                </div>
                <span class="font-semibold">Pendaftaran</span>
            </a>
            <a href="{{ route('Dashboard') }}#cek-status" class="flex items-center py-3 border-b border-gray-100 text-[#333] hover:text-primary transition-colors">
                <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3" style="background-color: #9c27b0 !important;">
                    <i class="ri-search-eye-line text-white"></i>
                </div>
                <span class="font-semibold">Cek Status</span>
            </a>
            <a href="{{ route('Dashboard') }}#kontak" class="flex items-center py-3 text-[#333] hover:text-primary transition-colors">
                <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3" style="background-color: #f68000 !important;">
                    <i class="ri-contacts-line text-white"></i>
                </div>
                <span class="font-semibold">Kontak</span>
            </a>
            @auth
            <a href="{{ route('admin') }}" class="flex items-center py-3 text-[#333] hover:text-primary transition-colors">
                <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3" style="background-color: #e42690 !important;">
                    <i class="ri-shield-user-line text-white"></i>
                </div>
                <span class="font-semibold">Admin</span>
            </a>
            <a href="{{ route('logout') }}" class="flex items-center py-3 text-[#333] hover:text-primary transition-colors">
                <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3" style="background-color: #00b0f6 !important;">
                    <i class="ri-logout-box-r-line text-white"></i>
                </div>
                <span class="font-semibold">Logout</span>
            </a>
            @else
            <a href="{{ route('login') }}" class="flex items-center py-3 text-[#333] hover:text-primary transition-colors">
                <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3" style="background-color: #e42690 !important;">
                    <i class="ri-login-box-line text-white"></i>
                </div>
                <span class="font-semibold">Login Admin</span>
            </a>
            @endauth
        </div>
    </div>
</header>
