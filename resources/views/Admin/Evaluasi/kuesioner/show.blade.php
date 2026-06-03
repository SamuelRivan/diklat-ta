{{-- Admin: View Detail Kuesioner & Pertanyaan --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title mb-2">
                        <i class="fas fa-clipboard-check me-3"></i>Detail Kuesioner
                    </h1>
                    <p class="card-text mb-0">{{ $kuesioner->judul }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.kuesioner.edit', $kuesioner->id) }}" class="btn btn-warning btn-lg me-2">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <a href="{{ route('admin.kuesioner.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
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

    <!-- Info Cards -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Kuesioner
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Judul</div>
                        <div class="col-md-9">{{ $kuesioner->judul }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Deskripsi</div>
                        <div class="col-md-9">
                            {{ $kuesioner->deskripsi ?? 'Tidak ada deskripsi' }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Target Responden</div>
                        <div class="col-md-9">
                            @if($kuesioner->role_target == 'alumni')
                                <span class="evaluasi-badge evaluasi-badge-success">Alumni</span>
                            @elseif($kuesioner->role_target == 'atasan')
                                <span class="evaluasi-badge evaluasi-badge-warning">Atasan</span>
                            @else
                                <span class="evaluasi-badge evaluasi-badge-info">Rekan</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Status</div>
                        <div class="col-md-9">
                            @if($kuesioner->is_active)
                                <span class="evaluasi-badge evaluasi-badge-success">Aktif</span>
                            @else
                                <span class="evaluasi-badge evaluasi-badge-secondary">Nonaktif</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Tanggal Dibuat</div>
                        <div class="col-md-9">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $kuesioner->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 fw-bold">Terakhir Diperbarui</div>
                        <div class="col-md-9">
                            <i class="fas fa-calendar-check me-1"></i>
                            {{ $kuesioner->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Statistik
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="display-4 fw-bold text-primary">{{ $kuesioner->pertanyaan->count() }}</div>
                        <p>Total Pertanyaan</p>
                    </div>
                    
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Pertanyaan Pilihan Ganda
                            <span class="badge bg-primary rounded-pill">{{ $kuesioner->pertanyaan->where('jenis', 'pilihan_ganda')->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Pertanyaan Singkat
                            <span class="badge bg-primary rounded-pill">{{ $kuesioner->pertanyaan->where('jenis', 'pertanyaan_singkat')->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Pertanyaan Ya/Tidak
                            <span class="badge bg-primary rounded-pill">{{ $kuesioner->pertanyaan->where('jenis', 'ya_tidak')->count() }}</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.kuesioner.pertanyaan.index', $kuesioner->id) }}" class="btn btn-primary w-100">
                        <i class="fas fa-list-check me-2"></i>Kelola Pertanyaan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Pertanyaan List -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-question-circle me-2"></i>Daftar Pertanyaan
            </h5>
            <a href="{{ route('admin.kuesioner.pertanyaan.create', $kuesioner->id) }}" class="btn btn-sm btn-success">
                <i class="fas fa-plus me-2"></i>Tambah Pertanyaan
            </a>
        </div>
        <div class="card-body">
            @if($kuesioner->pertanyaan->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-question-circle fa-3x mb-3"></i>
                    <h5>Belum ada pertanyaan</h5>
                    <p>Mulai dengan menambahkan pertanyaan pertama untuk kuesioner ini</p>
                    <a href="{{ route('admin.kuesioner.pertanyaan.create', $kuesioner->id) }}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus me-2"></i>Tambah Pertanyaan
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="5%">Urutan</th>
                                <th width="45%">Pertanyaan</th>
                                <th width="15%">Jenis</th>
                                <th width="10%">Wajib</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kuesioner->pertanyaan->sortBy('urutan') as $index => $pertanyaan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pertanyaan->urutan }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $pertanyaan->pertanyaan }}</div>
                                        
                                        @if($pertanyaan->jenis == 'pilihan_ganda' && $pertanyaan->opsiJawaban->isNotEmpty())
                                            <div class="mt-2">
                                                <small class="text-muted d-block">Opsi Jawaban:</small>
                                                <ul class="small mb-0">
                                                    @foreach($pertanyaan->opsiJawaban->sortBy('urutan') as $opsi)
                                                        <li>{{ $opsi->teks_opsi }} @if($opsi->nilai !== null) <span class="text-muted">(Nilai: {{ $opsi->nilai }})</span> @endif</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($pertanyaan->jenis == 'pilihan_ganda')
                                            <span class="evaluasi-badge evaluasi-badge-info">Pilihan Ganda</span>
                                        @elseif($pertanyaan->jenis == 'pertanyaan_singkat')
                                            <span class="evaluasi-badge evaluasi-badge-warning">Pertanyaan Singkat</span>
                                        @else
                                            <span class="evaluasi-badge evaluasi-badge-success">Ya/Tidak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($pertanyaan->wajib)
                                            <span class="evaluasi-badge evaluasi-badge-danger">Wajib</span>
                                        @else
                                            <span class="evaluasi-badge evaluasi-badge-secondary">Opsional</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.kuesioner.pertanyaan.edit', [$kuesioner->id, $pertanyaan->id]) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.kuesioner.pertanyaan.show', [$kuesioner->id, $pertanyaan->id]) }}" 
                                               class="btn btn-info btn-sm" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" 
                                                    onclick="confirmDeletePertanyaan({{ $kuesioner->id }}, {{ $pertanyaan->id }})" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Pertanyaan -->
<div class="modal fade" id="deletePertanyaanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus pertanyaan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deletePertanyaanForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .evaluasi-badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }
    .evaluasi-badge-info {
        color: #fff;
        background-color: #0dcaf0;
    }
    .evaluasi-badge-secondary {
        color: #fff;
        background-color: #6c757d;
    }
    .evaluasi-badge-success {
        color: #fff;
        background-color: #198754;
    }
    .evaluasi-badge-warning {
        color: #000;
        background-color: #ffc107;
    }
    .evaluasi-badge-danger {
        color: #fff;
        background-color: #dc3545;
    }
</style>
@endpush

@push('scripts')
<script>
    // Delete confirmation
    function confirmDeletePertanyaan(kuesionerId, pertanyaanId) {
        document.getElementById('deletePertanyaanForm').action = 
            '{{ url("admin/kuesioner") }}/' + kuesionerId + '/pertanyaan/' + pertanyaanId;
        new bootstrap.Modal(document.getElementById('deletePertanyaanModal')).show();
    }
</script>
@endpush