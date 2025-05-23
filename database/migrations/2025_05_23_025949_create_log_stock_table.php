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
        Schema::create('log_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('dashboard_inventory')->cascadeOnDelete();
            $table->integer('quantity_change');
            $table->string('reason');
            $table->timestamp('date');
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_stock');
    }
};
