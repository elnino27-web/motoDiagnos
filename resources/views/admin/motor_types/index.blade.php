@extends('layouts.admin')

@section('title', 'Manajemen Tipe Motor')

@section('content')

    {{-- Header Halaman & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Data Master Tipe</h3>
            <p class="text-muted small mb-0">Kelola varian dan model motor berdasarkan merek.</p>
        </div>
        <a href="{{ route('admin.motor-types.create') }}" class="btn text-white rounded-pill shadow-sm px-4 font-weight-bold"
           style="background: linear-gradient(45deg, #43e97b, #38f9d7); border: none;">
            <i class="fas fa-plus mr-2"></i> Tambah Tipe
        </a>
    </div>

    {{-- Card Utama --}}
    <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
        
        {{-- Header Card dengan Gradien Hijau/Tosca --}}
        <div class="card-header text-white py-3 border-0" 
             style="background: linear-gradient(45deg, #43e97b, #38f9d7);">
            <div class="d-flex align-items-center">
                <div class="icon-circle bg-white text-info d-inline-flex align-items-center justify-content-center rounded-circle mr-3 shadow-sm" style="width: 45px; height: 45px;">
                    <i class="fas fa-motorcycle fa-lg" style="color: #43e97b;"></i>
                </div>
                <div>
                    <h5 class="mb-0 font-weight-bold text-white">Daftar Tipe Motor</h5>
                    <p class="mb-0 small opacity-90">Total {{ $motorTypes->count() }} tipe terdaftar</p>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary text-uppercase small font-weight-bold">
                        <tr>
                            <th class="pl-4 py-3" style="width: 80px;">No</th>
                            <th class="py-3">Nama Tipe / Model</th>
                            <th class="py-3">Merek Motor</th>
                            <th class="py-3 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($motorTypes as $motorType)
                            <tr class="border-bottom-light">
                                {{-- Nomor Urut --}}
                                <td class="pl-4 py-3">
                                    <span class="badge badge-light text-secondary border px-2 py-1">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>

                                {{-- Nama Tipe --}}
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm rounded-circle mr-3 d-flex align-items-center justify-content-center shadow-sm" 
                                             style="width: 40px; height: 40px; background-color: #f0fdf4; color: #43e97b;">
                                            <i class="fas fa-biking"></i>
                                        </div>
                                        <span class="font-weight-bold text-dark" style="font-size: 1rem;">{{ $motorType->name }}</span>
                                    </div>
                                </td>

                                {{-- Merek Motor --}}
                                <td class="py-3">
                                    <span class="badge text-white px-3 py-2 rounded-pill shadow-sm" 
                                        style="font-weight: 500; background: linear-gradient(45deg, #43e97b, #38f9d7);">
                                        <i class="fas fa-gears"></i>{{ $motorType->brand->name ?? 'Tanpa Merek' }}
                                    </span>
                                </td>

                                {{-- Tombol Aksi --}}
                                <td class="py-3 text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.motor-types.edit', $motorType->id) }}" class="btn btn-sm btn-outline-warning mx-1 rounded" title="Edit Tipe" data-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.motor-types.destroy', $motorType->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger mx-1 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus tipe motor ini? Data Gejala dan Penyakit terkait mungkin akan hilang.')" title="Hapus Tipe">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted opacity-50">
                                        <i class="fas fa-motorcycle fa-4x mb-3"></i>
                                        <h5>Data Kosong</h5>
                                        <p class="small mb-0">Belum ada tipe motor yang ditambahkan.</p>
                                    </div>
                                    <a href="{{ route('admin.motor-types.create') }}" class="btn btn-sm mt-3 rounded-pill px-4 text-white font-weight-bold"
                                       style="background: linear-gradient(45deg, #43e97b, #38f9d7); border: none;">
                                        <i class="fas fa-plus mr-1"></i> Tambah Sekarang
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer Card --}}
        <div class="card-footer bg-white border-top py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Menampilkan <strong>{{ $motorTypes->count() }}</strong> data</small>
            </div>
        </div>
    </div>

@endsection