<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Models\MotorType;
use Illuminate\Validation\Rule; // Import untuk validasi unique saat update

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua Gejala, ikutkan relasi MotorType agar nama tipe motor bisa ditampilkan
        $symptoms = Symptom::with('motorType')->orderBy('motor_type_id')->get(); 

        return view('admin.symptoms.index', compact('symptoms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua tipe motor untuk dropdown
        // Kita juga bisa menggunakan with('brand') di sini jika ingin menampilkan nama Brand di form
        $motorTypes = MotorType::with('brand')->orderBy('brand_id')->get(); 

        return view('admin.symptoms.create', compact('motorTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'motor_type_id' => 'required|exists:motor_types,id',
            'name' => 'required|string|max:255|unique:symptoms,name',
        ], [
            'motor_type_id.required' => 'Tipe motor wajib dipilih.',
            'name.required' => 'Nama gejala wajib diisi.',
            'name.unique' => 'Gejala ini sudah terdaftar.',
        ]);

        try {
            Symptom::create([
                'motor_type_id' => $request->motor_type_id,
                'name' => $request->name,
            ]);

            return redirect()->route('admin.symptoms.index')->with('success', 'Gejala berhasil ditambahkan!');

        } catch (\Exception $e) {
            // Log::error($e->getMessage()); // Jika logging diaktifkan
            return redirect()->back()->with('error', 'Gagal menyimpan data gejala.')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Symptom $symptom)
    {
        // Ambil semua tipe motor untuk dropdown
        $motorTypes = MotorType::with('brand')->orderBy('brand_id')->get();
        
        return view('admin.symptoms.edit', compact('symptom', 'motorTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Symptom $symptom)
    {
        $request->validate([
            'motor_type_id' => 'required|exists:motor_types,id',
            // Validasi unique:name, kecuali untuk gejala itu sendiri
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('symptoms')->ignore($symptom->id),
            ],
        ], [
            'motor_type_id.required' => 'Tipe motor wajib dipilih.',
            'name.required' => 'Nama gejala wajib diisi.',
            'name.unique' => 'Gejala ini sudah terdaftar.',
        ]);

        try {
            $symptom->update([
                'motor_type_id' => $request->motor_type_id,
                'name' => $request->name,
            ]);

            return redirect()->route('admin.symptoms.index')->with('success', 'Gejala berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data gejala.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom)
    {
        try {
            // Karena relasi rules menggunakan symptom_id, penghapusan ini juga akan menghapus rules yang terkait (cascade)
            $symptom->delete();

            return redirect()->route('admin.symptoms.index')->with('success', 'Gejala berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus gejala.');
        }
    }
}