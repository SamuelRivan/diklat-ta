{{-- Admin: View Edit Data Alumni Evaluasi --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Data Alumni</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('evaluasi.updatealumni', $pelatihan_5_pascadiklat_alumni->alumni_id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Data Pegawai (Read Only) -->
                <h5 class="mt-3 mb-3 border-bottom pb-2"><i class="fas fa-user me-2"></i>Data Pegawai</h5>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="nip" class="fw-bold">NIP</label>
                            <input type="text" class="form-control bg-light" id="nip" value="{{ $pelatihan_5_pascadiklat_alumni->pegawai->nip ?? '-' }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="nama" class="fw-bold">Nama</label>
                            <input type="text" class="form-control bg-light" id="nama" value="{{ $pelatihan_5_pascadiklat_alumni->pegawai->nama ?? '-' }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="jabatan" class="fw-bold">Jabatan</label>
                            <input type="text" class="form-control bg-light" id="jabatan" value="{{ $pelatihan_5_pascadiklat_alumni->pegawai->jabatan ?? '-' }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="unit_kerja" class="fw-bold">Unit Kerja</label>
                            <input type="text" class="form-control bg-light" id="unit_kerja" value="{{ $pelatihan_5_pascadiklat_alumni->pegawai->unit_kerja ?? '-' }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Data Pelatihan (Read Only) -->
                <h5 class="mt-4 mb-3 border-bottom pb-2"><i class="fas fa-graduation-cap me-2"></i>Data Pelatihan</h5>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="jenis_pelatihan" class="fw-bold">Jenis Pelatihan</label>
                            <input type="text" class="form-control bg-light" id="jenis_pelatihan" value="{{ $pelatihan_5_pascadiklat_alumni->pelatihan->jenisPelatihan->jenis_pelatihan ?? '-' }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="nama_pelatihan" class="fw-bold">Nama Pelatihan</label>
                            <input type="text" class="form-control bg-light" id="nama_pelatihan" value="{{ $pelatihan_5_pascadiklat_alumni->pelatihan->nama_pelatihan ?? '-' }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Hidden fields untuk data yang required -->
                <input type="hidden" name="pegawai_id" value="{{ $pelatihan_5_pascadiklat_alumni->pegawai_id }}">
                <input type="hidden" name="pelatihan_id" value="{{ $pelatihan_5_pascadiklat_alumni->pelatihan_id }}">

                <!-- Data Alumni (Editable) -->
                <h5 class="mt-4 mb-3 border-bottom pb-2"><i class="fas fa-edit me-2"></i>Data Alumni <small class="text-muted">(Dapat Diedit)</small></h5>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tanggal_mulai_pelatihan" class="fw-bold">Tanggal Mulai Pelatihan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_mulai_pelatihan" name="tanggal_mulai_pelatihan" 
                                   value="{{ old('tanggal_mulai_pelatihan', $pelatihan_5_pascadiklat_alumni->tanggal_mulai_pelatihan) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tanggal_selesai_pelatihan" class="fw-bold">Tanggal Selesai Pelatihan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_selesai_pelatihan" name="tanggal_selesai_pelatihan" 
                                   value="{{ old('tanggal_selesai_pelatihan', $pelatihan_5_pascadiklat_alumni->tanggal_selesai_pelatihan) }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="status_alumni" class="fw-bold">Status Evaluasi <span class="text-danger">*</span></label>
                    <select class="form-control" id="status_alumni" name="status_alumni" required>
                        <option value="belum_dinilai" {{ $pelatihan_5_pascadiklat_alumni->status_alumni == 'belum_dinilai' ? 'selected' : '' }}>Belum Dinilai</option>
                        <option value="sedang_dinilai" {{ $pelatihan_5_pascadiklat_alumni->status_alumni == 'sedang_dinilai' ? 'selected' : '' }}>Sedang Dinilai</option>
                        <option value="sudah_dinilai" {{ $pelatihan_5_pascadiklat_alumni->status_alumni == 'sudah_dinilai' ? 'selected' : '' }}>Sudah Dinilai</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('evaluasi.alumni') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
