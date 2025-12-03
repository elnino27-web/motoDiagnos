<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel 'motor_types'
            $table->foreignId('motor_type_id')->constrained('motor_types')->cascadeOnDelete();
            $table->string('name');
            $table->text('description'); // Penjelasan penyakit
            $table->text('solution'); // Saran perbaikan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diseases');
    }
};