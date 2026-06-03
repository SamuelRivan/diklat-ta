<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Draft Katalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        .container {
            max-width: 900px;
            background: white;
            padding: 30px;
            margin-top: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #087f23;
            color: white;
            padding: 20px;
            border-radius: 12px 12px 0 0;
            margin: -30px -30px 30px -30px;
            text-align: center;
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

        .form-label {
            font-weight: 600;
        }

        .alert {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="text-start mt-4 ms-4">
        <a href="{{ route('BrosurPelatihan.usulan') }}" class="btn btn-outline-custom">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="container">
        <header>
            <h3 class="mb-0"><i class="fas fa-file-alt me-2"></i>Input Draft Katalog</h3>
        </header>

        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer || result.isConfirmed) {
                        window.location.href = "{{ route('BrosurPelatihan.usulan') }}";
                    }
                });
            </script>
            @php session()->forget('success'); @endphp
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('BrosurPelatihan.storeusulan') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Penyelenggara</label>
                <input type="text" class="form-control" name="nama_penyelenggara" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Sales</label>
                <input type="text" class="form-control" name="nama_sales" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input type="text" class="form-control" name="no_hp" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Katalog Excel</label>
                <input type="file" class="form-control" name="brosur_excel" accept=".xls,.xlsx">
            </div>

            <div class="mb-3">
                <label class="form-label">Katalog PDF</label>
                <input type="file" class="form-control" name="brosur_pdf" accept=".pdf">
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Surat</label>
                <input type="text" class="form-control" name="no_surat" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Tanggal Surat</label>
                <input type="date" class="form-control" name="tanggal_surat" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('BrosurPelatihan.usulan') }}" class="btn btn-danger">
                    <i class="fa-solid fa-xmark"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fa-solid fa-paper-plane"></i> Submit
                </button>
            </div>
        </form>
    </div>

</body>
</html>
