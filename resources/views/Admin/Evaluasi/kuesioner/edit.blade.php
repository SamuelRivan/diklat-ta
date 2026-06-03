{{-- Admin: View Edit Template Kuesioner --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title mb-2">
                        <i class="fas fa-edit me-3"></i>Edit Kuesioner
                    </h1>
                    <p class="card-text mb-0">Edit informasi kuesioner untuk evaluasi pasca diklat</p>
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
                <i class="fas fa-clipboard-check me-2"></i>Form Edit Kuesioner
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kuesioner.update', $kuesioner->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="judul" class="form-label fw-bold">Judul Kuesioner</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" 
                           value="{{ old('judul', $kuesioner->judul) }}" required placeholder="Masukkan judul kuesioner">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" 
                              rows="4" placeholder="Masukkan deskripsi kuesioner">{{ old('deskripsi', $kuesioner->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Deskripsikan tujuan dan konteks penggunaan kuesioner ini</small>
                </div>

                <div class="mb-4">
                    <label for="role_target" class="form-label fw-bold">Target Responden</label>
                    <select class="form-select @error('role_target') is-invalid @enderror" id="role_target" name="role_target" required>
                        <option value="" disabled>-- Pilih Target Responden --</option>
                        <option value="alumni" {{ old('role_target', $kuesioner->role_target) == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        <option value="atasan" {{ old('role_target', $kuesioner->role_target) == 'atasan' ? 'selected' : '' }}>Atasan</option>
                        <option value="rekan" {{ old('role_target', $kuesioner->role_target) == 'rekan' ? 'selected' : '' }}>Rekan Kerja</option>
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
                   {{ old('is_active', $kuesioner->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="is_active">Aktifkan Kuesioner</label>
                    </div>
                    <small class="text-muted d-block mt-1">Kuesioner yang aktif dapat digunakan dalam evaluasi</small>
                </div>

                <hr>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body bg-light">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 text-center me-3">
                                        <i class="fas fa-question-circle fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Pertanyaan Kuesioner</h6>
                                        <p class="mb-0">Terdapat {{ $kuesioner->pertanyaan->count() }} pertanyaan dalam kuesioner ini</p>
                                        <a href="{{ route('admin.kuesioner.pertanyaan.index', $kuesioner->id) }}" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-list me-1"></i> Kelola Pertanyaan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body bg-light">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 text-center me-3">
                                        <i class="fas fa-calendar-alt fa-2x text-info"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Informasi Kuesioner</h6>
                                        <p class="mb-0">Dibuat: {{ $kuesioner->created_at->format('d/m/Y H:i') }}</p>
                                        <p class="mb-0">Terakhir diperbarui: {{ $kuesioner->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.kuesioner.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <div>
                        <a href="{{ route('admin.kuesioner.show', $kuesioner->id) }}" class="btn btn-info me-2">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection