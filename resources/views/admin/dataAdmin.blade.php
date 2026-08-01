@extends('admin.layouts.main')

@section('contaner')

<div class="md:w-9/12 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b pb-4 mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-black text-gray-800">Manajemen Pengguna Admin</h2>
            <p class="text-sm text-gray-500">Kelola daftar pengguna yang memiliki hak akses ke panel administrator.</p>
        </div>
        <a href="{{ route('admin.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-md transition flex items-center gap-2">
            <i class="ri-user-add-line"></i> + Tambah Admin Baru
        </a>
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

    <!-- Tabel Admin -->
    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
        <table class="w-full text-left text-sm text-gray-700">
            <thead class="bg-gray-100 text-xs uppercase text-gray-700 font-bold border-b">
                <tr>
                    <th class="py-3.5 px-4 text-center">No</th>
                    <th class="py-3.5 px-4">Username</th>
                    <th class="py-3.5 px-4">Role Hak Akses</th>
                    <th class="py-3.5 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($admins as $index => $admin)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3.5 px-4 text-center font-semibold text-gray-500">{{ $index + 1 }}</td>
                        <td class="py-3.5 px-4">
                            <strong class="text-gray-900 text-base font-bold">{{ $admin->username }}</strong>
                            @if(auth()->user()->id == $admin->id)
                                <span class="bg-blue-100 text-blue-700 text-xs px-2 py-0.5 rounded-full font-bold ml-2">(Saya)</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full uppercase">
                                <i class="ri-shield-user-line me-1"></i> {{ $admin->role }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.edit', $admin->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold title='Edit'">
                                    <i class="ri-pencil-line"></i> Edit
                                </a>
                                @if(auth()->user()->id != $admin->id)
                                    <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus admin {{ $admin->username }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold title='Hapus'">
                                            <i class="ri-delete-bin-line"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-400">Belum ada data admin.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection