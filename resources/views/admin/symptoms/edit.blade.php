@extends('layouts.admin')

@section('title', 'Edit Gejala Motor')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        
        {{-- Card Utama --}}
        <div class="card shadow-sm border-0 rounded-lg">
            
            {{-- Header Card --}}
            <div class="card-header bg-warning text-white py-3 rounded-top">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-white text-warning d-inline-flex align-items-center justify-content-center rounded-circle mr-3 shadow-sm" style="width: 50px; height: 50px;">
                        <i class="fas fa-edit fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold">Edit Gejala: G{{ str_pad($symptom->id, 2, '0', STR_PAD_LEFT) }}</h5>
                        <p class="mb-0 small opacity-90">Perbarui informasi gejala kerusakan.</p>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('admin.symptoms.update', $symptom->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body p-4">
                    
                    {{-- Alert Info --}}
                    <div class="alert alert-light border-warning text-warning d-flex align-items-center rounded-lg mb-4" role="alert">
                        <i class="fas fa-exclamation-triangle mr-2 fa-lg"></i>
                        <div>
                            Perubahan deskripsi gejala akan mempengaruhi keterbacaan pada formulir diagnosa pengguna.
                        </div>
                    </div>

                    {{-- FIELD TIPE MOTOR (DROPDOWN) --}}
                    <div class="form-group mb-4">
                        <label for="motor_type_id" class="font-weight-bold text-uppercase text-muted small">Tipe Motor Terkait</label>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left text-warning">
                                    <i class="fas fa-motorcycle"></i>
                                </span>
                            </div>
                            <select 
                                class="form-control border-left-0 rounded-right @error('motor_type_id') is-invalid @enderror" 
                                id="motor_type_id" 
                                name="motor_type_id" 
                                required
                                style="font-size: 1rem;"
                            >
                                <option value="">-- Pilih Tipe Motor --</option>
                                @foreach ($motorTypes as $motorType)
                                    <option value="{{ $motorType->id }}" 
                                        {{ old('motor_type_id', $symptom->motor_type_id) == $motorType->id ? 'selected' : '' }}>
                                        {{ $motorType->brand->name }} - {{ $motorType->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('motor_type_id')
                                <div class="invalid-feedback ml-2 font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- FIELD NAMA GEJALA --}}
                    <div class="form-group mb-4">
                        <label for="name" class="font-weight-bold text-uppercase text-muted small">Deskripsi Gejala</label>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left text-warning">
                                    <i class="fas fa-clipboard-list"></i>
                                </span>
                            </div>
                            <input 
                                type="text" 
                                class="form-control border-left-0 rounded-right @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $symptom->name) }}"
                                placeholder="Contoh: Starter elektrik tidak berfungsi"
                                required
                                style="font-size: 1rem;"
                            >
                            @error('name')
                                <div class="invalid-feedback ml-2 font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                {{-- Footer Card --}}
                <div class="card-footer bg-light border-top-0 d-flex justify-content-between align-items-center py-3 px-4">
                    <a href="{{ route('admin.symptoms.index') }}" class="btn btn-link text-secondary font-weight-bold p-0 text-decoration-none">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    
                    <button type="submit" class="btn btn-warning rounded-pill px-5 shadow-sm font-weight-bold text-white">
                        <i class="fas fa-sync-alt mr-2"></i> Perbarui Gejala
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection