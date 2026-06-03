{{-- View Daftar Alumni untuk Dinilai Atasan --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi Alumni - Atasan</title>
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

        .alumni-card {
            border-left: 4px solid #007bff;
        }

        .alumni-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            border-left: 3px solid #28a745;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-user-tie me-2"></i>
                Evaluasi Alumni - Atasan
            </a>
            <div class="ms-auto">
                <span class="navbar-text me-3">
                    <i class="fas fa-user me-1"></i>
                    {{ $pegawai->nama }} (Atasan)
                </span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>
                        Logout
                    </button>
                </form>
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
                            <i class="fas fa-clipboard-check text-primary me-2"></i>
                            Daftar Alumni yang Perlu Dinilai
                        </h2>
                        <p class="card-text text-muted">
                            Selamat datang, <strong>{{ $pegawai->nama }}</strong>. Berikut adalah daftar alumni yang perlu Anda evaluasi.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alumni List -->
        <div class="row">
            @forelse($alumniList as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card alumni-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-user-graduate text-primary me-2"></i>
                            {{ $item->alumni->pegawai->nama }}
                        </h5>
                        
                        <div class="alumni-info mb-3">
                            <p class="mb-2">
                                <i class="fas fa-id-badge text-muted me-2"></i>
                                <strong>NIP:</strong> {{ $item->alumni->pegawai->nip }}
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-book text-muted me-2"></i>
                                <strong>Pelatihan:</strong> {{ $item->alumni->pelatihan->nama_pelatihan ?? 'N/A' }}
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-calendar text-muted me-2"></i>
                                <strong>Tanggal:</strong>
                                @if($item->alumni->tanggal_mulai_pelatihan && $item->alumni->tanggal_selesai_pelatihan)
                                    {{ \Carbon\Carbon::parse($item->alumni->tanggal_mulai_pelatihan)->format('d/m/Y') }} - 
                                    {{ \Carbon\Carbon::parse($item->alumni->tanggal_selesai_pelatihan)->format('d/m/Y') }}
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>

                        <div class="mb-3">
                            <span class="badge bg-warning">{{ ucfirst(str_replace('_', ' ', $item->status_penilaian)) }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('evaluasi.atasan.kuesioner', $item->alumni_id) }}" 
                           class="btn btn-primary w-100">
                            <i class="fas fa-edit me-1"></i>
                            Beri Penilaian
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-clipboard-check fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Tidak Ada Alumni</h4>
                        <p class="text-muted">Tidak ada alumni yang perlu dinilai saat ini.</p>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Navigation -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>