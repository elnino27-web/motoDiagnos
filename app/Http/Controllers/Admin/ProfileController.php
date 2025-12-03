<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule; // Diperlukan untuk validasi email unik

class ProfileController extends Controller
{
    /**
     * Tampilkan form ubah password.
     */
    public function editPassword()
    {
        return view('admin.settings.password');
    }

    /**
     * Proses update password.
     */
    public function updatePassword(Request $request)
    {
        // Validasi password lama dan password baru
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Update password di database
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }
    
    /**
     * Tampilkan form profil saya (Nama & Email).
     */
    public function edit(Request $request)
    {
        return view('admin.settings.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Proses update profil (Nama & Email).
     */
    public function update(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Validasi email: wajib unik di tabel users, KECUALI untuk user ini sendiri
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                Rule::unique('users')->ignore($request->user()->id)
            ],
        ]);

        // Simpan perubahan ke database
        $request->user()->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}