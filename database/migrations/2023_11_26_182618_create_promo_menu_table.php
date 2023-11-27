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
        Schema::create('promo_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promo_id')->references('id')->on('promos')->onDelete('cascade')->constrained();
            $table->foreignId('menu_id')->references('id')->on('menus')->onDelete('cascade')->constrained();
            $table->decimal('original_price', 10, 2)->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_menu');
    }
};
