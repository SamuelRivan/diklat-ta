{{-- Admin: View Daftar Pelatihan (Pascadiklat) --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title mb-2">
                        <i class="fas fa-graduation-cap me-3"></i>Data Pelatihan
                    </h1>
                    <p class="card-text mb-0">Kelola data pelatihan untuk evaluasi pasca diklat</p>
                </div>
                <a href="{{ route('admin.evaluasi.pelatihan.create') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-plus me-2"></i>Tambah Pelatihan
                </a>
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

    <!-- Statistics Cards -->
    {{-- <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-clipboard-list fa-2x"></i>
                    </div>
                    <h3 class="card-title">{{ $pelatihans->count() }}</h3>
                    <p class="card-text">Total Pelatihan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h3 class="card-title">{{ $pelatihans->sum(function($p) { return $p->alumni->count(); }) }}</h3>
                    <p class="card-text">Total Alumni</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-tasks fa-2x"></i>
                    </div>
                    <h3 class="card-title">{{ $pelatihans->sum(function($p) { return $p->alumni->where('status_alumni', 'sudah_dinilai')->count(); }) }}</h3>
                    <p class="card-text">Sudah Dinilai</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-danger text-white">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-hourglass-half fa-2x"></i>
                    </div>
                    <h3 class="card-title">{{ $pelatihans->sum(function($p) { return $p->alumni->where('status_alumni', 'belum_dinilai')->count(); }) }}</h3>
                    <p class="card-text">Belum Dinilai</p>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Search and Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-table me-2"></i>Daftar Pelatihan
            </h5>
        </div>
        <div class="card-body">
            <!-- Search Box -->
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control" 
                           placeholder="Cari nama pelatihan atau jenis pelatihan...">
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="pelatihanTable">
                    <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Jenis Pelatihan</th>
                                <th>Nama Pelatihan</th>
                                <th>Alumni</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelatihans as $index => $pelatihan)
                                <tr>
                                    <td><span class="fw-bold text-muted">{{ $index + 1 }}</span></td>
                                    <td>
                                        <span class="evaluasi-badge evaluasi-badge-info">
                                            {{ $pelatihan->jenisPelatihan->jenis_pelatihan ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $pelatihan->nama_pelatihan }}</div>
                                    </td>
                                    <td>
                                        <span class="evaluasi-badge evaluasi-badge-secondary">
                                            <i class="fas fa-users me-1"></i>{{ $pelatihan->alumni->count() }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $pelatihan->created_at->format('d/m/Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.evaluasi.pelatihan.show', $pelatihan->id) }}" 
                                               class="btn btn-info btn-sm" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.evaluasi.pelatihan.createAlumni', $pelatihan->id) }}" 
                                               class="btn btn-success btn-sm" title="Tambah Alumni">
                                                <i class="fas fa-user-plus"></i>
                                            </a>
                                            <a href="{{ route('admin.evaluasi.pelatihan.edit', $pelatihan->id) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" 
                                                    onclick="confirmDelete({{ $pelatihan->id }})" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                                            <h5>Belum ada data pelatihan</h5>
                                            <p>Mulai dengan menambahkan pelatihan pertama Anda</p>
                                            <a href="{{ route('admin.evaluasi.pelatihan.create') }}" class="btn btn-primary mt-3">
                                                <i class="fas fa-plus me-2"></i>Tambah Pelatihan
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data pelatihan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#pelatihanTable tbody tr');
        
        rows.forEach(function(row) {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Delete confirmation
    function confirmDelete(id) {
    // Use named route to ensure correct URL generation (works with subfolders)
    var form = document.getElementById('deleteForm');
    form.action = "{{ route('admin.evaluasi.pelatihan.destroy', ['id' => ':id']) }}".replace(':id', id);
        var modalEl = document.getElementById('deleteModal');
        var modal = new bootstrap.Modal(modalEl);
        modal.show();
    }
</script>
@endpush