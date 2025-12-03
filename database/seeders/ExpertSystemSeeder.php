<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\MotorType;
use App\Models\Disease;
use App\Models\Symptom;

class ExpertSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ------------------------------------
        // 1. BUAT DATA BRANDS (Merek)
        // ------------------------------------
        $honda = Brand::create(['name' => 'Honda']);
        $yamaha = Brand::create(['name' => 'Yamaha']);
        
        $this->command->info('Brands (Honda, Yamaha) berhasil dibuat.');

        // ------------------------------------
        // 2. BUAT DATA MOTOR TYPES (Tipe Motor)
        // ------------------------------------
        $beat = MotorType::create([
            'brand_id' => $honda->id, 
            'name' => 'Beat 110cc'
        ]);
        $scoopy = MotorType::create([
            'brand_id' => $honda->id, 
            'name' => 'Scoopy 110cc'
        ]);
        $nmax = MotorType::create([
            'brand_id' => $yamaha->id, 
            'name' => 'Nmax 155cc'
        ]);
        
        $this->command->info('Motor Types berhasil dibuat.');


        // ------------------------------------
        // 3. BUAT DATA DISEASES (Penyakit/Kerusakan) - Khusus Beat
        // ------------------------------------
        $aki_lemah = Disease::create([
            'motor_type_id' => $beat->id,
            'name' => 'Aki Lemah',
            'description' => 'Kerusakan umum yang menyebabkan starter elektrik gagal berfungsi. Biasanya terjadi karena usia pakai atau overcharge.',
            'solution' => 'Ganti aki baru (rekomendasi: tipe MF 12V 3Ah). Pastikan sistem pengisian (regulator/kiprok) berfungsi normal.'
        ]);
        
        $vbelt_aus = Disease::create([
            'motor_type_id' => $beat->id,
            'name' => 'V-Belt Aus',
            'description' => 'V-Belt (sabuk CVT) sudah tipis dan licin karena aus, menyebabkan tarikan motor berat atau bunyi berdecit.',
            'solution' => 'Segera ganti V-Belt baru (rekomendasi: ganti satu set dengan Roller dan Slider).'
        ]);
        
        $this->command->info('Diseases berhasil dibuat.');


        // ------------------------------------
        // 4. BUAT DATA SYMPTOMS (Gejala) - Khusus Beat
        // ------------------------------------
        $s1 = Symptom::create(['motor_type_id' => $beat->id, 'name' => 'Starter elektrik tidak berfungsi / hanya berbunyi "tek"']);
        $s2 = Symptom::create(['motor_type_id' => $beat->id, 'name' => 'Lampu utama redup saat mesin mati']);
        $s3 = Symptom::create(['motor_type_id' => $beat->id, 'name' => 'Tarikan motor terasa berat di putaran awal']);
        $s4 = Symptom::create(['motor_type_id' => $beat->id, 'name' => 'Terdengar bunyi "cit cit" dari area CVT']);
        
        $this->command->info('Symptoms berhasil dibuat.');


        // ------------------------------------
        // 5. BUAT DATA RULES (Aturan Sistem Pakar - Tabel Pivot)
        // ------------------------------------

        // A. Aturan untuk 'Aki Lemah'
        // Penyakit Aki Lemah terjadi jika: S1 OR S2
        $aki_lemah->symptoms()->attach([$s1->id, $s2->id]);

        // B. Aturan untuk 'V-Belt Aus'
        // Penyakit V-Belt Aus terjadi jika: S3 OR S4
        $vbelt_aus->symptoms()->attach([$s3->id, $s4->id]);
        
        $this->command->info('Rules (Aturan Diagnosa) berhasil dibuat.');
    }
}