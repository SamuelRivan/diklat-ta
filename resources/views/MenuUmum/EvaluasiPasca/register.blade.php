<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Evaluasi - BKPSDM Surakarta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a00c7;
            --secondary-color: #4a008f;
            --accent-color: #f39c12;
            --bg-color: #f4f6f9;
            --card-bg: #ffffff;
            --text-color: #333333;
            --shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 500px;
            animation: slideUp 0.5s ease-out;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--text-color);
            font-weight: 700;
            font-size: 28px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 14px;
        }

        .alert-danger {
            background-color: #ffebee;
            color: #c62828;
            border-left: 5px solid #c62828;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box;
            background-color: #fafafa;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            background-color: white;
            box-shadow: 0 0 0 4px rgba(106, 0, 199, 0.1);
        }

        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 10px;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-primary {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            color: white;
            box-shadow: 0 5px 15px rgba(106, 0, 199, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(106, 0, 199, 0.4);
        }

        .btn-back {
            background: transparent;
            color: #7f8c8d;
            border: 2px solid #ecf0f1;
            display: block;
            text-align: center;
            text-decoration: none;
            box-sizing: border-box; 
        }

        .btn-back:hover {
            background: #ecf0f1;
            color: #333;
        }

        ul {
            margin: 0;
            padding-left: 20px;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .container {
                padding: 25px;
            }
            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fa-solid fa-user-plus" style="margin-right: 10px; color: var(--primary-color);"></i>Registrasi Evaluator</h2>
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('evaluasi.register.submit') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>NIP</label>
                <input type="text" name="nip" class="form-control" placeholder="Nomor Induk Pegawai" required value="{{ old('nip') }}">
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap Beserta Gelar" required value="{{ old('nama') }}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required value="{{ old('tanggal_lahir') }}">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Buat Password Aman" required>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi Password" required>
            </div>

            <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
            <a href="{{ route('EvaluasiPasca.homepage') }}" class="btn btn-back">Kembali</a>
        </form>
    </div>
</body>
</html>
