{{-- Admin: View Buat Kuesioner Baru --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title mb-2">
                        <i class="fas fa-plus-circle me-3"></i>Tambah Kuesioner Baru
                    </h1>
                    <p class="card-text mb-0">Buat kuesioner baru untuk evaluasi pasca diklat</p>
                </div>
                <a href="{{ route('admin.kuesioner.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong>Error!</strong> Ada kesalahan dalam pengisian form:
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-clipboard-check me-2"></i>Form Kuesioner
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kuesioner.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="judul" class="form-label fw-bold">Judul Kuesioner</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" 
                           value="{{ old('judul') }}" required placeholder="Masukkan judul kuesioner">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Contoh: Evaluasi Pasca Diklat untuk Alumni</small>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" 
                              rows="4" placeholder="Masukkan deskripsi kuesioner">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Deskripsikan tujuan dan konteks penggunaan kuesioner ini</small>
                </div>

                <div class="mb-4">
                    <label for="role_target" class="form-label fw-bold">Target Responden</label>
                    <select class="form-select @error('role_target') is-invalid @enderror" id="role_target" name="role_target" required>
                        <option value="" disabled selected>-- Pilih Target Responden --</option>
                        <option value="alumni" {{ old('role_target') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        <option value="atasan" {{ old('role_target') == 'atasan' ? 'selected' : '' }}>Atasan</option>
                        <option value="rekan" {{ old('role_target') == 'rekan' ? 'selected' : '' }}>Rekan Kerja</option>
                    </select>
                    @error('role_target')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        {{-- ensure a boolean is always submitted: 0 when unchecked, 1 when checked --}}
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="is_active">Aktifkan Kuesioner</label>
                    </div>
                    <small class="text-muted d-block mt-1">Kuesioner yang aktif dapat digunakan dalam evaluasi</small>
                </div>

                <hr>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.kuesioner.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Kuesioner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection