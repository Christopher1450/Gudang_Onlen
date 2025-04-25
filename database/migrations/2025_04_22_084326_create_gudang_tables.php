<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tabel Categories
        Schema::create('categories', function (Blueprint $table) {
            $table->string('id')->primary(); // Example: CAT001
            $table->string('nama_kategori');
            $table->timestamps();
        });

        // Tabel Subcategories
        Schema::create('subcategories', function (Blueprint $table) {
            $table->string('id')->primary(); // Example: SUB001
            $table->string('kategori_id');
            $table->string('nama_subkategori');
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('categories')->onDelete('cascade');
        });

        // Tabel Suppliers
        Schema::create('suppliers', function (Blueprint $table) {
            $table->string('id')->primary(); // Example: SUP001
            $table->string('nama_supplier');
            $table->string('kontak')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();
        });

        // Tabel Items
        Schema::create('items', function (Blueprint $table) {
            $table->string('kode_item')->primary(); // Example: BJU001
            $table->string('nama_item');
            $table->string('kategori_id');
            $table->string('subkategori_id')->nullable();
            $table->string('warna');
            $table->string('size');
            $table->integer('stok')->default(0);
            $table->integer('minimum_stok')->default(0);
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subkategori_id')->references('id')->on('subcategories')->onDelete('set null');
        });

        // Tabel Item In Logs (Barang Masuk)
        Schema::create('item_in_logs', function (Blueprint $table) {
            $table->string('id')->primary(); // Example: IN001
            $table->string('kode_item');
            $table->integer('jumlah');
            $table->string('supplier_id');
            $table->text('deskripsi')->nullable();
            $table->timestamp('tanggal_masuk');
            $table->timestamps();

            $table->foreign('kode_item')->references('kode_item')->on('items')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });

        // Tabel Withdraw Logs (Barang Keluar)
        Schema::create('withdraw_logs', function (Blueprint $table) {
            $table->string('id')->primary(); // Example: OUT001
            $table->string('kode_item');
            // $table->string('nama_id');
            $table->string('nama_item');
            $table->string('warna');
            $table->string('size');
            $table->integer('jumlah');
            $table->string('nama_id');
            $table->string('nama_pengambil');
            $table->text('deskripsi')->nullable();
            $table->timestamp('tanggal_pengambilan');
            $table->timestamps();

            $table->foreign('kode_item')->references('kode_item')->on('items')->onDelete('cascade');
            $table->foreign('nama_id')->references('nama_id')->on('users')->onDelete('cascade');
        });

        // Tabel Activity Logs (Audit Trail)
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->string('id')->primary(); // Example: ACT001
            $table->string('nama_id');
            $table->string('aktivitas');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('nama_id')->references('nama_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('withdraw_logs');
        Schema::dropIfExists('item_in_logs');
        Schema::dropIfExists('items');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('subcategories');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('users');
    }
};
