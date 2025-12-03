<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MotoDiagnos</title>
    
    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Styles --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        /* Sidebar Customization */
        .main-sidebar {
            background-color: #1e293b; 
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }
        
        .brand-link {
            border-bottom: 1px solid rgba(255,255,255,0.1) !important;
            background-color: #0f172a;
        }

        .nav-sidebar .nav-item .nav-link.active {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: #ffffff !important;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.4);
            border-radius: 8px;
        }

        .nav-sidebar .nav-item .nav-link {
            border-radius: 8px;
            margin-bottom: 5px;
            color: #cbd5e1;
        }

        .nav-sidebar .nav-item .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
        }

        .nav-header {
            color: #64748b !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            padding-top: 1.5rem;
        }

        /* Header / Navbar Customization */
        .main-header {
            border-bottom: none;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .navbar-light .navbar-nav .nav-link {
            color: #475569;
            font-weight: 500;
        }

        /* Content Wrapper */
        .content-wrapper {
            background-color: #f8fafc;
        }

        .content-header h1 {
            font-weight: 600;
            color: #1e293b;
            font-size: 1.5rem;
        }

        /* Card Customization */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: transform 0.2s;
        }

        .profil-img {
            width: 30px; height: 30px;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); 
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 0.8rem; font-weight: bold;
            overflow: hidden;
        }

        .text-merk {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }

        .text-type {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }

        .text-symptoms {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }

        .text-diseases {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }

        .text-rules {
            background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Footer */
        .main-footer {
            background-color: #fff;
            border-top: none;
            color: #64748b;
            font-size: 0.85rem;
        }
    </style>

    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        
        {{-- Navbar --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
                        <div class="image mr-2">
                            <div class="img-circle elevation-2 profil-img">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                        </div>
                        <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'Administrator' }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right border-0 shadow-lg">
                        <div class="dropdown-header bg-light py-3">
                            <strong class="d-block text-dark">{{ Auth::user()->name ?? 'Administrator' }}</strong>
                            <small class="text-muted">{{ Auth::user()->email ?? '' }}</small>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin.profile.edit') }}" class="dropdown-item py-2">
                            <i class="fas fa-user mr-2 text-info"></i> Profil Saya
                        </a>
                        <a href="{{ route('admin.password.edit') }}" class="dropdown-item py-2">
                            <i class="fas fa-key mr-2 text-warning"></i> Ubah Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger py-2">
                                <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        {{-- Sidebar --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <div class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center text-white" style="width: 33px; height: 33px; font-size: 1.2rem; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <i class="fas fa-motorcycle"></i>
                </div>
                <span class="brand-text font-weight-bold ml-2">MotoDiagnos</span>
            </a>

            <div class="sidebar">
                <nav class="mt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif">
                                <i class="nav-icon fas fa-chart-column"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        
                        <li class="nav-header">DATA MASTER</li>
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.brands.index') }}" class="nav-link @if(request()->routeIs('admin.brands.*')) active @endif">
                                <i class="nav-icon fas fa-tag"></i>
                                <p>Merek Motor</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.motor-types.index') }}" class="nav-link @if(request()->routeIs('admin.motor-types.*')) active @endif">
                                <i class="nav-icon fas fa-motorcycle"></i>
                                <p>Tipe Motor</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.symptoms.index') }}" class="nav-link @if(request()->routeIs('admin.symptoms.*')) active @endif">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>Data Gejala</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.diseases.index') }}" class="nav-link @if(request()->routeIs('admin.diseases.*')) active @endif">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>Data Kerusakan</p>
                            </a>
                        </li>
                        
                        <li class="nav-header">SISTEM PAKAR</li>
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.rules.index') }}" class="nav-link @if(request()->routeIs('admin.rules.*')) active @endif">
                                <i class="nav-icon fas fa-project-diagram"></i>
                                <p>Basis Aturan (Rules)</p>
                            </a>
                        </li>

                        <li class="nav-header">AKUN</li>

                        @php
                            // Cek apakah halaman yang dibuka adalah halaman settings
                            $isSettingsOpen = request()->routeIs('admin.profile.*') || request()->routeIs('admin.password.*');
                        @endphp
                        
                        {{-- FIX: Tambahkan style display: block agar JS AdminLTE tidak bingung saat toggle --}}
                        <li class="nav-item has-treeview {{ $isSettingsOpen ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ $isSettingsOpen ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Pengaturan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            {{-- FIX: style="display: block/none" untuk sinkronisasi animasi --}}
                            <ul class="nav nav-treeview" style="display: {{ $isSettingsOpen ? 'block' : 'none' }};">
                                <li class="nav-item">
                                    <a href="{{ route('admin.profile.edit') }}" class="nav-link @if(request()->routeIs('admin.profile.edit')) active @endif">
                                        <i class="fa-solid fa-user nav-icon text-info"></i>
                                        <p>Profil Saya</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.password.edit') }}" class="nav-link @if(request()->routeIs('admin.password.edit')) active @endif">
                                        <i class="fa-solid fa-key nav-icon text-warning"></i>
                                        <p>Ganti Password</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        {{-- Content Wrapper --}}
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    {{-- Alert Messages --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    
                    @yield('content')
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Versi</b> 1.0
            </div>
            <strong><a href="#" class="text-merk">MotoDiagnos</a> &copy; 2025</strong>. Alat Bantu Cek Kerusakan Motor
        </footer>
    </div>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    
    {{-- Tidak perlu script init manual, biarkan AdminLTE menangani secara otomatis --}}
    @yield('scripts')
</body>
</html>