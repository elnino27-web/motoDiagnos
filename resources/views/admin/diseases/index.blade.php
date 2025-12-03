@extends('layouts.admin')

@section('title', 'Manajemen Penyakit/Kerusakan')

@section('content')

    {{-- Header Halaman & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Data Master Penyakit</h3>
            <p class="text-muted small mb-0">Kelola jenis kerusakan dan solusi perbaikannya.</p>
        </div>
        {{-- Tombol menggunakan gradien Merah-Pink --}}
        <a href="{{ route('admin.diseases.create') }}" class="btn text-white rounded-pill shadow-sm px-4 font-weight-bold"
           style="background: linear-gradient(45deg, #ff0844, #ffb199); border: none;">
            <i class="fas fa-plus mr-2"></i> Tambah Penyakit
        </a>
    </div>

    {{-- Card Utama --}}
    <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
        
        {{-- Header Card dengan Gradien Danger (Merah-Pink) --}}
        <div class="card-header py-3 border-0" 
             style="background: linear-gradient(45deg, #ff0844, #ffb199);">
            <div class="d-flex align-items-center">
                <div class="icon-circle bg-white text-danger d-inline-flex align-items-center justify-content-center rounded-circle mr-3 shadow-sm" style="width: 45px; height: 45px;">
                    <i class="fas fa-bug fa-lg" style="color: #ff0844;"></i>
                </div>
                <div>
                    <h5 class="mb-0 font-weight-bold text-white">Daftar Kerusakan Terdaftar</h5>
                    <p class="mb-0 small opacity-90">Total {{ $diseases->count() }} penyakit tersedia</p>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary text-uppercase small font-weight-bold">
                        <tr>
                            <th class="pl-4 py-3" style="width: 80px;">KODE</th>
                            <th class="py-3" style="width: 200px;">TIPE MOTOR</th>
                            <th class="py-3">PENYAKIT & DESKRIPSI</th>
                            <th class="py-3 text-center" style="width: 180px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($diseases as $disease)
                            <tr class="border-bottom-light">
                                {{-- Kode Penyakit FIX: Menggunakan $loop->iteration --}}
                                <td class="pl-4 py-3">
                                    <span class="badge border px-2 py-1 font-weight-bold" 
                                          style="background-color: #ffebee; color: #c62828; border-color: #ffcdd2 !important;">
                                        P{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                {{-- Tipe Motor --}}
                                <td class="py-3">
                                    <div class="d-flex flex-column">
                                        <span class="badge px-2 py-1 mb-1 align-self-start text-white shadow-sm" 
                                              style="background: linear-gradient(45deg, #43e97b, #38f9d7);"> {{-- Gradien Tipe Motor (Hijau/Tosca) --}}
                                            <i class="fas fa-motorcycle mr-1 small"></i> {{ $disease->motorType->name ?? 'Unknown' }}
                                        </span>
                                        <small class="text-muted pl-1">{{ $disease->motorType->brand->name ?? '-' }}</small>
                                    </div>
                                </td>

                                {{-- Nama & Deskripsi --}}
                                <td class="py-3">
                                    <span class="text-dark font-weight-bold d-block">{{ $disease->name }}</span>
                                    <small class="text-muted d-block mt-1 text-truncate" style="max-width: 400px;">
                                        {{ Str::limit($disease->description, 80) }}
                                    </small>
                                </td>

                                {{-- Tombol Aksi --}}
                                <td class="py-3 text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.diseases.edit', $disease->id) }}" class="btn btn-sm btn-outline-warning mx-1 rounded" title="Edit Penyakit" data-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.diseases.destroy', $disease->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger mx-1 rounded" onclick="return confirm('Yakin hapus penyakit ini? Ini akan menghapus semua Aturan Diagnosa yang terkait!')" title="Hapus Penyakit">
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
                                        <i class="fas fa-tools fa-4x mb-3"></i>
                                        <h5>Data Kosong</h5>
                                        <p class="small mb-0">Belum ada data penyakit yang ditambahkan.</p>
                                    </div>
                                    <a href="{{ route('admin.diseases.create') }}" class="btn btn-sm mt-3 rounded-pill px-4 text-white font-weight-bold"
                                       style="background: linear-gradient(45deg, #ff0844, #ffb199); border: none;">
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
                <small class="text-muted">Menampilkan <strong>{{ $diseases->count() }}</strong> data</small>
            </div>
        </div>
    </div>

@endsection