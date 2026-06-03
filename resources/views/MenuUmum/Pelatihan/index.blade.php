<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Katalog Pelatihan</title>
  <link rel="stylesheet" href="{{ asset('css/pelatihan.css') }}">
  <style>
    .card-quota {
      font-weight: bold;
      color: #0d6efd;
      margin-bottom: 10px;
    }

    .btn-group {
      display: flex;
      gap: 10px;
    }

    .btn-daftar {
      background-color: #198754; /* hijau */
      color: white;
      padding: 10px 15px;
      border-radius: 5px;
      text-decoration: none;
      text-align: center;
    }

    .btn-daftar.full {
      background-color: #dc3545; /* merah */
      pointer-events: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="text-center">E-Katalog Pelatihan</h1>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
      <button class="active" onclick="filterCards('all')">Semua</button>
      <button onclick="filterCards('teknis')">Teknis</button>
      <button onclick="filterCards('manajerial')">Manajerial</button>
      <button onclick="filterCards('sosial-kultural')">Sosial Kultural</button>
    </div>

    <!-- Kartu Pelatihan -->
    <div class="row">
      <!-- Teknis -->
      <div class="card" data-kategori="teknis">
        <img src="https://picsum.photos/id/1011/250/150" alt="Pelatihan Teknis">
        <div class="card-body">
          <h5 class="card-title">Pelatihan Teknis A</h5>
          <p class="card-text">Pelatihan untuk meningkatkan keterampilan teknis dalam bidang TI dan komunikasi.</p>
          <p class="card-quota">Kuota: 10/20</p>
          <div class="btn-group">
            <a href="#" class="btn">Detail</a>
            <a href="#" class="btn-daftar">Daftar</a>
          </div>
        </div>
      </div>

      <!-- Manajerial -->
      <div class="card" data-kategori="manajerial">
        <img src="https://picsum.photos/id/1021/250/150" alt="Pelatihan Manajerial">
        <div class="card-body">
          <h5 class="card-title">Pelatihan Manajerial B</h5>
          <p class="card-text">Pelatihan untuk mengembangkan kemampuan manajemen dan kepemimpinan.</p>
          <p class="card-quota">Kuota: 5/20</p>
          <div class="btn-group">
            <a href="#" class="btn">Detail</a>
            <a href="#" class="btn-daftar">Daftar</a>
          </div>
        </div>
      </div>

      <!-- Sosial Kultural - Penuh -->
      <div class="card" data-kategori="sosial-kultural">
        <img src="https://picsum.photos/id/1035/250/150" alt="Pelatihan Sosial">
        <div class="card-body">
          <h5 class="card-title">Pelatihan Sosial Kultural C</h5>
          <p class="card-text">Pelatihan untuk memperkuat pemahaman budaya dan sosial dalam organisasi.</p>
          <p class="card-quota">Kuota: 20/20</p>
          <div class="btn-group">
            <a href="#" class="btn">Detail</a>
            <a href="#" class="btn-daftar full">Penuh</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="Admin/MenuUmum/Pelatihan/script.js"></script>
</body>
</html>
