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
        Schema::create('carts', function (Blueprint $table) {
            $table->string('id')->primary(); // CART001
            $table->string('nama_id');        // user login
            $table->string('kode_item');
            $table->string('nama_item');
            $table->string('warna');
            $table->string('size');
            $table->integer('jumlah');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable(); // path gambar
            $table->timestamps();
        
            $table->foreign('nama_id')->references('nama_id')->on('users')->onDelete('cascade');
            $table->foreign('kode_item')->references('kode_item')->on('items')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
