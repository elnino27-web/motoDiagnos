@extends('layouts.admin')

@section('title', 'Tambah Penyakit/Kerusakan Baru')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-9 col-md-10"> {{-- Sedikit lebih lebar karena ada textarea --}}

        {{-- Card Utama --}}
        <div class="card shadow-sm border-0 rounded-lg">

            {{-- Header Card --}}
            <div class="card-header bg-danger text-white py-3 rounded-top">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-white text-danger d-inline-flex align-items-center justify-content-center rounded-circle mr-3 shadow-sm" style="width: 50px; height: 50px;">
                        <i class="fas fa-plus fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold">Input Data Kerusakan</h5>
                        <p class="mb-0 small opacity-90">Tambahkan jenis kerusakan baru beserta solusinya.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.diseases.store') }}" method="POST">
                @csrf

                <div class="card-body p-4">

                    {{-- Alert Info --}}
                    <div class="alert alert-light border-danger text-danger d-flex align-items-center rounded-lg mb-4" role="alert">
                        <i class="fas fa-info-circle mr-2 fa-lg"></i>
                        <div>
                            Penyakit adalah kesimpulan dari diagnosa. Pastikan deskripsi dan solusi ditulis dengan jelas dan lengkap.
                        </div>
                    </div>

                    {{-- FIELD TIPE MOTOR --}}
                    <div class="form-group mb-4">
                        <label for="motor_type_id" class="font-weight-bold text-uppercase text-muted small">Tipe Motor Terkait</label>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left text-danger">
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
                                    <option value="{{ $motorType->id }}" {{ old('motor_type_id') == $motorType->id ? 'selected' : '' }}>
                                        {{ $motorType->brand->name }} - {{ $motorType->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('motor_type_id')
                                <div class="invalid-feedback ml-2 font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- FIELD NAMA PENYAKIT --}}
                    <div class="form-group mb-4">
                        <label for="name" class="font-weight-bold text-uppercase text-muted small">Nama Penyakit/Kerusakan</label>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left text-danger">
                                    <i class="fas fa-tools"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control border-left-0 rounded-right @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required style="font-size: 1rem;">
                            @error('name')
                                <div class="invalid-feedback ml-2 font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- FIELD DESKRIPSI --}}
                    <div class="form-group mb-4">
                        <label for="description" class="font-weight-bold text-uppercase text-muted small">Deskripsi Penyakit</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left text-danger align-items-start pt-2">
                                    <i class="fas fa-align-left"></i>
                                </span>
                            </div>
                            <textarea class="form-control border-left-0 rounded-right @error('description') is-invalid @enderror" id="description" name="description" rows="3" required placeholder="Jelaskan detail kerusakan...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback ml-2 font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- FIELD SOLUSI --}}
                    <div class="form-group mb-4">
                        <label for="solution" class="font-weight-bold text-uppercase text-muted small">Saran Solusi/Perbaikan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0 rounded-left text-success align-items-start pt-2">
                                    <i class="fas fa-wrench"></i>
                                </span>
                            </div>
                            <textarea class="form-control border-left-0 rounded-right @error('solution') is-invalid @enderror" id="solution" name="solution" rows="3" required placeholder="Langkah-langkah perbaikan...">{{ old('solution') }}</textarea>
                            @error('solution')
                                <div class="invalid-feedback ml-2 font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                {{-- Footer Card --}}
                <div class="card-footer bg-light border-top-0 d-flex justify-content-between align-items-center py-3 px-4">
                    <a href="{{ route('admin.diseases.index') }}" class="btn btn-link text-secondary font-weight-bold p-0 text-decoration-none">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-danger rounded-pill px-5 shadow-sm font-weight-bold text-white">
                        <i class="fas fa-save mr-2"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
