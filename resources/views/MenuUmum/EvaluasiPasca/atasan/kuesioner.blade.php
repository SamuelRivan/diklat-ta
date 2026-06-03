{{-- View Pilihan Kuesioner untuk Atasan --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kuesioner - Atasan</title>
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

        .alumni-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            border-left: 3px solid #28a745;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-clipboard-list me-2"></i>
                Pilih Kuesioner Evaluasi
            </a>
            <div class="ms-auto">
                <span class="navbar-text me-3">
                    <i class="fas fa-user me-1"></i>
                    Evaluasi Alumni
                </span>
                <a href="{{ route('evaluasi.atasan.index') }}" class="btn btn-outline-light btn-sm me-2">
                    <i class="fas fa-arrow-left me-1"></i>
                    Kembali
                </a>
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
                            <i class="fas fa-clipboard-list text-primary me-2"></i>
                            Pilih Kuesioner untuk Evaluasi Alumni
                        </h2>
                        <p class="card-text text-muted">
                            Pilih kuesioner yang sesuai untuk mengevaluasi alumni
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alumni Information -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card alumni-info">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-user-graduate text-primary me-2"></i>
                            Informasi Alumni
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <i class="fas fa-user text-muted me-2"></i>
                                    <strong>Nama:</strong> {{ $atasanData->alumni->pegawai->nama }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-id-badge text-muted me-2"></i>
                                    <strong>NIP:</strong> {{ $atasanData->alumni->pegawai->nip }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <i class="fas fa-book text-muted me-2"></i>
                                    <strong>Pelatihan:</strong> {{ $atasanData->alumni->pelatihan->nama_pelatihan ?? 'N/A' }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-calendar text-muted me-2"></i>
                                    <strong>Tanggal:</strong> 
                                    @if($atasanData->alumni->tanggal_mulai_pelatihan && $atasanData->alumni->tanggal_selesai_pelatihan)
                                        {{ \Carbon\Carbon::parse($atasanData->alumni->tanggal_mulai_pelatihan)->format('d/m/Y') }} - 
                                        {{ \Carbon\Carbon::parse($atasanData->alumni->tanggal_selesai_pelatihan)->format('d/m/Y') }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                            <small class="text-muted">
                                <i class="fas fa-question-circle me-1"></i>
                                {{ $item->pertanyaan->count() }} pertanyaan
                            </small>
                        </div>

                        <div class="mb-3">
                            <span class="badge bg-info">{{ ucfirst($item->role_target) }}</span>
                            @if($item->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('evaluasi.atasan.form', [$atasanData->alumni_id, $item->id]) }}" 
                           class="btn btn-primary w-100">
                            <i class="fas fa-edit me-1"></i>
                            Mulai Evaluasi
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum Ada Kuesioner</h4>
                        <p class="text-muted">Tidak ada kuesioner yang tersedia untuk atasan saat ini.</p>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Navigation -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('evaluasi.atasan.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali ke Daftar Alumni
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>