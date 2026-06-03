{{-- Admin: View Edit Pertanyaan --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title mb-2">
                        <i class="fas fa-edit me-3"></i>Edit Pertanyaan
                    </h1>
                    <p class="card-text mb-0">{{ $kuesioner->judul }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.kuesioner.pertanyaan.index', $kuesioner->id) }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert for errors -->
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <strong>Terjadi kesalahan!</strong> Periksa formulir di bawah ini.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Pertanyaan Form Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-question-circle me-2"></i>Formulir Pertanyaan
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kuesioner.pertanyaan.update', [$kuesioner->id, $pertanyaan->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Pertanyaan Input -->
                <div class="mb-4">
                    <label for="pertanyaan" class="form-label fw-bold">Pertanyaan <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('pertanyaan') is-invalid @enderror" id="pertanyaan" name="pertanyaan" rows="3" required>{{ old('pertanyaan', $pertanyaan->pertanyaan) }}</textarea>
                    @error('pertanyaan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Deskripsi Input -->
                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi <small class="text-muted">(opsional)</small></label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="2">{{ old('deskripsi', $pertanyaan->deskripsi) }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <small class="text-muted">Teks pendukung atau panduan untuk menjawab pertanyaan ini.</small>
                </div>

                <!-- Jenis Pertanyaan -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Jenis Pertanyaan <span class="text-danger">*</span></label>
                    
                    <div class="card card-body bg-light border-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="jenis" id="jenis_pilihan_ganda" value="pilihan_ganda" 
                                           {{ old('jenis', $pertanyaan->jenis) == 'pilihan_ganda' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jenis_pilihan_ganda">
                                        <i class="fas fa-list-ul me-2 text-primary"></i>Pilihan Ganda
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="jenis" id="jenis_pertanyaan_singkat" value="pertanyaan_singkat"
                                           {{ old('jenis', $pertanyaan->jenis) == 'pertanyaan_singkat' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jenis_pertanyaan_singkat">
                                        <i class="fas fa-comment me-2 text-warning"></i>Pertanyaan Singkat
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="jenis" id="jenis_ya_tidak" value="ya_tidak"
                                           {{ old('jenis', $pertanyaan->jenis) == 'ya_tidak' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jenis_ya_tidak">
                                        <i class="fas fa-check-circle me-2 text-success"></i>Ya/Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @error('jenis')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Opsi Jawaban (untuk Pilihan Ganda) -->
                <div id="opsiJawabanSection" class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label fw-bold">Opsi Jawaban <span class="text-danger">*</span></label>
                        <button type="button" id="tambahOpsiBtn" class="btn btn-success btn-sm">
                            <i class="fas fa-plus me-2"></i>Tambah Opsi
                        </button>
                    </div>
                    
                    <div id="opsiContainer">
                        @if(old('opsi_jawaban'))
                            @foreach(old('opsi_jawaban') as $index => $opsi)
                                <div class="card mb-2 opsi-card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-9 mb-2 mb-md-0">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-circle"></i></span>
                                                    <input type="text" class="form-control @error('opsi_jawaban.'.$index) is-invalid @enderror" 
                                                           name="opsi_jawaban[]" value="{{ $opsi }}" placeholder="Teks opsi" required>
                                                </div>
                                                @error('opsi_jawaban.'.$index)
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 text-end">
                                                <button type="button" class="btn btn-danger btn-sm hapusOpsiBtn">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @elseif($pertanyaan->jenis == 'pilihan_ganda')
                            @foreach($pertanyaan->opsiJawaban as $opsi)
                                <div class="card mb-2 opsi-card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-9 mb-2 mb-md-0">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-circle"></i></span>
                                                    <input type="hidden" name="opsi_id[]" value="{{ $opsi->id }}">
                                                    <input type="text" class="form-control" name="opsi_jawaban[]" 
                                                           value="{{ $opsi->teks_opsi }}" placeholder="Teks opsi" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3 text-end">
                                                <button type="button" class="btn btn-danger btn-sm hapusOpsiBtn">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Default empty options -->
                            @for($i = 0; $i < 4; $i++)
                                <div class="card mb-2 opsi-card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-9 mb-2 mb-md-0">
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-circle"></i></span>
                                                    <input type="text" class="form-control" name="opsi_jawaban[]" placeholder="Teks opsi" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3 text-end">
                                                <button type="button" class="btn btn-danger btn-sm hapusOpsiBtn">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>

                </div>

                <!-- Wajib/Opsional -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Tipe Pertanyaan</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="wajib" name="wajib" value="1" 
                               {{ old('wajib', $pertanyaan->wajib) ? 'checked' : '' }}>
                        <label class="form-check-label" for="wajib">
                            <strong>Pertanyaan wajib dijawab</strong>
                        </label>
                        <small class="d-block text-muted">
                            Jika dicentang, responden harus menjawab pertanyaan ini untuk menyelesaikan kuesioner.
                        </small>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.kuesioner.pertanyaan.index', $kuesioner->id) }}" class="btn btn-light border">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jenisInputs = document.querySelectorAll('input[name="jenis"]');
        const opsiSection = document.getElementById('opsiJawabanSection');
        const tambahOpsiBtn = document.getElementById('tambahOpsiBtn');
        const opsiContainer = document.getElementById('opsiContainer');
        
        // Helpers to enable/disable all inputs inside opsiContainer
        function enableOpsiInputs() {
            opsiContainer.querySelectorAll('input, textarea, select').forEach(el => {
                el.disabled = false;
                if (el.name && el.name.includes('opsi')) {
                    // restore required for opsi_jawaban fields
                    if (el.name.includes('opsi_jawaban')) el.required = true;
                }
            });
        }

        function disableOpsiInputs() {
            opsiContainer.querySelectorAll('input, textarea, select').forEach(el => {
                el.disabled = true;
                if (el.name && el.name.includes('opsi')) {
                    if (el.name.includes('opsi_jawaban')) el.required = false;
                }
            });
        }

        // Function to toggle visibility of options section based on question type
        function toggleOpsiSection() {
            if (document.getElementById('jenis_pilihan_ganda').checked) {
                opsiSection.style.display = 'block';
                enableOpsiInputs();
            } else {
                opsiSection.style.display = 'none';
                disableOpsiInputs();
            }
        }
        
        // Add event listeners to the type radio buttons
        jenisInputs.forEach(input => {
            input.addEventListener('change', toggleOpsiSection);
        });
        
        // Check initial state
        toggleOpsiSection();
        
        // Add new option
        tambahOpsiBtn.addEventListener('click', function() {
            const newOpsi = document.createElement('div');
            newOpsi.className = 'card mb-2 opsi-card';
            newOpsi.innerHTML = `
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-9 mb-2 mb-md-0">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-circle"></i></span>
                                <input type="text" class="form-control" name="opsi_jawaban[]" placeholder="Teks opsi" required>
                            </div>
                        </div>
                        <div class="col-md-3 text-end">
                            <button type="button" class="btn btn-danger btn-sm hapusOpsiBtn">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </div>
                    </div>
                </div>
            `;
            opsiContainer.appendChild(newOpsi);
            
            // Add event listener to the new delete button
            newOpsi.querySelector('.hapusOpsiBtn').addEventListener('click', function() {
                if (document.querySelectorAll('.opsi-card').length > 2) {
                    newOpsi.remove();
                } else {
                    alert('Minimal 2 opsi jawaban diperlukan untuk pertanyaan pilihan ganda.');
                }
            });
        });
        
        // Add event listeners to existing delete buttons
        document.querySelectorAll('.hapusOpsiBtn').forEach(button => {
            button.addEventListener('click', function() {
                if (document.querySelectorAll('.opsi-card').length > 2) {
                    this.closest('.opsi-card').remove();
                } else {
                    alert('Minimal 2 opsi jawaban diperlukan untuk pertanyaan pilihan ganda.');
                }
            });
        });
    });
</script>
@endpush