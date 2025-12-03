<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\MotorType;
use App\Models\Symptom;
use App\Models\Disease;

class DiagnosisController extends Controller
{
    /**
     * Menampilkan form langkah pertama (Pemilihan Tipe Motor).
     */
    public function index()
    {
        // Ambil semua merek untuk dropdown.
        // Kita juga bisa mengambil semua tipe motor di sini,
        // tetapi lebih baik menggunakan AJAX untuk memuat tipe motor setelah merek dipilih.
        $brands = Brand::orderBy('name')->get();

        return view('diagnosis.index', compact('brands'));
    }

    /**
     * Metode ini akan dipanggil menggunakan AJAX untuk memuat Gejala
     * berdasarkan Tipe Motor yang dipilih pengguna.
     * (Akan diimplementasikan di langkah berikutnya)
     */
    public function diagnose(Request $request)
    {
        // Validasi data yang dikirimkan dari form (ID Tipe Motor dan Gejala yang dicentang)
        $request->validate([
            'motor_type_id' => 'required|exists:motor_types,id',
            'symptoms' => 'nullable|array',
            'symptoms.*' => 'exists:symptoms,id',
        ]);

        // ID gejala yang dipilih pengguna
        $selectedSymptomIds = $request->symptoms ?? [];
        
        // Cek jika tidak ada gejala yang dipilih
        if (empty($selectedSymptomIds)) {
             return redirect()->back()->with('error', 'Silakan pilih minimal satu gejala untuk melakukan diagnosa.');
        }

        // ----------------------------------------------------
        // LOGIKA INFERENCE ENGINE AKAN DITEMPATKAN DI SINI
        // ----------------------------------------------------
        
        // 1. Ambil semua penyakit yang terkait dengan tipe motor yang dipilih.
        $diseasesByMotorType = Disease::where('motor_type_id', $request->motor_type_id)
            ->with('symptoms')
            ->get();
            
        $results = [];

        foreach ($diseasesByMotorType as $disease) {
            // ID gejala yang dibutuhkan penyakit ini
            $requiredSymptomIds = $disease->symptoms->pluck('id')->toArray();
            
            // Mencari gejala yang cocok antara input user dan yang dibutuhkan penyakit
            $matchedSymptoms = array_intersect($selectedSymptomIds, $requiredSymptomIds);
            
            // Menghitung skor kecocokan
            $matchCount = count($matchedSymptoms);
            $requiredCount = count($requiredSymptomIds);

            if ($requiredCount > 0) {
                // Persentase kecocokan
                $percentage = ($matchCount / $requiredCount) * 100;

                // Hanya tampilkan jika ada kecocokan (> 0%)
                if ($percentage > 0) {
                    $results[] = [
                        'disease' => $disease,
                        'percentage' => round($percentage, 2),
                        'matched_symptoms_count' => $matchCount,
                        'required_symptoms_count' => $requiredCount,
                    ];
                }
            }
        }
        
        // Urutkan hasil berdasarkan persentase kecocokan tertinggi
        usort($results, function($a, $b) {
            return $b['percentage'] <=> $a['percentage'];
        });


        // Tampilkan hasil diagnosa
        return view('diagnosis.result', compact('results'));
    }
}