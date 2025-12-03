<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Validation\Rule; 

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data Brands dari database
        $brands = Brand::all(); 

        // Kirim data ke view index.blade.php
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
        ], [
            'name.required' => 'Nama merek wajib diisi.',
            'name.unique' => 'Merek ini sudah terdaftar.',
        ]);

        try {
            Brand::create($request->validate(['name' => 'required|string|max:255|unique:brands,name'])); 
 
            return redirect()->route('admin.brands.index')->with('success', 'Merek motor berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data merek. Silakan coba lagi.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Metode ini diabaikan dalam CRUD standar
        return redirect()->route('admin.brands.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        // 1. Validasi Data
        $request->validate([
            // Menggunakan Rule::unique atau sintaks lengkap
            'name' => ['required', 'string', 'max:255', Rule::unique('brands', 'name')->ignore($brand->id)],
        ], [
            'name.required' => 'Nama merek wajib diisi.',
            'name.unique' => 'Merek ini sudah terdaftar.',
        ]);

        try {
            // 2. Perbarui Data
            $brand->update($request->only('name')); // Menggunakan only()

            // 3. Redirect dengan pesan sukses
            return redirect()->route('admin.brands.index')->with('success', 'Merek motor berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data merek. Silakan coba lagi.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            // Hapus data merek
            $brand->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.brands.index')->with('success', 'Merek motor berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data merek. Pastikan tidak ada Tipe Motor yang menggunakan merek ini.');
        }
    }
}