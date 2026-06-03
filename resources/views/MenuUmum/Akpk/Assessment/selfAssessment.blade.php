@extends('layouts.akpkLayouts.akpk')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        background: #ffffff;
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        background-color: #6C63FF;
        color: white;
        font-size: 1.25rem;
        font-weight: bold;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 15px;
    }

    .table th, .table td {
        padding: 15px;
        text-align: center;
    }

    thead.bg-primary th {
        background-color: #4e73df !important;
        color: white;
    }

    .form-control {
        border-radius: 10px;
        padding: 15px;
        border: 2px solid #ddd;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #6C63FF;
        box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
    }

    .btn-primary {
        background-color: #6C63FF;
        border-color: #6C63FF;
        padding: 12px 30px;
        font-size: 1.1rem;
        border-radius: 30px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #5a54e5;
        transform: translateY(-5px);
    }

    .form-check-input {
        border-radius: 50%;
    }

    .kompetensi-radio input[type="radio"] {
        accent-color: #0d6efd;
    }

    .shadow-box {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        padding: 20px;
        background: #fff;
    }

    .container {
        margin-top: 50px;
    }

    h2 {
        font-size: 2.5rem;
        color: #333;
        font-weight: bold;
    }

    label {
        font-weight: 600;
        color: #555;
    }
</style>

@section('content')
<section class="container">
    <div class="d-flex justify-content-start align-items-center mb-4">
        <!-- Ikon Feather -->
        <i data-feather="user" style="width: 30px; height: 30px;"></i>
        <h2 class="mb-0">Self Assessment</h2>
    </div>

    <!-- Form Data Diri -->
    <div class="card shadow-box mb-4">
        <div class="card-header">Form Data Diri</div>
        <div class="card-body">
            <form action="{{ route('self-assessment.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ Auth::guard('pegawais')->user()->nama }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ Auth::guard('pegawais')->user()->nip }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ Auth::guard('pegawais')->user()->jabatan }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="unit_kerja" class="col-sm-3 col-form-label">Unit Kerja</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" value="{{ Auth::guard('pegawais')->user()->unit_kerja }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nama_atasan" class="col-sm-3 col-form-label">Nama Atasan</label>
                    <div class="col-sm-9">
                        @php
                            $id_atasan = Auth::guard('pegawais')->user()->id_atasan;
                            $nama = \App\Models\ref_pegawais::find($id_atasan)->nama ?? 'Tidak Diketahui';
                        @endphp
                        <input type="text" class="form-control" id="nama_atasan" name="nama_atasan" value="{{ $nama }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tanggal_pengisian" class="col-sm-3 col-form-label">Tanggal Pengisian</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_pengisian" name="tanggal_pengisian" value="{{ now()->format('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                    <div class="col-sm-9">
                        <select class="form-select form-control" id="tahun" name="tahun">
                            @for ($year = 2025; $year <= 2030; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Instruksi Penilaian -->
                <div class="card shadow-box mb-4">
                    <div class="card-header">Instruksi Penilaian</div>
                    <div class="card-body">
                        <p><strong>Instruksi:</strong><br>
                        Silakan beri penilaian dari 1 - 5 pada setiap kompetensi berdasarkan pengamatan dan penilaian Anda terhadap diri sendiri.</p>

                        <p><strong>Skala Penilaian:</strong></p>
                        <ul>
                            <li><strong>5</strong> : Sangat Mampu</li>
                            <li><strong>4</strong> : Mampu</li>
                            <li><strong>3</strong> : Cukup Mampu</li>
                            <li><strong>2</strong> : Kurang Mampu</li>
                            <li><strong>1</strong> : Tidak Mampu</li>
                        </ul>
                    </div>
                </div>

                <!-- Form Assessment Kompetensi Manajerial -->
                <div class="card shadow-box mb-4">
                    <div class="card-header">Assessment Kompetensi Manajerial</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Kompetensi</th>
                                        <th>Deskripsi</th>
                                        <th>Skala (1-5)</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $manajerialLanjutan = [
                                            ['nama' => 'Integritas', 'deskripsi' => 'Konsisten dengan nilai dan etika organisasi.'],
                                            ['nama' => 'Kerjasama', 'deskripsi' => 'Bekerja efektif dalam tim.'],
                                            ['nama' => 'Komunikasi', 'deskripsi' => 'Menyampaikan dan menerima informasi dengan jelas.'],
                                            ['nama' => 'Orientasi pada Hasil', 'deskripsi' => 'Fokus pada pencapaian tujuan.'],
                                            ['nama' => 'Pelayanan Publik', 'deskripsi' => 'Memberikan pelayanan terbaik kepada masyarakat.'],
                                            ['nama' => 'Pengembangan Diri dan Orang Lain', 'deskripsi' => 'Meningkatkan kapasitas diri dan tim.'],
                                            ['nama' => 'Mengelola Perubahan', 'deskripsi' => 'Beradaptasi dan memimpin perubahan.'],
                                            ['nama' => 'Pengambilan Keputusan', 'deskripsi' => 'Membuat keputusan yang tepat.'],
                                        ];
                                    @endphp

                                    @foreach ($manajerialLanjutan as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item['nama'] }}</td>
                                            <td>{{ $item['deskripsi'] }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2 kompetensi-radio">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div class="d-flex flex-column align-items-center" style="width: 30px;">
                                                            <input class="form-check-input" type="radio" name="manajerial_skala[{{ $index }}]" id="manajerial{{ $index }}_{{ $i }}" value="{{ $i }}" required>
                                                            <span class="mt-1">{{ $i }}</span>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" name="manajerial_keterangan[{{ $index }}]" class="form-control" placeholder="Keterangan">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Form Assessment Kompetensi Teknis -->
                <div class="card shadow-box mb-4">
                    <div class="card-header">Assessment Kompetensi Teknis</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Kompetensi</th>
                                        <th>Deskripsi</th>
                                        <th>Skala (1-5)</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $teknis = [
                                            ['nama' => 'Penguasaan Teknologi', 'deskripsi' => 'Menggunakan teknologi yang relevan.'],
                                            ['nama' => 'Keahlian Spesifik', 'deskripsi' => 'Keterampilan teknis spesifik untuk jabatan.'],
                                            ['nama' => 'Penerapan Prosedur', 'deskripsi' => 'Melaksanakan prosedur kerja dengan konsisten.'],
                                        ];
                                    @endphp

                                    @foreach ($teknis as $index => $item)
                                        <tr>
                                            <td>{{ $index + 9 }}</td>
                                            <td>{{ $item['nama'] }}</td>
                                            <td>{{ $item['deskripsi'] }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="teknis_skala[{{ $index }}]" id="teknis{{ $index }}_{{ $i }}" value="{{ $i }}" required>
                                                            <label class="form-check-label" for="teknis{{ $index }}_{{ $i }}">{{ $i }}</label>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </td>
                                            <td><input type="text" name="teknis_keterangan[{{ $index }}]" class="form-control" placeholder="Keterangan"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Form Assessment Kompetensi Sosio Kultural -->
                <div class="card shadow-box mb-4">
                    <div class="card-header">Assessment Kompetensi Sosio Kultural</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Kompetensi</th>
                                        <th>Deskripsi</th>
                                        <th>Skala (1-5)</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sosio = [
                                            ['nama' => 'Kemajemukan', 'deskripsi' => 'Peka, memahami, dan menerima kemajemukan.'],
                                            ['nama' => 'Menghargai', 'deskripsi' => 'Aktif mengembangkan sikap saling menghargai, menekankan persamaan dan kesatuan.'],
                                            ['nama' => 'Toleransi', 'deskripsi' => 'Mempromosikan dan mengembangkan sikap toleransi dan persatuan.'],
                                            ['nama' => 'Daya Guna', 'deskripsi' => 'Mendayagunakan perbedaan secara konstruktif dan kreatif untuk efektivitas organisasi.'],
                                            ['nama' => 'Hubungan Sosial', 'deskripsi' => 'Membangun hubungan sosial yang produktif dan inklusif.'],
                                        ];
                                    @endphp

                                    @foreach ($sosio as $index => $item)
                                        <tr>
                                            <td>{{ $index + 12 }}</td>
                                            <td>{{ $item['nama'] }}</td>
                                            <td>{{ $item['deskripsi'] }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="sosio_skala[{{ $index }}]" id="sosio{{ $index }}_{{ $i }}" value="{{ $i }}" required>
                                                            <label class="form-check-label" for="sosio{{ $index }}_{{ $i }}">{{ $i }}</label>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </td>
                                            <td><input type="text" name="sosio_keterangan[{{ $index }}]" class="form-control" placeholder="Keterangan"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Identifikasi Kebutuhan -->
                <div class="card shadow-box mb-4">
                    <div class="card-header" style="background-color: #6C63FF; color: white;">Identifikasi Kebutuhan</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="kompetensi_dibutuhkan" class="form-label">Kompetensi yang dibutuhkan</label>
                            <textarea class="form-control" id="kompetensi_dibutuhkan" name="kompetensi_dibutuhkan" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="pelatihan_dibutuhkan" class="form-label">Pelatihan yang dibutuhkan</label>
                            <textarea class="form-control" id="pelatihan_dibutuhkan" name="pelatihan_dibutuhkan" rows="3" required></textarea>
                        </div>
                    </div>
                </div>

                <!-- Button Simpan Data -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
