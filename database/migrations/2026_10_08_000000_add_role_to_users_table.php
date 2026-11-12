<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Role: 'admin' atau 'customer'
            $table->string('role')->default('customer')->after('password');
        });

        // Sebelum ada role, semua akun yang sudah ada berfungsi sebagai admin.
        // Jadikan admin agar tidak terkunci dari halaman admin.
        DB::table('users')->update(['role' => 'admin']);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
