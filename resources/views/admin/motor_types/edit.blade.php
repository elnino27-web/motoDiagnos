@extends('layouts.admin')

@section('title', 'Edit Tipe Motor')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        
        {{-- Card Utama --}}
        <div class="card shadow-sm border-0 rounded-lg">
            
            {{-- Header Card (Kuning untuk mode Edit) --}}
            <div class="card-header bg-warning text-white py-3 rounded-top">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-white text-warning d-inline-flex align-items-center justify-content-center rounded-circle mr-3 shadow-sm" style="width: 50px; height: 50px;">
                        <i class="fas fa-edit fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold">Edit Tipe: {{ $motorType->name }}</h5>
                        <p class="mb-0 small opacity-90">Perbarui informasi model motor yang dipilih.</p>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('admin.motor-types.update', $motorType->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Wajib untuk operasi Update --}}

                <div class="card-body p-4">
                    
                    {{-- Alert Info --}}
                    <div class="alert alert-light border-warning text-warning d-flex align-items-center rounded-lg mb-4" role="alert">
                        <i class="fas fa-exclamation-triangle mr-2 fa-lg"></i>
                        <div>
                            Perubahan data tipe motor akan otomatis terupdate pada semua Gejala dan Penyakit yang terkait.
                        </div>
                    </div>

                    {{-- FIELD MEREK (DROPDOWN) --}}
                    <div class="form-group mb-4">
                        <label for="brand_id" class="font-weight-bold text-uppercase text-muted small">Merek Motor</label>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left text-warning">
                                    <i class="fas fa-tag"></i>
                                </span>
                            </div>
                            <select 
                                class="form-control border-left-0 rounded-right @error('brand_id') is-invalid @enderror" 
                                id="brand_id" 
                                name="brand_id" 
                                required
                                style="font-size: 1rem;"
                            >
                                <option value="">-- Pilih Merek --</option>
                                {{-- $brands diambil dari MotorTypeController@edit --}}
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" 
                                        {{ old('brand_id', $motorType->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="invalid-feedback ml-2 font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- FIELD NAMA TIPE --}}
                    <div class="form-group mb-4">
                        <label for="name" class="font-weight-bold text-uppercase text-muted small">Nama Tipe Motor</label>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left text-warning">
                                    <i class="fas fa-motorcycle"></i>
                                </span>
                            </div>
                            <input 
                                type="text" 
                                class="form-control border-left-0 rounded-right @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $motorType->name) }}"
                                placeholder="Contoh: Vario 125 atau Nmax 155cc"
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
                    <a href="{{ route('admin.motor-types.index') }}" class="btn btn-link text-secondary font-weight-bold p-0 text-decoration-none">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    
                    <button type="submit" class="btn btn-warning rounded-pill px-5 shadow-sm font-weight-bold text-white">
                        <i class="fas fa-sync-alt mr-2"></i> Perbarui Tipe
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection