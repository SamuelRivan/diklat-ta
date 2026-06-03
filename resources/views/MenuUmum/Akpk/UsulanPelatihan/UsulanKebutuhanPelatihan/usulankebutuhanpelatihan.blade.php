@extends('layouts.akpkLayouts.akpk')

@push('styles')
<style>
    thead.bg-akpk th {
        background-color: #3f3d56;
        color: #fff;
    }

    .card-akpk {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 0 16px rgba(0, 0, 0, 0.08);
        padding: 24px;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .btn-akpk {
        background-color: #3f3d56;
        border: none;
        color: #fff;
        border-radius: 10px;
    }

    .btn-akpk:hover {
        background-color: #2d2b46;
    }

    .table-wrapper {
        border-radius: 12px;
        overflow: hidden;
    }

    .pagination .page-item.active .page-link {
        background-color: #3f3d56;
        border-color: #3f3d56;
    }
</style>
@endpush

@section('content')
<section class="container">
    <div class="d-flex justify-content-start align-items-center mb-4">
        <!-- Ikon Feather -->
        <i data-feather="user" style="width: 30px; height: 30px;"></i>
        <h2 class="mb-0">Usulan Kebutuhan Pelatihan</h2>
    </div>
</section>

<div class="card-akpk mb-4">
    <div class="row mb-3 align-items-center">
        <div class="col-md-3 mb-2 mb-md-0">
            <select class="form-select" id="tahun">
                <option selected disabled>Pilih Tahun</option>
                @for ($year = date('Y'); $year >= 2020; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-5 mb-2 mb-md-0">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari..." id="searchInput">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="/nomenklatur" class="btn btn-outline-secondary me-2">
                <i class="bi bi-check-circle"></i> Cek Nomenklatur
            </a>
            <a href="#" class="btn btn-akpk" data-bs-toggle="modal" data-bs-target="#tambahUsulanModal">
                <i class="bi bi-plus-lg"></i> Tambah Usulan
            </a>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="table table-bordered mb-0">
            <thead class="bg-akpk text-white text-center">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Tahun</th>
                    <th>Nama Pelatihan</th>
                    <th style="width: 20%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akpk_5_usulankebutuhanpelatihans as $index => $item)
                    <tr>
                        <td class="text-center">{{ ($akpk_5_usulankebutuhanpelatihans->currentPage() - 1) * $akpk_5_usulankebutuhanpelatihans->perPage() + $index + 1 }}</td>
                        <td class="text-center">{{ $item->tahun }}</td>
                        <td>{{ $item->nama_pelatihan }}</td>
                        <td class="text-center">
                            <form action="{{ route('usulan-kebutuhan-pelatihan.update', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </form>
                            <form action="{{ route('usulan-kebutuhan-pelatihan.delete', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $akpk_5_usulankebutuhanpelatihans->links() }}
    </div>
</div>

<!-- Modal for Tambah Usulan -->
<div class="modal fade" id="tambahUsulanModal" tabindex="-1" aria-labelledby="tambahUsulanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahUsulanModalLabel">Tambah Usulan Pelatihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('usulan-kebutuhan-pelatihan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="tahun" name="tahun" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pelatihan" class="form-label">Nama Pelatihan</label>
                        <input type="text" class="form-control" id="nama_pelatihan" name="nama_pelatihan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-akpk">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('MenuUmum.Akpk.UsulanPelatihan.UsulanKebutuhanPelatihan.editusulpelatihan')
@endsection
