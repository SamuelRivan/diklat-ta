{{-- Admin: View Edit Pelatihan --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="card bg-warning text-dark mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title mb-2">
                        <i class="fas fa-edit me-3"></i>Edit Pelatihan
                    </h1>
                    <p class="card-text mb-0">Ubah data pelatihan "{{ $pelatihan->nama_pelatihan }}"</p>
                </div>
                <div>
                    <a href="{{ route('admin.evaluasi.pelatihan.show', $pelatihan->id) }}" class="btn btn-info me-2">
                        <i class="fas fa-eye me-2"></i>Lihat
                    </a>
                    <a href="{{ route('admin.evaluasi.pelatihan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
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

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Form Edit Pelatihan
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.evaluasi.pelatihan.update', $pelatihan->id) }}" method="POST" id="editForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jenis_pelatihan_id" class="form-label">
                                        <i class="fas fa-list me-1"></i>Jenis Pelatihan <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('jenis_pelatihan_id') is-invalid @enderror" 
                                            id="jenis_pelatihan_id" name="jenis_pelatihan_id" required>
                                        <option value="">Pilih Jenis Pelatihan</option>
                                        @foreach($jenispelatihans as $jenis)
                                            <option value="{{ $jenis->id }}" 
                                                    {{ (old('jenis_pelatihan_id', $pelatihan->jenis_pelatihan_id) == $jenis->id) ? 'selected' : '' }}>
                                                {{ $jenis->jenis_pelatihan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_pelatihan_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>Pilih kategori pelatihan yang sesuai
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_pelatihan" class="form-label">
                                        <i class="fas fa-graduation-cap me-1"></i>Nama Pelatihan <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('nama_pelatihan') is-invalid @enderror" 
                                           id="nama_pelatihan" 
                                           name="nama_pelatihan" 
                                           value="{{ old('nama_pelatihan', $pelatihan->nama_pelatihan) }}" 
                                           placeholder="Masukkan nama pelatihan"
                                           required>
                                    @error('nama_pelatihan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>Nama pelatihan harus unik dan deskriptif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Perhatian:</strong> Mengubah data pelatihan akan mempengaruhi semua alumni yang terkait dengan pelatihan ini.
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.evaluasi.pelatihan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i>Update Pelatihan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Current
                    </h5>
                </div>
                <div class="card-body">
                    <div class="border-start border-warning border-3 ps-3 mb-3">
                        <h6 class="text-muted mb-2">Data Saat Ini:</h6>
                        <div class="mb-2">
                            <strong>Jenis:</strong> 
                            <span class="text-muted">{{ $pelatihan->jenisPelatihan->jenis_pelatihan ?? 'Tidak ada' }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Nama:</strong> 
                            <span class="text-muted">{{ $pelatihan->nama_pelatihan }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Alumni:</strong> 
                            <span class="badge bg-primary">{{ $pelatihan->alumni->count() }} orang</span>
                        </div>
                        <div>
                            <strong>Dibuat:</strong> 
                            <small class="text-muted">{{ $pelatihan->created_at->format('d M Y, H:i') }}</small>
                        </div>
                    </div>

                    <div class="alert alert-info mb-0">
                        <i class="fas fa-lightbulb me-2"></i>
                        <strong>Tips:</strong> Pastikan perubahan tidak mengganggu data evaluasi yang sudah ada.
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.evaluasi.pelatihan.show', $pelatihan->id) }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </a>
                        @if($pelatihan->alumni->count() == 0)
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $pelatihan->id }})">
                            <i class="fas fa-trash me-2"></i>Hapus Pelatihan
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission handling
    document.getElementById('editForm').addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mengupdate...';
        submitBtn.disabled = true;
    });
});

function confirmDelete(id) {
    if(confirm('Apakah Anda yakin ingin menghapus pelatihan ini?')) {
        // Create form for delete
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('admin/evaluasi/pelatihan') }}/${id}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection