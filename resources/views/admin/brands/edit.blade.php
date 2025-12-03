@extends('layouts.admin')

@section('title', 'Edit Merek Motor')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        
        {{-- Card Utama --}}
        <div class="card shadow-sm border-0 rounded-lg">
            
            {{-- Header Card (Gunakan warna Warning/Kuning karena ini operasi edit) --}}
            <div class="card-header bg-warning text-white py-3 rounded-top">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-white text-warning d-inline-flex align-items-center justify-content-center rounded-circle mr-3 shadow-sm" style="width: 50px; height: 50px;">
                        <i class="fas fa-edit fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold">Edit Merek: {{ $brand->name }}</h5>
                        <p class="mb-0 small opacity-90">Perbarui nama produsen motor yang dipilih.</p>
                    </div>
                </div>
            </div>
            
            {{-- Form mengarah ke route update profil --}}
            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Wajib untuk operasi Update --}}

                <div class="card-body p-4">
                    
                    {{-- Alert Info --}}
                    <div class="alert alert-light border-warning text-warning d-flex align-items-center rounded-lg mb-4" role="alert">
                        <i class="fas fa-exclamation-triangle mr-2 fa-lg"></i>
                        <div>
                            Perubahan nama merek akan berlaku pada semua Tipe Motor yang terkait.
                        </div>
                    </div>

                    {{-- Input Nama Merek --}}
                    <div class="form-group mb-4">
                        <label for="name" class="font-weight-bold text-uppercase text-muted small">Nama Merek Motor</label>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left text-warning">
                                    <i class="fas fa-tag"></i>
                                </span>
                            </div>
                            <input 
                                type="text" 
                                class="form-control border-left-0 rounded-right @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $brand->name) }}"
                                placeholder="Contoh: Honda atau Yamaha"
                                required
                                autofocus
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
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-link text-secondary font-weight-bold p-0 text-decoration-none">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    
                    <button type="submit" class="btn btn-warning rounded-pill px-5 shadow-sm font-weight-bold text-white">
                        <i class="fas fa-save mr-2"></i> Perbarui Merek
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection