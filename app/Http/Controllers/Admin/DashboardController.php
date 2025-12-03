<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\MotorType;
use App\Models\Disease;
use App\Models\Symptom;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama admin.
     */
    public function index()
    {
        // Hitung total data dari setiap tabel
        $stats = [
            'total_brands' => Brand::count(),
            'total_motor_types' => MotorType::count(),
            'total_diseases' => Disease::count(),
            'total_symptoms' => Symptom::count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }
}