@extends('layouts.admin')

@section('title', 'Tambah Merek Motor Baru')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        
        {{-- Card Utama --}}
        <div class="card shadow-sm border-0 rounded-lg">
            
            {{-- Header Card (Menggunakan bg-info agar seragam dengan Tipe Motor) --}}
            <div class="card-header bg-info text-white py-3 rounded-top">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-white text-info d-inline-flex align-items-center justify-content-center rounded-circle mr-3 shadow-sm" style="width: 50px; height: 50px;">
                        <i class="fas fa-plus fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold">Tambah Merek Baru</h5>
                        <p class="mb-0 small opacity-90">Daftarkan produsen motor baru ke dalam sistem.</p>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('admin.brands.store') }}" method="POST">
                @csrf

                <div class="card-body p-4">
                    
                    {{-- Alert Info --}}
                    <div class="alert alert-light border-info text-info d-flex align-items-center rounded-lg mb-4" role="alert">
                        <i class="fas fa-info-circle mr-2 fa-lg"></i>
                        <div>
                            Pastikan nama merek belum terdaftar sebelumnya. Gunakan penulisan yang baku (Contoh: <strong>Honda</strong>, <strong>Yamaha</strong>).
                        </div>
                    </div>

                    {{-- Input Nama Merek --}}
                    <div class="form-group mb-4">
                        <label for="name" class="font-weight-bold text-uppercase text-muted small">Nama Merek Motor</label>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left text-info">
                                    <i class="fas fa-tag"></i>
                                </span>
                            </div>
                            <input 
                                type="text" 
                                class="form-control border-left-0 rounded-right @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama merek..."
                                required
                                autofocus
                                style="font-size: 1rem;"
                            >
                            @error('name')
                                <div class="invalid-feedback ml-2 font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="form-text text-muted mt-2">
                            Merek ini akan menjadi kategori induk untuk berbagai tipe motor.
                        </small>
                    </div>

                </div>

                {{-- Footer Card --}}
                <div class="card-footer bg-light border-top-0 d-flex justify-content-between align-items-center py-3 px-4">
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-link text-secondary font-weight-bold p-0 text-decoration-none">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    
                    <button type="submit" class="btn btn-info rounded-pill px-5 shadow-sm font-weight-bold text-white">
                        <i class="fas fa-save mr-2"></i> Simpan Merek
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection