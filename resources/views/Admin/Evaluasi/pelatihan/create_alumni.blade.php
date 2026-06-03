{{-- Admin: View Tambah Peserta (Alumni) ke Pelatihan --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Page Header -->
    <div class="card bg-success text-white mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="card-title mb-2">
                        <i class="fas fa-user-plus me-3"></i>Tambah Alumni ke Pelatihan
                    </h1>
                    <p class="card-text mb-0">{{ $pelatihan->nama_pelatihan }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.evaluasi.pelatihan.show', $pelatihan->id) }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Terdapat kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.evaluasi.pelatihan.storeAlumni', $pelatihan->id) }}" method="POST">
        @csrf
        
        <div class="row">
            <!-- Form Data Pelatihan -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-calendar me-2"></i>Data Pelatihan
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Tanggal Mulai -->
                        <div class="mb-3">
                            <label for="tanggal_mulai_pelatihan" class="form-label">
                                <i class="fas fa-calendar-alt me-2"></i>Tanggal Mulai <span class="text-danger">*</span>
                            </label>
                            <input type="date" 
                                   class="form-control @error('tanggal_mulai_pelatihan') is-invalid @enderror" 
                                   id="tanggal_mulai_pelatihan" 
                                   name="tanggal_mulai_pelatihan" 
                                   value="{{ old('tanggal_mulai_pelatihan') }}" 
                                   required>
                            @error('tanggal_mulai_pelatihan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Selesai -->
                        <div class="mb-3">
                            <label for="tanggal_selesai_pelatihan" class="form-label">
                                <i class="fas fa-calendar-check me-2"></i>Tanggal Selesai <span class="text-danger">*</span>
                            </label>
                            <input type="date" 
                                   class="form-control @error('tanggal_selesai_pelatihan') is-invalid @enderror" 
                                   id="tanggal_selesai_pelatihan" 
                                   name="tanggal_selesai_pelatihan" 
                                   value="{{ old('tanggal_selesai_pelatihan') }}" 
                                   required>
                            @error('tanggal_selesai_pelatihan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Alumni -->
                        <div class="mb-3">
                            <label for="status_alumni" class="form-label">
                                <i class="fas fa-tasks me-2"></i>Status Alumni <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('status_alumni') is-invalid @enderror" 
                                    id="status_alumni" name="status_alumni" required>
                                <option value="">Pilih Status</option>
                                <option value="belum_dinilai" {{ old('status_alumni') == 'belum_dinilai' ? 'selected' : '' }}>
                                    Belum Dinilai
                                </option>
                                <option value="sedang_dinilai" {{ old('status_alumni') == 'sedang_dinilai' ? 'selected' : '' }}>
                                    Sedang Dinilai
                                </option>
                                <option value="sudah_dinilai" {{ old('status_alumni') == 'sudah_dinilai' ? 'selected' : '' }}>
                                    Sudah Dinilai
                                </option>
                            </select>
                            @error('status_alumni')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success" id="submitBtn" disabled>
                                <i class="fas fa-save me-2"></i>Simpan Alumni (<span id="selectedCount">0</span>)
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Pegawai -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-users me-2"></i>Pilih Pegawai untuk dijadikan Alumni
                            </h5>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectAll()">
                                    <i class="fas fa-check-square me-1"></i>Pilih Semua
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="selectNone()">
                                    <i class="fas fa-square me-1"></i>Batal Semua
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($pegawais->count() > 0)
                            <!-- Search Box -->
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" id="searchPegawai" 
                                           placeholder="Cari berdasarkan nama, NIP, atau jabatan...">
                                </div>
                            </div>

                            <!-- Daftar Pegawai -->
                            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                <table class="table table-hover">
                                    <thead class="table-light sticky-top">
                                        <tr>
                                            <th width="50">
                                                <input type="checkbox" class="form-check-input" id="selectAllCheckbox" 
                                                       onchange="toggleSelectAll()">
                                            </th>
                                            <th>NIP</th>
                                            <th>Nama Lengkap</th>
                                            <th>Jabatan</th>
                                            <th>Unit Kerja</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pegawaiTableBody">
                                        @foreach($pegawais as $pegawai)
                                        <tr class="pegawai-row" data-search="{{ strtolower($pegawai->nama_lengkap . ' ' . $pegawai->nip . ' ' . ($pegawai->jabatan ?? '') . ' ' . ($pegawai->unit_kerja ?? '')) }}">
                                            <td>
                                                <input type="checkbox" class="form-check-input pegawai-checkbox" 
                                                       name="pegawai_ids[]" value="{{ $pegawai->id }}" 
                                                       onchange="updateSelectedCount()"
                                                       {{ in_array($pegawai->id, old('pegawai_ids', [])) ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $pegawai->nip ?? '-' }}</td>
                                            <td>
                                                <strong>{{ $pegawai->nama }}</strong>
                                            </td>
                                            <td>{{ $pegawai->jabatan ?? '-' }}</td>
                                            <td>{{ $pegawai->unit_kerja ?? '-' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Selected Count Info -->
                            <div class="mt-3 p-3 bg-light rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fas fa-info-circle text-info me-2"></i>
                                        <strong id="selectedInfo">Belum ada pegawai yang dipilih</strong>
                                    </span>
                                    <small class="text-muted">
                                        Total pegawai tersedia: {{ $pegawais->count() }}
                                    </small>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5 text-muted">
                                <i class="fas fa-users-slash fa-4x mb-3"></i>
                                <h5>Tidak Ada Pegawai Tersedia</h5>
                                <p>Semua pegawai sudah terdaftar sebagai alumni untuk pelatihan ini.</p>
                                <a href="{{ route('admin.evaluasi.pelatihan.show', $pelatihan->id) }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Pelatihan
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update initial count
    updateSelectedCount();
    
    // Validasi tanggal
    const tanggalMulai = document.getElementById('tanggal_mulai_pelatihan');
    const tanggalSelesai = document.getElementById('tanggal_selesai_pelatihan');
    
    tanggalMulai.addEventListener('change', function() {
        tanggalSelesai.min = this.value;
        if (tanggalSelesai.value && tanggalSelesai.value < this.value) {
            tanggalSelesai.value = this.value;
        }
    });

    // Search functionality
    const searchInput = document.getElementById('searchPegawai');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('.pegawai-row');
            
            rows.forEach(row => {
                const searchData = row.getAttribute('data-search');
                if (searchData.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});

function updateSelectedCount() {
    const checkboxes = document.querySelectorAll('.pegawai-checkbox');
    const selectedCheckboxes = document.querySelectorAll('.pegawai-checkbox:checked');
    const count = selectedCheckboxes.length;
    
    // Update counter
    document.getElementById('selectedCount').textContent = count;
    
    // Update submit button
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = count === 0;
    
    // Update info text
    const selectedInfo = document.getElementById('selectedInfo');
    if (count === 0) {
        selectedInfo.textContent = 'Belum ada pegawai yang dipilih';
    } else if (count === 1) {
        selectedInfo.textContent = '1 pegawai dipilih';
    } else {
        selectedInfo.textContent = count + ' pegawai dipilih';
    }
    
    // Update select all checkbox
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    if (selectAllCheckbox) {
        const visibleCheckboxes = Array.from(checkboxes).filter(cb => 
            cb.closest('.pegawai-row').style.display !== 'none'
        );
        const visibleCheckedCount = visibleCheckboxes.filter(cb => cb.checked).length;
        
        selectAllCheckbox.checked = visibleCheckboxes.length > 0 && visibleCheckedCount === visibleCheckboxes.length;
        selectAllCheckbox.indeterminate = visibleCheckedCount > 0 && visibleCheckedCount < visibleCheckboxes.length;
    }
}

function toggleSelectAll() {
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const checkboxes = document.querySelectorAll('.pegawai-checkbox');
    
    // Only affect visible checkboxes
    const visibleCheckboxes = Array.from(checkboxes).filter(cb => 
        cb.closest('.pegawai-row').style.display !== 'none'
    );
    
    visibleCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
    });
    
    updateSelectedCount();
}

function selectAll() {
    const checkboxes = document.querySelectorAll('.pegawai-checkbox');
    const visibleCheckboxes = Array.from(checkboxes).filter(cb => 
        cb.closest('.pegawai-row').style.display !== 'none'
    );
    
    visibleCheckboxes.forEach(checkbox => {
        checkbox.checked = true;
    });
    
    updateSelectedCount();
}

function selectNone() {
    const checkboxes = document.querySelectorAll('.pegawai-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    
    updateSelectedCount();
}
</script>
@endsection