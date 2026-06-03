@extends('layouts.pegawai') <!-- Layout utama yang kamu gunakan, bisa disesuaikan -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard Pegawai</div>

                <div class="card-body">
                    <p>Selamat datang, {{ $pegawai->nama }} (NIP: {{ $pegawai->nip }})</p>
                    <p>Unit Kerja: {{ $pegawai->unitKerja->unitkerja }}</p>
                    <p>Jabatan: {{ $pegawai->jabatan }}</p>
                    
                    <hr>

                    <p>Anda dapat mengakses berbagai fitur terkait dengan pelatihan yang telah diikuti atau status Anda di unit kerja ini.</p>

                    <!-- Contoh link navigasi untuk fitur lainnya -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
