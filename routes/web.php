<?php

use Illuminate\Support\Facades\Route;
// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\MotorTypeController;
use App\Http\Controllers\Admin\SymptomController;
use App\Http\Controllers\Admin\DiseaseController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\ProfileController;

// Front-end & API Controllers
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\ApiController; 
// Auth Controller
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// =======================================================================
// AUTHENTICATION ROUTES
// =======================================================================

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Route redirect agar middleware auth tidak error
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');


// =======================================================================
// A. ROUTE ADMIN AREA (Prefix: /admin, Name: admin.)
// =======================================================================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Data Master
    Route::resource('brands', BrandController::class);
    Route::resource('motor-types', MotorTypeController::class);
    Route::resource('symptoms', SymptomController::class);
    Route::resource('diseases', DiseaseController::class);
    
    // CRUD Sistem Pakar (Rules)
    Route::resource('rules', RuleController::class);
    
    // ==========================================
    // ROUTE SETTINGS (Profil & Password)
    // ==========================================
    // Nama route otomatis menjadi 'admin.profile.edit' karena berada dalam group 'admin.'
    Route::get('/settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/settings/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::get('/settings/password', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::put('/settings/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});


// =======================================================================
// B. ROUTE FRONT-END / PENGGUNA (DIAGNOSA & WELCOME)
// =======================================================================

// 1. Halaman Welcome (Landing Page) - URL: /
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 2. Halaman Form Diagnosa - URL: /diagnose (GET)
Route::get('/diagnose', [DiagnosisController::class, 'index'])->name('diagnosis.form');

// 3. Proses Diagnosa - URL: /diagnose (POST)
Route::post('/diagnose', [DiagnosisController::class, 'diagnose'])->name('run.diagnosis');


// =======================================================================
// C. ROUTE AJAX DEDIKASI (Untuk Dropdown Dinamis)
// =======================================================================
Route::get('/ajax/get-motor-types/{brandId}', [ApiController::class, 'getMotorTypes']);
Route::get('/ajax/get-symptoms/{motorTypeId}', [ApiController::class, 'getSymptoms']);