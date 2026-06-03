@extends('layouts.akpkLayouts.akpk')

@push('styles')
<style>
    .card-profile {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        padding: 32px;
        transition: 0.3s;
    }

    .card-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }

    .profile-img {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: 4px solid #f5f5f5;
    }

    .profile-heading {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 24px;
    }

    .profile-label {
        font-weight: 500;
        color: #555;
    }

    .profile-value {
        color: #111;
    }

    .info-row {
        margin-bottom: 16px;
    }

    .update-btn {
        background-color: #3f3d56;
        color: #fff;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 500;
        transition: 0.3s;
    }

    .update-btn:hover {
        background-color: #2c2a45;
    }

    @media (max-width: 768px) {
        .profile-img {
            margin-bottom: 20px;
        }
    }
</style>
@endpush

@section('content')
<section class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="profile-heading">Profil Pengguna</h2>
        <a href="{{ route('profile.edit') }}" class="btn update-btn">Update Profil</a>
    </div>

    @if(Auth::guard('pegawais')->check())  <!-- Cek jika pengguna sudah login -->
        @php
            $user = Auth::guard('pegawais')->user();
        @endphp

        <div class="card-profile">
            <div class="row align-items-start">
                <!-- Foto Profil -->
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/default-profile.png') }}" alt="Foto Profil" class="profile-img">
                </div>

                <!-- Data Profil -->
                <div class="col-md-8">
                    <div class="info-row row">
                        <div class="col-sm-4 profile-label">NIP</div>
                        <div class="col-sm-8 profile-value">{{ $user->nip ?? '-' }}</div>
                    </div>
                    <div class="info-row row">
                        <div class="col-sm-4 profile-label">NAMA</div>
                        <div class="col-sm-8 profile-value">{{ $user->nama ?? '-' }}</div>
                    </div>
                    <div class="info-row row">
                        <div class="col-sm-4 profile-label">TEMPAT, TANGGAL LAHIR</div>
                        <div class="col-sm-8 profile-value">{{ $user->tempat_lahir ?? '-' }}, {{ \Carbon\Carbon::parse($user->tanggal_lahir ?? null)->translatedFormat('d F Y') }}</div>
                    </div>
                    <div class="info-row row">
                        <div class="col-sm-4 profile-label">PANGKAT/GOLONGAN</div>
                        <div class="col-sm-8 profile-value">{{ $user->pangkat ?? '-' }}</div>
                    </div>
                    <div class="info-row row">
                        <div class="col-sm-4 profile-label">JENIS JABATAN</div>
                        <div class="col-sm-8 profile-value">{{ $user->jenis_asn ?? '-' }}</div>
                    </div>
                    <div class="info-row row">
                        <div class="col-sm-4 profile-label">JABATAN</div>
                        <div class="col-sm-8 profile-value">{{ $user->jabatan ?? '-' }}</div>
                    </div>
                    <div class="info-row row">
                        <div class="col-sm-4 profile-label">UNIT KERJA</div>
                        <div class="col-sm-8 profile-value">{{ $user->unit_kerja ?? '-' }}</div>
                    </div>
                    <div class="info-row row">
                        <div class="col-sm-4 profile-label">NAMA ATASAN</div>
                        <div class="col-sm-8 profile-value">
                            @if($user->id_atasan)
                                @php
                                    $atasan = \App\Models\ref_pegawais::find($user->id_atasan);
                                @endphp
                                {{ $atasan->nama ?? '-' }}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="info-row row">
                        <div class="col-sm-4 profile-label">JABATAN ATASAN</div>
                        <div class="col-sm-8 profile-value">
                            @if($user->id_atasan)
                                {{ $atasan->jabatan ?? '-' }}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="info-row row">
                        <div class="col-sm-4 profile-label">NO HP</div>
                        <div class="col-sm-8 profile-value">{{ $user->no_hp ?? '-' }}</div>
                    </div>
                    <div class="info-row row">
                        <div class="col-sm-4 profile-label">EMAIL</div>
                        <div class="col-sm-8 profile-value">{{ $user->email ?? '-' }}</div>
                    </div>
                    <div class="info-row row">
                        <div class="col-sm-4 profile-label">ALAMAT</div>
                        <div class="col-sm-8 profile-value">{{ $user->alamat ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            Anda harus login terlebih dahulu untuk mengakses halaman ini.
        </div>
        <a href="{{ route('login.akpk') }}" class="btn update-btn">Login AKPK</a>
    @endif
</section>
@endsection
