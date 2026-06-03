@extends('layouts.app')
@section('head')
<style>
    body {
        background-color: #E9ECEF !important;
    }
</style>
@endsection
@section('content')
<div class="container-fluid p-0 content-container main-content">
    <!-- Header dengan background biru -->
    <div class="bg-primary text-white p-4 position-relative overflow-hidden bg-primary-section">
        <!-- Elemen dekoratif (seperti roket) di pojok kanan -->
        <div class="position-absolute end-0 top-0 opacity-25">
            <img src="{{ asset('images/roketDashboard.png') }}" alt="Illustration" height="150">
        </div>
        <!-- Background pattern dots -->
        <div class="position-absolute w-100 h-100 top-0 start-0" style="background-image: radial-gradient(rgba(255,255,255,0.2) 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div class="container position-relative">
            <h4 class="fw-bold mb-2">Pertanyaan Assessment</h4>
            <p class="mb-0 opacity-75">Data pertanyaan Self Assessment untuk seluruh ASN Kota Surakarta.</p>
        </div>
    </div>
    <div class="container mt-4">
        <!-- Filter dan Tombol -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <div class="d-flex gap-2">
                <select class="form-select" style="min-width: 200px;">
                    <option selected>Pilih Kategori</option>
                    <option value="1">Eselon II</option>
                    <option value="2">Eselon III</option>
                    <option value="3">Eselon IV</option>
                </select>
                <div class="input-group" style="min-width: 250px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Search">
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary">
                    <i class="bi bi-upload me-1"></i> Import
                </button>
                <button class="btn btn-success">
                    <i class="bi bi-file-earmark-excel-fill me-1"></i> Cetak Excel
                </button>
                <button class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> Cetak PDF
                </button>
                <button class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah
                </button>
            </div>
        </div>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Tipe</th>
                        <th>Kompetensi</th>
                        <th>Deskripsi</th>
                        <th>Standar Minimum</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $data = [
                            ['Eselon II', 'Skala', 'Integritas', 'Mematuhi dan menegakkan nilai-nilai dan etika organisasi pada tingkat yang sangat tinggi.', 5],
                            ['Eselon II', 'Skala', 'Kerjasama', 'Mampu mengelola kolaborasi strategis antara unit kerja dan dengan pemangku kepentingan eksternal.', 5],
                            ['Eselon II', 'Skala', 'Komunikasi', 'Mampu berkomunikasi secara efektif baik secara lisan maupun tertulis, terutama dalam konteks kebijakan publik.', 5],
                            ['Eselon II', 'Skala', 'Orientasi pada Hasil', 'Fokus yang kuat pada pencapaian hasil strategis organisasi.', 5],
                            ['Eselon II', 'Skala', 'Pelayanan Publik', 'Komitmen tinggi terhadap pelayanan publik yang inovatif dan proaktif.', 4],
                            ['Eselon II', 'Skala', 'Pengembangan Diri dan Orang Lain', 'Mampu mengembangkan diri dan memimpin pengembangan kompetensi orang lain dalam organisasi.', 4],
                            ['Eselon II', 'Skala', 'Mengelola Perubahan', 'Memimpin dan mengelola perubahan besar dalam organisasi.', 5],
                            ['Eselon II', 'Skala', 'Pengambilan Keputusan', 'Membuat keputusan strategis dengan dampak jangka panjang yang tinggi.', 5],
                            ['Eselon II', 'Skala', 'Kemajemukan', 'Peka memahami dan menerima kemajemukan.', 5],
                            ['Eselon II', 'Skala', 'Menghargai', 'Aktif mengembangkan sikap saling menghargai, menekankan persamaan dan kesatuan.', 5],
                            ['Eselon II', 'Skala', 'Toleransi', 'Memproklamasikan, mengembangkan sikap saling toleransi dan persatuan.', 5],
                            ['Eselon II', 'Skala', 'Daya Guna', 'Mendayagunakan perbedaan secara konstruktif dan kreatif untuk meningkatkan efektivitas organisasi.', 5],
                            ['Eselon II', 'Skala', 'Hubungan Sosial', 'Mendayagunakan perbedaan secara konstruktif dan kreatif untuk meningkatkan efektivitas organisasi.', 5],
                            ['Eselon II', 'Skala', 'Penguasaan Teknologi', 'Menguasai teknologi informasi dan manajemen data untuk pengambilan keputusan strategis.', 5],
                            ['Eselon II', 'Skala', 'Keahlian Spesifik', 'Kebijakan publik dan pengelolaan sumber daya organisasi.', 4],
                            ['Eselon II', 'Skala', 'Penerapan Prosedur', 'Menerapkan prosedur kerja dengan standar tertinggi, termasuk dalam situasi yang kompleks.', 5],
                            ['Eselon II', 'Essai', 'Identifikasi Kebutuhan', 'Kompetensi yang perlu ditingkatkan :', 0],
                            ['Eselon II', 'Essai', 'Identifikasi Kebutuhan', 'Pelatihan yang dibutuhkan :', 0],
                        ];
                    @endphp
                    @foreach($data as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row[0] }}</td>
                        <td>{{ $row[1] }}</td>
                        <td>{{ $row[2] }}</td>
                        <td>{{ $row[3] }}</td>
                        <td class="text-center">{{ $row[4] }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <button class="btn btn-outline-secondary btn-sm">Previous</button>
            <span class="text-muted">Page 1 of 10</span>
            <button class="btn btn-outline-secondary btn-sm">Next</button>
        </div>
    </div>
</div>
@endsection

