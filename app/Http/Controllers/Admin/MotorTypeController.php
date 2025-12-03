<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MotorType;
use App\Models\Brand;
use Illuminate\Validation\Rule; // <-- WAJIB: Diperlukan untuk validasi unik saat update

class MotorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motorTypes = MotorType::with('brand')->get(); 
        return view('admin.motor_types.index', compact('motorTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get(); 
        return view('admin.motor_types.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255|unique:motor_types,name',
        ], [
            'brand_id.required' => 'Merek motor wajib dipilih.',
            'name.required' => 'Nama tipe motor wajib diisi.',
            'name.unique' => 'Tipe motor ini sudah terdaftar.',
        ]);

        try {
            // Menggunakan $request->only('brand_id', 'name') untuk keamanan
            MotorType::create($request->only('brand_id', 'name')); 
            return redirect()->route('admin.motor-types.index')->with('success', 'Tipe motor berhasil ditambahkan!');

        } catch (\Exception $e) {
            // dd($e->getMessage()); // Debugging
            return redirect()->back()->with('error', 'Gagal menyimpan data tipe motor.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.motor-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MotorType $motorType) // <-- Route Model Binding DITERIMA di sini
    {
        $brands = Brand::all(); 
        return view('admin.motor_types.edit', compact('motorType', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MotorType $motorType) // <-- PERBAIKAN: Menggunakan Route Model Binding
    {
        // 1. Validasi Data
        $request->validate([
            'brand_id' => 'required|exists:brands,id', 
            // PERBAIKAN: Menggunakan Rule::unique dengan mengabaikan ID MotorType saat ini
            'name' => ['required', 'string', 'max:255', Rule::unique('motor_types')->ignore($motorType->id)],
        ], [
            'brand_id.required' => 'Merek motor wajib dipilih.',
            'name.required' => 'Nama tipe motor wajib diisi.',
            'name.unique' => 'Tipe motor ini sudah terdaftar.',
        ]);

        try {
            // 2. Perbarui Data
            $motorType->update($request->only('brand_id', 'name'));

            // 3. Redirect dengan pesan sukses
            return redirect()->route('admin.motor-types.index')->with('success', 'Tipe motor berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data tipe motor.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MotorType $motorType) // <-- PERBAIKAN: Menggunakan Route Model Binding
    {
        try {
            $motorType->delete();
            return redirect()->route('admin.motor-types.index')->with('success', 'Tipe motor berhasil dihapus!');
        } catch (\Exception $e) {
            // Pesan error jika ada konflik Foreign Key
            return redirect()->back()->with('error', 'Gagal menghapus Tipe Motor. Hapus semua Gejala atau Penyakit yang terkait terlebih dahulu.');
        }
    }
}