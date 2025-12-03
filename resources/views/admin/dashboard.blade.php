@extends('layouts.admin')

@section('title', 'Dashboard - Ringkasan Sistem')

@section('content')

{{-- Custom CSS untuk Dashboard --}}
<style>
    /* Banner Selamat Datang */
    .welcome-banner {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }
    
    .welcome-banner h2 { font-weight: 700; margin-bottom: 0.5rem; }
    .welcome-banner p { opacity: 0.8; font-weight: 300; margin-bottom: 0; }
    
    .banner-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 5rem;
        opacity: 0.1;
        color: white;
    }

    /* Kartu Statistik */
    .stat-card {
        border: none;
        border-radius: 15px;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* FIX: Tetapkan tinggi tetap agar semua kartu sama ukurannya */
        height: 160px; 
        width: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .stat-card .card-body {
        position: relative;
        z-index: 2;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0;
        line-height: 1.2;
    }

    .stat-label {
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.9;
        margin-bottom: 5px;
        display: block;
    }

    .stat-icon-bg {
        position: absolute;
        right: -10px;
        bottom: -10px;
        font-size: 6rem;
        opacity: 0.15;
        transform: rotate(-15deg);
        z-index: 1;
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon-bg {
        transform: rotate(0deg) scale(1.1);
        right: 10px;
    }

    .stat-link {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 5px 0;
        text-align: center;
        background: rgba(0,0,0,0.1);
        color: white;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 600;
        transition: background 0.2s;
        z-index: 3;
    }

    .stat-link:hover {
        background: rgba(0,0,0,0.2);
        color: white;
        text-decoration: none;
    }

    /* Warna Gradien Kartu */
    .bg-gradient-primary-custom { background: linear-gradient(45deg, #4facfe, #00f2fe); color: white; }
    .bg-gradient-info-custom { background: linear-gradient(45deg, #43e97b, #38f9d7); color: white; } 
    .bg-gradient-danger-custom { background: linear-gradient(45deg, #fa709a, #fee140); color: white; }
    .bg-gradient-warning-custom { background: linear-gradient(45deg, #f093fb, #f5576c); color: white; }
</style>

<div class="row animate__animated animate__fadeIn justify-content-center"> {{-- FIX: justify-content-center agar konten banner di tengah --}}
    
    {{-- Banner Selamat Datang --}}
    <div class="col-12">
        <div class="welcome-banner">
            <div>
                <h2>Halo, <span class="text-merk">{{ Auth::user()->name ?? 'Administrator' }}</span>! 👋
                </h2>
                <p>Selamat datang di panel kontrol <strong>MotoDiagnos</strong>. Berikut adalah ringkasan data sistem pakar Anda hari ini.</p>
            </div>
            <i class="fas fa-chart-line banner-icon"></i>
        </div>
    </div>
</div>

{{-- FIX: Row baru dengan justify-content-center agar kartu selalu di tengah --}}
<div class="row animate__animated animate__fadeInUp justify-content-center"> 

    {{-- KARTU 1: Total Merek (Biru) --}}
    {{-- FIX: Mengubah col-lg-3 menjadi col-md-3 col-sm-6 agar ukurannya pas dan kotak --}}
    <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
        <div class="card stat-card bg-gradient-primary-custom">
            <div class="card-body">
                <span class="stat-label">Total Merek</span>
                {{-- data-target adalah angka tujuan animasi --}}
                <h3 class="stat-number counter" data-target="{{ $stats['total_brands'] ?? 0 }}">0</h3>
            </div>
            <i class="fas fa-tag stat-icon-bg"></i>
            <a href="{{ route('admin.brands.index') }}" class="stat-link">
                Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
            </a>
        </div>
    </div>

    {{-- KARTU 2: Total Tipe (Hijau/Tosca) --}}
    <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
        <div class="card stat-card bg-gradient-info-custom">
            <div class="card-body">
                <span class="stat-label">Total Tipe</span>
                <h3 class="stat-number counter" data-target="{{ $stats['total_motor_types'] ?? 0 }}">0</h3>
            </div>
            <i class="fas fa-motorcycle stat-icon-bg"></i>
            <a href="{{ route('admin.motor-types.index') }}" class="stat-link">
                Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
            </a>
        </div>
    </div>

    {{-- KARTU 3: Total Gejala (Pink/Kuning) --}}
    <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
        <div class="card stat-card bg-gradient-danger-custom">
            <div class="card-body">
                <span class="stat-label">Data Gejala</span>
                <h3 class="stat-number counter" data-target="{{ $stats['total_symptoms'] ?? 0 }}">0</h3>
            </div>
            <i class="fas fa-clipboard-list stat-icon-bg"></i>
            <a href="{{ route('admin.symptoms.index') }}" class="stat-link">
                Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
            </a>
        </div>
    </div>

    {{-- KARTU 4: Total Kerusakan (Ungu/Merah) --}}
    <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
        <div class="card stat-card bg-gradient-warning-custom">
            <div class="card-body">
                <span class="stat-label">Data Kerusakan</span>
                <h3 class="stat-number counter" data-target="{{ $stats['total_diseases'] ?? 0 }}">0</h3>
            </div>
            <i class="fas fa-tools stat-icon-bg"></i>
            <a href="{{ route('admin.diseases.index') }}" class="stat-link">
                Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
            </a>
        </div>
    </div>

</div>

{{-- Tambahan: Quick Actions / Aktivitas Terbaru (Opsional) --}}
<div class="row mt-2 animate__animated animate__fadeInUp justify-content-center" style="animation-delay: 0.3s;">
    <div class="col-lg-6 col-md-12 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white border-0">
                <h3 class="card-title font-weight-bold text-dark">
                    <i class="fas fa-rocket mr-2 text-merk"></i> Aksi Cepat
                </h3>
            </div>
            <div class="card-body d-flex flex-wrap justify-content-center">
                {{-- Master Data --}}
                <a href="{{ route('admin.brands.create') }}" class="btn btn-app bg-light border m-2" title="Tambah Merek Baru">
                    <i class="fas fa-tag text-merk"></i> Tambah Merek
                </a>
                <a href="{{ route('admin.motor-types.create') }}" class="btn btn-app bg-light border m-2" title="Tambah Tipe Motor">
                    <i class="fas fa-motorcycle text-type"></i> Tambah Tipe
                </a>
                
                {{-- Expert System Data --}}
                <a href="{{ route('admin.symptoms.create') }}" class="btn btn-app bg-light border m-2" title="Input Kerusakan Baru">
                    <i class="fas fa-clipboard-list text-symptoms"></i> Input Gejala
                </a>
                <a href="{{ route('admin.symptoms.create') }}" class="btn btn-app bg-light border m-2" title="Input Penyakit Baru">
                    <i class="fas fa-tools text-diseases"></i> Input Kerusakan
                </a>
                
                {{-- Rules & Settings --}}
                <a href="{{ route('admin.rules.create') }}" class="btn btn-app bg-light border m-2" title="Buat Aturan Diagnosa">
                    <i class="fas fa-project-diagram text-rules"></i> Buat Aturan
                </a>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-app bg-light border m-2" title="Edit Profil Saya">
                    <i class="fas fa-user-edit text-info"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 col-md-12 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white border-0">
                <h3 class="card-title font-weight-bold text-dark">
                    <i class="fas fa-info-circle mr-2 text-info"></i> Informasi Sistem
                </h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-valign-middle">
                    <tbody>
                        <tr>
                            <td>Total Aturan Diagnosa</td>
                            <td class="text-right">
                                <span class="badge bg-gradient-primary-custom">{{ \App\Models\Disease::has('symptoms')->count() }} Penyakit Terhubung</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Status Aplikasi</td>
                            <td class="text-right"><span class="badge bg-gradient-info-custom">Aktif & Stabil</span></td>
                        </tr>
                        <tr>
                            <td>Versi</td>
                            <td class="text-right text-muted text-rules">v1.0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Script Animasi Counter
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.counter');
        const speed = 200; // Kecepatan animasi (semakin kecil, semakin lambat)

        counters.forEach(counter => {
            const animate = () => {
                const value = +counter.getAttribute('data-target'); // Ambil target angka
                const data = +counter.innerText; // Ambil angka saat ini
                
                const time = value / speed; // Hitung langkah penambahan
                
                if(data < value) {
                    // Tambahkan angka, gunakan Math.ceil untuk membulatkan ke atas
                    counter.innerText = Math.ceil(data + time);
                    // Panggil fungsi lagi setelah 10ms (efek animasi)
                    setTimeout(animate, 50);
                } else {
                    counter.innerText = value; // Pastikan angka akhir tepat
                }
            }
            animate();
        });
    });
</script>
@endsection