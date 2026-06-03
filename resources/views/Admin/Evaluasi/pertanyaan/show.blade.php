{{-- Admin: View Detail Pertanyaan --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title mb-2">
                        <i class="fas fa-eye me-3"></i>Detail Pertanyaan
                    </h1>
                    <p class="card-text mb-0">{{ $kuesioner->judul }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.kuesioner.pertanyaan.edit', [$kuesioner->id, $pertanyaan->id]) }}" class="btn btn-warning btn-lg me-2">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <a href="{{ route('admin.kuesioner.pertanyaan.index', $kuesioner->id) }}" class="btn btn-outline-light btn-lg">
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

    <!-- Pertanyaan Detail Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-question-circle me-2"></i>Detail Pertanyaan
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%" class="ps-0">ID Pertanyaan</th>
                            <td>{{ $pertanyaan->id }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0">Urutan</th>
                            <td>{{ $pertanyaan->urutan }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0">Jenis</th>
                            <td>
                                @if($pertanyaan->jenis == 'pilihan_ganda')
                                    <span class="evaluasi-badge evaluasi-badge-info">Pilihan Ganda</span>
                                @elseif($pertanyaan->jenis == 'pertanyaan_singkat')
                                    <span class="evaluasi-badge evaluasi-badge-warning">Pertanyaan Singkat</span>
                                @else
                                    <span class="evaluasi-badge evaluasi-badge-success">Ya/Tidak</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%" class="ps-0">Status</th>
                            <td>
                                @if($pertanyaan->wajib)
                                    <span class="evaluasi-badge evaluasi-badge-danger">Wajib</span>
                                @else
                                    <span class="evaluasi-badge evaluasi-badge-secondary">Opsional</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="ps-0">Dibuat</th>
                            <td>{{ $pertanyaan->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0">Diperbarui</th>
                            <td>{{ $pertanyaan->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card bg-light mb-4 mt-2">
                <div class="card-body">
                    <h5 class="card-title mb-3">Pertanyaan</h5>
                    <p class="mb-0">{{ $pertanyaan->pertanyaan }}</p>
                </div>
            </div>

            @if($pertanyaan->deskripsi)
                <div class="card border-info mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">Deskripsi/Petunjuk</h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $pertanyaan->deskripsi }}</p>
                    </div>
                </div>
            @endif

            @if($pertanyaan->jenis == 'pilihan_ganda' && $pertanyaan->opsiJawaban->isNotEmpty())
                <div class="card border mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Opsi Jawaban</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">Urutan</th>
                                        <th width="65%">Teks Opsi</th>
                                        <th width="20%">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pertanyaan->opsiJawaban->sortBy('urutan') as $index => $opsi)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $opsi->urutan }}</td>
                                            <td>{{ $opsi->teks_opsi }}</td>
                                            <td>
                                                @if($opsi->nilai !== null)
                                                    <span class="badge bg-primary">{{ $opsi->nilai }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Kuesioner Information -->
            <div class="card border mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Informasi Kuesioner</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%" class="ps-0">Judul</th>
                                    <td>{{ $kuesioner->judul }}</td>
                                </tr>
                                <tr>
                                    <th class="ps-0">Target</th>
                                    <td>
                                        @if($kuesioner->role_target == 'alumni')
                                            <span class="evaluasi-badge evaluasi-badge-success">Alumni</span>
                                        @elseif($kuesioner->role_target == 'atasan')
                                            <span class="evaluasi-badge evaluasi-badge-warning">Atasan</span>
                                        @else
                                            <span class="evaluasi-badge evaluasi-badge-info">Rekan</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%" class="ps-0">Status</th>
                                    <td>
                                        @if($kuesioner->is_active)
                                            <span class="evaluasi-badge evaluasi-badge-success">Aktif</span>
                                        @else
                                            <span class="evaluasi-badge evaluasi-badge-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="ps-0">Jumlah Pelatihan</th>
                                    <td>{{ $kuesioner->pelatihan->count() }} pelatihan</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between">
                <div>
                    <button class="btn btn-danger" onclick="confirmDeletePertanyaan({{ $kuesioner->id }}, {{ $pertanyaan->id }})">
                        <i class="fas fa-trash me-2"></i>Hapus Pertanyaan
                    </button>
                </div>
                <div>
                    <a href="{{ route('admin.kuesioner.pertanyaan.index', $kuesioner->id) }}" class="btn btn-light border me-2">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                    <a href="{{ route('admin.kuesioner.pertanyaan.edit', [$kuesioner->id, $pertanyaan->id]) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Pertanyaan
                    </a>
                </div>
            </div>
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
                <p>Apakah Anda yakin ingin menghapus pertanyaan ini?</p>
                <p class="fw-bold text-danger">Perhatian: Semua jawaban untuk pertanyaan ini juga akan dihapus!</p>
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
    function confirmDeletePertanyaan(kuesionerId, pertanyaanId) {
        document.getElementById('deletePertanyaanForm').action = 
            '{{ url("admin/kuesioner") }}/' + kuesionerId + '/pertanyaan/' + pertanyaanId;
        new bootstrap.Modal(document.getElementById('deletePertanyaanModal')).show();
    }
</script>
@endpush