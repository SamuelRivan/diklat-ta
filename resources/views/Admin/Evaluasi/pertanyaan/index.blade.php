{{-- Admin: View Daftar Pertanyaan Kuesioner --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title mb-2">
                        <i class="fas fa-list-check me-3"></i>Pertanyaan Kuesioner
                    </h1>
                    <p class="card-text mb-0">{{ $kuesioner->judul }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.kuesioner.pertanyaan.create', $kuesioner->id) }}" class="btn btn-light btn-lg me-2">
                        <i class="fas fa-plus me-2"></i>Tambah Pertanyaan
                    </a>
                    <a href="{{ route('admin.kuesioner.show', $kuesioner->id) }}" class="btn btn-outline-light btn-lg">
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

    <!-- Info Card -->
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="fas fa-info-circle me-2"></i>Informasi Kuesioner
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="fw-bold">Judul:</label>
                        <p>{{ $kuesioner->judul }}</p>
                    </div>
                    <div>
                        <label class="fw-bold">Target Responden:</label>
                        <p>
                            @if($kuesioner->role_target == 'alumni')
                                <span class="evaluasi-badge evaluasi-badge-success">Alumni</span>
                            @elseif($kuesioner->role_target == 'atasan')
                                <span class="evaluasi-badge evaluasi-badge-warning">Atasan</span>
                            @else
                                <span class="evaluasi-badge evaluasi-badge-info">Rekan</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="fw-bold">Status:</label>
                        <p>
                            @if($kuesioner->is_active)
                                <span class="evaluasi-badge evaluasi-badge-success">Aktif</span>
                            @else
                                <span class="evaluasi-badge evaluasi-badge-secondary">Nonaktif</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="fw-bold">Jumlah Pertanyaan:</label>
                        <p>{{ $pertanyaans->total() }} pertanyaan</p>
                    </div>
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
            <div>
                <button class="btn btn-outline-primary btn-sm me-2" id="urutanBtn" title="Sesuaikan Urutan Pertanyaan">
                    <i class="fas fa-sort me-1"></i> Atur Urutan
                </button>
                <a href="{{ route('admin.kuesioner.pertanyaan.create', $kuesioner->id) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus me-2"></i>Tambah Pertanyaan
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($pertanyaans->isEmpty())
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
                    <table class="table table-hover" id="pertanyaanTable">
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
                        <tbody id="sortablePertanyaan">
                            @foreach($pertanyaans as $index => $pertanyaan)
                                <tr data-id="{{ $pertanyaan->id }}" class="{{ $index % 2 == 0 ? 'table-light' : '' }}">
                                    <td>{{ ($pertanyaans->currentPage() - 1) * $pertanyaans->perPage() + $index + 1 }}</td>
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
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $pertanyaans->links() }}
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

<!-- Modal Atur Urutan -->
<div class="modal fade" id="urutanModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-sort me-2"></i>Atur Urutan Pertanyaan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Tarik dan geser pertanyaan untuk mengubah urutannya.</p>
                
                <ul class="list-group" id="sortableList">
                    @foreach($pertanyaans->sortBy('urutan') as $pertanyaan)
                        <li class="list-group-item" data-id="{{ $pertanyaan->id }}">
                            <div class="d-flex align-items-center">
                                <div class="me-3 handle">
                                    <i class="fas fa-grip-vertical text-secondary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ $pertanyaan->pertanyaan }}</div>
                                    <small class="text-muted">
                                        @if($pertanyaan->jenis == 'pilihan_ganda')
                                            Pilihan Ganda
                                        @elseif($pertanyaan->jenis == 'pertanyaan_singkat')
                                            Pertanyaan Singkat
                                        @else
                                            Ya/Tidak
                                        @endif
                                    </small>
                                </div>
                                <div class="ms-3 order-badge">
                                    <span class="badge bg-primary">{{ $pertanyaan->urutan }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveUrutan">
                    <i class="fas fa-save me-2"></i>Simpan Urutan
                </button>
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
    .handle {
        cursor: grab;
    }
    .handle:active {
        cursor: grabbing;
    }
    #sortableList .list-group-item:hover {
        background-color: #f8f9fa;
    }
    #sortableList .ui-sortable-helper {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        background-color: #fff;
    }
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    // Delete confirmation
    function confirmDeletePertanyaan(kuesionerId, pertanyaanId) {
        document.getElementById('deletePertanyaanForm').action = 
            '{{ url("admin/kuesioner") }}/' + kuesionerId + '/pertanyaan/' + pertanyaanId;
        new bootstrap.Modal(document.getElementById('deletePertanyaanModal')).show();
    }

    // Sortable for reordering
    $(document).ready(function() {
        // Show urutan modal
        $('#urutanBtn').click(function() {
            new bootstrap.Modal(document.getElementById('urutanModal')).show();
        });

        // Make the list sortable
        $('#sortableList').sortable({
            handle: '.handle',
            update: function() {
                updateOrderBadges();
            }
        });

        // Update order badges after sorting
        function updateOrderBadges() {
            $('#sortableList li').each(function(index) {
                $(this).find('.order-badge .badge').text(index + 1);
            });
        }

        // Save new order
        $('#saveUrutan').click(function() {
            const pertanyaanIds = [];
            $('#sortableList li').each(function() {
                pertanyaanIds.push($(this).data('id'));
            });

            $.ajax({
                url: '{{ route("admin.kuesioner.pertanyaan.updateUrutan", $kuesioner->id) }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    pertanyaan_ids: pertanyaanIds
                },
                success: function(response) {
                    bootstrap.Modal.getInstance(document.getElementById('urutanModal')).hide();
                    window.location.reload();
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat menyimpan urutan.');
                }
            });
        });
    });
</script>
@endpush