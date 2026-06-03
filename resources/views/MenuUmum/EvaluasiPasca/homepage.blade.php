<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BKPSDM Surakarta - Evaluasi Pasca Diklat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        :root {
            --primary-color: #6a00c7;
            --secondary-color: #4a008f;
            --accent-color: #ffd700;
            --bg-color: #f4f6f9;
            --card-bg: #ffffff;
            --text-color: #333333;
            --text-light: #666666;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--bg-color);
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: var(--text-color);
        }

        .container {
            max-width: 1000px;
            width: 90%;
            text-align: center;
        }

        .header {
            margin-bottom: 50px;
            animation: fadeInDown 1s ease-out;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .logo-container img {
            height: 80px;
            object-fit: contain;
            transition: var(--transition);
        }

        .logo-container img:hover {
            transform: scale(1.05);
        }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-color);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .header p {
            font-size: 18px;
            color: var(--text-light);
            margin-top: 10px;
            font-weight: 400;
        }

        .options {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .card {
            background: var(--card-bg);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            width: 250px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            transform: scaleX(0);
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .card:hover::before {
            transform: scaleX(1);
        }

        .card i {
            display: inline-block;
            font-size: 50px;
            color: var(--primary-color);
            margin-bottom: 20px;
            transition: var(--transition);
            background: rgba(106, 0, 199, 0.1);
            padding: 20px;
            border-radius: 50%;
        }

        .card:hover i {
            background: var(--primary-color);
            color: white;
            transform: rotateY(180deg);
        }

        .card h3 {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-color);
        }

        /* Modal Login */
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-content {
            background: white;
            padding: 40px;
            border-radius: 20px;
            width: 400px;
            text-align: left;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: slideUp 0.3s ease-out;
        }

        .close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            color: #aaa;
            cursor: pointer;
            transition: var(--transition);
        }

        .close:hover {
            color: var(--text-color);
        }

        .modal-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: var(--transition);
            background-color: #fafafa;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            background-color: white;
            box-shadow: 0 0 0 4px rgba(106, 0, 199, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
            font-size: 14px;
        }

        .btn {
            padding: 12px;
            border: none;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            color: white;
            width: 100%;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(106, 0, 199, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(106, 0, 199, 0.4);
        }

        .auth-links {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }

        .auth-links a {
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 500;
            transition: var(--transition);
            display: inline-block;
            margin: 5px 0;
        }

        .auth-links a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .auth-links .forgot {
            color: #e74c3c;
        }
        
        .auth-links .forgot:hover {
            color: #c0392b;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                <img src="{{ asset('images/surakarta.png') }}" alt="Logo Surakarta">
                <!-- <span class="logo-text">KOTA SURAKARTA</span> -->
                <img src="{{ asset('images/bkpsdm.png') }}" alt="Logo BKPSDM" style="height: 100px;">
            </div>
            <h1 class="logo-text">Evaluasi Pasca Diklat</h1>
            <p>Pilih peran Anda untuk melanjutkan</p>
        </div>
        <div class="options">
            <div class="card" onclick="openModal('alumni')">
                <i class="fa-solid fa-user-graduate"></i>
                <h3>Alumni</h3>
            </div>
            <div class="card" onclick="openModal('atasan')">
                <i class="fa-solid fa-user-tie"></i>
                <h3>Atasan</h3>
            </div>
            <div class="card" onclick="openModal('rekan')">
                <i class="fa-solid fa-users"></i>
                <h3>Rekan Kerja</h3>
            </div>
        </div>
    </div>
    
    <!-- Modal Login -->
    <div class="modal" id="loginModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3 id="modalTitle" class="modal-title">Login</h3>
            <form id="loginForm">
                @csrf
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" class="form-control" name="nip" id="nip" placeholder="Masukkan NIP Anda" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required>
                </div>
                
                <button type="submit" class="btn">Masuk</button>

                <div class="auth-links">
                    <a href="{{ route('evaluasi.register.form') }}">Belum punya akun? Daftar Sekarang</a>
                    <br>
                    <a href="{{ route('evaluasi.forgot.form') }}" class="forgot">Lupa Password?</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(role) {
            let roleFormatted = role.charAt(0).toUpperCase() + role.slice(1);
            if(role === 'rekan') roleFormatted = "Rekan Kerja";
            
            document.getElementById("modalTitle").innerText = "Login " + roleFormatted;
            // Store raw role in a data attribute or imply it
            document.getElementById("loginModal").setAttribute('data-role', role);
            document.getElementById("loginModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("loginModal").style.display = "none";
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            let modal = document.getElementById("loginModal");
            if (event.target == modal) {
                closeModal();
            }
        }

        $(document).ready(function() {
            $("#loginForm").submit(function(event) {
                event.preventDefault();

                let nip = $("#nip").val();
                let password = $("#password").val();
                let role = document.getElementById("loginModal").getAttribute('data-role'); 

                // Simple loading state
                let btn = $(this).find('button');
                let originalText = btn.text();
                btn.prop('disabled', true).text('Memproses...');

                $.ajax({
                    url: "{{ route('auth.login') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        nip: nip,
                        password: password,
                        role: role
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect;
                        } else {
                            alert(response.message);
                            btn.prop('disabled', false).text(originalText);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", xhr.responseText);
                        alert("Terjadi kesalahan, silakan coba lagi atau periksa koneksi Anda.");
                        btn.prop('disabled', false).text(originalText);
                    }
                });
            });
        });
    </script>
</body>
</html>
