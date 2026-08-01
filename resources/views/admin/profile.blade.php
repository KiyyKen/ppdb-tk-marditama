@extends('admin.layouts.main')

@section('contaner')

<div class="md:w-9/12 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
    <div class="flex justify-between items-center border-b pb-4 mb-6">
        <div>
            <h2 class="text-2xl font-black text-gray-800">Profil & Ganti Password</h2>
            <p class="text-sm text-gray-500">Perbarui username dan ubah kata sandi akun administrator Anda.</p>
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

    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="ri-error-warning-fill text-xl"></i>
                <span>{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-red-800 font-bold">&times;</button>
        </div>
    @endif

    <div class="max-w-xl mx-auto bg-gray-50 p-6 rounded-2xl border border-gray-200">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-white p-5 rounded-xl border mb-6">
                <h4 class="font-bold text-blue-600 mb-4 text-sm uppercase tracking-wider flex items-center gap-2">
                    <i class="ri-user-settings-line"></i> Info Akun
                </h4>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Username *</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" required class="w-full px-3 py-2 border rounded-lg text-sm">
                    @error('username')
                        <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border mb-6">
                <h4 class="font-bold text-purple-600 mb-4 text-sm uppercase tracking-wider flex items-center gap-2">
                    <i class="ri-lock-password-line"></i> Ubah Password
                </h4>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Password Saat Ini (Wajib Diisi) *</label>
                    <input type="password" name="current_password" required class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Masukkan password Anda saat ini">
                    @error('current_password')
                        <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Password Baru (Opsional)</label>
                    <input type="password" name="new_password" class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Biarkan kosong jika tidak ingin mengganti password">
                    @error('new_password')
                        <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="block text-xs font-bold text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Ketik ulang password baru">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-md flex items-center justify-center gap-2">
                <i class="ri-save-line"></i> Perbarui Profil & Password
            </button>
        </form>
    </div>
</div>

@endsection
