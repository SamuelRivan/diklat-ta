{{-- Admin: View Detail Jawaban Alumni --}}
@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><i class="fas fa-user-graduate me-2"></i>Detail Alumni</h2>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
    </div>

    @php $alumni = $pelatihan_5_pascadiklat_alumni; @endphp

    <div class="row">
        <div class="col-lg-5 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white"><strong>Data Alumni</strong></div>
                <div class="card-body p-0">
                    <table class="table mb-0 table-sm">
                        <tr><th style="width:40%">NIP</th><td>{{ $alumni->pegawai->nip ?? '-' }}</td></tr>
                        <tr><th>Nama</th><td>{{ $alumni->pegawai->nama ?? $alumni->pegawai->nama_lengkap ?? '-' }}</td></tr>
                        <tr><th>Jabatan</th><td>{{ $alumni->pegawai->jabatan ?? '-' }}</td></tr>
                        <tr><th>Unit Kerja</th><td>{{ $alumni->pegawai->unit_kerja ?? '-' }}</td></tr>
                        <tr><th>Status Evaluasi</th><td>
                            @switch($alumni->status_alumni)
                                @case('belum_dinilai')<span class="badge bg-secondary">Belum Dinilai</span>@break
                                @case('sedang_dinilai')<span class="badge bg-warning text-dark">Sedang Dinilai</span>@break
                                @case('sudah_dinilai')<span class="badge bg-success">Sudah Dinilai</span>@break
                                @default <span class="badge bg-light text-dark">-</span>
                            @endswitch
                        </td></tr>
                        <tr><th>Tgl Mulai Pelatihan</th><td>{{ $alumni->tanggal_mulai_pelatihan ? \Carbon\Carbon::parse($alumni->tanggal_mulai_pelatihan)->format('d/m/Y') : '-' }}</td></tr>
                        <tr><th>Tgl Selesai Pelatihan</th><td>{{ $alumni->tanggal_selesai_pelatihan ? \Carbon\Carbon::parse($alumni->tanggal_selesai_pelatihan)->format('d/m/Y') : '-' }}</td></tr>
                        <tr><th>Pelatihan</th><td>{{ $alumni->pelatihan->nama_pelatihan ?? '-' }}</td></tr>
                        <tr><th>Jenis Pelatihan</th><td>{{ $alumni->pelatihan->jenisPelatihan->jenis_pelatihan ?? '-' }}</td></tr>
                        <tr><th>Created</th><td>{{ $alumni->created_at?->format('d/m/Y H:i') }}</td></tr>
                        <tr><th>Updated</th><td>{{ $alumni->updated_at?->format('d/m/Y H:i') }}</td></tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-7 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <strong>Jawaban Kuesioner Alumni</strong>
                    <span class="badge bg-light text-dark">Total: {{ $alumni->jawabanKuesioner->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if($alumni->jawabanKuesioner->count() === 0)
                        <div class="p-4 text-center text-muted">
                            <i class="fas fa-file-alt fa-2x mb-2"></i>
                            <p class="mb-0">Belum ada jawaban kuesioner untuk alumni ini.</p>
                            <small class="d-block mt-2 text-info">
                                <i class="fas fa-info-circle"></i> 
                                Alumni: {{ $alumni->pegawai->nama ?? '-' }} (ID: {{ $alumni->pegawai_id }}) | 
                                Pelatihan ID: {{ $alumni->pelatihan_id }}
                            </small>
                        </div>
                    @else
                        <div class="table-responsive" style="max-height:520px;">
                            <table class="table table-hover table-sm mb-0 align-middle">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th style="width:50px">No</th>
                                        <th>Pertanyaan</th>
                                        <th style="width:35%">Jawaban</th>
                                        <th style="width:140px">Tanggal Isi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($alumni->jawabanKuesioner as $jawab)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>
                                                <div class="fw-semibold">{{ $jawab->pertanyaan->pertanyaan ?? 'Pertanyaan #' . $jawab->pertanyaan_id }}</div>
                                                @if(isset($jawab->pertanyaan->jenis))
                                                    <small class="text-muted">Jenis: {{ ucfirst($jawab->pertanyaan->jenis) }} @if($jawab->pertanyaan->wajib) • Wajib @endif</small>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $displayJawaban = null;
                                                    if($jawab->opsiJawaban && $jawab->opsiJawaban->teks) {
                                                        $displayJawaban = $jawab->opsiJawaban->teks;
                                                    } elseif(!empty($jawab->jawaban_teks)) {
                                                        $displayJawaban = $jawab->jawaban_teks;
                                                    } else {
                                                        $displayJawaban = '-';
                                                    }
                                                @endphp
                                                <div class="small">{!! nl2br(e($displayJawaban)) !!}</div>
                                            </td>
                                            <td class="small">{{ $jawab->tanggal_pengisian?->format('d/m/Y H:i') ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body d-flex justify-content-between">
            <div>
                <a href="{{ route('admin.evaluasi.pelatihan.show', $alumni->pelatihan_id) }}" class="btn btn-outline-primary"><i class="fas fa-list me-1"></i>Kembali ke Pelatihan</a>
                <a href="{{ route('evaluasi.alumni') }}" class="btn btn-outline-secondary"><i class="fas fa-users me-1"></i>Daftar Alumni</a>
            </div>
            <button onclick="window.print()" class="btn btn-outline-dark"><i class="fas fa-print me-1"></i>Cetak</button>
        </div>
    </div>
</div>
@endsection