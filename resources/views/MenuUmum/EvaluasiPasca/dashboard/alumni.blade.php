<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Alumni</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    .navbar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
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
        text-align: center;
    }

    .profile-img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #667eea;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 50px;
        text-align: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        overflow: hidden;
    }

    img.profile-img {
        display: block;
    }

    .btn-danger {
        background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 15px;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 15px;
        border: none;
    }

    .content-container {
        min-height: calc(100vh - 70px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top: 30px;
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
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        <span class="navbar-brand">Dashboard Alumni</span>
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
        <div class="card">
            @if(isset($evaluasiUser) && $evaluasiUser->foto_profile)
                <img src="{{ asset($evaluasiUser->foto_profile) }}" alt="Profile" class="profile-img mb-3">
            @else
                <div class="profile-img mb-3">
                    <i class="fas fa-user"></i>
                </div>
            @endif
            <h5 class="fw-bold text-primary">
                {{ $ref_pegawai->nama }}
            </h5>
            <p class="text-muted">
                {{ $ref_pegawai->jabatan }}
            </p>
            <p class="text-muted small">
                {{ $ref_pegawai->unit_kerja }}
            </p>
            <hr>
            <p><strong>NIP:</strong> {{ $ref_pegawai->nip }}
            </p>
            <p><strong>Email:</strong> {{ $ref_pegawai->email }}
            </p>
            <p><strong>No HP:</strong> {{ $ref_pegawai->no_hp }}
            </p>
        </div>

        <div class="mt-3">
            <!-- <a href="{{ route('evaluasi.formalumni') }}" class="btn btn-primary px-4 py-2 me-2">Evaluasi Lama</a> -->
            <a href="{{ route('pascadiklat.kuesioner.index', ['role' => 'alumni']) }}" class="btn btn-success px-4 py-2">
                <i class="fas fa-clipboard-list me-2"></i>
                Kuesioner Pascadiklat
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>