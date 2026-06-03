<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login AKPK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('/images/balaikota.jpg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            min-height: 100vh;
        }

        /* Overlay gelap */
        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Redupkan background */
            z-index: 0;
        }

        .login-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: #ffffffd9; /* putih transparan */
            border-radius: 16px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .login-card h4 {
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #3f3d56;
            border: none;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #2d2b46;
        }

        .text-muted {
            font-size: 0.9rem;
        }
    </style>
    </head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="text-center mb-4">
                <img src="/images/logoBkpsdm.svg" alt="Logo BKPSDM" style="height: 60px;">
                <h4 class="mt-3">Login AKPK</h4>
                <p class="text-muted">Masukkan NIP dan E-mail</p>
            </div>
            <form action="{{ route('login.akpk.post') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP" required>
        @error('nip')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
        @error('email')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary w-100">Masuk</button>
</form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
