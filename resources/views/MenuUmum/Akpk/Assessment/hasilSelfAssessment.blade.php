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
    <section class="container">
        <div class="d-flex align-items-center mb-4">
            <img src="images/IconHitamBiru.png" alt="Icon" class="me-2" style="width: 24px; height: 24px;">
            <h2 class="mb-0">Hasil Self Assessment</h2>
        </div>

        <!-- Form Assessment Kompetensi Manajerial -->
        <div class="card mb-4">
            <div class="table-responsive rounded overflow-hidden">
                <table class="table table-bordered mb-0">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <th style="vertical-align: middle;">No</th>
                            <th style="vertical-align: middle;">Kompetensi <br> Teknis</th>
                            <th style="vertical-align: middle;">Deskripsi</th>
                            <th style="vertical-align: middle;">Nilai</th>
                            <th style="vertical-align: middle;">Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $kompetensi = [
                                [
                                    'nama' => 'Integritas',
                                    'deskripsi' =>
                                        'Mematuhi dan menegakkan nilai-nilai dan etika organisasi pada tingkat yang sangat tinggi.',
                                    'nilai' => 4,
                                    'komentar' => 'ASN sangat mampu dan konsisten dalam mematuhi dan menegakkan nilai-nilai dan etika organisasi pada tingkat yang sangat tinggi.',
                                ],
                                [
                                    'nama' => 'Kerjasama',
                                    'deskripsi' => 'Mampu bekerja sama dalam tim dengan efektif.',
                                    'nilai' => 3,
                                    'komentar' => 'ASN mampu bekerja sama dalam tim dengan efektif.',
                                ],
                                [
                                    'nama' => 'Kepemimpinan',
                                    'deskripsi' => 'Mampu memimpin dan mengambil keputusan strategis.',
                                    'nilai' => 4,
                                    'komentar' => 'ASN sangat mampu memimpin dan mengambil keputusan strategis.',
                                ],
                                [
                                    'nama' => 'Integritas',
                                    'deskripsi' =>
                                        'Mematuhi dan menegakkan nilai-nilai dan etika organisasi pada tingkat yang sangat tinggi.',
                                    'nilai' => 4,
                                    'komentar' => 'ASN sangat mampu dan konsisten dalam mematuhi dan menegakkan nilai-nilai dan etika organisasi pada tingkat yang sangat tinggi.',
                                ],
                                [
                                    'nama' => 'Kerjasama',
                                    'deskripsi' => 'Mampu bekerja sama dalam tim dengan efektif.',
                                    'nilai' => 4,
                                    'komentar' => 'ASN sangat mampu dan konsisten dalam mematuhi dan menegakkan nilai-nilai dan etika organisasi pada tingkat yang sangat tinggi.',
                                ],
                                [
                                    'nama' => 'Kepemimpinan',
                                    'deskripsi' => 'Mampu memimpin dan mengambil keputusan strategis.',
                                    'nilai' => 4,
                                    'komentar' => 'ASN sangat mampu dan konsisten dalam mematuhi dan menegakkan nilai-nilai dan etika organisasi pada tingkat yang sangat tinggi.',
                                ],
                                [
                                    'nama' => 'Kerjasama',
                                    'deskripsi' => 'Mampu bekerja sama dalam tim dengan efektif.',
                                    'nilai' => 3,
                                    'komentar' => 'ASN mampu bekerja sama dalam tim dengan efektif.',
                                ],
                                [
                                    'nama' => 'Kepemimpinan',
                                    'deskripsi' => 'Mampu memimpin dan mengambil keputusan strategis.',
                                    'nilai' => 2,
                                    'komentar' => 'ASN mampu memimpin dan mengambil keputusan strategis.',
                                ],
                            ];
                        @endphp

                        @foreach ($kompetensi as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td>{{ $item['deskripsi'] }}</td>
                                <td>{{ $item['nilai'] }}</td>
                                <td>{{ $item['komentar'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer" style="background-color: #C1D6F7"></div>
        </div>

        <!-- Form Assessment Kompetensi Kepribadian -->
        <div class="card mb-4">
            <div class="card-header fw-bold" style="background-color: #C1D6F7">Identifikasi Kebutuhan</div>

            <div class="mb-1 p-3">
                <label for="exampleFormControlTextarea1" class="form-label">1. Kompetensi yang dibutuhkan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">Kompetensi yang saya butuhkan adalah komputerisasi agar saya leih handal dalam menggunakan komputer</textarea>
            </div>

            <div class="mb-2 p-3">
                <label for="exampleFormControlTextarea1" class="form-label">2. Pelatihan yang dibutuhkan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"> Pelatihan yang saya butuhkan adalah komputerisasi agar saya leih handal dalam menggunakan komputer</textarea>
            </div>
            <div class="card-footer" style="background-color: #C1D6F7"></div>
        </div>
    </section>
@endsection
