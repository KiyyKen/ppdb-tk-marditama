@extends('admin.layouts.main')

@section('contaner')

<div class="md:w-9/12 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
    <div class="flex justify-between items-center border-b pb-4 mb-6">
        <div>
            <h2 class="text-2xl font-black text-gray-800">Tambah Data Admin Baru</h2>
            <p class="text-sm text-gray-500">Buat akun administrator baru untuk mengakses panel pengelolaan PPDB.</p>
        </div>
        <a href="{{ route('data.admin') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-xl text-sm font-bold transition">
            &larr; Kembali
        </a>
    </div>

    <div class="max-w-lg mx-auto bg-gray-50 p-6 rounded-2xl border border-gray-200">
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-1">Username Admin *</label>
                <input type="text" name="username" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none" required placeholder="Masukkan username admin">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-1">Password *</label>
                <input type="password" name="password" class="w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none" required placeholder="Minimal 6 karakter">
            </div>

            <div class="flex gap-3">
                <a href="{{ route('data.admin') }}" class="w-1/2 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2.5 rounded-xl transition">
                    Batal
                </a>
                <button type="submit" class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 rounded-xl transition shadow-md">
                    Simpan Admin
                </button>
            </div>
        </form>
    </div>
</div>

@endsection