<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AKPK Surakarta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    @stack('styles')
</head>

<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light px-3" style="background-color: #ffffff;">
            <a class="navbar-brand" href="/homepage-akpk">
                <img src="/images/logoBkpsdm.svg" alt="AKPK Logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="berandaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dashboard
            </a>
            <ul class="dropdown-menu" aria-labelledby="berandaDropdown">
                <li><a class="dropdown-item" href="/dashboard-akpk">Beranda</a></li>
                <li><a class="dropdown-item" href="/profile">Profile</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="assessmentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Usul Kebutuhan Pelatihan
            </a>
            <ul class="dropdown-menu" aria-labelledby="assessmentDropdown">
                <li><a class="dropdown-item" href="/selfAssessment">Self Assessment</a></li>
                <li><a class="dropdown-item" href="/assessmentBawahan">Assessment Atasan-Bawahan</a></li>
                <li><a class="dropdown-item" href="/usulan-kebutuhan-pelatihan">Kebutuhan Pelatihan Tahun Depan</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="riwayatAssessmentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Riwayat Assessment
            </a>
            <ul class="dropdown-menu" aria-labelledby="riwayatAssessmentDropdown">
                <li><a class="dropdown-item" href="/hasilSelfAssessment">Hasil Self Assessment</a></li>
                <li><a class="dropdown-item" href="/hasilAssessmentBawahan">Hasil Assessment Bawahan</a></li>
            </ul>
        </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="usulanDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Pendaftaran Pelatihan </a>
                        <ul class="dropdown-menu" aria-labelledby="usulanDropdown">
                            <li><a class="dropdown-item" href="/usulanpelatihan">Usulan Pelatihan</a></li>
                      
                        </ul>
                    </li>

                  
                    </li>
                </ul>
                @guest('pegawais')
    <a href="{{ route('login.akpk') }}" class="btn btn-outline-primary ms-lg-3">Login</a>
@else
    <form action="{{ route('logout.akpk') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-outline-danger ms-lg-3">Logout</button>
    </form>
@endguest


            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
