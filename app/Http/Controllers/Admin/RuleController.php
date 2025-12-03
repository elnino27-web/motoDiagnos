<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Rule; // Kita akan gunakan model Rule jika perlu, tapi fokus pada relasi Disease

class RuleController extends Controller
{
    public function index()
    {
        // Ambil semua Penyakit, dan ikutkan relasi Gejala yang terkait (Rules)
        $diseases = Disease::with('symptoms')->orderBy('name')->get();
        
        return view('admin.rules.index', compact('diseases'));
    }

    public function create()
    {
        // Ambil semua penyakit untuk dropdown utama
        $diseases = Disease::with('motorType.brand')->orderBy('name')->get();
        // Ambil semua gejala untuk checkbox/multi-select
        $symptoms = Symptom::with('motorType.brand')->orderBy('motor_type_id')->get();
        
        return view('admin.rules.create', compact('diseases', 'symptoms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'disease_id' => 'required|exists:diseases,id',
            'symptoms' => 'required|array', // Harus berupa array ID gejala
            'symptoms.*' => 'exists:symptoms,id', // Setiap ID gejala harus ada
        ], [
            'disease_id.required' => 'Penyakit wajib dipilih.',
            'symptoms.required' => 'Minimal satu gejala wajib dipilih.',
        ]);

        try {
            $disease = Disease::findOrFail($request->disease_id);

            // Melampirkan gejala ke penyakit (metode sync menghapus yang lama dan melampirkan yang baru)
            $disease->symptoms()->sync($request->symptoms);

            return redirect()->route('admin.rules.index')->with('success', 'Aturan diagnosa berhasil disimpan!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan aturan. Pastikan data Disease dan Symptom sudah benar.')->withInput();
        }
    }
    
    // Karena kita menggunakan sync di store, kita tidak butuh edit/update terpisah.
    // Metode edit akan mengarahkan ke form create dengan data yang sudah ada.
    public function edit($id)
    {
        $disease = Disease::with('symptoms')->findOrFail($id);
        $diseases = Disease::with('motorType.brand')->orderBy('name')->get();
        $symptoms = Symptom::with('motorType.brand')->orderBy('motor_type_id')->get();
        
        return view('admin.rules.create', compact('disease', 'diseases', 'symptoms'));
    }
    
    // Metode destroy akan menghapus semua aturan yang terkait dengan penyakit ini
    public function destroy($id)
    {
        try {
            $disease = Disease::findOrFail($id);
            // Menghapus semua relasi di tabel rules untuk penyakit ini
            $disease->symptoms()->detach(); 

            return redirect()->route('admin.rules.index')->with('success', 'Semua aturan untuk penyakit ' . $disease->name . ' berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus aturan.');
        }
    }

    // Metode show tidak diperlukan untuk CRUD aturan
    public function show($id)
    {
        return redirect()->route('admin.rules.index');
    }
}