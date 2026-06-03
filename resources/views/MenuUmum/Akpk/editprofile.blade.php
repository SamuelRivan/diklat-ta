@extends('layouts.akpkLayouts.akpk')

@section('content')
<section class="container py-4">
    <h2>Edit Profil</h2>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $user->tempat_lahir }}">
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}">
        </div>
        <div class="mb-3">
            <label for="pangkat_golongan" class="form-label">Pangkat/Golongan</label>
            <input type="text" class="form-control" id="pangkat_golongan" name="pangkat_golongan" value="{{ $user->pangkat }}">
        </div>
        <div class="mb-3">
            <label for="jenis_jabatan" class="form-label">Jenis Jabatan</label>
            <input type="text" class="form-control" id="jenis_jabatan" name="jenis_jabatan" value="{{ $user->jenis_asn }}">
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $user->jabatan }}">
        </div>
        <div class="mb-3">
            <label for="unit_kerja" class="form-label">Unit Kerja</label>
            <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" value="{{ $user->unit_kerja }}">
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $user->no_hp }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="atasan_anda" class="form-label">Atasan Anda</label>
            <select class="form-control" id="atasan_anda" name="atasan_anda">
                <option value="">Pilih Atasan Anda</option>
                @foreach($refPegawais as $pegawai)
                    <option value="{{ $pegawai->id }}" {{ $user->id_atasan == $pegawai->id ? 'selected' : '' }}>
                        {{ $pegawai->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $user->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto Profil</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</section>
@endsection
