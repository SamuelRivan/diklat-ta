<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Rekan Kerja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    .navbar {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        box-shadow: 0 4px 20px rgba(17, 153, 142, 0.4);
    }

    .navbar-brand {
        font-weight: bold;
        color: #ffffff;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background: #ffffff;
        padding: 25px;
    }

    .btn-danger {
        background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 15px;
        border: none;
    }

    .btn-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 15px;
        border: none;
    }

    .content-container {
        min-height: calc(100vh - 70px);
        padding: 30px 20px;
    }

    .feature-card {
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .feature-card:hover {
        transform: translateY(-5px);
    }

    /* Profile Dropdown Styles */
    .profile-dropdown {
        position: relative;
    }

    .profile-toggle {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.15);
        transition: all 0.3s ease;
    }

    .profile-toggle:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .profile-avatar-sm {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid white;
        background: linear-gradient(135deg, #f2994a 0%, #f2c94c 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .profile-avatar-sm img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-avatar-sm .avatar-initials {
        color: white;
        font-weight: 600;
        font-size: 14px;
    }

    .profile-name-sm {
        color: white;
        font-weight: 500;
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .dropdown-menu {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        padding: 0.5rem;
        min-width: 200px;
    }

    .dropdown-item {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .dropdown-item i {
        width: 20px;
        margin-right: 10px;
    }

    .dropdown-divider {
        margin: 0.5rem 0;
    }
    </style>
</head>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<body>
    <nav class="navbar navbar-expand-lg navbar-dark px-4 py-3">
        <span class="navbar-brand">Dashboard Rekan Kerja - Evaluasi Pascadiklat</span>
        <div class="ms-auto d-flex align-items-center gap-3">
            <!-- Profile Dropdown -->
            <div class="dropdown profile-dropdown">
                <div class="profile-toggle dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-avatar-sm">
                        @if(isset($evaluasiUser) && $evaluasiUser->foto_profile)
                            <img src="{{ asset($evaluasiUser->foto_profile) }}" alt="Profile">
                        @else
                            <span class="avatar-initials">
                                {{ strtoupper(substr($ref_pegawai->nama ?? 'U', 0, 1)) }}
                            </span>
                        @endif
                    </div>
                    <span class="profile-name-sm d-none d-md-inline">{{ $ref_pegawai->nama ?? 'User' }}</span>
                </div>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="fas fa-user"></i> Profile Saya
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('evaluasi.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <form id="logout-form" action="{{ route('evaluasi.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>

    <div class="content-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="text-center">
                            <h4 class="fw-bold text-success">Selamat datang, {{ session('nama', 'Rekan Kerja') }}!</h4>
                            <p class="text-muted">Sebagai rekan kerja, Anda dapat mengevaluasi alumni yang telah mengikuti pelatihan.</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-success text-white feature-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title text-white">Evaluasi Alumni</h5>
                                            <p class="card-text text-white">
                                                Berikan penilaian terhadap rekan kerja yang telah mengikuti pelatihan
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <i class="fas fa-users fa-3x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-success border-0">
                                    <a href="{{ route('evaluasi.rekankerja.index') }}" class="text-white text-decoration-none">
                                        Mulai Evaluasi <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-warning text-white feature-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title text-white">Panduan Evaluasi</h5>
                                            <p class="card-text text-white">
                                                Pelajari cara menggunakan sistem evaluasi pascadiklat
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <i class="fas fa-book fa-3x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-warning border-0">
                                    <a href="#" class="text-white text-decoration-none">
                                        Lihat Panduan <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="alert alert-success">
                                <h5><i class="fas fa-info-circle"></i> Informasi</h5>
                                <ul class="mb-0">
                                    <li>Anda akan mengevaluasi rekan kerja yang telah dipilih oleh alumni</li>
                                    <li>Evaluasi terdiri dari beberapa kuesioner untuk menilai soft skills dan kolaborasi</li>
                                    <li>Berikan penilaian yang jujur berdasarkan pengamatan sehari-hari</li>
                                    <li>Setiap kuesioner hanya dapat diisi sekali untuk setiap alumni</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
