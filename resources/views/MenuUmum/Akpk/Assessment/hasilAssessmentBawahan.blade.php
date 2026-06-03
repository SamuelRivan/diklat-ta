@extends('layouts.akpkLayouts.akpk')

<style>
    thead.bg-primary th {
        background-color: #C1D6F7 !important;
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
</style>

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <section class="container">
        <div class="d-flex align-items-center mb-4">
            <img src="images/IconHitamBiru.png" alt="Icon" class="me-2" style="width: 24px; height: 24px;">
            <h2 class="mb-0">Hasil Assessment Bawahan</h2>
        </div>

        <!-- Form Data Diri -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Form Data Diri</div>
            <div class="card-body">
                <form>
                    <div class="row mb-2">
                        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" value="Nanang Ardiansyah" readonly>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="nip" class="col-sm-3 col-form-label">NIP Atasan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nip" value="1987654321" readonly>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jabatan" value="Analis Kepegawaian" readonly>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="unit_kerja" class="col-sm-3 col-form-label">Unit Kerja</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="unit_kerja" value="BKPSDM Surakarta" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-primary"></div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-3">
            <button type="button" class="btn btn-success" onclick="cetakExcel()">
                <i class="fas fa-file-excel me-2"></i>Cetak Excel
            </button>
            <button type="button" class="btn btn-danger" onclick="cetakPDF()">
                <i class="fas fa-file-pdf me-2"></i>Cetak PDF
            </button>
        </div>

        <!-- Form Assessment Kompetensi Teknis -->
        <div class="card mb-4">
            <div class="table-responsive" style="max-width: 100%; overflow-x: auto;">
                <table class="table table-bordered mb-0">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <th style="vertical-align: middle;">No</th>
                            <th style="vertical-align: middle;">NIP</th>
                            <th style="vertical-align: middle;">Nama Bawahan</th>
                            <th style="vertical-align: middle;">Jabatan</th>
                            <th style="vertical-align: middle;">Standar Minimal <br> Kompetensi</th>
                            <th style="vertical-align: middle;">Integritas</th>
                            <th style="vertical-align: middle;">Kerjasama</th>
                            <th style="vertical-align: middle;">Kepemimpinan</th>
                            <th style="vertical-align: middle;">Orientasi <br> Hasil</th>
                            <th style="vertical-align: middle;">Pelayanan <br> Publik</th>
                            <th style="vertical-align: middle;">Pengembangan <br> Diri</th>
                            <th style="vertical-align: middle;">Mengelola <br> Perubahan</th>
                            <th style="vertical-align: middle;">Pengambilan <br> Keputusan</th>
                            <th style="vertical-align: middle;">Penguasaan <br> Teknologi</th>
                            <th style="vertical-align: middle;">Keahlian <br> Spesifik</th>
                            <th style="vertical-align: middle;">Kepemimpinan</th>
                            <th style="vertical-align: middle;">Kepemimpinan</th>
                            <th style="vertical-align: middle;">Kepemimpinan</th>
                            <th style="vertical-align: middle;">Kepemimpinan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $itemsPerPage = 10;
                            $currentPage = request()->get('page', 1);
                            $kompetensi = [
                                [
                                    'NIP' => '1987654321',
                                    'nama' => 'Nanang Ardiansyah',
                                    'jabatan' => 'Analis Kepegawaian',
                                    'standar_minimal' => 3,
                                    'integritas' => 4,
                                    'kerjasama' => 3,
                                    'kepemimpinan' => 4,
                                    'orientasi_hasil' => 3,
                                    'pelayanan_publik' => 4,
                                    'pengembangan_diri' => 3,
                                    'mengelola_perubahan' => 4,
                                    'pengambilan_keputusan' => 3,
                                    'penguasaan_teknologi' => 4,
                                    'keahlian_spesifik' => 3,
                                    'kepemimpinan' => 4,
                                    'kepemimpinan' => 3,
                                    'kepemimpinan' => 4,
                                    'kepemimpinan' => 3,
                                ],
                            ];

                            $totalPages = ceil(count($kompetensi) / $itemsPerPage);
                            $start = ($currentPage - 1) * $itemsPerPage;
                            $paginatedKompetensi = array_slice($kompetensi, $start, $itemsPerPage);
                        @endphp

                        @foreach ($paginatedKompetensi as $index => $item)
                            <tr>
                                <td>{{ $start + $index + 1 }}</td>
                                <td>{{ $item['NIP'] }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td>{{ $item['jabatan'] }}</td>
                                <td>{{ $item['standar_minimal'] }}</td>
                                <td>{{ $item['integritas'] }}</td>
                                <td>{{ $item['kerjasama'] }}</td>
                                <td>{{ $item['kepemimpinan'] }}</td>
                                <td>{{ $item['orientasi_hasil'] }}</td>
                                <td>{{ $item['pelayanan_publik'] }}</td>
                                <td>{{ $item['pengembangan_diri'] }}</td>
                                <td>{{ $item['mengelola_perubahan'] }}</td>
                                <td>{{ $item['pengambilan_keputusan'] }}</td>
                                <td>{{ $item['penguasaan_teknologi'] }}</td>
                                <td>{{ $item['keahlian_spesifik'] }}</td>
                                <td>{{ $item['kepemimpinan'] }}</td>
                                <td>{{ $item['kepemimpinan'] }}</td>
                                <td>{{ $item['kepemimpinan'] }}</td>
                                <td>{{ $item['kepemimpinan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Controls -->
            <div class="card-footer" style="background-color: #C1D6F7">
                <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="?page={{ $currentPage - 1 }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo; Previous</span>
                                </a>
                            </li>
                            @for ($i = 1; $i <= $totalPages; $i++)
                                <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                    <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                                <a class="page-link" href="?page={{ $currentPage + 1 }}" aria-label="Next">
                                    <span aria-hidden="true">Net &raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <script>
        function cetakExcel() {
            Swal.fire({
                title: 'Download Excel Berhasil',
                text: 'File Excel telah berhasil diunduh',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        }

        function cetakPDF() {
            // Add your PDF export logic here
            Swal.fire({
                title: 'Download PDF Berhasil',
                text: 'File PDF telah berhasil diunduh',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        }
    </script>
@endsection
