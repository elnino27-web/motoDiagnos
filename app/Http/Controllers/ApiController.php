<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MotorType;
use App\Models\Symptom;

class ApiController extends Controller
{
    public function getMotorTypes($brandId)
    {
        // Mengambil Tipe Motor berdasarkan Brand ID
        $motorTypes = MotorType::where('brand_id', $brandId)
            ->get(['id', 'name']);

        return response()->json($motorTypes);
    }

    public function getSymptoms($motorTypeId)
    {
        // Mengambil Gejala berdasarkan Motor Type ID
        $symptoms = Symptom::where('motor_type_id', $motorTypeId)
            ->get(['id', 'name']);

        return response()->json($symptoms);
    }
}