<div id="sidebar" class="sidebar">
    <button class="btn btn-sm btn-dark toggle-btn" id="sidebarToggle">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="sidebar-menu">
        <li class="menu-item {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="fa fa-th-large"></i> <span class="menu-text">Dashboard</span>
            </a>
        </li>

        <li class="menu-item {{ Route::currentRouteName() === 'Admin.Pegawai.index' ? 'active' : '' }}">
            <a href="{{ route('Admin.Pegawai.index') }}" class="nav-link">
                <i class="fa fa-users"></i> <span class="menu-text">Data Pegawai</span>
            </a>
        </li>


        @if (auth()->check() && auth()->user()->is_admin == 1)

        <li class="menu-header">Usulan Katalog</li>
        <li
            class="menu-item has-dropdown {{ in_array(Route::currentRouteName(), ['Admin.Brosur.usulan', 'Admin.Brosur.arsip']) ? 'active' : '' }}">
            <div class="menu-title">
                <i class="fa fa-file-alt"></i>
                <span class="menu-text">Brosur</span>
                <span class="dropdown-icon"><i class="fa fa-chevron-down"></i></span>
            </div>
            <ul class="submenu">
                <li class="{{ Route::currentRouteName() === 'Admin.Brosur.usulan' ? 'active' : '' }}">
                    <a href="{{ route('Admin.Brosur.usulan') }}">Usulan Brosur</a>
                </li>
                <li class="{{ Route::currentRouteName() === 'Admin.Brosur.arsip' ? 'active' : '' }}">
                    <a href="{{ route('Admin.Brosur.arsip') }}">Arsip Brosur</a>
                </li>
            </ul>
        <li
            class="menu-item has-dropdown {{ in_array(Route::currentRouteName(), ['ekatalog.database', 'ekatalog.diklat']) ? 'active' : '' }}">
            <div class="menu-title">
                <i class="fa fa-book"></i>
                <span class="menu-text">E-Katalog</span>
                <span class="dropdown-icon"><i class="fa fa-chevron-down"></i></span>
            </div>
            <ul class="submenu">
                <li class="{{ Route::currentRouteName() === 'ekatalog.database' ? 'active' : '' }}">
                    <a href="{{ route('Admin.ekatalog.database') }}">Input Database</a>
                </li>
                <li class="{{ Route::currentRouteName() === 'ekatalog.diklat' ? 'active' : '' }}">
                    <a href="{{ route('admin.ekatalog.diklat') }}">E-Katalog Diklat</a>
                </li>
            </ul>
        <li class="menu-item {{ Route::currentRouteName() === 'laporan.rekap' ? 'active' : '' }}">
            <a href="{{ route('laporan.rekap') }}" class="nav-link">
                <i class="bi bi-view-list"></i> <span class="menu-text">Rekap Brosur</span>
            </a>
        </li>


        </li>
        @endif


        <li class="menu-header">Pelatihan Diklat</li>
        <li
            class="menu-item has-dropdown {{ in_array(Route::currentRouteName(), ['laporan.usulan', 'laporan.arsip']) ? 'active' : '' }}">
            <div class="menu-title">
                <i class="fa fa-file-alt"></i>
                <span class="menu-text">Laporan</span>
                <span class="dropdown-icon"><i class="fa fa-chevron-down"></i></span>
            </div>
            <ul class="submenu">
                <li class="{{ Route::currentRouteName() === 'laporan.usulan' ? 'active' : '' }}">
                    <a href="{{ route('laporan.usulan') }}">Usulan Laporan</a>
                </li>
                <li class="{{ Route::currentRouteName() === 'laporan.arsip' ? 'active' : '' }}">
                    <a href="{{ route('laporan.arsip') }}">Arsip Laporan</a>
                </li>
            </ul>
        </li>


        <li class="menu-header">EVALUASI PASCA DIKLAT</li>
        <li
            class="menu-item has-dropdown {{ in_array(Route::currentRouteName(), ['evaluasi.alumni', 'evaluasi.atasan', 'admin.evaluasi.pelatihan.index', 'admin.evaluasi.pelatihan.create', 'admin.evaluasi.pelatihan.edit', 'admin.evaluasi.pelatihan.show', 'admin.kuesioner.index', 'admin.kuesioner.create', 'admin.kuesioner.edit', 'admin.kuesioner.show', 'admin.kuesioner.pertanyaan.index', 'admin.kuesioner.pertanyaan.create', 'admin.kuesioner.pertanyaan.edit', 'admin.kuesioner.pertanyaan.show']) ? 'active' : '' }}">
            <div class="menu-title">
                <i class="fa fa-database"></i>
                <span class="menu-text">Evaluasi Pasca Diklat</span>
                <span class="dropdown-icon"><i class="fa fa-chevron-down"></i></span>
            </div>
            <ul class="submenu">
                <li class="{{ in_array(Route::currentRouteName(), ['admin.evaluasi.pelatihan.index', 'admin.evaluasi.pelatihan.create', 'admin.evaluasi.pelatihan.edit', 'admin.evaluasi.pelatihan.show']) ? 'active' : '' }}">
                    <a href="{{ route('admin.evaluasi.pelatihan.index') }}">Data Pelatihan</a>
                </li>
                <li class="{{ in_array(Route::currentRouteName(), ['admin.kuesioner.index', 'admin.kuesioner.create', 'admin.kuesioner.edit', 'admin.kuesioner.show', 'admin.kuesioner.pertanyaan.index', 'admin.kuesioner.pertanyaan.create', 'admin.kuesioner.pertanyaan.edit', 'admin.kuesioner.pertanyaan.show']) ? 'active' : '' }}">
                    <a href="{{ route('admin.kuesioner.index') }}">Kuesioner</a>
                </li>
                <li class="{{ Route::currentRouteName() === 'evaluasi.alumni' ? 'active' : '' }}">
                    <a href="{{ route('evaluasi.alumni') }}">Evaluasi Alumni</a>
                </li>
                {{-- <li class="{{ Route::currentRouteName() === 'evaluasi.atasan' ? 'active' : '' }}">
                    <a href="{{ route('evaluasi.atasan') }}">Evaluasi Atasan</a>
                </li>
                <li class="{{ Route::currentRouteName() === 'evaluasi.atasan' ? 'active' : '' }}">
                    <a href="{{ route('evaluasi.atasan') }}">Evaluasi Rekan Kerja</a>
                </li> --}}
            </ul>
        </li>


        <li class="menu-header">AKPK</li>

        <li class="menu-item has-dropdown">
            <div class="menu-title">
                <i class="fa fa-clipboard-check"></i>
                <span class="menu-text">Assessment</span>
                <span class="dropdown-icon"><i class="fa fa-chevron-down"></i></span>
            </div>
            <ul class="submenu">
                <li><a href="{{ route('Admin.Akpk.selfassessment') }}">Self Assessment</a></li>
                <li><a href="{{ route('Admin.Akpk.asessmentatasan') }}">Assessment Atasan</a></li>
                <li><a href="{{ route("Admin.Akpk.evaluasiassessment") }}">Evaluasi Assessment</a></li>
            </ul>
        </li>

        <li class="menu-item has-dropdown">
            <div class="menu-title">
                <i class="fa fa-paper-plane"></i>
                <span class="menu-text">Usulan</span>
                <span class="dropdown-icon"><i class="fa fa-chevron-down"></i></span>
            </div>
            <ul class="submenu">
                <li><a href="{{ route('Admin.Akpk.Usulan.usulkebutuhanpelatihan') }}">Usulan Pelatihan Umum</a></li>
                <li><a href="{{ route('Admin.Akpk.Usulan.usulpelatihansolowasis') }}">Usulan Pelatihan Solowasis</a>
                </li>
            </ul>
        </li>

        <li class="menu-item has-dropdown">
            <div class="menu-title">
                <i class="fa fa-cogs"></i>
                <span class="menu-text">Manajemen Data</span>
                <span class="dropdown-icon"><i class="fa fa-chevron-down"></i></span>
            </div>
            <ul class="submenu">
                <li><a href="{{ route('Admin.Akpk.ManajemenData.manajemenpertanyaan') }}">Pertanyaan</a></li>
                <li><a href="{{ route('Admin.Akpk.ManajemenData.manajemenkomentar') }}">Komentar</a></li>
                <li><a href="{{ route('Admin.Akpk.ManajemenData.manajemenGaleri') }}">Galeri</a></li>
                <li><a href="{{ route('Admin.Akpk.ManajemenData.manajemenSolowasis') }}">Solowasis</a></li>
            </ul>
        </li>
    </ul>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.querySelector(".sidebar");
    const toggleButton = document.querySelector("#sidebarToggle");
    const mainContainer = document.querySelector(".main-container");
    const dropdowns = document.querySelectorAll(".has-dropdown .menu-title");

    // Initialize tooltip for mini sidebar
    function initTooltips() {
        if (sidebar.classList.contains('closed')) {
            document.querySelectorAll('.sidebar .menu-item a, .sidebar .menu-title').forEach(el => {
                el.setAttribute('data-title', el.querySelector('.menu-text')?.textContent || '');
            });
        } else {
            document.querySelectorAll('.sidebar [data-title]').forEach(el => {
                el.removeAttribute('data-title');
            });
        }
    }

    // Toggle sidebar expanded/collapsed state
    if (toggleButton) {
        toggleButton.addEventListener("click", function() {
            sidebar.classList.toggle("closed");
            if (mainContainer) {
                mainContainer.classList.toggle("expanded");
            }
            initTooltips();
            document.body.classList.toggle("sidebar-closed"); // Add class to body for header adjustment
        });
    }

    // Handle dropdown menus
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener("click", function(e) {
            e.preventDefault();
            const parent = this.parentElement;

            // If sidebar is collapsed, expand it first then open the dropdown
            if (sidebar.classList.contains('closed')) {
                sidebar.classList.remove('closed');
                if (mainContainer) {
                    mainContainer.classList.remove("expanded");
                }
                setTimeout(() => {
                    parent.classList.toggle("show");
                }, 300); // Wait for sidebar animation to complete
            } else {
                // If already expanded, just toggle the dropdown
                parent.classList.toggle("show");
            }

            // Close other dropdowns
            dropdowns.forEach(item => {
                if (item !== dropdown && item.parentElement.classList.contains(
                        'show')) {
                    item.parentElement.classList.remove('show');
                }
            });
        });
    });

    // Handle submenu item clicks
    document.querySelectorAll('.submenu a').forEach(submenuItem => {
        submenuItem.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent bubbling to parent dropdown
        });
    });

    // Initialize tooltips on load
    initTooltips();

    // Check if any dropdown should be open based on active state
    document.querySelectorAll('.has-dropdown').forEach(dropdown => {
        const hasActiveChild = dropdown.querySelector('.submenu li.active');
        if (hasActiveChild) {
            dropdown.classList.add('show');
        }
    });
});
</script>

<style>
/* Base Sidebar Styling */
.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: 250px;
    height: 100%;
    background-color: #343a40;
    color: white;
    padding-top: 20px;
    transition: all 0.3s ease;
    z-index: 1000;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

/* Container untuk content utama */
.main-container {
    position: relative;
    min-height: 100vh;
    margin-left: 250px;
    padding: 20px;
    transition: all 0.3s ease;
    background: #f4f6f9;
    overflow-x: hidden;
}

/* Mengatur tinggi maksimal sidebar-menu */
.sidebar-menu {
    height: calc(100vh - 70px);
    overflow-y: auto;
    margin-top: 50px;
    padding-bottom: 20px;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

/* Styling untuk scrollbar */
.sidebar-menu::-webkit-scrollbar {
    width: 5px;
}

.sidebar-menu::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-menu::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 20px;
}

/* Adjustments untuk collapsed state */
.main-container.expanded {
    margin-left: 60px;
}

@media (max-width: 768px) {
    .main-container {
        margin-left: 60px;
        width: calc(100% - 60px);
    }

    .sidebar-menu {
        height: calc(100vh - 60px);
    }
}

/* Toggle Button Styling */
.sidebar .toggle-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 18px;
    transition: all 0.3s ease;
    padding: 5px 8px;
    border-radius: 3px;
}

.sidebar::-webkit-scrollbar {
    display: none;
}

.sidebar .toggle-btn:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

/* Collapsed Sidebar */
.sidebar.closed {
    width: 60px;
}

/* Menu Styling */
.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 50px 0 0 0;
}

.menu-item {
    position: relative;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.menu-item a,
.menu-title {
    padding: 12px 20px;
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #f8f9fa;
    transition: all 0.2s ease;
}

.menu-item i {
    margin-right: 10px;
    width: 20px;
    text-align: center;
    font-size: 16px;
}

/* Header Menu */
.menu-header {
    padding: 16px 20px 8px;
    font-size: 12px;
    text-transform: uppercase;
    font-weight: 600;
    color: #adb5bd;
    letter-spacing: 0.5px;
    transition: opacity 0.3s ease;
}

/* Active State */
.menu-item.active>a,
.menu-item.active>.menu-title,
.submenu li.active>a {
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
    font-weight: 500;
}

/* Hover States */
.menu-item:hover>a,
.menu-item:hover>.menu-title,
.submenu li:hover>a {
    background-color: rgba(255, 255, 255, 0.07);
    color: #fff;
}

/* Dropdown Styling */
.dropdown-icon {
    margin-left: auto;
    transition: transform 0.3s;
}

.has-dropdown.show .dropdown-icon i {
    transform: rotate(180deg);
}

.submenu {
    list-style: none;
    padding: 0;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out;
    background-color: rgba(0, 0, 0, 0.15);
}

.has-dropdown.show .submenu {
    max-height: 500px;
    /* Adjust based on your needs */
}

.submenu li a {
    padding: 10px 10px 10px 50px;
    font-size: 14px;
    display: block;
    color: #e9ecef;
}

/* Collapsed Sidebar Adjustments */
.sidebar.closed .menu-text,
.sidebar.closed .menu-header,
.sidebar.closed .dropdown-icon {
    display: none;
}

.sidebar.closed .menu-item i {
    margin-right: 0;
    width: 100%;
    text-align: center;
}

.sidebar.closed .menu-item a,
.sidebar.closed .menu-title {
    padding: 15px 0;
    justify-content: center;
}

/* Hide submenu in collapsed mode */
.sidebar.closed .submenu {
    display: none !important;
}

/* Tooltip for collapsed sidebar */
.sidebar.closed .menu-item a[data-title]:hover:after,
.sidebar.closed .menu-title[data-title]:hover:after {
    content: attr(data-title);
    position: absolute;
    left: 100%;
    top: 0;
    z-index: 1001;
    margin-left: 10px;
    padding: 5px 10px;
    white-space: nowrap;
    background-color: #495057;
    color: #fff;
    border-radius: 4px;
    font-size: 13px;
    pointer-events: none;
}

/* Main Content Adjustment */
.main-container {
    margin-left: 250px;
    padding: 20px;
    transition: all 0.3s ease;
}

.main-container.expanded {
    margin-left: 60px;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        width: 60px;
    }

    .sidebar .menu-text,
    .sidebar .menu-header,
    .sidebar .dropdown-icon {
        display: none;
    }

    .sidebar .menu-item i {
        margin-right: 0;
        width: 100%;
        text-align: center;
    }

    .sidebar .menu-item a,
    .sidebar .menu-title {
        padding: 15px 0;
        justify-content: center;
    }

    .sidebar .submenu {
        display: none !important;
    }

    .main-container {
        margin-left: 60px;
    }

    .sidebar.show-mobile {
        width: 250px;
    }

    .sidebar.show-mobile .menu-text,
    .sidebar.show-mobile .menu-header,
    .sidebar.show-mobile .dropdown-icon {
        display: block;
    }

    .sidebar.show-mobile .menu-item i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .sidebar.show-mobile .menu-item a,
    .sidebar.show-mobile .menu-title {
        padding: 12px 20px;
        justify-content: flex-start;
    }

    .sidebar.show-mobile .has-dropdown.show .submenu {
        display: block !important;
    }
}
</style>