<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\MotorType;
use Illuminate\Validation\Rule;

class DiseaseController extends Controller
{
    public function index()
    {
        $diseases = Disease::with('motorType')->orderBy('motor_type_id')->get(); 
        return view('admin.diseases.index', compact('diseases'));
    }

    public function create()
    {
        $motorTypes = MotorType::with('brand')->orderBy('brand_id')->get(); 
        return view('admin.diseases.create', compact('motorTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'motor_type_id' => 'required|exists:motor_types,id',
            'name' => 'required|string|max:255|unique:diseases,name',
            'description' => 'required|string',
            'solution' => 'required|string',
        ]);

        try {
            Disease::create($request->all());

            return redirect()->route('admin.diseases.index')->with('success', 'Penyakit berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data penyakit.')->withInput();
        }
    }

    public function edit(Disease $disease)
    {
        $motorTypes = MotorType::with('brand')->orderBy('brand_id')->get();
        return view('admin.diseases.edit', compact('disease', 'motorTypes'));
    }

    public function update(Request $request, Disease $disease)
    {
        $request->validate([
            'motor_type_id' => 'required|exists:motor_types,id',
            'name' => ['required', 'string', 'max:255', Rule::unique('diseases')->ignore($disease->id)],
            'description' => 'required|string',
            'solution' => 'required|string',
        ]);

        try {
            $disease->update($request->all());

            return redirect()->route('admin.diseases.index')->with('success', 'Penyakit berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data penyakit.')->withInput();
        }
    }

    public function destroy(Disease $disease)
    {
        try {
            // Karena relasi rules menggunakan disease_id, penghapusan ini juga akan menghapus rules yang terkait.
            $disease->delete();

            return redirect()->route('admin.diseases.index')->with('success', 'Penyakit berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus penyakit. Pastikan tidak ada Aturan Diagnosa yang terkait.');
        }
    }
}