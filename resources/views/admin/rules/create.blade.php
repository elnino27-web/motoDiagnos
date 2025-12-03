@extends('layouts.admin')

@section('title', isset($disease) ? 'Edit Aturan Diagnosa' : 'Tambah Aturan Diagnosa Baru')

@section('styles')
<style>
    /* Styling khusus untuk Checkbox Card */
    .symptom-card-label {
        display: block;
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        height: 100%;
        position: relative;
    }

    /* Warna hover menyesuaikan tema (default biru muda jika tidak ada override) */
    .symptom-card-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border-color: #b3d7ff;
    }

    /* Input checkbox asli disembunyikan */
    .symptom-card-input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Style saat dipilih - Akan menggunakan class utility Bootstrap di HTML untuk warna */
    .symptom-card-input:checked + .symptom-card-label {
        background-color: #f0f9ff;
        border-color: {{ isset($disease) ? '#ffc107' : '#17a2b8' }}; /* Dinamis: Kuning/Cyan */
        color: {{ isset($disease) ? '#856404' : '#117a8b' }};
    }

    .symptom-card-input:checked + .symptom-card-label::after {
        content: '\f00c'; /* FontAwesome Check */
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        top: 10px;
        right: 10px;
        color: {{ isset($disease) ? '#ffc107' : '#17a2b8' }}; /* Dinamis: Kuning/Cyan */
        font-size: 1.2rem;
    }

    /* Header Section */
    .section-header {
        border-bottom: 2px solid #f4f6f9;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }
</style>
@endsection

@section('content')

    {{-- Tentukan warna tema berdasarkan mode: Warning (Edit) atau Info (Tambah) --}}
    @php
        $themeClass = isset($disease) ? 'warning' : 'info';
        $themeText = isset($disease) ? 'text-dark' : 'text-white'; // Warning butuh text-dark kadang, tapi di header kita pakai text-white agar kontras
    @endphp

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 rounded-lg">

                {{-- Header Card Dinamis --}}
                <div class="card-header bg-{{ $themeClass }} text-white py-3 rounded-top">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-white text-{{ $themeClass }} d-inline-flex align-items-center justify-content-center rounded-circle mr-3 shadow-sm" style="width: 50px; height: 50px;">
                            <i class="fas fa-{{ isset($disease) ? 'edit' : 'plus' }} fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 font-weight-bold">{{ isset($disease) ? 'Edit Aturan: ' . $disease->name : 'Buat Aturan Baru' }}</h5>
                            <p class="mb-0 small opacity-90">Definisikan logika sistem pakar (Jika Gejala X, Y, Z maka Penyakit A)</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.rules.store') }}" method="POST">
                    @csrf

                    <div class="card-body p-4">

                        {{-- BAGIAN 1: KESIMPULAN (THEN) --}}
                        <div class="mb-5">
                            <h6 class="section-header text-{{ $themeClass }}">
                                <i class="fas fa-bullseye mr-2"></i> 1. Pilih Kesimpulan (Penyakit)
                            </h6>

                            {{-- Alert Info Dinamis --}}
                            <div class="alert alert-light border-{{ $themeClass }} text-{{ $themeClass }} d-flex align-items-center rounded-lg mb-4" role="alert">
                                <i class="fas fa-{{ isset($disease) ? 'exclamation-triangle' : 'info-circle' }} mr-2 fa-lg"></i>
                                <div>
                                    @if(isset($disease))
                                        Anda sedang mengedit aturan untuk penyakit ini. Penyakit tidak dapat diubah dalam mode edit.
                                    @else
                                        Pilih penyakit yang akan menjadi kesimpulan akhir dari diagnosa.
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="disease_id" class="font-weight-bold text-uppercase text-muted small">Penyakit / Kerusakan</label>
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0 rounded-left text-{{ $themeClass }}">
                                            <i class="fas fa-bug"></i>
                                        </span>
                                    </div>
                                    <select
                                        class="form-control border-left-0 rounded-right @error('disease_id') is-invalid @enderror"
                                        id="disease_id"
                                        name="disease_id"
                                        required
                                        {{ isset($disease) ? 'disabled' : '' }}
                                        style="font-size: 1rem;"
                                    >
                                        <option value="">-- Pilih Penyakit --</option>
                                        @foreach ($diseases as $d)
                                            <option value="{{ $d->id }}"
                                                {{ old('disease_id', $disease->id ?? '') == $d->id ? 'selected' : '' }}>
                                                [{{ $d->motorType->name ?? '?' }}] {{ $d->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('disease_id')
                                        <div class="invalid-feedback d-block ml-2 font-weight-bold">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if (isset($disease))
                                    <input type="hidden" name="disease_id" value="{{ $disease->id }}">
                                @endif
                            </div>
                        </div>

                        {{-- BAGIAN 2: PREMIS (IF) --}}
                        <div>
                            <h6 class="section-header text-{{ $themeClass }}">
                                <i class="fas fa-list-ul mr-2"></i> 2. Pilih Gejala (Premis)
                            </h6>

                            {{-- Alert Info Gejala --}}
                            <div class="alert alert-light border-{{ $themeClass }} text-{{ $themeClass }} d-flex align-items-center rounded-lg mb-4" role="alert">
                                <i class="fas fa-check-double mr-2 fa-lg"></i>
                                <div>
                                    Centang semua gejala yang menjadi indikator kuat untuk penyakit di atas.
                                </div>
                            </div>

                            @php
                                $selectedSymptoms = old('symptoms', isset($disease) ? $disease->symptoms->pluck('id')->toArray() : []);
                            @endphp

                            {{-- Grid Gejala --}}
                            <div class="row" style="max-height: 500px; overflow-y: auto;">
                                @forelse ($symptoms as $symptom)
                                    <div class="col-md-6 mb-3">
                                        <div class="position-relative h-100">
                                            <input
                                                type="checkbox"
                                                class="symptom-card-input"
                                                name="symptoms[]"
                                                value="{{ $symptom->id }}"
                                                id="symptom-{{ $symptom->id }}"
                                                {{ in_array($symptom->id, $selectedSymptoms) ? 'checked' : '' }}
                                            >
                                            <label class="symptom-card-label" for="symptom-{{ $symptom->id }}">
                                                <div class="d-flex align-items-start">
                                                    <span class="badge badge-light border mr-2 mt-1">G{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                                    <div>
                                                        <span class="d-block font-weight-bold text-dark mb-1" style="font-size: 0.95rem;">{{ $symptom->name }}</span>
                                                        <span class="badge badge-secondary badge-pill" style="font-size: 0.7rem; opacity: 0.8;">
                                                            {{ $symptom->motorType->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <div class="alert alert-{{ $themeClass }} d-inline-block border-0 shadow-sm">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            Belum ada data Gejala. Silakan input Gejala terlebih dahulu.
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            @error('symptoms')
                                <div class="alert alert-danger mt-3 border-0 shadow-sm">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer bg-light border-top-0 d-flex justify-content-between align-items-center py-3 px-4">
                        <a href="{{ route('admin.rules.index') }}" class="btn btn-link text-secondary font-weight-bold p-0 text-decoration-none">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>

                        <button type="submit" class="btn btn-{{ $themeClass }} text-white rounded-pill px-5 shadow-sm font-weight-bold">
                            <i class="fas fa-save mr-2"></i> {{ isset($disease) ? 'Perbarui Aturan' : 'Simpan Aturan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
