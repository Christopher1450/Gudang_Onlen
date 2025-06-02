<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('withdraw_logs', function (Blueprint $table) {
            $table->id()->primary;
            $table->string('kode_item');
            $table->string('nama_item');
            $table->string('warna');
            $table->string('size');
            $table->integer('quantity');
            $table->string('user_id');
            $table->string('nama_pengambil');
            $table->text('deskripsi')->nullable();
            $table->timestamp('tanggal_pengambilan');
            $table->timestamps();

            $table->foreign('kode_item')->references('kode_item')->on('items')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdraw_logs');
    }
};
