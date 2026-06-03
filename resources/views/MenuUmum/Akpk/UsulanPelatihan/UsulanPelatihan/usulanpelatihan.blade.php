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
        <h2 class="mb-0">Usulan Pelatihan</h2>
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
                <button class="btn btn-akpk" data-bs-toggle="modal" data-bs-target="#modalTambahUsulan">
                    <i class="bi bi-plus-lg"></i> Tambah Usulan
                </button>
            </div>
        </div>

        <div class="table-wrapper">
            <table class="table table-bordered mb-0">
                <thead class="bg-akpk text-white text-center">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Tanggal Daftar</th>
                        <th>Nama Pelatihan</th>
                        <th style="width: 20%;">Waktu Pelaksanaan</th>
                        <th>Biaya Pelatihan</th>
                        <th>Biaya Hotel</th>
                        <th>Biaya Akomodasi</th>
                        <th>Uang Harian</th>
                        <th>Usulan Dari OPD</th>
                        <th>File Penawaran</th>
                        <th>Status</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $itemsPerPage = 10;
                        $currentPage = request()->get('page', 1);
                        $usulan = [
                            ['id' => 1, 'tanggal_daftar' => '02 Januari 2025', 'nama_pelatihan' => 'Pelatihan SPBE', 'waktu_pelaksanaan' => '28 s.d 29 Oktober 2025', 'biaya_pelatihan' => '3,000,000', 'biaya_hotel' => '1,500,000', 'biaya_akomodasi' => '150,000', 'uang_harian' => '300,000', 'usulan_opd' => 'OPD 1', 'file_penawaran' => 'FILE USULAN.pdf', 'status' => 'Diterima'],
                            ['id' => 2, 'tanggal_daftar' => '10 Januari 2025', 'nama_pelatihan' => 'Pelatihan Teknologi', 'waktu_pelaksanaan' => '15 s.d 17 November 2025', 'biaya_pelatihan' => '4,000,000', 'biaya_hotel' => '2,000,000', 'biaya_akomodasi' => '200,000', 'uang_harian' => '350,000', 'usulan_opd' => 'OPD 2', 'file_penawaran' => 'FILE PENAWARAN.pdf', 'status' => 'Ditolak'],
                        ];
                        $totalPages = ceil(count($usulan) / $itemsPerPage);
                        $start = ($currentPage - 1) * $itemsPerPage;
                        $paginatedUsulan = array_slice($usulan, $start, $itemsPerPage);
                    @endphp

                    @foreach ($paginatedUsulan as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $item['tanggal_daftar'] }}</td>
                            <td>{{ $item['nama_pelatihan'] }}</td>
                            <td class="text-center">{{ $item['waktu_pelaksanaan'] }}</td>
                            <td class="text-end">{{ number_format(floatval($item['biaya_pelatihan']), 0, ',', '.') }}</td>
<td class="text-end">{{ number_format(floatval($item['biaya_hotel']), 0, ',', '.') }}</td>
<td class="text-end">{{ number_format(floatval($item['biaya_akomodasi']), 0, ',', '.') }}</td>
<td class="text-end">{{ number_format(floatval($item['uang_harian']), 0, ',', '.') }}</td>

                            <td>{{ $item['usulan_opd'] }}</td>
                            <td>
                                <a href="{{ asset('files/' . $item['file_penawaran']) }}" target="_blank" class="btn btn-link">
                                    {{ $item['file_penawaran'] }}
                                </a>
                            </td>
                            <td class="text-center">{{ $item['status'] }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-1" title="Edit" data-bs-toggle="modal"
                                    data-bs-target="#modalEditUsulan" data-id="{{ $item['id'] }}"
                                    data-tanggal="{{ $item['tanggal_daftar'] }}" data-nama="{{ $item['nama_pelatihan'] }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <a href="#" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            <nav>
                <ul class="pagination">
                    <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="?page={{ $currentPage - 1 }}" aria-label="Previous">
                            &laquo;
                        </a>
                    </li>
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                            <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                        <a class="page-link" href="?page={{ $currentPage + 1 }}" aria-label="Next">
                            &raquo;
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    @include('MenuUmum.Akpk.UsulanPelatihan.Usulan.tambahUsulPelatihan')
    @include('MenuUmum.Akpk.UsulanPelatihan.Usulan.editUsulPelatihan')
</section>
@endsection
