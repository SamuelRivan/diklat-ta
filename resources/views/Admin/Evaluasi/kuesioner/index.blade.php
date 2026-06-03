{{-- Admin: View Daftar Template Kuesioner --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title mb-2">
                        <i class="fas fa-clipboard-check me-3"></i>Data Kuesioner
                    </h1>
                    <p class="card-text mb-0">Kelola data kuesioner untuk evaluasi pasca diklat</p>
                </div>
                <a href="{{ route('admin.kuesioner.create') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-plus me-2"></i>Tambah Kuesioner
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
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-list-alt fa-2x"></i>
                    </div>
                    <h3 class="card-title">{{ $kuesioners->count() }}</h3>
                    <p class="card-text">Total Kuesioner</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-user-graduate fa-2x"></i>
                    </div>
                    <h3 class="card-title">{{ $kuesioners->where('role_target', 'alumni')->count() }}</h3>
                    <p class="card-text">Kuesioner Alumni</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-user-tie fa-2x"></i>
                    </div>
                    <h3 class="card-title">{{ $kuesioners->where('role_target', 'atasan')->count() }}</h3>
                    <p class="card-text">Kuesioner Atasan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-secondary text-white">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-user-friends fa-2x"></i>
                    </div>
                    <h3 class="card-title">{{ $kuesioners->where('role_target', 'rekan')->count() }}</h3>
                    <p class="card-text">Kuesioner Rekan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-table me-2"></i>Daftar Kuesioner
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
                           placeholder="Cari judul kuesioner atau role target...">
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="kuesionerTable">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Role Target</th>
                            <th>Jumlah Pertanyaan</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="kuesionerBody">
                        <!-- Rows rendered by JS -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination (right-aligned, client-side) -->
            <div class="d-flex justify-content-end mt-3">
                <nav>
                    <ul class="pagination mb-0" id="pagination">
                        <!-- pages rendered by JS -->
                    </ul>
                </nav>
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
                Apakah Anda yakin ingin menghapus kuesioner ini? Semua pertanyaan terkait juga akan dihapus.
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
    // Client-side rendering + search + pagination
    @php
        $__kuesioners_for_js = [];
        foreach($kuesioners as $k) {
            $__kuesioners_for_js[] = [
                'id' => $k->id,
                'judul' => $k->judul,
                'deskripsi' => $k->deskripsi,
                'role_target' => $k->role_target,
                'pertanyaan_count' => $k->pertanyaan->count(),
                'is_active' => (bool) $k->is_active,
                'created_at' => $k->created_at->format('d/m/Y'),
            ];
        }
    @endphp
    const kuesioners = @json($__kuesioners_for_js);

    const perPage = 10; // simple, change as needed
    let currentPage = 1;
    let filtered = kuesioners.slice();

    const tbody = document.getElementById('kuesionerBody');
    const pagination = document.getElementById('pagination');
    const searchInput = document.getElementById('searchInput');

    function renderRows() {
        tbody.innerHTML = '';
        const start = (currentPage - 1) * perPage;
        const pageItems = filtered.slice(start, start + perPage);

        if (pageItems.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                            <h5>Belum ada data kuesioner</h5>
                            <p>Mulai dengan menambahkan kuesioner pertama Anda</p>
                            <a href="{{ route('admin.kuesioner.create') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-plus me-2"></i>Tambah Kuesioner
                            </a>
                        </div>
                    </td>
                </tr>
            `;
            renderPagination();
            return;
        }

        pageItems.forEach((k, idx) => {
            const no = start + idx + 1;
            const roleBadge = k.role_target === 'alumni' ? '<span class="evaluasi-badge evaluasi-badge-success">Alumni</span>' : (k.role_target === 'atasan' ? '<span class="evaluasi-badge evaluasi-badge-warning">Atasan</span>' : '<span class="evaluasi-badge evaluasi-badge-info">Rekan</span>');
            const statusBadge = k.is_active ? '<span class="evaluasi-badge evaluasi-badge-success">Aktif</span>' : '<span class="evaluasi-badge evaluasi-badge-secondary">Nonaktif</span>';

            const row = document.createElement('tr');
            row.innerHTML = `
                <td><span class="fw-bold text-muted">${no}</span></td>
                <td>
                    <div class="fw-bold">${escapeHtml(k.judul)}</div>
                    <small class="text-muted">${escapeHtml(limitText(k.deskripsi || '', 50))}</small>
                </td>
                <td>${roleBadge}</td>
                <td>
                    <span class="evaluasi-badge evaluasi-badge-secondary">
                        <i class="fas fa-question-circle me-1"></i>${k.pertanyaan_count}
                    </span>
                </td>
                <td>${statusBadge}</td>
                <td>
                    <small class="text-muted"><i class="fas fa-calendar me-1"></i>${k.created_at}</small>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="${routeUrl('admin.kuesioner.show', k.id)}" class="btn btn-info btn-sm" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                        <a href="${routeUrl('admin.kuesioner.pertanyaan.index', k.id)}" class="btn btn-success btn-sm" title="Kelola Pertanyaan"><i class="fas fa-list-check"></i></a>
                        <a href="${routeUrl('admin.kuesioner.assign.form', k.id)}" class="btn btn-primary btn-sm" title="Assign ke Pelatihan"><i class="fas fa-link"></i></a>
                        <a href="${routeUrl('admin.kuesioner.edit', k.id)}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(${k.id})" title="Hapus"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            `;

            tbody.appendChild(row);
        });

        renderPagination();
    }

    function renderPagination() {
        pagination.innerHTML = '';
        const totalPages = Math.ceil(filtered.length / perPage) || 1;

        // prev
        const prevLi = document.createElement('li');
        prevLi.className = 'page-item ' + (currentPage === 1 ? 'disabled' : '');
        prevLi.innerHTML = `<a class="page-link" href="#" tabindex="-1">&laquo;</a>`;
        prevLi.addEventListener('click', (e) => { e.preventDefault(); if (currentPage>1) { currentPage--; renderRows(); }});
        pagination.appendChild(prevLi);

        // pages (keep simple: show up to 5 pages centered)
        const maxPagesToShow = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow/2));
        let endPage = Math.min(totalPages, startPage + maxPagesToShow -1);
        if (endPage - startPage < maxPagesToShow -1) {
            startPage = Math.max(1, endPage - maxPagesToShow +1);
        }

        for (let p = startPage; p <= endPage; p++) {
            const li = document.createElement('li');
            li.className = 'page-item ' + (p === currentPage ? 'active' : '');
            li.innerHTML = `<a class="page-link" href="#">${p}</a>`;
            li.addEventListener('click', (e) => { e.preventDefault(); currentPage = p; renderRows(); });
            pagination.appendChild(li);
        }

        // next
        const nextLi = document.createElement('li');
        nextLi.className = 'page-item ' + (currentPage === totalPages ? 'disabled' : '');
        nextLi.innerHTML = `<a class="page-link" href="#">&raquo;</a>`;
        nextLi.addEventListener('click', (e) => { e.preventDefault(); if (currentPage<totalPages) { currentPage++; renderRows(); }});
        pagination.appendChild(nextLi);
    }

    function escapeHtml(text) {
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function limitText(text, limit) {
        if (text.length <= limit) return text;
        return text.slice(0, limit - 3) + '...';
    }

    searchInput.addEventListener('input', function() {
        const q = this.value.trim().toLowerCase();
        filtered = kuesioners.filter(k => {
            return (k.judul || '').toLowerCase().includes(q) || (k.deskripsi || '').toLowerCase().includes(q) || (k.role_target || '').toLowerCase().includes(q);
        });
        currentPage = 1;
        renderRows();
    });

    // helpers to build routes - uses Blade to output base routes
    function routeUrl(name, id) {
        // Known route patterns used in this view
        const patterns = {
            'admin.kuesioner.show': '{{ url('admin/kuesioner') }}' + '/:id',
            'admin.kuesioner.pertanyaan.index': '{{ url('admin/kuesioner') }}' + '/:id/pertanyaan',
            'admin.kuesioner.assign.form': '{{ url('admin/kuesioner') }}' + '/:id/assign',
            'admin.kuesioner.edit': '{{ url('admin/kuesioner') }}' + '/:id/edit',
        };
        const pattern = patterns[name] || '#';
        return pattern.replace(':id', id);
    }

    // Delete confirmation (sets form action and shows modal)
    function confirmDelete(id) {
        document.getElementById('deleteForm').action = '{{ url("admin/kuesioner") }}/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    // initial render
    renderRows();
</script>
@endpush