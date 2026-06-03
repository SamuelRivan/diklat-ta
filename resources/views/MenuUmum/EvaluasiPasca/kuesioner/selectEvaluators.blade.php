{{-- View Pemilihan Evaluator (Atasan & Rekan) --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Evaluator - {{ $kuesioner->judul }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
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
            border: none;
            margin-bottom: 20px;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
        }

        .btn-outline-primary {
            border: 2px solid #007bff;
            border-radius: 8px;
            padding: 12px 30px;
        }

        .select2-container--default .select2-selection--single {
            height: 48px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
        }

        .select2-container--default .select2-selection--multiple {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            min-height: 48px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 44px;
            padding-left: 15px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            color: white;
            padding: 5px 10px;
        }

        .evaluator-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
            border-left: 4px solid #28a745;
        }

        .required-label::after {
            content: " *";
            color: red;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-users me-2"></i>
                Pilih Evaluator
            </a>
            <div class="ms-auto">
                <a href="{{ route('pascadiklat.kuesioner.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">
                            <i class="fas fa-user-friends text-primary me-2"></i>
                            Pilih Evaluator untuk Kuesioner
                        </h2>
                        <p class="card-text text-muted mb-3">
                            Sebelum mengisi kuesioner, Anda perlu memilih rekan kerja dan atasan yang akan mengevaluasi Anda.
                        </p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="evaluator-info">
                                    <h6 class="fw-bold text-success">
                                        <i class="fas fa-clipboard-list me-1"></i>
                                        Kuesioner: {{ $kuesioner->judul }}
                                    </h6>
                                    @if($kuesioner->deskripsi)
                                        <small class="text-muted">{{ $kuesioner->deskripsi }}</small>
                                    @endif
                                </div>
                            </div>
                            @if($pelatihan)
                            <div class="col-md-6">
                                <div class="evaluator-info">
                                    <h6 class="fw-bold text-success">
                                        <i class="fas fa-book me-1"></i>
                                        Pelatihan: {{ $pelatihan->nama_pelatihan }}
                                    </h6>
                                </div>
                            </div>
                            @endif
                        </div>
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

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Form Pilih Evaluator -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-user-check text-primary me-2"></i>
                            Pilih Evaluator
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pascadiklat.kuesioner.store.evaluators') }}" method="POST" id="evaluatorForm">
                            @csrf
                            <input type="hidden" name="kuesioner_id" value="{{ $kuesioner->id }}">
                            <input type="hidden" name="pelatihan_id" value="{{ $pelatihan->id ?? '' }}">
                            <input type="hidden" name="alumni_id" value="{{ $alumniData->alumni_id }}">

                            <!-- Pilih Rekan Kerja -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="rekan_kerja" class="form-label fw-bold required-label">
                                        <i class="fas fa-user me-1"></i>
                                        Pilih Rekan Kerja (1 orang)
                                    </label>
                                    @if($rekanKerja->count() > 0)
                                        <select class="form-select" id="rekan_kerja" name="rekan_kerja" required>
                                            <option value="">-- Pilih Rekan Kerja --</option>
                                            @foreach($rekanKerja as $rekan)
                                            <option value="{{ $rekan->id }}" {{ old('rekan_kerja') == $rekan->id ? 'selected' : '' }}>
                                                {{ $rekan->nama }} ({{ $rekan->nip }}) - {{ $rekan->jabatan ?? 'N/A' }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Pilih 1 rekan kerja yang akan mengevaluasi kinerja Anda setelah pelatihan.</small>
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Tidak ada rekan kerja yang tersedia untuk dipilih. Silakan hubungi administrator.
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Pilih Atasan -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="atasan" class="form-label fw-bold required-label">
                                        <i class="fas fa-user-tie me-1"></i>
                                        Pilih Atasan (minimal 1 orang)
                                    </label>
                                    @if($atasan->count() > 0)
                                        <select class="form-select" id="atasan" name="atasan[]" multiple required>
                                            @foreach($atasan as $ats)
                                            <option value="{{ $ats->id }}" {{ in_array($ats->id, old('atasan', [])) ? 'selected' : '' }}>
                                                {{ $ats->nama }} ({{ $ats->nip }}) - {{ $ats->jabatan ?? 'N/A' }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Pilih minimal 1 atasan yang akan mengevaluasi kinerja Anda setelah pelatihan. Anda bisa memilih lebih dari 1 atasan.</small>
                                    @else
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Tidak ada atasan yang tersedia untuk dipilih. Silakan hubungi administrator.
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Informasi -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <strong>Informasi:</strong>
                                        <ul class="mb-0 mt-2">
                                            <li>Rekan kerja dan atasan yang dipilih akan menerima notifikasi untuk mengisi kuesioner evaluasi.</li>
                                            <li>Pastikan Anda memilih evaluator yang mengenal dengan baik kinerja Anda.</li>
                                            <li>Setelah memilih evaluator, Anda baru bisa mengisi kuesioner sebagai alumni.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-12 text-center">
                                    @if($rekanKerja->count() > 0 && $atasan->count() > 0)
                                        <button type="submit" class="btn btn-primary me-3">
                                            <i class="fas fa-save me-2"></i>
                                            Simpan Pilihan Evaluator
                                        </button>
                                    @else
                                        <div class="alert alert-danger">
                                            <i class="fas fa-exclamation-circle me-2"></i>
                                            Tidak dapat melanjutkan karena tidak ada evaluator yang tersedia untuk dipilih.
                                        </div>
                                    @endif
                                    <a href="{{ route('pascadiklat.kuesioner.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i>
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize Select2 for rekan kerja
            $('#rekan_kerja').select2({
                placeholder: "-- Pilih Rekan Kerja --",
                allowClear: true,
                width: '100%'
            });

            // Initialize Select2 for atasan (multiple)
            $('#atasan').select2({
                placeholder: "-- Pilih Atasan (minimal 1) --",
                allowClear: true,
                width: '100%'
            });

            // Form validation
            $('#evaluatorForm').on('submit', function(e) {
                const rekanKerja = $('#rekan_kerja').val();
                const atasan = $('#atasan').val();

                if (!rekanKerja) {
                    e.preventDefault();
                    alert('Silakan pilih rekan kerja terlebih dahulu.');
                    $('#rekan_kerja').focus();
                    return false;
                }

                if (!atasan || atasan.length === 0) {
                    e.preventDefault();
                    alert('Silakan pilih minimal 1 atasan terlebih dahulu.');
                    $('#atasan').focus();
                    return false;
                }

                // Show loading state
                $(this).find('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...');
            });
        });
    </script>
</body>

</html>