<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di MotoDiagnos</title>
    
    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9; /* Warna latar belakang lembut senada dengan halaman diagnosa */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Hiasan Latar Belakang (Bulatan Abstrak) */
        .bg-shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            opacity: 0.1;
            z-index: -1;
        }
        .shape-1 { width: 300px; height: 300px; top: -50px; left: -50px; }
        .shape-2 { width: 400px; height: 400px; bottom: -100px; right: -100px; }

        .welcome-card {
            background: white;
            border: none;
            border-radius: 25px;
            padding: 0;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .welcome-card:hover {
            transform: translateY(-5px);
        }

        .card-header-image {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Efek gelombang di bawah header */
        .card-header-image::after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 40px;
            background: white;
            clip-path: ellipse(60% 100% at 50% 100%);
        }

        .icon-wrapper {
            background: rgba(255, 255, 255, 0.2);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3.5rem;
            backdrop-filter: blur(5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-content {
            padding: 2rem 2.5rem 3rem;
            text-align: center;
        }

        .app-title {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .app-desc {
            color: #6c757d;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn-start {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 50px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            color: white;
            box-shadow: 0 10px 20px rgba(79, 172, 254, 0.3);
            transition: all 0.3s;
            width: 100%;
            display: block;
            text-decoration: none;
        }

        .btn-start:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(79, 172, 254, 0.4);
            color: white;
        }

        .btn-admin {
            margin-top: 1.5rem;
            display: inline-flex;
            align-items: center;
            color: #adb5bd;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.3s;
            background: transparent;
            border: 1px solid transparent;
            padding: 8px 20px;
            border-radius: 20px;
        }

        .btn-admin:hover {
            color: #4facfe;
            background: rgba(79, 172, 254, 0.05);
            border-color: rgba(79, 172, 254, 0.2);
        }

        .footer-text {
            font-size: 0.8rem;
            color: #ced4da;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

    {{-- Elemen Dekorasi Latar Belakang --}}
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <div class="welcome-card animate__animated animate__fadeInUp">
        
        <div class="card-header-image">
            <div class="icon-wrapper animate__animated animate__pulse animate__infinite animate__slower">
                <i class="fas fa-motorcycle"></i>
            </div>
        </div>

        <div class="card-content">
            <h1 class="app-title">MotoDiagnos</h1>
            <p class="app-desc">
                Solusi cerdas untuk mendeteksi kerusakan sepeda motor Anda. 
                Dapatkan analisa akurat dan solusi perbaikan dalam hitungan detik.
            </p>
            
            <a href="{{ route('diagnosis.form') }}" class="btn-start">
                <i class="fas fa-stethoscope me-2"></i> Mulai Diagnosa
            </a>
            
            <div>
                <a href="{{ route('admin.login') }}" class="btn-admin">
                    <i class="fas fa-user-shield me-2"></i> Login Admin
                </a>
            </div>

            <div class="footer-text">
                &copy; 2025 MotoDiagnos System
            </div>
        </div>
    </div>

</body>
</html>