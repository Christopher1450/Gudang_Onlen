<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('item_in_logs', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('kode_item');
            $table->integer('quantity');
            $table->unsignedBigInteger('supplier_id');
            $table->text('deskripsi')->nullable();
            $table->timestamp('tanggal_masuk');
            $table->timestamps();

            $table->foreign('kode_item')->references('kode_item')->on('items')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_in_logs');
    }
};

