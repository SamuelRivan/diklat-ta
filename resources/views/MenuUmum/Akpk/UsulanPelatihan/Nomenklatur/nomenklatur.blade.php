@extends('layouts.akpkLayouts.akpk')

<style>
    thead.bg-primary th {
        background-color: #C1D6F7 !important;
        color: #000 !important;
    }

    .table-bordered {
        border: none;
    }

    .rounded .table-bordered thead th:first-child {
        border-top-left-radius: 0.25rem;
    }

    .rounded .table-bordered thead th:last-child {
        border-top-right-radius: 0.25rem;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.5em 0.75em;
    }
</style>

@section('content')
<section class="container">
    <div class="d-flex justify-content-start align-items-center mb-4">
        <!-- Ikon Feather -->
        <i data-feather="user" style="width: 30px; height: 30px;"></i>
        <h2 class="mb-0">Nomenklatur</h2>
    </div>
</section>

        <!-- Filter dan Tombol -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3 mb-2">
                <select class="form-select" id="rumpun">
                    <option selected disabled>Pilih Rumpun</option>
                    <option value="Kepemimpinan">Kepemimpinan</option>
                    <option value="Manajerial">Manajerial</option>
                    <option value="Teknis">Teknis</option>
                    <option value="Fungsional">Fungsional</option>
                    <option value="Sosial Kultural">Sosial Kultural</option>
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari..." id="searchInput">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-5 text-end">
                <button type="button" class="btn btn-danger me-2" onclick="cetakPDF()">
                    <i class="fas fa-file-pdf me-2"></i> Cetak PDF
                </button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahNomenklatur">
                    <i class="bi bi-plus-lg"></i> Tambah Usulan
                </button>
            </div>
        </div>

        <!-- Tabel -->
        <div class="card mb-4">
            <div class="table-responsive rounded overflow-hidden">
                <table class="table table-bordered mb-0">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Rumpun</th>
                            <th>Nama Pelatihan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $itemsPerPage = 10;
                            $currentPage = request()->get('page', 1);
                            $Nomenklatur = [
                                [
                                    'id' => 1,
                                    'rumpun' => 'Kepemimpinan',
                                    'nama_pelatihan' => 'Pelatihan Kepemimpinan Administrator',
                                    'status' => 'aktif',
                                ],
                                [
                                    'id' => 2,
                                    'rumpun' => 'Manajerial',
                                    'nama_pelatihan' => 'Pelatihan Manajemen SDM',
                                    'status' => 'tidak_aktif',
                                ],
                            ];
                            $totalPages = ceil(count($Nomenklatur) / $itemsPerPage);
                            $start = ($currentPage - 1) * $itemsPerPage;
                            $paginatedNomenklatur = array_slice($Nomenklatur, $start, $itemsPerPage);
                        @endphp

                        @foreach ($paginatedNomenklatur as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $item['rumpun'] }}</td>
                                <td>{{ $item['nama_pelatihan'] }}</td>
                                <td class="text-center">
                                    @if ($item['status'] == 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item['status'] == 'tidak_aktif')
                                        <span class="text-muted">Pelatihan sudah tidak tersedia</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-center">
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="?page={{ $currentPage - 1 }}">
                                    &laquo; Previous
                                </a>
                            </li>
                            @for ($i = 1; $i <= $totalPages; $i++)
                                <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                    <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                                <a class="page-link" href="?page={{ $currentPage + 1 }}">
                                    Next &raquo;
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Modal Tambah -->
        @include('MenuUmum.Akpk.UsulanPelatihan.Nomenklatur.tambahNomenklatur')
    </section>

    <script>
        function cetakPDF() {
            alert('Ekspor ke PDF belum diimplementasikan.');
        }
    </script>
@endsection
