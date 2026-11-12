<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('stock')->default(0)->after('price');
        });

        // Produk yang sudah ada diberi stok awal 10 agar tetap bisa dibeli.
        DB::table('products')->update(['stock' => 10]);
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('stock');
        });
    }
};
