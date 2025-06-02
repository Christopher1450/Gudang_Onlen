<?php

use App\Models\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->string(column: 'kode_item')->primary(); // Example: BJU001
            $table->string('nama_item');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->string('supplier_name');
            $table->string('warna');
            $table->string('size');
            $table->string('harga');
            $table->integer('stok')->default(0);
            $table->integer('minimum_stok')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategory')->onDelete('set null');
            $table->foreign('supplier_name')->references('name')->on('suppliers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
