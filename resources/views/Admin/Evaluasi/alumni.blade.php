{{-- Admin: View Daftar Alumni Evaluasi --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-3">Daftar Alumni</h2>

        {{-- Form Pencarian & Export --}}
        <div class="d-flex justify-content-between mb-3">
            <form action="{{ route('evaluasi.alumni') }}" method="GET" class="d-flex">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama pelatihan..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportModal">
                <i class="fas fa-file-excel"></i> Export Data
            </button>
        </div>

        {{-- Tabel Data Alumni --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Unit Kerja</th>
                        <th>Pelatihan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelatihan_5_pascadiklat_alumni as $alumni)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $alumni->pegawai->nip ?? '-' }}</td>
                            <td>{{ $alumni->pegawai->nama ?? '-' }}</td>
                            <td>{{ $alumni->pegawai->jabatan ?? '-' }}</td>
                            <td>{{ $alumni->pegawai->unit_kerja ?? '-' }}</td>
                            <td>
                                <strong>{{ $alumni->pelatihan->nama_pelatihan ?? '-' }}</strong><br>
                                <small class="text-muted">{{ $alumni->pelatihan->jenisPelatihan->jenis_pelatihan ?? '-' }}</small>
                            </td>
                            <td>{{ $alumni->tanggal_mulai_pelatihan ? date('d-m-Y', strtotime($alumni->tanggal_mulai_pelatihan)) : '-' }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.evaluasi.pelatihan.alumni.answers', ['pelatihanId' => $alumni->pelatihan_id, 'alumniId' => $alumni->alumni_id]) }}" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('evaluasi.alumni.export', ['pelatihan_id' => $alumni->pelatihan_id, 'pegawai_id' => $alumni->pegawai_id]) }}" class="btn btn-success btn-sm" title="Export Excel"><i class="fas fa-file-excel"></i></a>
                                    <a href="{{ route('evaluasi.editalumni', $alumni->alumni_id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('evaluasi.destroyalumni', $alumni->alumni_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Data alumni tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $pelatihan_5_pascadiklat_alumni->links() }}
        </div>
    </div>

    <!-- Modal Export -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Export Data Evaluasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('evaluasi.alumni.export') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label">Export Berdasarkan Pelatihan</label>
                            <select name="pelatihan_id" class="form-select">
                                <option value="">-- Pilih Pelatihan --</option>
                                @foreach($pelatihans as $pelatihan)
                                    <option value="{{ $pelatihan->id }}">{{ $pelatihan->nama_pelatihan }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Pilih pelatihan untuk mengunduh rekap jawaban seluruh alumni di pelatihan tersebut.</small>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Download Excel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
