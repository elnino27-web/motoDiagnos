@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        
        {{-- Card Utama --}}
        <div class="card shadow-sm border-0 rounded-lg">
            
            {{-- Header Card (Menggunakan warna Info/Biru Muda) --}}
            <div class="card-header bg-info text-white py-4 rounded-top">
                <div class="d-flex flex-column align-items-center text-center">
                    <div class="mb-3">
                        <div class="icon-circle bg-white text-info d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 70px; height: 70px;">
                            <i class="fas fa-user-circle fa-3x"></i>
                        </div>
                    </div>
                    <h4 class="card-title font-weight-bold mb-1 w-100">Profil Akun</h4>
                    <p class="mb-0 small opacity-75 w-100">Kelola informasi identitas akun administrator Anda.</p>
                </div>
            </div>
            
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body p-4">
                    
                    {{-- Nama Lengkap --}}
                    <div class="form-group mb-4">
                        <label for="name" class="font-weight-bold text-muted small text-uppercase">Nama Lengkap</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left"><i class="fas fa-user text-muted"></i></span>
                            </div>
                            <input type="text" 
                                   class="form-control border-left-0 rounded-right @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   placeholder="Masukkan nama lengkap Anda"
                                   required>
                            @error('name')
                                <div class="invalid-feedback ml-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4 border-light">

                    {{-- Alamat Email --}}
                    <div class="form-group mb-3">
                        <label for="email" class="font-weight-bold text-muted small text-uppercase">Alamat Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left"><i class="fas fa-envelope text-muted"></i></span>
                            </div>
                            <input type="email" 
                                   class="form-control border-left-0 rounded-right @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   placeholder="nama@email.com"
                                   required>
                            @error('email')
                                <div class="invalid-feedback ml-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="form-text text-muted mt-2">
                            <i class="fas fa-info-circle mr-1"></i> Email ini digunakan untuk login ke sistem.
                        </small>
                    </div>

                </div>

                <div class="card-footer bg-white border-0 text-right pb-4 pr-4">
                    <button type="submit" class="btn btn-info text-white rounded-pill px-4 shadow-sm">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection