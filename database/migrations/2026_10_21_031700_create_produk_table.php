<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('Id_Produk');
            $table->foreignId('Id_Penjual')
                ->constrained('penjual', 'Id_Penjual')
                ->onDelete('cascade');
            $table->string('Nama_Produk', 100);
            $table->text('Deskripsi')->nullable();
            $table->decimal('Harga', 12, 2);
            $table->unsignedInteger('Stok')->default(0);
            $table->enum('Status', ['tersedia', 'habis'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
