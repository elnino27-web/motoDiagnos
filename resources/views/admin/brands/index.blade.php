@extends('layouts.admin')

@section('title', 'Manajemen Merek Motor')

@section('content')

    {{-- Header Halaman & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Data Master Merek</h3>
            <p class="text-muted small mb-0">Kelola daftar produsen motor yang terdaftar dalam sistem.</p>
        </div>
        {{-- Tombol menggunakan gradien yang sama agar serasi --}}
        <a href="{{ route('admin.brands.create') }}" class="btn text-dark rounded-pill shadow-sm px-4 font-weight-bold" 
           style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none;">
            <i class="fas fa-plus mr-2"></i> Tambah Merek
        </a>
    </div>

    {{-- Card Utama --}}
    <div class="card shadow-sm border-0 rounded-lg overflow-hidden">
        
        {{-- Header Card dengan Gradien Biru Muda (Custom Style) --}}
        <div class="card-header text-white py-3 border-0" 
             style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="d-flex align-items-center">
                <div class="icon-circle bg-white text-info d-inline-flex align-items-center justify-content-center rounded-circle mr-3 shadow-sm" style="width: 45px; height: 45px;">
                    <i class="fas fa-tag fa-lg" style="color: #4facfe;"></i>
                </div>
                <div>
                    <h5 class="mb-0 font-weight-bold text-dark" style="opacity: 0.8;">Daftar Merek Terdaftar</h5>
                    <p class="mb-0 small text-dark" style="opacity: 0.6;">Total {{ $brands->count() }} merek tersedia</p>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary text-uppercase small font-weight-bold">
                        <tr>
                            <th class="pl-4 py-3" style="width: 80px;">No</th>
                            <th class="py-3">Nama Merek</th>
                            <th class="py-3 text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr class="border-bottom-light">
                                {{-- Nomor Urut --}}
                                <td class="pl-4 py-3">
                                    <span class="badge badge-light text-secondary border px-2 py-1">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>

                                {{-- Nama Merek --}}
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        {{-- Ikon Merek dengan latar biru muda yang sangat lembut --}}
                                        <div class="avatar-sm rounded-circle mr-3 d-flex align-items-center justify-content-center shadow-sm" 
                                             style="width: 40px; height: 40px; background-color: #e0f7fa; color: #00f2fe;">
                                            <i class="fas fa-gears"></i>
                                        </div>
                                        <div>
                                            <span class="font-weight-bold text-dark d-block" style="font-size: 1rem;">{{ $brand->name }}</span>
                                            <small class="text-muted">Produsen Kendaraan</small>
                                        </div>
                                    </div>
                                </td>

                                {{-- Tombol Aksi --}}
                                <td class="py-3 text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-sm btn-outline-warning mx-1 rounded" title="Edit Merek" data-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger mx-1 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus merek ini? Semua Tipe Motor terkait mungkin akan terpengaruh.')" title="Hapus Merek">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <div class="text-muted opacity-50">
                                        <i class="fas fa-folder-open fa-4x mb-3"></i>
                                        <h5>Data Kosong</h5>
                                        <p class="small mb-0">Belum ada merek motor yang ditambahkan.</p>
                                    </div>
                                    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary btn-sm mt-3 rounded-pill px-4"
                                       style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none;">
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
                <small class="text-muted">Menampilkan <strong>{{ $brands->count() }}</strong> data</small>
            </div>
        </div>
    </div>

@endsection