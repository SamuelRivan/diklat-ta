{{-- Admin: View Mapping Kuesioner ke Pelatihan --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Assign Kuesioner : {{ $kuesioner->judul }}</h5>
            </div>
            <a href="{{ route('admin.kuesioner.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.kuesioner.assign', $kuesioner->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="pelatihan_id" class="form-label">Pilih Pelatihan</label>
                            <select name="pelatihan_id" id="pelatihan_id" class="form-select" required>
                                <option value="">-- Pilih Pelatihan --</option>
                                @foreach($pelatihanList as $pel)
                                    <option value="{{ $pel->id }}">{{ $pel->nama_pelatihan ?? ('Pelatihan #' . $pel->id) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai (opsional)</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai (opsional)</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control">
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1">
                            <label class="form-check-label" for="is_active">Aktifkan assignment</label>
                        </div>
                        <button class="btn btn-primary">Assign</button>
                    </form>
                </div>

                <div class="col-md-6">
                    <h6>Pelatihan yang sudah di-assign</h6>
                    @if($kuesioner->pelatihan->isEmpty())
                        <p class="text-muted">Belum ada pelatihan yang menggunakan kuesioner ini.</p>
                    @else
                        <ul class="list-group">
                            @foreach($kuesioner->pelatihan as $pel)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="fw-bold">{{ $pel->nama_pelatihan ?? ('Pelatihan #' . $pel->id) }}</div>
                                        <small class="text-muted">
                                            Mulai: {{ $pel->pivot->tanggal_mulai ? \Carbon\Carbon::parse($pel->pivot->tanggal_mulai)->format('Y-m-d') : '-' }}
                                            | Selesai: {{ $pel->pivot->tanggal_selesai ? \Carbon\Carbon::parse($pel->pivot->tanggal_selesai)->format('Y-m-d') : '-' }}
                                        </small>
                                    </div>
                                    <form action="{{ route('admin.kuesioner.unassign', [$kuesioner->id, $pel->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus assignment ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Unassign</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
