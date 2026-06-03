<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Evaluasi BKPSDM Surakarta</title>
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
            max-width: 450px;
            animation: fadeIn 0.5s ease-out;
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
            background: linear-gradient(90deg, #ff9966, #ff5e62);
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            color: var(--text-color);
            font-weight: 700;
            font-size: 26px;
        }

        p.subtitle {
            text-align: center;
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 30px;
            line-height: 1.6;
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

        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border-left: 5px solid #2e7d32;
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
            border-color: #ff5e62;
            outline: none;
            background-color: white;
            box-shadow: 0 0 0 4px rgba(255, 94, 98, 0.1);
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
            display: block;
            text-align: center;
            text-decoration: none;
            box-sizing: border-box;
        }

        .btn-primary {
            background: linear-gradient(90deg, #ff9966, #ff5e62);
            color: white;
            box-shadow: 0 5px 15px rgba(255, 94, 98, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 94, 98, 0.4);
        }

        .btn-back {
            background: transparent;
            color: #7f8c8d;
            border: 2px solid #ecf0f1;
            margin-top: 15px;
        }

        .btn-back:hover {
            background: #ecf0f1;
            color: #333;
        }

        .divider {
            margin: 30px 0;
            border-top: 1px dashed #e0e0e0;
            position: relative;
        }

        .divider span {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            padding: 0 15px;
            color: #95a5a6;
            font-size: 12px;
            font-weight: 500;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fa-solid fa-lock-open" style="margin-right: 10px; color: #ff5e62;"></i>Reset Password</h2>
        <p class="subtitle">Verifikasi identitas Anda dengan NIP, Email, dan Tanggal Lahir untuk mengatur ulang password.</p>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('evaluasi.forgot.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>NIP</label>
                <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP" required value="{{ old('nip') }}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email Terdaftar" required value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required value="{{ old('tanggal_lahir') }}">
            </div>

            <div class="divider">
                <span>PASSWORD BARU</span>
            </div>

            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password Baru" required>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi Password Baru" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Password Baru</button>
            <a href="{{ route('EvaluasiPasca.homepage') }}" class="btn btn-back">Kembali</a>
        </form>
    </div>
</body>
</html>
