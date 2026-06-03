<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Evaluasi Pascadiklat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --warning-gradient: linear-gradient(135deg, #f2994a 0%, #f2c94c 100%);
        --card-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        --hover-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    * {
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
        font-family: 'Poppins', sans-serif;
        color: #333;
        min-height: 100vh;
    }

    .navbar {
        background: var(--primary-gradient);
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
        padding: 1rem 2rem;
    }

    .navbar-brand {
        font-weight: 700;
        color: #ffffff;
        font-size: 1.3rem;
        letter-spacing: 0.5px;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        transition: all 0.3s ease;
        margin: 0 0.5rem;
        border-radius: 8px;
        padding: 0.5rem 1rem !important;
    }

    .nav-link:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.15);
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-2px);
    }

    .btn-logout {
        background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-logout:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(255, 65, 108, 0.4);
        color: white;
    }

    .main-container {
        padding: 3rem 1rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .profile-header {
        background: white;
        border-radius: 24px;
        padding: 3rem;
        box-shadow: var(--card-shadow);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 150px;
        background: var(--primary-gradient);
        z-index: 0;
    }

    .profile-content {
        position: relative;
        z-index: 1;
    }

    .profile-avatar-container {
        text-align: center;
        margin-top: 50px;
    }

    .profile-avatar {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 6px solid white;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        overflow: hidden;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-avatar .avatar-placeholder {
        font-size: 72px;
        color: white;
    }

    .profile-avatar-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        padding: 1rem;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 0 0 50% 50%;
    }

    .avatar-wrapper {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .avatar-wrapper:hover .profile-avatar-overlay {
        opacity: 1;
    }

    .camera-icon {
        color: white;
        font-size: 1.5rem;
    }

    .profile-name {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .profile-role {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .role-alumni {
        background: var(--success-gradient);
        color: white;
    }

    .role-atasan {
        background: var(--primary-gradient);
        color: white;
    }

    .role-rekan {
        background: var(--warning-gradient);
        color: white;
    }

    .info-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .info-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--hover-shadow);
    }

    .info-card-title {
        font-size: 1rem;
        font-weight: 600;
        color: #718096;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .info-card-title i {
        font-size: 1.25rem;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid #edf2f7;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        width: 140px;
        font-size: 0.875rem;
        color: #718096;
        font-weight: 500;
    }

    .info-value {
        flex: 1;
        font-weight: 600;
        color: #2d3748;
    }

    /* Photo Upload Modal */
    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }

    .modal-header {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 1.5rem 2rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        padding: 2rem;
    }

    .upload-zone {
        border: 3px dashed #cbd5e0;
        border-radius: 16px;
        padding: 3rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #f7fafc;
    }

    .upload-zone:hover {
        border-color: #667eea;
        background: #f0f4ff;
    }

    .upload-zone.dragover {
        border-color: #667eea;
        background: #e8ecff;
    }

    .upload-icon {
        font-size: 3rem;
        color: #a0aec0;
        margin-bottom: 1rem;
    }

    .upload-text {
        color: #718096;
        font-size: 1rem;
    }

    .upload-text span {
        color: #667eea;
        font-weight: 600;
    }

    .preview-container {
        text-align: center;
        margin-top: 1.5rem;
        display: none;
    }

    .preview-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #667eea;
        margin-bottom: 1rem;
    }

    .btn-upload {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-upload:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-remove {
        background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .btn-remove:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(255, 65, 108, 0.4);
        color: white;
    }

    .change-photo-btn {
        background: var(--primary-gradient);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        margin-top: 1rem;
        transition: all 0.3s ease;
    }

    .change-photo-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    /* Alert styling */
    .alert {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
    }

    @media (max-width: 768px) {
        .profile-header {
            padding: 2rem 1rem;
        }

        .profile-avatar {
            width: 140px;
            height: 140px;
        }

        .profile-avatar .avatar-placeholder {
            font-size: 56px;
        }

        .profile-name {
            font-size: 1.5rem;
        }

        .info-item {
            flex-direction: column;
        }

        .info-label {
            width: 100%;
            margin-bottom: 0.25rem;
        }

        .navbar {
            padding: 0.75rem 1rem;
        }

        .main-container {
            padding: 1.5rem 1rem;
        }
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand">
                <i class="fas fa-user-circle me-2"></i>Profile
            </span>
            <div class="d-flex align-items-center gap-2">
                @php
                    $dashboardRoute = match($userRole) {
                        'alumni' => route('dashboard.alumni'),
                        'atasan' => route('dashboard.atasan'),
                        'rekan', 'rekan_kerja' => route('dashboard.rekan'),
                        default => route('EvaluasiPasca.homepage')
                    };
                @endphp
                <a href="{{ $dashboardRoute }}" class="btn btn-back">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <a href="{{ route('evaluasi.logout') }}" class="btn btn-logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('evaluasi.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="main-container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="profile-header">
            <div class="profile-content">
                <div class="profile-avatar-container">
                    <div class="avatar-wrapper" data-bs-toggle="modal" data-bs-target="#photoModal">
                        <div class="profile-avatar">
                            @if($evaluasiUser->foto_profile)
                                <img src="{{ asset($evaluasiUser->foto_profile) }}" alt="Profile Photo">
                            @else
                                <span class="avatar-placeholder"><i class="fas fa-user"></i></span>
                            @endif
                        </div>
                    </div>
                    <button class="change-photo-btn" data-bs-toggle="modal" data-bs-target="#photoModal">
                        <i class="fas fa-camera me-2"></i>Ubah Foto
                    </button>
                </div>
                <div class="text-center mt-4">
                    <h1 class="profile-name">{{ $ref_pegawai->nama }}</h1>
                    <span class="profile-role role-{{ $userRole }}">
                        @if($userRole == 'rekan_kerja')
                            Rekan Kerja
                        @else
                            {{ ucfirst($userRole) }}
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <div class="info-cards">
            <div class="info-card">
                <h3 class="info-card-title">
                    <i class="fas fa-id-card"></i>
                    Informasi Pegawai
                </h3>
                <div class="info-item">
                    <span class="info-label">NIP</span>
                    <span class="info-value">{{ $ref_pegawai->nip }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Nama Lengkap</span>
                    <span class="info-value">{{ $ref_pegawai->nama }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Jabatan</span>
                    <span class="info-value">{{ $ref_pegawai->jabatan ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Pangkat/Gol</span>
                    <span class="info-value">{{ $ref_pegawai->pangkat ?? '-' }} / {{ $ref_pegawai->golongan ?? '-' }}</span>
                </div>
            </div>

            <div class="info-card">
                <h3 class="info-card-title">
                    <i class="fas fa-building"></i>
                    Unit Kerja
                </h3>
                <div class="info-item">
                    <span class="info-label">Unit Kerja</span>
                    <span class="info-value">{{ $ref_pegawai->unit_kerja ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">OPD</span>
                    <span class="info-value">{{ $ref_pegawai->opd ?? '-' }}</span>
                </div>
            </div>

            <div class="info-card">
                <h3 class="info-card-title">
                    <i class="fas fa-address-book"></i>
                    Kontak
                </h3>
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $ref_pegawai->email ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">No. HP</span>
                    <span class="info-value">{{ $ref_pegawai->no_hp ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Photo Upload Modal -->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoModalLabel">
                        <i class="fas fa-camera me-2"></i>Ubah Foto Profile
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                        @csrf
                        <div class="upload-zone" id="uploadZone">
                            <input type="file" name="foto_profile" id="photoInput" accept="image/*" hidden>
                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                            <p class="upload-text">
                                Drag & drop foto di sini atau <span>pilih file</span>
                            </p>
                            <p class="text-muted small mt-2">Format: JPG, PNG, GIF. Max: 2MB</p>
                        </div>
                        <div class="preview-container" id="previewContainer">
                            <img src="" alt="Preview" class="preview-image" id="previewImage">
                            <p class="text-muted">Preview foto baru</p>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <button type="submit" class="btn btn-upload" id="uploadBtn" disabled>
                                <i class="fas fa-upload me-2"></i>Upload Foto
                            </button>
                            @if($evaluasiUser->foto_profile)
                            <button type="button" class="btn btn-remove" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-bs-dismiss="modal">
                                <i class="fas fa-trash me-1"></i>Hapus Foto
                            </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Delete Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);">
                    <h5 class="modal-title" id="confirmDeleteLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <p>Apakah Anda yakin ingin menghapus foto profile?</p>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('profile.removePhoto') }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-remove">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadZone = document.getElementById('uploadZone');
        const photoInput = document.getElementById('photoInput');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const uploadBtn = document.getElementById('uploadBtn');

        // Click to upload
        uploadZone.addEventListener('click', () => photoInput.click());

        // Drag and drop
        uploadZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadZone.classList.add('dragover');
        });

        uploadZone.addEventListener('dragleave', () => {
            uploadZone.classList.remove('dragover');
        });

        uploadZone.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadZone.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                photoInput.files = files;
                handleFileSelect(files[0]);
            }
        });

        // File input change
        photoInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                handleFileSelect(this.files[0]);
            }
        });

        function handleFileSelect(file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Mohon pilih file gambar.');
                return;
            }

            // Validate file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB.');
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
                uploadBtn.disabled = false;
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>

</html>
