<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motor_types', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel 'brands'
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->string('name');

            // Opsional: Membuat kombinasi nama dan brand_id unik
            $table->unique(['name', 'brand_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motor_types');
    }
};