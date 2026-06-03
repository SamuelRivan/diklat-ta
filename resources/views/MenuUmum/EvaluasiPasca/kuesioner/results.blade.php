{{-- View Hasil Kuesioner Pascadiklat --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuesioner - {{ $kuesioner->judul }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .stats-card {
            border-left: 4px solid #28a745;
        }

        .chart-container {
            position: relative;
            height: 400px;
        }

        .jawaban-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            border-left: 3px solid #007bff;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-chart-bar me-2"></i>
                Hasil Kuesioner
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
                            <i class="fas fa-clipboard-list text-primary me-2"></i>
                            {{ $kuesioner->judul }}
                        </h2>
                        @if($kuesioner->deskripsi)
                        <p class="card-text text-muted">{{ $kuesioner->deskripsi }}</p>
                        @endif
                        
                        @if($pelatihan)
                        <div class="alert alert-info">
                            <i class="fas fa-book me-2"></i>
                            <strong>Pelatihan:</strong> {{ $pelatihan->nama_pelatihan }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <h3 class="text-primary">{{ $jawaban->count() }}</h3>
                        <p class="text-muted mb-0">Total Responden</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <h3 class="text-success">{{ $jawaban->where('role_pengisi', 'alumni')->count() }}</h3>
                        <p class="text-muted mb-0">Alumni</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <h3 class="text-warning">{{ $jawaban->where('role_pengisi', 'atasan')->count() }}</h3>
                        <p class="text-muted mb-0">Atasan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <h3 class="text-info">{{ $jawaban->where('role_pengisi', 'rekan')->count() }}</h3>
                        <p class="text-muted mb-0">Rekan Kerja</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results by Question -->
        @foreach($kuesioner->pertanyaan->sortBy('urutan') as $pertanyaan)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-question-circle text-primary me-2"></i>
                    {{ $pertanyaan->pertanyaan }}
                </h5>
                <small class="text-muted">Jenis: {{ ucfirst($pertanyaan->jenis) }}</small>
            </div>
            <div class="card-body">
                @php
                    $jawabanPertanyaan = $jawaban->where('pertanyaan_id', $pertanyaan->id);
                @endphp

                @if($pertanyaan->jenis === 'radio' || $pertanyaan->jenis === 'pilihan_ganda' || $pertanyaan->jenis === 'select')
                    <!-- Chart for multiple choice -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="chart_{{ $pertanyaan->id }}"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Detail Jawaban:</h6>
                            @foreach($pertanyaan->opsiJawaban->sortBy('urutan') as $opsi)
                                @php
                                    $count = $jawabanPertanyaan->where('opsi_jawaban_id', $opsi->id)->count();
                                    $percentage = $jawabanPertanyaan->count() > 0 ? round(($count / $jawabanPertanyaan->count()) * 100, 1) : 0;
                                @endphp
                                <div class="jawaban-item">
                                    <div class="d-flex justify-content-between">
                                        <span>{{ $opsi->teks_opsi }}</span>
                                        <span><strong>{{ $count }} ({{ $percentage }}%)</strong></span>
                                    </div>
                                    <div class="progress mt-2" style="height: 5px;">
                                        <div class="progress-bar" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const ctx{{ $pertanyaan->id }} = document.getElementById('chart_{{ $pertanyaan->id }}').getContext('2d');
                            new Chart(ctx{{ $pertanyaan->id }}, {
                                type: 'pie',
                                data: {
                                    labels: [
                                        @foreach($pertanyaan->opsiJawaban->sortBy('urutan') as $opsi)
                                        '{{ $opsi->teks_opsi }}',
                                        @endforeach
                                    ],
                                    datasets: [{
                                        data: [
                                            @foreach($pertanyaan->opsiJawaban->sortBy('urutan') as $opsi)
                                            {{ $jawabanPertanyaan->where('opsi_jawaban_id', $opsi->id)->count() }},
                                            @endforeach
                                        ],
                                        backgroundColor: [
                                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                                        ]
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
                                }
                            });
                        });
                    </script>

                @elseif($pertanyaan->jenis === 'ya_tidak')
                    <!-- Chart for Ya/Tidak -->
                    @php
                        $jawabanYa = $jawabanPertanyaan->where('jawaban_teks', 'ya')->count();
                        $jawabanTidak = $jawabanPertanyaan->where('jawaban_teks', 'tidak')->count();
                        $total = $jawabanYa + $jawabanTidak;
                        $persenYa = $total > 0 ? round(($jawabanYa / $total) * 100, 1) : 0;
                        $persenTidak = $total > 0 ? round(($jawabanTidak / $total) * 100, 1) : 0;
                    @endphp
                    <div class="row">
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="chart_{{ $pertanyaan->id }}"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Detail Jawaban:</h6>
                            <div class="jawaban-item">
                                <div class="d-flex justify-content-between">
                                    <span><i class="fas fa-check-circle text-success me-1"></i> Ya / Setuju</span>
                                    <span><strong>{{ $jawabanYa }} ({{ $persenYa }}%)</strong></span>
                                </div>
                                <div class="progress mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-success" style="width: {{ $persenYa }}%"></div>
                                </div>
                            </div>
                            <div class="jawaban-item">
                                <div class="d-flex justify-content-between">
                                    <span><i class="fas fa-times-circle text-danger me-1"></i> Tidak / Tidak Setuju</span>
                                    <span><strong>{{ $jawabanTidak }} ({{ $persenTidak }}%)</strong></span>
                                </div>
                                <div class="progress mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-danger" style="width: {{ $persenTidak }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const ctx{{ $pertanyaan->id }} = document.getElementById('chart_{{ $pertanyaan->id }}').getContext('2d');
                            new Chart(ctx{{ $pertanyaan->id }}, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Ya / Setuju', 'Tidak / Tidak Setuju'],
                                    datasets: [{
                                        data: [{{ $jawabanYa }}, {{ $jawabanTidak }}],
                                        backgroundColor: ['#28a745', '#dc3545']
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
                                }
                            });
                        });
                    </script>

                @else
                    <!-- Text answers -->
                    <h6>Jawaban Responden:</h6>
                    @if($jawabanPertanyaan->count() > 0)
                        @foreach($jawabanPertanyaan as $jawab)
                        <div class="jawaban-item">
                            <div class="d-flex justify-content-between mb-2">
                                <strong>{{ $jawab->pegawai->nama }}</strong>
                                <small class="text-muted">
                                    {{ $jawab->role_pengisi }} - 
                                    {{ $jawab->tanggal_pengisian->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <p class="mb-0">{{ $jawab->jawaban_teks ?: 'Tidak ada jawaban' }}</p>
                        </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Belum ada responden yang menjawab pertanyaan ini.
                        </div>
                    @endif
                @endif
            </div>
        </div>
        @endforeach

        @if($jawaban->count() == 0)
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-chart-bar fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum Ada Responden</h4>
                <p class="text-muted">Belum ada yang mengisi kuesioner ini.</p>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>