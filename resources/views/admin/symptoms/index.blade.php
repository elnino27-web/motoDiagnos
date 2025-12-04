@extends('layouts.admin')

@section('title', 'Manajemen Gejala Motor')

@section('content')

    {{-- Header Halaman & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Data Master Gejala</h3>
            <p class="text-muted small mb-0">Kelola indikator fisik dan masalah yang dialami pada motor.</p>
        </div>
        {{-- Tombol menggunakan gradien Kuning-Oranye --}}
        <a href="{{ route('admin.symptoms.create') }}" class="btn text-dark rounded-pill shadow-sm px-4 font-weight-bold"
           style="background: linear-gradient(45deg, #f6d365, #fda085); border: none; color: #5a4604;">
            <i class="fas fa-plus mr-2"></i> Tambah Gejala
        </a>
    </div>

    {{-- Card Utama --}}
    <div class="card shadow-sm border-0 rounded-lg overflow-hidden">

        {{-- Header Card dengan Gradien Warning (Kuning-Oranye) --}}
        <div class="card-header py-3 border-0"
             style="background: linear-gradient(45deg, #f6d365, #fda085);">
            <div class="d-flex align-items-center">
                <div class="icon-circle bg-white text-warning d-inline-flex align-items-center justify-content-center rounded-circle mr-3 shadow-sm" style="width: 45px; height: 45px;">
                    <i class="fas fa-clipboard-list fa-lg" style="color: #fda085;"></i>
                </div>
                <div>
                    <h5 class="mb-0 font-weight-bold text-dark" style="opacity: 0.8;">Daftar Gejala Terdaftar</h5>
                    <p class="mb-0 small text-dark" style="opacity: 0.6;">Total {{ $symptoms->count() }} gejala tersedia</p>
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
                            <th class="py-3">DESKRIPSI GEJALA</th>
                            <th class="py-3 text-center" style="width: 180px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($symptoms as $symptom)
                            <tr class="border-bottom-light">
                                {{-- Kode Gejala FIX: Menggunakan $loop->iteration untuk urutan G01, G02, dst. --}}
                                <td class="pl-4 py-3">
                                    <span class="badge border px-2 py-1 font-weight-bold"
                                          style="background-color: #fff8e1; color: #5a4604; border-color: #ffe0b2 !important;">
                                        G{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                {{-- Tipe Motor --}}
                                <td class="py-3">
                                    <div class="d-flex flex-column">
                                        <span class="badge px-2 py-1 mb-1 align-self-start text-white shadow-sm"
                                              style="background: linear-gradient(45deg, #f6d365, #fda085);">
                                            <i class="fas fa-motorcycle"></i> {{ $symptom->motorType->name ?? 'Unknown' }}
                                        </span>
                                        <small class="text-muted pl-1">{{ $symptom->motorType->brand->name ?? '-' }}</small>
                                    </div>
                                </td>

                                {{-- Deskripsi Gejala --}}
                                <td class="py-3">
                                    <span class="text-dark font-weight-500">{{ $symptom->name }}</span>
                                </td>

                                {{-- Tombol Aksi --}}
                                <td class="py-3 text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.symptoms.edit', $symptom->id) }}" class="btn btn-sm btn-outline-warning mx-1 rounded" title="Edit Gejala" data-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.symptoms.destroy', $symptom->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger mx-1 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus gejala ini? Aturan diagnosa yang terkait juga akan terhapus.')" title="Hapus Gejala">
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
                                        <i class="fas fa-clipboard-list fa-4x mb-3"></i>
                                        <h5>Data Kosong</h5>
                                        <p class="small mb-0">Belum ada data gejala yang ditambahkan.</p>
                                    </div>
                                    <a href="{{ route('admin.symptoms.create') }}" class="btn btn-sm mt-3 rounded-pill px-4 font-weight-bold text-white"
                                       style="background: linear-gradient(45deg, #f6d365, #fda085); border: none; color: #5a4604;">
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
                <small class="text-muted">Menampilkan <strong>{{ $symptoms->count() }}</strong> data</small>
            </div>
        </div>
    </div>

@endsection
