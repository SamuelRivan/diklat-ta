{{-- Admin: View Detail Pelatihan & Daftar Alumni --}}
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
    .btn-group {
        display: inline-block;
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

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Header -->
    <div class="card bg-info text-white mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title mb-2">
                        <i class="fas fa-graduation-cap me-3"></i>{{ $pelatihan->nama_pelatihan }}
                    </h1>
                    <p class="card-text mb-0">Detail informasi dan statistik pelatihan</p>
                </div>
                <div>
                    <a href="{{ route('admin.evaluasi.pelatihan.createAlumni', $pelatihan->id) }}" class="btn btn-success me-2">
                        <i class="fas fa-user-plus me-2"></i>Tambah Alumni
                    </a>
                    <a href="{{ route('admin.evaluasi.pelatihan.edit', $pelatihan->id) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <a href="{{ route('admin.evaluasi.pelatihan.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    @php
        $totalAlumni = $pelatihan->alumni->count();
        $belumDinilai = $pelatihan->alumni->where('status_alumni', 'belum_dinilai')->count();
        $sedangDinilai = $pelatihan->alumni->where('status_alumni', 'sedang_dinilai')->count();
        $sudahDinilai = $pelatihan->alumni->where('status_alumni', 'sudah_dinilai')->count();
        $persentaseSelesai = $totalAlumni > 0 ? round(($sudahDinilai / $totalAlumni) * 100, 1) : 0;
    @endphp

    <!-- Detail Information -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Pelatihan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Jenis Pelatihan</strong></td>
                                    <td>:</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $pelatihan->jenisPelatihan->jenis_pelatihan ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Pelatihan</strong></td>
                                    <td>:</td>
                                    <td>{{ $pelatihan->nama_pelatihan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Alumni</strong></td>
                                    <td>:</td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $pelatihan->alumni->count() }} Orang
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Tanggal Dibuat</strong></td>
                                    <td>:</td>
                                    <td>{{ $pelatihan->created_at->format('d F Y, H:i') }} WIB</td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir Diupdate</strong></td>
                                    <td>:</td>
                                    <td>{{ $pelatihan->updated_at->format('d F Y, H:i') }} WIB</td>
                                </tr>
                                <tr>
                                    <td><strong>Progress Evaluasi</strong></td>
                                    <td>:</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" 
                                                 style="width: {{ $persentaseSelesai }}%" 
                                                 aria-valuenow="{{ $persentaseSelesai }}" 
                                                 aria-valuemin="0" aria-valuemax="100">
                                                {{ $persentaseSelesai }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.evaluasi.pelatihan.edit', $pelatihan->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Pelatihan
                        </a>
                        <button class="btn btn-info" onclick="window.print()">
                            <i class="fas fa-print me-2"></i>Cetak Detail
                        </button>
                        <button class="btn btn-success" onclick="exportExcel()">
                            <i class="fas fa-file-excel me-2"></i>Export Excel
                        </button>
                        @if($totalAlumni > 0)
                        <button class="btn btn-primary" onclick="kirimNotifikasi()">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Notifikasi
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Daftar Alumni -->
    @if($pelatihan->alumni->count() > 0)
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-users me-2"></i>Daftar Alumni ({{ $pelatihan->alumni->count() }} orang)
                </h5>
                <div>
                    <select class="form-select form-select-sm" id="statusFilter" onchange="filterTable()" style="width: auto;">
                        <option value="">Semua Status</option>
                        <option value="belum_dinilai">Belum Dinilai</option>
                        <option value="sedang_dinilai">Sedang Dinilai</option>
                        <option value="sudah_dinilai">Sudah Dinilai</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="alumniTable">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Unit Kerja</th>
                            <th>Status Evaluasi</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelatihan->alumni as $index => $alumni)
                        <tr data-status="{{ $alumni->status_alumni }}">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <code class="text-primary">{{ $alumni->pegawai->nip ?? '-' }}</code>
                            </td>
                            <td>
                                <strong>{{ $alumni->pegawai->nama ?? '-' }}</strong>
                            </td>
                            <td>{{ $alumni->pegawai->jabatan ?? '-' }}</td>
                            <td>{{ $alumni->pegawai->unit_kerja ?? '-' }}</td>
                            <td>
                                @switch($alumni->status_alumni)
                                    @case('belum_dinilai')
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-hourglass-start me-1"></i>Belum Dinilai
                                        </span>
                                        @break
                                    @case('sedang_dinilai')
                                        <span class="badge bg-warning">
                                            <i class="fas fa-clock me-1"></i>Sedang Dinilai
                                        </span>
                                        @break
                                    @case('sudah_dinilai')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Sudah Dinilai
                                        </span>
                                        @break
                                    @default
                                        <span class="badge bg-light text-dark">-</span>
                                @endswitch
                            </td>
                            <td>
                                @if($alumni->tanggal_mulai_pelatihan)
                                    {{ \Carbon\Carbon::parse($alumni->tanggal_mulai_pelatihan)->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($alumni->tanggal_selesai_pelatihan)
                                    {{ \Carbon\Carbon::parse($alumni->tanggal_selesai_pelatihan)->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                              <a href="{{ route('admin.evaluasi.pelatihan.alumni.answers', ['pelatihanId' => $pelatihan->id, 'alumniId' => $alumni->alumni_id]) }}" 
                                class="btn btn-outline-primary btn-sm" title="Lihat Jawaban Kuesioner">
                                 <i class="fas fa-file-alt"></i>
                              </a>
                              
                              <!-- Dropdown untuk ubah status -->
                              <div class="btn-group" role="group">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <div class="text-center py-5 text-muted">
                <i class="fas fa-users fa-4x mb-3"></i>
                <h5>Belum Ada Alumni</h5>
                <p>Pelatihan ini belum memiliki data alumni. Silakan tambahkan alumni terlebih dahulu.</p>
                <a href="{{ route('admin.evaluasi.pelatihan.createAlumni', $pelatihan->id) }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Alumni
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
// Filter table by status
function filterTable() {
    const filter = document.getElementById('statusFilter').value;
    const table = document.getElementById('alumniTable');
    const rows = table.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const status = row.getAttribute('data-status');
        if (filter === '' || status === filter) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// View alumni detail
function viewDetail(alumniId) {
    window.location.href = "{{ route('evaluasi.viewalumni', ':id') }}".replace(':id', alumniId);
}

// Export to Excel
function exportExcel() {
    alert('Export Excel functionality akan diimplementasi');
}

// Send notification
function kirimNotifikasi() {
    if(confirm('Apakah Anda yakin ingin mengirim notifikasi ke semua alumni?')) {
        alert('Notifikasi berhasil dikirim! (simulasi)');
    }
}
</script>

@endsection