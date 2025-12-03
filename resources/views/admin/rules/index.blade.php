@extends('layouts.admin')

@section('title', 'Aturan Diagnosa (Sistem Pakar)')

@section('content')

    {{-- Header Halaman & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Basis Pengetahuan</h3>
            <p class="text-muted small mb-0">Kelola logika sistem pakar yang menghubungkan penyakit dan gejala.</p>
        </div>
        {{-- Tombol menggunakan gradien Ungu --}}
        <a href="{{ route('admin.rules.create') }}" class="btn text-dark rounded-pill shadow-sm px-4 font-weight-bold"
           style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); border: none; color: #fff;">
            <i class="fas fa-plus mr-2"></i> Tambah Aturan Baru
        </a>
    </div>

    {{-- Card Utama --}}
    <div class="card shadow-sm border-0 rounded-lg overflow-hidden">

        {{-- Header Card dengan Gradien Ungu Lembut --}}
        <div class="card-header py-3 border-0"
             style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);">
            <div class="d-flex align-items-center">
                <div class="icon-circle bg-white text-purple d-inline-flex align-items-center justify-content-center rounded-circle mr-3 shadow-sm" style="width: 45px; height: 45px;">
                    <i class="fas fa-project-diagram fa-lg" style="color: #9b59b6;"></i>
                </div>
                <div>
                    <h5 class="mb-0 font-weight-bold text-dark" style="opacity: 0.8;">Daftar Aturan Penyakit</h5>
                    <p class="mb-0 small text-dark" style="opacity: 0.6;">Logika diagnosa aktif dalam sistem</p>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary text-uppercase small font-weight-bold">
                        <tr>
                            <th class="pl-4 py-3" style="width: 80px;">KODE</th>
                            <th class="py-3">PENYAKIT & TIPE MOTOR</th>
                            <th class="py-3">GEJALA (RULES)</th>
                            <th class="py-3 text-center" style="width: 150px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($diseases as $disease)
                            <tr class="border-bottom-light">
                                {{-- Kode Penyakit --}}
                                <td class="pl-4 align-middle">
                                    <span class="badge border px-2 py-1 font-weight-bold"
                                          style="background-color: #f3e5f5; color: #8e24aa; border-color: #e1bee7 !important;">
                                        R{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                {{-- Info Penyakit --}}
                                <td class="align-middle">
                                    <h6 class="text-dark font-weight-bold mb-1">{{ $disease->name }}</h6>
                                    <span class="badge text-white px-2 py-1 shadow-sm"
                                          style="font-weight: 500; font-size: 0.75rem; background: linear-gradient(45deg, #43e97b, #38f9d7);">
                                        <i class="fas fa-motorcycle mr-1"></i> {{ $disease->motorType->name ?? 'Semua Tipe' }}
                                    </span>
                                </td>

                                {{-- Daftar Gejala --}}
                                <td class="align-middle py-3">
                                    @if ($disease->symptoms->count() > 0)
                                        <div class="mb-2">
                                            <span class="badge px-2 py-1" style="background-color: #e8f5e9; color: #2e7d32;">
                                                {{ $disease->symptoms->count() }} Gejala Terhubung
                                            </span>
                                        </div>
                                        <ul class="list-unstyled mb-0 pl-3" style="font-size: 0.9rem; border-left: 3px solid #d1c4e9;">
                                            @foreach ($disease->symptoms as $symptom)
                                                <li class="text-secondary mb-1">
                                                    <i class="fas fa-check-circle mr-2 small" style="color: #9b59b6;"></i>
                                                    <span class="text-dark font-weight-500">G{{ str_pad($loop->iteration, 1, '0', STR_PAD_LEFT) }}</span> - {{ Str::limit($symptom->name, 60) }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="alert alert-light border-warning text-warning d-inline-block px-3 py-2 rounded mb-0 shadow-sm">
                                            <i class="fas fa-exclamation-triangle mr-2"></i> Belum ada aturan gejala!
                                        </div>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="align-middle text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.rules.edit', $disease->id) }}" class="btn btn-sm btn-outline-warning mx-1 rounded" title="Edit Aturan" data-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.rules.destroy', $disease->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger mx-1 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus SEMUA aturan diagnosa untuk penyakit ini?')" title="Hapus Semua Aturan">
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
                                        <i class="fas fa-project-diagram fa-4x mb-3" style="color: #d1c4e9;"></i>
                                        <h5>Basis Pengetahuan Kosong</h5>
                                        <p class="small mb-0">Belum ada penyakit yang memiliki aturan diagnosa.</p>
                                    </div>
                                    <a href="{{ route('admin.rules.create') }}" class="btn btn-sm mt-3 rounded-pill px-4 font-weight-bold text-white"
                                       style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); border: none;">
                                        <i class="fas fa-plus mr-1"></i> Buat Aturan Sekarang
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
