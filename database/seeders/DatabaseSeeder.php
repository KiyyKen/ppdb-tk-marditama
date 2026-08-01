<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'Rizky Ariyan'],
            [
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['username' => 'Azhar Lubis'],
            [
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['username' => "Muhamad Zul Sa'ban"],
            [
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Seed default school settings
        Setting::setByKey('biaya_masuk', '2500000', 'Biaya Masuk (Uang Pangkal)');
        Setting::setByKey('biaya_spp', '150000', 'SPP Bulanan');
        Setting::setByKey('biaya_formulir', '50000', 'Formulir Pendaftaran');
        Setting::setByKey('gelombang_nama', 'Gelombang I', 'Nama Gelombang');
        Setting::setByKey('gelombang_jadwal', '1 Januari - 30 Juni', 'Jadwal Gelombang');
    }
}
