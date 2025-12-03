<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Diagnosa - MotoDiagnos</title>
    
    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            min-height: 100vh;
            padding-bottom: 50px;
        }

        .result-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 3rem;
            text-align: center;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.2);
        }

        .result-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            overflow: hidden;
            background: white;
        }

        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .result-card.primary-result {
            border: 2px solid #4facfe;
        }

        .match-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #eef2ff;
            color: #4facfe;
            padding: 5px 15px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .progress {
            height: 10px;
            border-radius: 10px;
            background-color: #e9ecef;
            margin-top: 10px;
            overflow: hidden;
        }

        .progress-bar {
            background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 10px;
            transition: width 1s ease-in-out;
        }

        .btn-detail {
            background-color: #f8f9fa;
            color: #495057;
            border: none;
            border-radius: 50px;
            padding: 8px 20px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-detail:hover {
            background-color: #e9ecef;
            color: #4facfe;
        }

        .solution-box {
            background-color: #f0fdf4; /* Hijau sangat muda */
            border-left: 4px solid #2ecc71;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .btn-restart {
            background: white;
            color: #4facfe;
            border: 2px solid #4facfe;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-restart:hover {
            background: #4facfe;
            color: white;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="result-header animate__animated animate__fadeInDown">
        <div class="container">
            <div class="icon-wrapper mb-3">
                <i class="fas fa-clipboard-check fa-3x"></i>
            </div>
            <h2 class="fw-bold">Hasil Analisa Kerusakan</h2>
            <p class="opacity-75 mb-0">Berikut adalah kemungkinan kerusakan berdasarkan gejala yang Anda pilih.</p>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                
                @forelse ($results as $result)
                    @php
                        $disease = $result['disease'];
                        $percentage = $result['percentage'];
                        $isHighest = $loop->first; 
                    @endphp
                    
                    <div class="card result-card mb-4 animate__animated animate__fadeInUp {{ $isHighest ? 'primary-result' : '' }}" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <div class="card-body p-4">
                            
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    @if($isHighest)
                                        <span class="badge bg-primary mb-2">KEMUNGKINAN UTAMA</span>
                                    @endif
                                    <h4 class="card-title fw-bold text-dark mb-1">{{ $disease->name }}</h4>
                                    <p class="text-muted small mb-0">
                                        Cocok dengan {{ $result['matched_symptoms_count'] }} dari {{ $result['required_symptoms_count'] }} gejala
                                    </p>
                                </div>
                                <div class="text-end">
                                    <h3 class="fw-bold text-primary mb-0">{{ $percentage }}%</h3>
                                    <small class="text-muted">Akurasi</small>
                                </div>
                            </div>

                            {{-- Progress Bar --}}
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" 
                                     style="width:{{$percentage}}%;" 
                                     aria-valuenow="{{$percentage}}" 
                                     aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            
                            {{-- Tombol Detail (Collapse) --}}
                            <button class="btn btn-detail w-100" type="button" data-bs-toggle="collapse" data-bs-target="#detail-{{ $disease->id }}">
                                <i class="fas fa-info-circle me-2"></i> Lihat Detail & Solusi Perbaikan
                            </button>
                            
                            {{-- Konten Detail --}}
                            <div class="collapse mt-3" id="detail-{{ $disease->id }}">
                                <div class="p-3 bg-light rounded-3">
                                    <h6 class="fw-bold text-secondary mb-2"><i class="fas fa-search me-2"></i>Analisa:</h6>
                                    <p class="text-dark mb-3">{{ $disease->description }}</p>
                                    
                                    <div class="solution-box">
                                        <h6 class="fw-bold text-success mb-2"><i class="fas fa-tools me-2"></i>Saran Perbaikan:</h6>
                                        <p class="mb-0">{{ $disease->solution }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    {{-- State Kosong --}}
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-search-minus fa-4x text-muted opacity-50"></i>
                        </div>
                        <h4 class="text-muted">Tidak Ditemukan Kecocokan</h4>
                        <p class="text-muted">Gejala yang Anda pilih tidak mengarah pada kerusakan spesifik dalam database kami.</p>
                    </div>
                @endforelse

                {{-- Footer Action --}}
                <div class="text-center mt-5 mb-5 animate__animated animate__fadeIn">
                    <a href="{{ route('diagnosis.form') }}" class="btn btn-restart">
                        <i class="fas fa-redo-alt me-2"></i> Ulangi Diagnosa
                    </a>
                    <div class="mt-4 text-muted small">
                        &copy; 2025 MotoDiagnos System
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>