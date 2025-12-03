<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosa - MotoDiagnos</title>
    
    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }
        
        .main-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card-header-custom {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            border: none;
        }

        .step-indicator {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .form-label-custom {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            display: block;
        }

        .form-select-custom {
            border-radius: 10px;
            padding: 12px;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
        }

        .form-select-custom:focus {
            border-color: #4facfe;
            box-shadow: 0 0 0 0.2rem rgba(79, 172, 254, 0.25);
        }

        /* Styling untuk Checkbox Gejala menjadi Kartu */
        .symptom-card-container {
            max-height: 400px;
            overflow-y: auto;
            padding: 5px;
        }

        /* Scrollbar cantik */
        .symptom-card-container::-webkit-scrollbar {
            width: 6px;
        }
        .symptom-card-container::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 10px;
        }

        /* Checkbox tersembunyi */
        .symptom-checkbox {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Label yang bertindak sebagai kartu */
        .symptom-label {
            display: block;
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            height: 100%;
            position: relative;
        }

        .symptom-label:hover {
            transform: translateY(-2px);
            border-color: #b3d7ff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        /* Style saat checkbox dipilih */
        .symptom-checkbox:checked + .symptom-label {
            background-color: #e7f1ff;
            border-color: #4facfe;
            color: #0056b3;
        }

        .symptom-checkbox:checked + .symptom-label::after {
            content: '\f00c'; /* FontAwesome Check Icon */
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 10px;
            right: 10px;
            color: #4facfe;
        }

        .btn-diagnose {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 50px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 1px;
            box-shadow: 0 10px 20px rgba(79, 172, 254, 0.3);
            transition: all 0.3s;
        }

        .btn-diagnose:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(79, 172, 254, 0.4);
        }

        .btn-diagnose:disabled {
            background: #ccc;
            cursor: not-allowed;
            box-shadow: none;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                {{-- Form Card --}}
                <div class="card main-card animate__animated animate__fadeIn">
                    
                    {{-- Header --}}
                    <div class="card-header-custom">
                        <div class="step-indicator">
                            <i class="fas fa-stethoscope me-2"></i>Mode Diagnosa
                        </div>
                        <h2 class="mb-0 fw-bold">Deteksi Kerusakan</h2>
                        <p class="mb-0 opacity-75">Isi data kendaraan untuk memulai analisa sistem pakar.</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        
                        {{-- Notifikasi Error --}}
                        @if (session('error'))
                            <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
                                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('run.diagnosis') }}" method="POST">
                            @csrf
                            
                            {{-- LANGKAH 1 --}}
                            <div class="mb-4">
                                <label class="form-label-custom">1. Pilih Merek Motor</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-3 ps-3">
                                        <i class="fas fa-motorcycle text-muted"></i>
                                    </span>
                                    <select id="brand_select" class="form-select form-select-custom border-start-0 ps-2 @error('brand_id') is-invalid @enderror">
                                        <option value="">-- Silakan Pilih Merek --</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            {{-- LANGKAH 2 --}}
                            <div class="mb-4">
                                <label class="form-label-custom">2. Pilih Tipe Motor</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start-3 ps-3">
                                        <i class="fas fa-list-ul text-muted"></i>
                                    </span>
                                    <select id="motor_type_select" name="motor_type_id" class="form-select form-select-custom border-start-0 ps-2" disabled>
                                        <option value="">-- Menunggu Pilihan Merek --</option>
                                    </select>
                                </div>
                            </div>
                            
                            {{-- LANGKAH 3 --}}
                            <div class="mb-5">
                                <label class="form-label-custom mb-3">3. Pilih Gejala yang Dialami</label>
                                
                                {{-- Container Gejala (Grid System) --}}
                                <div id="symptoms_container" class="symptom-card-container bg-light rounded-3 p-3 text-center border border-dashed">
                                    <div class="py-5 text-muted">
                                        <i class="fas fa-arrow-up mb-3 fs-3"></i>
                                        <p>Silakan pilih <strong>Tipe Motor</strong> terlebih dahulu <br>untuk memuat daftar gejala yang sesuai.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 btn-diagnose text-white" id="diagnose_button" disabled>
                                <i class="fas fa-brain me-2"></i> Analisa Kerusakan Sekarang
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Footer Link --}}
                <div class="text-center mt-4">
                    <a href="{{ route('welcome') }}" class="text-decoration-none text-muted fw-bold">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>
    
    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            const $brandSelect = $('#brand_select');
            const $motorTypeSelect = $('#motor_type_select');
            const $symptomsContainer = $('#symptoms_container');
            const $diagnoseButton = $('#diagnose_button');

            // --- 1. AJAX Load Tipe Motor ---
            $brandSelect.change(function() {
                const brandId = $(this).val();
                $motorTypeSelect.prop('disabled', true).empty().append('<option value="">-- Memuat Data... --</option>');
                
                // Reset Gejala
                $symptomsContainer.html(`
                    <div class="py-5 text-muted text-center">
                        <i class="fas fa-arrow-up mb-3 fs-3"></i>
                        <p>Silakan pilih <strong>Tipe Motor</strong> terlebih dahulu.</p>
                    </div>
                `);
                $diagnoseButton.prop('disabled', true);

                if (brandId) {
                    $.ajax({
                        url: '{{ url("ajax/get-motor-types") }}/' + brandId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $motorTypeSelect.empty().append('<option value="">-- Pilih Tipe Motor --</option>');
                            if (data.length > 0) {
                                $.each(data, function(key, value) {
                                    $motorTypeSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                                $motorTypeSelect.prop('disabled', false);
                            } else {
                                $motorTypeSelect.append('<option value="">Tidak ada tipe terdaftar</option>');
                            }
                        },
                        error: function() {
                            $motorTypeSelect.empty().append('<option value="">Gagal memuat data</option>');
                        }
                    });
                } else {
                    $motorTypeSelect.empty().append('<option value="">-- Menunggu Pilihan Merek --</option>');
                }
            });

            // --- 2. AJAX Load Gejala (Menjadi Kartu) ---
            $motorTypeSelect.change(function() {
                const motorTypeId = $(this).val();
                $symptomsContainer.html('<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div><p class="mt-2 text-muted">Sedang mengambil data gejala...</p></div>');
                $diagnoseButton.prop('disabled', true);

                if (motorTypeId) {
                    $.ajax({
                        url: '{{ url("ajax/get-symptoms") }}/' + motorTypeId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.length > 0) {
                                let html = '<div class="row g-3">'; // Grid row
                                
                                $.each(data, function(key, symptom) {
                                    html += `
                                        <div class="col-md-6">
                                            <div class="position-relative h-100">
                                                <input class="symptom-checkbox" type="checkbox" name="symptoms[]" value="${symptom.id}" id="symptom-${symptom.id}">
                                                <label class="symptom-label" for="symptom-${symptom.id}">
                                                    <span class="d-block fw-bold mb-1 text-dark">Gejala #${key + 1}</span>
                                                    <span class="text-secondary small">${symptom.name}</span>
                                                </label>
                                            </div>
                                        </div>
                                    `;
                                });
                                
                                html += '</div>'; // End Grid row
                                $symptomsContainer.html(html);
                                $diagnoseButton.prop('disabled', false);
                            } else {
                                $symptomsContainer.html(`
                                    <div class="alert alert-warning border-0 text-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i> 
                                        Belum ada data gejala untuk tipe motor ini.
                                    </div>
                                `);
                            }
                        },
                        error: function() {
                            $symptomsContainer.html('<div class="text-center text-danger py-4">Gagal memuat data gejala. Silakan coba lagi.</div>');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>