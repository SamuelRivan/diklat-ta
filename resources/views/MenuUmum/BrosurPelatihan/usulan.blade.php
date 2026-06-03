<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usulan Brosur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-weight: bold;
            color: #087f23;
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .btn-primary-custom {
            background-color: #087f23;
            border: none;
            color: white;
            transition: 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #056018;
        }

        .btn-outline-custom {
            border: 1px solid #087f23;
            color: #087f23;
            background: transparent;
        }

        .btn-outline-custom:hover {
            background-color: #087f23;
            color: white;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .table thead {
            background-color: #087f23;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f0f0f0;
        }

        footer {
            padding: 20px;
            background-color: #087f23;
            color: white;
            text-align: center;
            border-radius: 0 0 10px 10px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-leaf"></i> Usulan Brosur
        </a>
        <div class="header-actions ms-auto">
            <a href="{{ route('frontpage.index') }}" class="btn btn-outline-custom">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('BrosurPelatihan.createusulan') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus"></i> Tambah Usulan
            </a>
        </div>
    </div>
</nav>

<main class="container my-5">
    <div class="card p-4">
        <form method="GET" action="{{ route('BrosurPelatihan.usulan') }}" class="row g-3 align-items-center mb-4">
            <div class="col-md-4">
                <select name="tahun" class="form-select">
                    <option value="">Semua Tahun</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Cari Penyelenggara" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary-custom w-100">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>

        <!-- Tambahan Judul Sebelum Tabel -->
        <h5 class="mb-3 fw-semibold text-success">
            <i class="fas fa-check-circle me-2"></i> Daftar brosur yang sudah disetujui
        </h5>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Penyelenggara</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                        <th>Katalog PDF</th>
                        <th>Katalog Excel</th>
                        <th>Tanggal Ajuan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usulan as $item)
                        <tr>
                            <td>{{ ($usulan->firstItem() ?? 0) + $loop->iteration - 1 }}</td>
                            <td>{{ $item->nama_penyelenggara }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>
                                @if ($item->katalog_pdf)
                                    <a href="{{ asset($item->katalog_pdf) }}" class="btn btn-sm btn-outline-success">Lihat</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->katalog_excel)
                                    <a href="{{ asset($item->katalog_excel) }}" class="btn btn-sm btn-outline-success">Lihat</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $usulan->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</main>

<footer>
    <div class="container text-center">
        <small>
            <i class="fas fa-leaf me-2"></i> 
            <strong>Usulan Brosur</strong> &copy; 2025 • Sistem Informasi Pelatihan
        </small>
    </div>
</footer>

</body>
</html>
