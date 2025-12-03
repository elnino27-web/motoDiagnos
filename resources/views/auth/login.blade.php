<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - MotoDiagnos</title>
    
    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Dekorasi Background Senada dengan Welcome Page */
        .bg-shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            opacity: 0.1;
            z-index: -1;
        }
        .shape-1 { width: 400px; height: 400px; top: -100px; right: -50px; }
        .shape-2 { width: 300px; height: 300px; bottom: -50px; left: -50px; }

        .login-card {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }

        .login-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            color: white;
            position: relative;
        }

        /* Ikon Admin Bulat */
        .admin-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2.5rem;
            backdrop-filter: blur(5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .form-control-custom {
            border-radius: 50px;
            padding: 12px 20px;
            border: 1px solid #e9ecef;
            background-color: #f8f9fa;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-control-custom:focus {
            background-color: white;
            border-color: #4facfe;
            box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.1);
        }

        .input-icon {
            position: absolute;
            right: 20px;
            top: 70%;
            transform: translateY(-50%);
            color: #adb5bd;
        }

        .btn-login {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
            transition: all 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 172, 254, 0.4);
        }

        .btn-back {
            color: #6c757d;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.3s;
            display: inline-flex;
            align-items: center;
        }

        .btn-back:hover {
            color: #4facfe;
        }
    </style>
</head>
<body>

    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <div class="login-card animate__animated animate__zoomIn">
        
        {{-- Header Biru --}}
        <div class="login-header">
            <div class="admin-icon animate__animated animate__pulse animate__infinite animate__slower">
                <i class="fas fa-user-shield"></i>
            </div>
            <h3 class="fw-bold mb-0">Admin Login</h3>
            <p class="mb-0 opacity-75 small">Sistem Pakar MotoDiagnos</p>
        </div>

        <div class="p-4 p-md-5">
            
            <form action="{{ url('/admin/login') }}" method="POST">
                @csrf
                
                {{-- Email --}}
                <div class="mb-4 position-relative">
                    <label class="form-label text-muted small fw-bold ms-2">ALAMAT EMAIL</label>
                    <input type="email" name="email" class="form-control form-control-custom @error('email') is-invalid @enderror" 
                           placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                    <i class="fas fa-envelope input-icon"></i>
                    @error('email')
                        <div class="invalid-feedback ms-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4 position-relative">
                    <label class="form-label text-muted small fw-bold ms-2">PASSWORD</label>
                    <input type="password" name="password" class="form-control form-control-custom @error('password') is-invalid @enderror" 
                           placeholder="Masukkan password" required>
                    <i class="fas fa-lock input-icon"></i>
                    @error('password')
                        <div class="invalid-feedback ms-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Masuk --}}
                <div class="d-grid gap-2 mb-4">
                    <button type="submit" class="btn btn-primary btn-login text-white">
                        MASUK DASHBOARD
                    </button>
                </div>

                {{-- Tombol Kembali --}}
                <div class="text-center">
                    <a href="{{ route('welcome') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Halaman Utama
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>