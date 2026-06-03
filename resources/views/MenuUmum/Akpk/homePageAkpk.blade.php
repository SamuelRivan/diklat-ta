@extends('layouts.akpkLayouts.akpk')

@push ('styles')
    <style>
        /* Basic Styles */
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f1f1;
            margin: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #00b4d8, #90e0ef);
            padding: 120px 0;
            color: white;
            text-align: center;
            border-radius: 3rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .hero .btn {
            padding: 0.75rem 2rem;
            font-size: 1.2rem;
            border-radius: 50px;
            background: white;
            color: #0077b6;
            transition: all 0.3s ease;
        }

        .hero .btn:hover {
            background: #caf0f8;
            color: #0077b6;
        }

        /* Card Design */
        .card-modern {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
            text-align: center;
            color: #333;
        }

        .galeri-img {
            border-radius: 1.25rem;
            object-fit: cover;
            height: 220px;
            width: 100%;
        }

        .galeri-img-lg {
            height: 100%;
            min-height: 400px;
        }

        /* Footer Design */
        footer {
            color: white;
            padding: 40px 0;
            margin-top: auto; /* This ensures the footer stays at the bottom */
        }

        .footer-logo img {
            height: 50px;
        }

        .footer-social i {
            font-size: 20px;
            margin-right: 12px;
            transition: color 0.3s;
        }

        .footer-social i:hover {
            color: #FFD700;
        }

        .footer-links a {
            color: white;
            font-size: 16px;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }
        }

        img[src="/images/pns.jpg"] {
    max-width: 300px; /* Ukuran gambar terbatas maksimal 500px */
    height: auto;     /* Menjaga rasio gambar */
}

    </style>
@endpush

@section('content')

    <!-- Hero Section -->
    <section class="hero">
        <div class="container"> 
            <h1>Selamat Datang di AKPK Surakarta</h1>
            <p>Meningkatkan kompetensi ASN melalui pelatihan modern, efisien, dan berdampak.</p>
            <a href="#tutorial" class="btn">Lihat Tutorial</a>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="py-5 bg-light">
        <div class="container d-md-flex align-items-center gap-5">
            <div class="flex-fill mb-4 mb-md-0">
                <img src="/images/pns.jpg" class="img-fluid rounded shadow" alt="Tentang Kami">
            </div>
            <div class="flex-fill">
                <h2 class="section-title text-md-start text-center">Tentang Kami</h2>
                <p class="text-muted">
                    AKPK Surakarta hadir sebagai lembaga pengembangan kompetensi ASN dengan pendekatan digital, berbasis
                    kebutuhan, dan transformasi berkelanjutan. Kami percaya bahwa setiap pelatihan harus memberi dampak
                    langsung terhadap kualitas pelayanan publik.
                </p>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Visi & Misi</h2>
            <div class="row g-4">
                @php
                    $visiMisiData = [
                        ['title' => 'Visi', 'desc' => 'Menjadi pusat pelatihan ASN yang unggul dan adaptif.'],
                        ['title' => 'Misi 1', 'desc' => 'Mengembangkan SDM aparatur melalui pelatihan berbasis kompetensi.'],
                        ['title' => 'Misi 2', 'desc' => 'Mendorong budaya inovasi dan transformasi digital.']
                    ];
                @endphp
                @foreach ($visiMisiData as $item)
                    <div class="col-md-4">
                        <div class="card-modern p-4 text-center h-100">
                            <img src="/images/Roket.png" class="mb-3" width="60" alt="Icon">
                            <h5 class="fw-bold">
                                {{ $item['title'] }}
                            </h5>
                            <p class="text-muted">
                                {{ $item['desc'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Tutorial PDF -->
    <section id="tutorial" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Tutorial Penggunaan</h2>
            <div class="card-modern p-4">
                <!-- <p id="pdf-warning" class="text-danger d-none">PDF tidak dapat ditampilkan. <a href="/images/contoh.pdf" -->
                        download>Download di sini</a>.</p>
                <!-- <embed id="pdf-viewer" src="/images/contoh.pdf" type="application/pdf" class="w-100"
                    style="height: 75vh; border-radius: 1rem;"
                    onerror="document.getElementById('pdf-warning').classList.remove('d-none'); this.style.display='none';" /> -->
            </div>
        </div>
    </section>

    <!-- Galeri Kegiatan -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Galeri Kegiatan</h2>
            
            <div class="row g-4">
                @php
                    $gallery = [
                        '/images/homepage.png', 
                        '/images/homepage.png', 
                        '/images/homepage.png', 
                        '/images/homepage.png', 
                        '/images/homepage.png'
                    ];
                @endphp
                
                <!-- Gambar Besar -->
                <div class="col-lg-8">
                    <div class="card-modern">
                        <img src="{{ $gallery[0] }}" alt="Gambar Besar" class="img-fluid rounded shadow-lg galeri-img-lg">
                    </div>
                </div>

                <!-- Gambar Kecil -->
                <div class="col-lg-4">
                    <div class="row g-3">
                        @foreach(array_slice($gallery, 1) as $img)
                            <div class="col-6">
                                <div class="card-modern">
                                    <img src="{{ $img }}" alt="Galeri" class="img-fluid rounded shadow-lg galeri-img">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="#!" class="btn btn-outline-primary">Lihat Lebih Banyak</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-3 text-dark">
    <div class="container">
        <div class="row text-center text-md-start">
            <!-- Kolom 1: Logo dan Deskripsi -->
            <div class="col-md-4 mb-4 mb-md-0">
                <img src="/images/logoBkpsdm.svg" alt="AKPK Logo" height="50" class="mb-3">
                <p class="small">AKPK Surakarta memfasilitasi peningkatan kompetensi ASN dengan pelatihan yang berbasis teknologi dan inovasi.</p>
            </div>

            <!-- Kolom 2: Navigasi -->
            <div class="col-md-4 mb-4 mb-md-0">
                <h6 class="fw-semibold mb-3">Navigasi</h6>
                <ul class="list-unstyled">
                    <li><a href="/homepage-akpk" class="text-dark text-decoration-none">Beranda</a></li>
                    <li><a href="/selfAssessment" class="text-dark text-decoration-none">Penilaian</a></li>
                    <li><a href="/usulan" class="text-dark text-decoration-none">Usulan</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Ikuti Kami -->
            <div class="col-md-4 mb-4 mb-md-0 text-md-end">
                <h6 class="fw-semibold mb-3">Ikuti Kami</h6>
                <div class="d-flex justify-content-center justify-content-md-end gap-4">
                    <a href="#" class="text-dark fs-4"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-dark fs-4"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-dark fs-4"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-dark fs-4"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>

        <!-- Peta Lokasi -->

<div class="row mt-3">
    <div class="col">
        <h6 class="text-center fw-semibold mb-3">Peta Lokasi</h6>
        <div class="ratio ratio-16x9" style="max-width: 600px; height: 300px; margin: 0 auto;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.0467781690963!2d110.82864149999999!3d-7.5698794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a16604244913d%3A0xb23896628cd69569!2sBKPSDM%20Kota%20Surakarta!5e0!3m2!1sid!2sid!4v1744260308106!5m2!1sid!2sid" allowfullscreen loading="lazy"></iframe>
        </div>
    </div>
</div>

</footer>



@endsection
