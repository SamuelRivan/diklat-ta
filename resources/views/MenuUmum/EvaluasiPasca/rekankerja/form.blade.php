{{-- View Form Kuesioner Rekan Kerja --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kuesioner->judul }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, #28a745, #198754);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 20px;
        }

        .pertanyaan-card {
            border-left: 4px solid #28a745;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 12px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #28a745, #198754);
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
        }

        .btn-outline-secondary {
            border: 2px solid #6c757d;
            border-radius: 8px;
            padding: 12px 30px;
        }

        .required {
            color: #dc3545;
        }

        .radio-option {
            padding: 10px;
            margin: 5px 0;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .radio-option:hover {
            border-color: #28a745;
            background-color: #f8f9fa;
        }

        .radio-option input[type="radio"]:checked + label {
            color: #28a745;
            font-weight: 600;
        }

        .progress {
            height: 10px;
            border-radius: 5px;
        }

        .alumni-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            border-left: 3px solid #28a745;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-clipboard-list me-2"></i>
                {{ $kuesioner->judul }}
            </a>
            <div class="ms-auto">
                <span class="navbar-text me-3">
                    <i class="fas fa-user me-1"></i>
                    Evaluasi Alumni
                </span>
                <a href="{{ route('evaluasi.rekankerja.kuesioner', $rekanKerjaData->alumni_id) }}" class="btn btn-outline-light btn-sm me-2">
                    <i class="fas fa-arrow-left me-1"></i>
                    Kembali
                </a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">
                            <i class="fas fa-clipboard-list text-success me-2"></i>
                            {{ $kuesioner->judul }}
                        </h2>
                        @if($kuesioner->deskripsi)
                        <p class="card-text text-muted">{{ $kuesioner->deskripsi }}</p>
                        @endif
                        
                        <div class="alert alert-info alumni-info">
                            <h5><i class="fas fa-info-circle me-2"></i>Informasi Alumni yang Dinilai</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2">
                                        <i class="fas fa-user text-muted me-2"></i>
                                        <strong>Nama:</strong> {{ $rekanKerjaData->alumni->pegawai->nama }}
                                    </p>
                                    <p class="mb-2">
                                        <i class="fas fa-id-badge text-muted me-2"></i>
                                        <strong>NIP:</strong> {{ $rekanKerjaData->alumni->pegawai->nip }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2">
                                        <i class="fas fa-book text-muted me-2"></i>
                                        <strong>Pelatihan:</strong> {{ $rekanKerjaData->alumni->pelatihan->nama_pelatihan ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="progress mb-3">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%" id="progressBar">
                                <span id="progressText">0%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Kuesioner -->
        <form action="{{ route('evaluasi.rekankerja.store') }}" method="POST" id="evaluationForm">
            @csrf
            <input type="hidden" name="kuesioner_id" value="{{ $kuesioner->id }}">
            <input type="hidden" name="alumni_id" value="{{ $rekanKerjaData->alumni_id }}">

            @foreach($pertanyaan as $index => $item)
            <div class="card pertanyaan-card">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="badge bg-success me-2">{{ $index + 1 }}</span>
                        {{ $item->pertanyaan }}
                        @if($item->wajib)
                        <span class="required">*</span>
                        @endif
                    </h5>

                    @if($item->jenis === 'text' || $item->jenis === 'teks')
                        <input type="text" 
                               class="form-control" 
                               name="jawaban[{{ $item->id }}]" 
                               {{ $item->wajib ? 'required' : '' }}
                               placeholder="Masukkan jawaban Anda...">

                    @elseif($item->jenis === 'textarea' || $item->jenis === 'teks_panjang')
                        <textarea class="form-control" 
                                  name="jawaban[{{ $item->id }}]" 
                                  rows="4" 
                                  {{ $item->wajib ? 'required' : '' }}
                                  placeholder="Masukkan jawaban Anda..."></textarea>

                    @elseif($item->jenis === 'radio' || $item->jenis === 'pilihan_ganda')
                        @foreach($item->opsiJawaban()->orderBy('urutan')->get() as $opsi)
                        <div class="radio-option">
                            <input type="radio" 
                                   class="form-check-input me-2" 
                                   name="jawaban[{{ $item->id }}]" 
                                   value="{{ $opsi->id }}" 
                                   id="opsi_{{ $item->id }}_{{ $opsi->id }}"
                                   {{ $item->wajib ? 'required' : '' }}>
                            <label class="form-check-label" for="opsi_{{ $item->id }}_{{ $opsi->id }}">
                                {{ $opsi->teks_opsi }}
                                @if($opsi->nilai)
                                <span class="badge bg-secondary ms-2">{{ $opsi->nilai }} poin</span>
                                @endif
                            </label>
                        </div>
                        @endforeach

                    @elseif($item->jenis === 'checkbox')
                        @foreach($item->opsiJawaban()->orderBy('urutan')->get() as $opsi)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" 
                                   name="jawaban[{{ $item->id }}][]" 
                                   id="opsi_{{ $item->id }}_{{ $opsi->id }}"
                                   value="{{ $opsi->id }}">
                            <label class="form-check-label" for="opsi_{{ $item->id }}_{{ $opsi->id }}">
                                {{ $opsi->teks_opsi }}
                                @if($opsi->nilai)
                                    <small class="text-muted">({{ $opsi->nilai }} poin)</small>
                                @endif
                            </label>
                        </div>
                        @endforeach

                    @elseif($item->jenis === 'skala_likert')
                        <div class="row">
                            @foreach($item->opsiJawaban()->orderBy('urutan')->get() as $opsi)
                            <div class="col-md-2 text-center mb-2">
                                <div class="radio-option">
                                    <input type="radio" 
                                           class="form-check-input me-2" 
                                           name="jawaban[{{ $item->id }}]" 
                                           value="{{ $opsi->id }}" 
                                           id="opsi_{{ $item->id }}_{{ $opsi->id }}"
                                           {{ $item->wajib ? 'required' : '' }}>
                                    <label class="form-check-label d-block" for="opsi_{{ $item->id }}_{{ $opsi->id }}">
                                        <div class="badge bg-success mb-1">{{ $opsi->nilai }}</div>
                                        <br>
                                        <small>{{ $opsi->teks_opsi }}</small>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    @elseif($item->jenis === 'select')
                        <select class="form-select" 
                                name="jawaban[{{ $item->id }}]" 
                                {{ $item->wajib ? 'required' : '' }}>
                            <option value="">Pilih jawaban...</option>
                            @foreach($item->opsiJawaban()->orderBy('urutan')->get() as $opsi)
                            <option value="{{ $opsi->id }}">
                                {{ $opsi->teks_opsi }}
                                @if($opsi->nilai) ({{ $opsi->nilai }} poin) @endif
                            </option>
                            @endforeach
                        </select>

                    @elseif($item->jenis === 'number')
                        <input type="number" 
                               class="form-control" 
                               name="jawaban[{{ $item->id }}]" 
                               {{ $item->wajib ? 'required' : '' }}
                               placeholder="Masukkan angka...">

                    @elseif($item->jenis === 'email')
                        <input type="email" 
                               class="form-control" 
                               name="jawaban[{{ $item->id }}]" 
                               {{ $item->wajib ? 'required' : '' }}
                               placeholder="Masukkan email...">

                    @elseif($item->jenis === 'date')
                        <input type="date" 
                               class="form-control" 
                               name="jawaban[{{ $item->id }}]" 
                               {{ $item->wajib ? 'required' : '' }}>

                    @elseif($item->jenis === 'ya_tidak')
                        <div class="radio-option">
                            <input type="radio" 
                                   class="form-check-input me-2" 
                                   name="jawaban[{{ $item->id }}]" 
                                   value="ya" 
                                   id="ya_{{ $item->id }}"
                                   {{ $item->wajib ? 'required' : '' }}>
                            <label class="form-check-label" for="ya_{{ $item->id }}">
                                <i class="fas fa-check-circle text-success me-1"></i>
                                Ya / Setuju
                            </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" 
                                   class="form-check-input me-2" 
                                   name="jawaban[{{ $item->id }}]" 
                                   value="tidak" 
                                   id="tidak_{{ $item->id }}"
                                   {{ $item->wajib ? 'required' : '' }}>
                            <label class="form-check-label" for="tidak_{{ $item->id }}">
                                <i class="fas fa-times-circle text-danger me-1"></i>
                                Tidak / Tidak Setuju
                            </label>
                        </div>

                    @else
                        <input type="text" 
                               class="form-control" 
                               name="jawaban[{{ $item->id }}]" 
                               {{ $item->wajib ? 'required' : '' }}
                               placeholder="Masukkan jawaban Anda...">
                    @endif

                    @if($item->wajib)
                    <small class="text-muted">
                        <i class="fas fa-asterisk text-danger me-1" style="font-size: 8px;"></i>
                        Pertanyaan ini wajib diisi
                    </small>
                    @endif
                </div>
            </div>
            @endforeach

            <!-- Submit Button -->
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-outline-secondary me-3" onclick="history.back()">
                        <i class="fas fa-arrow-left me-2"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-paper-plane me-2"></i>
                        Simpan Evaluasi
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('evaluationForm');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const submitBtn = document.getElementById('submitBtn');
            
            const totalQuestions = {{ $pertanyaan->count() }};
            
            function updateProgress() {
                const answeredQuestions = form.querySelectorAll('input:checked, input[type="text"]:not([value=""]), input[type="email"]:not([value=""]), input[type="number"]:not([value=""]), input[type="date"]:not([value=""]), textarea:not([value=""]), select:not([value=""])').length;
                const percentage = Math.round((answeredQuestions / totalQuestions) * 100);
                
                progressBar.style.width = percentage + '%';
                progressText.textContent = percentage + '%';
                
                if (percentage === 100) {
                    progressBar.classList.add('bg-success');
                    submitBtn.classList.remove('btn-primary');
                    submitBtn.classList.add('btn-success');
                } else {
                    progressBar.classList.remove('bg-success');
                    submitBtn.classList.remove('btn-success');
                    submitBtn.classList.add('btn-primary');
                }
            }
            
            // Monitor changes
            form.addEventListener('input', updateProgress);
            form.addEventListener('change', updateProgress);
            
            // Initial progress check
            updateProgress();
            
            // Form validation before submit
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(function(field) {
                    if (field.type === 'radio') {
                        const name = field.name;
                        const radioGroup = form.querySelectorAll(`input[name="${name}"]:checked`);
                        if (radioGroup.length === 0) {
                            isValid = false;
                            field.closest('.card').classList.add('border-danger');
                        } else {
                            field.closest('.card').classList.remove('border-danger');
                        }
                    } else if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Harap lengkapi semua pertanyaan yang wajib diisi!');
                    return false;
                }
                
                if (!confirm('Apakah Anda yakin ingin menyimpan jawaban ini?')) {
                    e.preventDefault();
                    return false;
                }
                
                // Show loading
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                submitBtn.disabled = true;
            });
        });
    </script>
</body>

</html>