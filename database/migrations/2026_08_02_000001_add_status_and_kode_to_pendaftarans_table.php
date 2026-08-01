<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->string('kode_pendaftaran')->nullable()->unique()->after('id');
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending')->after('kesehatan');
            $table->text('catatan_admin')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn(['kode_pendaftaran', 'status', 'catatan_admin']);
        });
    }
};
