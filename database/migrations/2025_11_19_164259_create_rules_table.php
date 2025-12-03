<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rules', function (Blueprint $table) {
            // Kita tidak perlu kolom 'id' auto-increment di tabel pivot
            // Cukup gunakan dua foreign keys sebagai primary key gabungan

            // Foreign Key ke tabel 'diseases'
            $table->foreignId('disease_id')->constrained('diseases')->cascadeOnDelete();
            // Foreign Key ke tabel 'symptoms'
            $table->foreignId('symptom_id')->constrained('symptoms')->cascadeOnDelete();

            // Membuat kedua kolom ini menjadi primary key gabungan (compound primary key)
            $table->primary(['disease_id', 'symptom_id']);
            // Kolom timestamps tidak diperlukan di tabel pivot sederhana
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};