@extends('layouts.admin')

@section('title', 'Ubah Password')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        
        {{-- Card Utama --}}
        <div class="card shadow-sm border-0 rounded-lg">
            
            {{-- Header Card --}}
            {{-- FIX: Menggunakan d-flex flex-column untuk memastikan posisi atas-bawah --}}
            <div class="card-header bg-warning text-white py-4 rounded-top">
                <div class="d-flex flex-column align-items-center text-center">
                    <div class="mb-3">
                        <div class="icon-circle bg-white text-warning d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 60px; height: 60px;">
                            <i class="fas fa-key fa-2x"></i>
                        </div>
                    </div>
                    <h4 class="card-title font-weight-bold mb-1 w-100">Ganti Password Admin</h4>
                    <p class="mb-0 small opacity-75 w-100">Perbarui kata sandi Anda secara berkala untuk keamanan.</p>
                </div>
            </div>
            
            <form action="{{ route('admin.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body p-4">
                    
                    {{-- Alert Info (Optional) --}}
                    <div class="alert alert-light border-warning text-muted small mb-4">
                        <i class="fas fa-info-circle mr-1 text-warning"></i> 
                        Pastikan password baru Anda memiliki minimal 8 karakter.
                    </div>

                    {{-- Password Saat Ini --}}
                    <div class="form-group mb-4">
                        <label for="current_password" class="font-weight-bold text-muted small text-uppercase">Password Saat Ini</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left"><i class="fas fa-lock text-muted"></i></span>
                            </div>
                            <input type="password" 
                                   class="form-control border-left-0 rounded-right @error('current_password', 'updatePassword') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password" 
                                   placeholder="Masukkan password lama Anda">
                            @error('current_password', 'updatePassword')
                                <div class="invalid-feedback ml-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4 border-light">

                    {{-- Password Baru --}}
                    <div class="form-group mb-3">
                        <label for="password" class="font-weight-bold text-muted small text-uppercase">Password Baru</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left"><i class="fas fa-key text-muted"></i></span>
                            </div>
                            <input type="password" 
                                   class="form-control border-left-0 rounded-right @error('password', 'updatePassword') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Password baru minimal 8 karakter">
                            @error('password', 'updatePassword')
                                <div class="invalid-feedback ml-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Konfirmasi Password Baru --}}
                    <div class="form-group mb-4">
                        <label for="password_confirmation" class="font-weight-bold text-muted small text-uppercase">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left"><i class="fas fa-check-double text-muted"></i></span>
                            </div>
                            <input type="password" 
                                   class="form-control border-left-0 rounded-right" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   placeholder="Ketik ulang password baru">
                        </div>
                    </div>

                </div>

                <div class="card-footer bg-white border-0 text-right pb-4 pr-4">
                    <button type="reset" class="btn btn-light text-muted mr-2 rounded-pill px-4">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-warning text-white rounded-pill px-4 shadow-sm">
                        <i class="fas fa-save mr-1"></i> Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection