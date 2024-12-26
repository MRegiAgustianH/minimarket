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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama produk
            $table->text('deskripsi')->nullable(); // Deskripsi produk
            $table->decimal('harga', 10, 2); // Harga produk
            $table->integer('stok_minimal')->default(0); // Stok minimal untuk peringatan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
