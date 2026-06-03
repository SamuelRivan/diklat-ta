{{-- Admin: View Rekap Jawaban Alumni, Atasan, & Rekan --}}
@extends('layouts.app')

@section('content')
<style>
    .dropdown-item form {
        margin: 0;
    }
    .dropdown-item button {
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        padding: 0.25rem 1rem;
        color: #212529;
    }
    .dropdown-item button:hover {
        background-color: #f8f9fa;
    }
</style>

<div class="container mt-4">
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><i class="fas fa-user-graduate me-2"></i>Jawaban Kuesioner Alumni</h2>
        <div>
            <a href="{{ route('admin.evaluasi.pelatihan.show', $pelatihan->id) }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Informasi Alumni</h5>
            <div class="row">
                <div class="col-md-4">
                    <table class="table table-sm table-borderless mb-0">
                        <tr><th width="40%">Nama</th><td>{{ $alumni->pegawai->nama ?? '-' }}</td></tr>
                        <tr><th>NIP</th><td>{{ $alumni->pegawai->nip ?? '-' }}</td></tr>
                        <tr><th>Jabatan</th><td>{{ $alumni->pegawai->jabatan ?? '-' }}</td></tr>
                        <tr><th>Unit Kerja</th><td>{{ $alumni->pegawai->unit_kerja ?? '-' }}</td></tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-sm table-borderless mb-0">
                        <tr><th width="50%">Tanggal Mulai</th><td>{{ $alumni->tanggal_mulai_pelatihan ? \Carbon\Carbon::parse($alumni->tanggal_mulai_pelatihan)->format('d/m/Y') : '-' }}</td></tr>
                        <tr><th>Tanggal Selesai</th><td>{{ $alumni->tanggal_selesai_pelatihan ? \Carbon\Carbon::parse($alumni->tanggal_selesai_pelatihan)->format('d/m/Y') : '-' }}</td></tr>
                        <tr>
                            <th>Status Alumni</th>
                            <td>
                                @switch($alumni->status_alumni)
                                    @case('belum_dinilai')
                                        <span class="badge bg-secondary">Belum Dinilai</span>
                                        @break
                                    @case('sedang_dinilai')
                                        <span class="badge bg-warning">Sedang Dinilai</span>
                                        @break
                                    @case('sudah_dinilai')
                                        <span class="badge bg-success">Sudah Dinilai</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $alumni->status_alumni }}</span>
                                @endswitch
                                
                                <!-- Dropdown untuk ubah status -->
                                <div class="btn-group ms-2" role="group">
                                    <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" 
                                            data-bs-toggle="dropdown" aria-expanded="false" title="Ubah Status">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form method="POST" action="{{ route('admin.evaluasi.pelatihan.updateAlumniStatus', ['pelatihanId' => $pelatihan->id, 'alumniId' => $alumni->alumni_id]) }}" 
                                                  onsubmit="return confirm('Ubah status menjadi Sedang Dinilai?')">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="sedang_dinilai">
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-clock text-warning"></i> Sedang Dinilai
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('admin.evaluasi.pelatihan.updateAlumniStatus', ['pelatihanId' => $pelatihan->id, 'alumniId' => $alumni->alumni_id]) }}" 
                                                  onsubmit="return confirm('Ubah status menjadi Sudah Dinilai?')">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="sudah_dinilai">
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-check-circle text-success"></i> Sudah Dinilai
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('admin.evaluasi.pelatihan.updateAlumniStatus', ['pelatihanId' => $pelatihan->id, 'alumniId' => $alumni->alumni_id]) }}" 
                                                  onsubmit="return confirm('Ubah status menjadi Belum Dinilai?')">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="belum_dinilai">
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-hourglass-start text-secondary"></i> Belum Dinilai
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-sm table-borderless mb-0">
                        <tr><th colspan="2">Evaluator</th></tr>
                        <tr><td>Atasan</td><td>
                            @if($alumni->atasan->count())
                                @foreach($alumni->atasan as $i=>$atas)
                                    <span class="badge bg-primary mb-1">{{ $atas->pegawai->nama ?? 'Atasan '.$i+1 }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">Belum dipilih</span>
                            @endif
                        </td></tr>
                        <tr><td>Rekan Kerja</td><td>
                            @if($alumni->rekanKerja)
                                <span class="badge bg-success">{{ $alumni->rekanKerja->pegawai->nama ?? '-' }}</span>
                            @else
                                <span class="text-muted">Belum dipilih</span>
                            @endif
                        </td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($kuesioners->count() === 0)
        <div class="alert alert-warning">Belum ada kuesioner yang terhubung ke pelatihan ini.</div>
    @endif

    @foreach($kuesioners as $k)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">{{ $k->judul }}</h5>
                    <small class="text-muted">Diisi oleh {{ $k->role_target }}</small>
                </div>
            </div>
            <div class="card-body">
                @foreach($k->pertanyaan as $p)
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title font-weight-bold">{{ $p->urutan }}. {{ $p->pertanyaan ?? $p->teks_pertanyaan }}</h6>
                            
                            {{-- Jawaban Alumni/User Ini --}}
                            <div class="mb-3 p-2 bg-light rounded">
                                <strong>Jawaban {{ $alumni->pegawai->nama }}:</strong>
                                @php
                                    // Cari jawaban user ini
                                    $jawab = null;
                                    if($k->role_target == 'alumni') $jawab = ($jawabanAlumni->get($k->id) ?? collect())->firstWhere('pertanyaan_id', $p->id);
                                    // Untuk atasan/rekan, logika lebih kompleks karena bisa multiple atasan. 
                                    // Simplifikasi: jika role target bukan alumni, kita skip highlight jawaban spesifik untuk chart visual, 
                                    // tapi tetap tampilkan list jawaban mereka di bawah (seperti kode sebelumnya).
                                @endphp

                                @if($k->role_target == 'alumni')
                                    @if($jawab)
                                        @if($jawab->opsiJawaban)
                                            <span class="badge bg-primary">{{ $jawab->opsiJawaban->teks_opsi }}</span>
                                        @else
                                            <span class="text-dark">{{ $jawab->jawaban_teks }}</span>
                                        @endif
                                    @else
                                        <span class="text-muted">(Belum dijawab)</span>
                                    @endif
                                @else
                                    <small class="text-muted">Lihat detail jawaban individu di bawah.</small>
                                @endif
                            </div>

                            {{-- Statistik & Chart (Hanya untuk Pilihan Ganda) --}}
                            @if($p->jenis == 'pilihan_ganda' || $p->opsiJawaban->count() > 0)
                                @php
                                    $stats = $globalStats->get($p->id);
                                    $chartId = 'chart_' . $p->id;
                                    $labels = [];
                                    $data = [];
                                    $colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69'];
                                    
                                    if($stats) {
                                        foreach($p->opsiJawaban as $idx => $opsi) {
                                            $statItem = $stats->firstWhere('opsi_jawaban_id', $opsi->id);
                                            $count = $statItem ? $statItem->total : 0;
                                            $labels[] = \Illuminate\Support\Str::limit($opsi->teks_opsi, 20); // Limit text for label
                                            $data[] = $count;
                                        }
                                    }
                                @endphp
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="chart-container" style="position: relative; height:200px; width:100%">
                                            <canvas id="{{ $chartId }}"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-sm table-bordered mt-2">
                                            <thead class="table-light">
                                                <tr><th>Opsi Jawaban</th><th class="text-center">Jumlah</th><th class="text-center">%</th></tr>
                                            </thead>
                                            <tbody>
                                                @php $totalRespondents = array_sum($data); @endphp
                                                @foreach($p->opsiJawaban as $idx => $opsi)
                                                    @php 
                                                        $count = $data[$idx] ?? 0;
                                                        $percentage = $totalRespondents > 0 ? round(($count / $totalRespondents) * 100, 1) : 0;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $opsi->teks_opsi }}</td>
                                                        <td class="text-center">{{ $count }}</td>
                                                        <td class="text-center">{{ $percentage }}%</td>
                                                    </tr>
                                                @endforeach
                                                <tr class="fw-bold bg-light">
                                                    <td>Total Responden</td>
                                                    <td class="text-center">{{ $totalRespondents }}</td>
                                                    <td class="text-center">100%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        var ctx = document.getElementById("{{ $chartId }}").getContext('2d');
                                        var myChart = new Chart(ctx, {
                                            type: 'doughnut',
                                            data: {
                                                labels: {!! json_encode($labels) !!},
                                                datasets: [{
                                                    data: {!! json_encode($data) !!},
                                                    backgroundColor: {!! json_encode(array_slice($colors, 0, count($data))) !!},
                                                    hoverBackgroundColor: {!! json_encode(array_slice($colors, 0, count($data))) !!},
                                                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                                                }],
                                            },
                                            options: {
                                                maintainAspectRatio: false,
                                                tooltips: {
                                                    backgroundColor: "rgb(255,255,255)",
                                                    bodyFontColor: "#858796",
                                                    borderColor: '#dddfeb',
                                                    borderWidth: 1,
                                                    xPadding: 15,
                                                    yPadding: 15,
                                                    displayColors: false,
                                                    caretPadding: 10,
                                                },
                                                legend: {
                                                    display: true,
                                                    position: 'right',
                                                    labels: {
                                                        boxWidth: 10,
                                                        fontSize: 10
                                                    }
                                                },
                                                cutoutPercentage: 70,
                                            },
                                        });
                                    });
                                </script>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
</div>
@endsection