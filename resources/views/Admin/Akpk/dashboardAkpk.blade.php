@extends('layouts.app')
<style>
    .card {
        border-radius: 1rem;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 1rem 1rem rgba(0, 0, 0, 1);
    }

    .card:hover {
        transform: translateY(-0.3125rem);
    }

    .card-footer {
        border-radius: 0 0 1rem 1rem;
    }

    .bg-primary-section {
        height: 180px;
        border-radius: 0 0 10px 10px;
    }

    .user-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-bottom: none;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        margin-right: 12px;
        border-radius: 50%;
        overflow: hidden;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 600;
        font-size: 0.95rem;
        color: #333;
        line-height: 1.2;
    }

    .user-title {
        color: #6c757d;
        font-size: 0.8rem;
        line-height: 1.2;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.8rem;
    }

    .btn-outline-primary {
        border-color: #e0e0e0;
        color: #5c6bc0;
    }

    .btn-outline-primary:hover {
        background-color: #5c6bc0;
        border-color: #5c6bc0;
    }

    .component-container {
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
    }

    .component-container:hover {
        border-color: #d1d5db;
    }
</style>

@section('content')
    <div class="">
        <!-- Container untuk konten -->
        <div class="stats-cards">
            <div class="row mb-4">
                @php
                    $cards = [
                        [
                            'title' => 'Total Pegawai',
                            'value' => '215',
                            'unit' => 'Orang',
                            'icon' => 'iconPegawai.png',
                            'bg' => 'bg-primary',
                        ],
                        [
                            'title' => 'Total Assessment',
                            'value' => '519',
                            'unit' => 'penilaian',
                            'icon' => 'iconAsessment.png',
                            'bg' => 'bg-danger',
                        ],
                        [
                            'title' => 'GAP Pegawai',
                            'value' => '75%',
                            'unit' => 'GAP',
                            'icon' => 'iconGapPegawai.png',
                            'bg' => 'bg-success',
                        ],
                        [
                            'title' => 'Usulan Pelatihan',
                            'value' => '437',
                            'unit' => 'Usulan',
                            'icon' => 'iconUsulanPelatihan.png',
                            'bg' => 'bg-warning',
                        ],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="col-md-3">
                        <div class="card shadow-sm rounded h-100">
                            <div class="card-body d-flex align-items-center p-3">
                                <div class="d-flex flex-column flex-grow-1">
                                    <span class="text-muted small mb-1">{{ $card['title'] }}</span>
                                    <div class="d-flex flex-column">
                                        <h2 class="fw-bold mb-0">{{ $card['value'] }}</h2>
                                        <span class="text-muted small">{{ $card['unit'] }}</span>
                                    </div>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center {{ $card['bg'] }} bg-opacity-10"
                                    style="width: 48px; height: 48px;">
                                    <img src="{{ asset('images/' . $card['icon']) }}" alt="Icon" width="24"
                                        height="24">
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 text-end py-2">
                                <a href="#" class="text-decoration-none text-primary small">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Ganti bagian chart dan analisis -->
        <div class="row mt-4">
            <!-- Chart Section -->
            <div class="col-lg-8">
                <div class="component-container p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h6 class="mb-0 fw-bold">Evaluasi Kompetensi Pegawai</h6>
                            <small class="text-muted">Seluruh ASN Kota Surakarta</small>
                        </div>
                        <div class="d-flex gap-2">
                            <select class="form-select form-select-sm" id="chartPeriod">
                                <option value="1">1 Hari</option>
                                <option value="7">7 Hari</option>
                                <option value="30">30 Hari</option>
                                <option value="365" selected>1 Tahun</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-container" style="position: relative; height:300px;">
                        <canvas id="kompetensiChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Analisis Section -->
            <div class="col-lg-4">
                <div class="component-container p-4">
                    <h6 class="fw-bold mb-4">Analisis Pelatihan Solowasis</h6>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted small">PELATIHAN</span>
                        <span class="text-muted small">PEMINAT</span>
                    </div>

                    <!-- Training List -->
                    <div class="training-list">
                        @php
                            $trainings = [
                                [
                                    'name' => 'Public Speaking',
                                    'participants' => 85,
                                    'percentage' => 85,
                                ],
                                [
                                    'name' => 'Leadership',
                                    'participants' => 46,
                                    'percentage' => 46,
                                ],
                                [
                                    'name' => 'Digital Marketing',
                                    'participants' => 38,
                                    'percentage' => 38,
                                ],
                                [
                                    'name' => 'Cyber Security',
                                    'participants' => 27,
                                    'percentage' => 27,
                                ],
                                [
                                    'name' => 'Data Science',
                                    'participants' => 17,
                                    'percentage' => 17,
                                ],
                                [
                                    'name' => 'Bahasa Inggris',
                                    'participants' => 3,
                                    'percentage' => 3,
                                ],
                            ];
                        @endphp

                        @foreach ($trainings as $training)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="progress flex-grow-1 me-3" style="height: 35px; background-color: #F5F6FA;">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $training['percentage'] }}%; background-color: #DDE7FF;"
                                        aria-valuenow="{{ $training['percentage'] }}" aria-valuemin="0" aria-valuemax="100">
                                        <span class="ms-2 text-dark">{{ $training['name'] }}</span>
                                    </div>
                                </div>
                                <span class="fw-medium" style="min-width: 30px;">{{ $training['participants'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Modifikasi section tabel -->
        <div class="row mt-4">
            <!-- Usulan Pelatihan Table -->
            <div class="col-lg-8">
                <div class="component-container">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white py-3 px-4 border-0">
                        <h5 class="mb-0 fw-bold">Usulan Pelatihan</h5>
                        <a href="#" class="text-primary text-decoration-none">View All</a>
                    </div>
                    <div class="card-body px-4 pb-4 pt-0">
                        @php
                            $usulanPelatihan = [
                                [
                                    'tanggal' => '10/03/2025',
                                    'waktu' => '09:05 WIB',
                                    'nama' => 'Nanang Ardiansyah',
                                    'pelatihan' => 'Cyber Security',
                                    'status' => 'Diproses',
                                ],
                                [
                                    'tanggal' => '07/03/2025',
                                    'waktu' => '08:51 WIB',
                                    'nama' => 'Risa Nur Azizah',
                                    'pelatihan' => 'Komputer Operator',
                                    'status' => 'Disetujui',
                                ],
                                [
                                    'tanggal' => '07/03/2025',
                                    'waktu' => '13:39 WIB',
                                    'nama' => 'Nanang',
                                    'pelatihan' => 'Komputer Technical Support',
                                    'status' => 'Ditolak',
                                ],
                            ];
                        @endphp
                        <table class="table table-hover mb-0">
                            <thead style="background-color: #F0F4FF;">
                                <tr>
                                    <th class="py-3" style="width: 5%">No</th>
                                    <th class="py-3" style="width: 20%">Tanggal Pengajuan</th>
                                    <th class="py-3" style="width: 25%">Nama</th>
                                    <th class="py-3" style="width: 25%">Usulan Pelatihan</th>
                                    <th class="py-3" style="width: 15%">Status</th>
                                    <th class="py-3 text-center" style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usulanPelatihan as $index => $usulan)
                                    <tr>
                                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                                        <td class="py-3">
                                            <div>{{ $usulan['tanggal'] }}</div>
                                            <small class="text-muted">{{ $usulan['waktu'] }}</small>
                                        </td>
                                        <td class="py-3">{{ $usulan['nama'] }}</td>
                                        <td class="py-3">{{ $usulan['pelatihan'] }}</td>
                                        <td class="py-3">
                                            <span
                                                class="badge bg-{{ $usulan['status'] == 'Diproses' ? 'warning' : ($usulan['status'] == 'Disetujui' ? 'success' : 'danger') }} 
                                                text-{{ $usulan['status'] == 'Diproses' ? 'warning' : ($usulan['status'] == 'Disetujui' ? 'success' : 'danger') }} 
                                                bg-opacity-10">{{ $usulan['status'] }}</span>
                                        </td>
                                        <td class="py-3 text-center">
                                            <button class="btn btn-sm btn-outline-primary rounded-circle">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- User List -->
            <div class="col-lg-4">
                <div class="component-container">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white py-3 px-4 border-0">
                        <h5 class="mb-0 fw-bold">User</h5>
                        <a href="#" class="text-primary text-decoration-none">View all</a>
                    </div>
                    <div class="card-body px-4 pb-4 pt-0">
                        <div class="user-list">
                            @foreach (range(1, 4) as $i)
                                <div class="d-flex align-items-center py-3">
                                    <div style="width: 36px; height: 36px; margin-right: 12px;">
                                        <img src="{{ asset('images/avatarUser.svg') }}" alt="User"
                                            class="img-fluid rounded-circle">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span style="font-size: 14px; font-weight: 600; color: #333;">Nama User
                                            {{ $i }}</span>
                                        <span style="font-size: 12px; color: #6c757d;">BKPSDM Surakarta</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('kompetensiChart').getContext('2d');
        let kompetensiChart;

        const mockData = {
            1: {
                atasan: [85, 82, 88, 84, 86, 83, 89],
                assessment: [75, 72, 83, 73, 72, 74, 79]
            },
            7: {
                atasan: [87, 84, 90, 86, 88, 85, 91],
                assessment: [77, 74, 85, 75, 74, 76, 81]
            },
            30: {
                atasan: [89, 86, 91, 88, 89, 87, 92],
                assessment: [79, 75, 86, 76, 75, 77, 82]
            },
            365: {
                atasan: [90, 87, 92, 89, 90, 88, 93],
                assessment: [80, 76, 87, 77, 76, 78, 83]
            }
        };

        const createChart = (period) => {
            if (kompetensiChart) {
                kompetensiChart.destroy();
            }

            const data = mockData[period] || mockData[365]; // Default to 1 year if period not found

            kompetensiChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Integrasi', 'Kerjasama', 'Komunikasi', 'Orientasi Hasil', 'Pelayanan Publik',
                        'Pengembangan diri', 'Toleransi'
                    ],
                    datasets: [{
                        label: 'Self Atasan',
                        data: data.atasan,
                        borderColor: '#3A58F2',
                        backgroundColor: 'rgba(54, 162, 235, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Self Assessment',
                        data: data.assessment,
                        borderColor: '#53D1EF',
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            min: 70,
                            max: 100,
                            ticks: {
                                stepSize: 5
                            }
                        }
                    }
                }
            });
        };

        // Handle period change
        document.getElementById('chartPeriod').addEventListener('change', function(e) {
            createChart(parseInt(e.target.value));
        });

        // Initial chart creation with 1 year data
        createChart(365);
    </script>
@endsection
