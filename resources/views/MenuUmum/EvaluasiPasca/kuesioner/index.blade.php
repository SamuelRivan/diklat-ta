{{-- View Daftar Kuesioner Pascadiklat --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuesioner Pascadiklat - Alumni</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, #007bff, #0056b3);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border: none;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
        }

        .btn-outline-primary {
            border: 2px solid #007bff;
            border-radius: 8px;
            padding: 10px 20px;
        }

        .badge {
            font-size: 0.85rem;
            padding: 8px 12px;
        }

        .kuesioner-card {
            border-left: 4px solid #007bff;
        }

        .pelatihan-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            margin: 5px 0;
            border-left: 3px solid #28a745;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-graduation-cap me-2"></i>
                Evaluasi Pascadiklat
            </a>
            <div class="ms-auto">
                <span class="navbar-text me-3">
                    <i class="fas fa-user me-1"></i>
                    {{ $pegawai->nama }} ({{ ucfirst($role) }})
                </span>
                <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i>
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="card-title mb-3">
                            <i class="fas fa-clipboard-list text-primary me-2"></i>
                            Kuesioner Evaluasi Pascadiklat
                        </h2>
                        <p class="card-text text-muted">
                            Silakan pilih kuesioner untuk pelatihan yang pernah Anda ikuti
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Kuesioner List -->
        <div class="row">
            @forelse($kuesioner as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card kuesioner-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-file-alt text-primary me-2"></i>
                            {{ $item->judul }}
                        </h5>
                        <p class="card-text text-muted">{{ $item->deskripsi }}</p>
                        
                        <div class="mb-3">
                            <span class="badge bg-primary">{{ ucfirst($item->role_target) }}</span>
                            @if($item->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Non-aktif</span>
                            @endif
                        </div>

                        <!-- Pelatihan yang tersedia -->
                        @if($item->pelatihan->count() > 0)
                            <h6 class="fw-bold mb-2">
                                <i class="fas fa-book me-1"></i>
                                Pelatihan yang Pernah Anda Ikuti:
                            </h6>
                            <div class="pelatihan-list mb-3">
                                @foreach($item->pelatihan as $pelatihan)
                                <div class="pelatihan-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="fw-bold">{{ $pelatihan->nama_pelatihan }}</small>
                                            @if($pelatihan->pivot->tanggal_mulai)
                                                <br><small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    {{ \Carbon\Carbon::parse($pelatihan->pivot->tanggal_mulai)->format('d/m/Y') }}
                                                    @if($pelatihan->pivot->tanggal_selesai)
                                                        - {{ \Carbon\Carbon::parse($pelatihan->pivot->tanggal_selesai)->format('d/m/Y') }}
                                                    @endif
                                                </small>
                                            @endif
                                        </div>
                                        @if($role === 'alumni')
                                            <a href="{{ route('pascadiklat.kuesioner.select.evaluators', [$item->id, $pelatihan->id]) }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-users me-1"></i>
                                                Pilih Evaluator
                                            </a>
                                        @else
                                            <a href="{{ route('pascadiklat.kuesioner.show.pelatihan', [$item->id, $pelatihan->id]) }}" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit me-1"></i>
                                                Isi
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <small>Tidak ada pelatihan yang pernah Anda ikuti untuk kuesioner ini</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum Ada Kuesioner</h4>
                        <p class="text-muted">Saat ini belum ada kuesioner yang tersedia untuk pelatihan yang pernah Anda ikuti sebagai {{ ucfirst($role) }}</p>
                        <small class="text-muted">Kuesioner hanya ditampilkan untuk pelatihan yang sudah pernah Anda ikuti</small>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Navigation -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('dashboard.alumni') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>