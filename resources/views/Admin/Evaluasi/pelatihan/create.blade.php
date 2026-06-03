{{-- Admin: View Tambah Pelatihan Baru --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title mb-2">
                        <i class="fas fa-plus-circle me-3"></i>Tambah Pelatihan
                    </h1>
                    <p class="card-text mb-0">Tambahkan data pelatihan baru untuk evaluasi pasca diklat</p>
                </div>
                <a href="{{ route('admin.evaluasi.pelatihan.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
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
                        <i class="fas fa-edit me-2"></i>Form Tambah Pelatihan
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.evaluasi.pelatihan.store') }}" method="POST" id="createForm">
                        @csrf
                        
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
                                                    {{ old('jenis_pelatihan_id') == $jenis->id ? 'selected' : '' }}>
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
                                           value="{{ old('nama_pelatihan') }}" 
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

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.evaluasi.pelatihan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Pelatihan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Preview Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-eye me-2"></i>Preview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-lightbulb me-2"></i>
                        <strong>Tips:</strong> Pastikan nama pelatihan mudah dipahami dan sesuai dengan jenis pelatihan yang dipilih.
                    </div>
                    
                    <div class="border-start border-primary border-3 ps-3">
                        <h6 class="text-muted mb-2">Preview Data:</h6>
                        <div class="mb-2">
                            <strong>Jenis:</strong> 
                            <span id="preview-jenis" class="text-muted">Belum dipilih</span>
                        </div>
                        <div>
                            <strong>Nama:</strong> 
                            <span id="preview-nama" class="text-muted">Belum diisi</span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            Data akan tersimpan setelah tombol "Simpan Pelatihan" diklik
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisSelect = document.getElementById('jenis_pelatihan_id');
    const namaInput = document.getElementById('nama_pelatihan');
    const previewJenis = document.getElementById('preview-jenis');
    const previewNama = document.getElementById('preview-nama');

    // Update preview saat jenis pelatihan berubah
    jenisSelect.addEventListener('change', function() {
        const selectedText = this.options[this.selectedIndex].text;
        previewJenis.textContent = this.value ? selectedText : 'Belum dipilih';
    });

    // Update preview saat nama pelatihan berubah
    namaInput.addEventListener('input', function() {
        previewNama.textContent = this.value || 'Belum diisi';
    });

    // Form submission handling
    document.getElementById('createForm').addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
        submitBtn.disabled = true;
    });
});
</script>
@endsection