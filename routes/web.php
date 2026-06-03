<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PegawaiAuthController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ExportUsulanController;

use App\Http\Controllers\ImportUsulanController;
use App\Http\Controllers\ExportEkatalogController;
use App\Http\Controllers\ImportArsipController;
use App\Http\Controllers\ImportPelatihanController;
use App\Http\Controllers\ImportDiklatController;

use App\Http\Controllers\Umum\EkatalogPelatihan\EkatalogUmumController;
// Controller Evaluasi Pasca Pelatihan
use App\Http\Controllers\Umum\EvaluasiPasca\EvaluasiAlumniController;
use App\Http\Controllers\Umum\EvaluasiPasca\EvaluasiAtasanController;
use App\Http\Controllers\Umum\EvaluasiPasca\EvaluasiRekanKerjaController;
use App\Http\Controllers\Umum\EvaluasiPasca\Pelatihan5PascadiklatJawabanController;

use App\Http\Controllers\Umum\DirektoriPelatihan\DirektoriUmumController;
use App\Http\Controllers\Umum\UsulanBrosur\BrosurUmumController;
use App\Http\Controllers\Umum\Akpk\AkpkController;
use App\Http\Controllers\Umum\Pelatihan\UmumPelatihanController;
use App\Http\Controllers\Umum\Akpk\SelfAssessmentController;
use App\Http\Controllers\Umum\Akpk\AssessmentBawahanController;
use App\Http\Controllers\Umum\Akpk\ProfileAkpkController;
use App\Http\Controllers\Umum\Akpk\UsulKebutuhanPelatihanController;
// Controller Admin Evaluasi
use App\Http\Controllers\Admin\Evaluasi\AlumniAdminController;
use App\Http\Controllers\Admin\Evaluasi\AtasanAdminController;
use App\Http\Controllers\Admin\Evaluasi\PertanyaanController;
use App\Http\Controllers\Admin\Evaluasi\EvaluasiPelatihanController;
use App\Http\Controllers\Admin\KuesionerController;

use App\Http\Controllers\Admin\Laporan\RekapController;
use App\Http\Controllers\Admin\Laporan\LaporanController;
use App\Http\Controllers\Admin\DatabaseEkatalog\PelatihanController;
use App\Http\Controllers\Admin\Brosur\BrosurAdminController;
use App\Http\Controllers\Admin\DatabaseEkatalog\EkatalogController;
use App\Http\Controllers\Admin\Akpk\AkpkAdminController;
use App\Http\Controllers\Admin\Pegawai\PegawaiController;

use App\Http\Controllers\Pegawai\PegawaiDashboardController;

use App\Http\Controllers\Auth\LoginAkpkController;
use App\Http\Controllers\Auth\UserEvaluasiController;

use App\Http\Middleware\AkpkMiddleware;

//Route untuk halaman publik
Route::get('/', function () {
    return view('FrontPage.index');
})->name('frontpage.index');

Route::middleware([AkpkMiddleware::class])->group(function () {
    Route::get('/selfAssessment', function () {
        return view('MenuUmum.Akpk.Assessment.selfAssessment');
    });
    
    Route::get('/profile/edit', [ProfileAkpkController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileAkpkController::class, 'update'])->name('profile.update');
});


Route::get('/hasilSelfAssessment', function () {
    return view('MenuUmum.Akpk.Assessment.hasilSelfAssessment');
});

Route::get('/hasilAssessmentBawahan', function () {
    return view('MenuUmum.Akpk.Assessment.hasilAssessmentBawahan');
});

Route::get('/solowasis', function () {
    return view('MenuUmum.Akpk.UsulanPelatihan.solowasis');
});


Route::post('/usulan/store', [AkpkController::class, 'storeUsulan'])->name('usulan.store');
Route::put('/usulan/update/{id}', [AkpkController::class, 'updateUsulan'])->name('usulan.update');

Route::get('/nomenklatur', function () {
    return view('MenuUmum.Akpk.UsulanPelatihan.Nomenklatur.nomenklatur');
});



// Route::get('/usulanpelatihan', function () {
//     return view('MenuUmum.Akpk.UsulanPelatihan.UsulanPelatihan.usulanPelatihan');
// });

//route untuk menu umum usulan brosur
Route::get('/BrosurPelatihan', [BrosurUmumController::class, 'index'])->name('BrosurPelatihan.usulan');
Route::get('BrosurPelatihan/create', [BrosurUmumController::class, 'create'])->name('BrosurPelatihan.createusulan');
Route::post('BrosurPelatihan/store', [BrosurUmumController::class, 'store'])->name('BrosurPelatihan.storeusulan');

//route untuk menu umum e-katalog pelatihan
Route::get('/EkatalogPelatihan', [EkatalogUmumController::class, 'index'])->name('EkatalogPelatihan.ekatalog');
Route::get('/EkatalogPelatihan/view/{id}', [EkatalogUmumController::class, 'view'])->name('EkatalogPelatihan.viewekatalog');

//route untuk menu umum direktori laporan
Route::get('/DirektoriPelatihan', [DirektoriUmumController::class, 'index'])->name('DirektoriPelatihan.direktori');
Route::get('DirektoriPelatihan/create', [DirektoriUmumController::class, 'create'])->name('DirektoriPelatihan.createdirektori');
Route::post('DirektoriPelatihan/store', [DirektoriUmumController::class, 'store'])->name('DirektoriPelatihan.storedirektori');
Route::get('/DirektoriPelatihan/view/{id}', [DirektoriUmumController::class, 'view'])->name('DirektoriPelatihan.viewdirektori');


// Route untuk login admin
Route::get('admin0', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('admin0', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Form login pegawai
Route::get('/pegawai/login', [PegawaiAuthController::class, 'showLoginForm'])->name('Pegawai.login');

// Proses login pegawai
Route::post('/pegawai/login', [PegawaiAuthController::class, 'login'])->name('Pegawai.login.submit');

// Logout pegawai
Route::post('/pegawai/logout', [PegawaiAuthController::class, 'logout'])->name('Pegawai.logout');

Route::middleware(['auth:pegawais'])->group(function () {
    Route::get('/pegawai/dashboard', [PegawaiDashboardController::class, 'index'])->name('Pegawai.dashboard');

    // Tambahkan route lain untuk pegawai di sini jika diperlukan
    Route::get('/homepage-akpk', [AkpkController::class, 'index'])->name('akpk.index');
    
});


//Route Untuk AKPK
Route::get('/dashboard-akpk', [AkpkController::class, 'index'])->name('akpk.index');

//Route Untuk AKPK
Route::get('/homepage-akpk', [AkpkController::class, 'index'])->name('akpk.index');

// Login untuk AKPK
Route::get('/login-akpk', [LoginAkpkController::class, 'showLoginForm'])->name('login.akpk');
Route::post('/login-akpk', [LoginAkpkController::class, 'login'])->name('login.akpk.post');
Route::post('/logout-akpk', [LoginAkpkController::class, 'logout'])->name('logout.akpk');


Route::middleware([\App\Http\Middleware\SuperadminMiddleware::class])->group(function () {
       
        // Route untuk halaman usulan brosur
        Route::get('/brosur/usulan', [BrosurAdminController::class, 'index'])->name('Admin.Brosur.usulan');
        Route::get('/brosur/arsip', [BrosurAdminController::class, 'index'])->name('Admin.Brosur.arsip');
        Route::put('/brosur/approve/{id}', [BrosurAdminController::class, 'approve'])->name('brosur.approve');
        Route::get('/brosur/editusulan/{brosur}', [BrosurAdminController::class, 'edit'])->name('Admin.Brosur.editusulan');
        Route::put('/brosur/updateusulan/{brosur}', [BrosurAdminController::class, 'update'])->name('Admin.Brosur.updateusulan');
        Route::delete('/brosur/deleteusulan/{id}', [BrosurAdminController::class, 'deletes'])->name('brosur.deleteusulan');
        Route::get('/brosur/create', [BrosurAdminController::class, 'create'])->name('Admin.Brosur.create');
        Route::post('/brosur/store', [BrosurAdminController::class, 'storebrosur'])->name('brosur.store');
        Route::get('/brosur/edit/{id}', [BrosurAdminController::class, 'edit'])->name('Admin.Brosur.edit');
        Route::put('/brosur/update/{id}', [BrosurAdminController::class, 'update'])->name('brosur.update');
        Route::get('/exportusulan-excel', [ExportUsulanController::class, 'exportusulan'])->name('exportusulan.excel');
        Route::post('/import-usulan', [ImportUsulanController::class, 'importUsulanDiklat'])->name('import.usulan');
        Route::post('/import-arsip', [ImportArsipController::class, 'importArsip'])->name('import.arsip');
    
        
});

Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    Route::prefix('admin/pegawai')->name('Admin.Pegawai.')->group(function() {
    Route::get('/', [PegawaiController::class, 'index'])->name('index');
    Route::get('/{id}', [PegawaiController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [PegawaiController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PegawaiController::class, 'update'])->name('update');
    Route::delete('/{id}', [PegawaiController::class, 'destroy'])->name('destroy');
});

    

    // Route untuk nama ekatalog databse
    Route::get('/ekatalog/database', [PelatihanController::class, 'index'])->name('Admin.ekatalog.database');
    Route::post('/store/{type}', [PelatihanController::class, 'store'])->name('pelatihan.store');
    Route::delete('/deletedatas/{model}/{id}', [PelatihanController::class, 'delete'])->name('deletedata');


    Route::patch('/pelatihan/{id}', [PelatihanController::class, 'update'])->name('pelatihan.update');



    // // route untuk ekatalog diklat
    Route::get('/ekatalog/createpelatihan', [PelatihanController::class, 'create'])->name('ekatalog.createpelatihan');
    Route::post('/ekatalog/storepelatihan', [PelatihanController::class, 'storepelatihan'])->name('ekatalog.storepelatihan');
    Route::post('/import-pelatihan', [ImportPelatihanController::class, 'importPelatihan'])->name('import.pelatihan');
    Route::put('/toggle-status/{id_katalog2}', [EkatalogController::class, 'toggleStatus'])->name('toggle.status');


    // // Route untuk halaman ekatalog diklat
    Route::get('/ekatalog/diklat', [EkatalogController::class, 'index'])->name('admin.ekatalog.diklat');
    Route::get('/ekatalog/creatediklat', [EkatalogController::class, 'create'])->name('admin.ekatalog.creatediklat');
    Route::post('/ekatalog/storediklat', [EkatalogController::class, 'store'])->name('admin.ekatalog.storediklat');
    Route::get('/ekatalog/viewdiklat/{id}', [EkatalogController::class, 'view'])->name('admin.ekatalog.viewdiklat');

    Route::get('/ekatalog/deleteekatalog/{id}', [EkatalogController::class, 'destroy'])->name('deleteekatalog');
    Route::get('/exportekatalog-excel', [ExportEkatalogController::class, 'exportekatalog'])->name('exportekatalog.excel');
    Route::post('/import-diklat', [ImportDiklatController::class, 'importDiklat'])->name('import.diklat');

    // // Route untuk halaman laporan
    Route::get('/laporan/usulan', [LaporanController::class, 'index'])->name('laporan.usulan');
    Route::get('/laporan/arsip', [LaporanController::class, 'index'])->name('laporan.arsip');
    Route::get('/laporan/createusulan', [LaporanController::class, 'create'])->name('laporan.createusulan');
    Route::post('/laporan/storediklat', [LaporanController::class, 'store'])->name('laporan.storeusulan');
    Route::put('/laporan/editarsip/{id}', [LaporanController::class, 'update'])->name('laporan.updateusulan');
    Route::get('/laporan/editarsip/{id}/edit', [LaporanController::class, 'edit'])->name('laporan.editlaporan');
    Route::delete('/laporan/deleteusulanlaporan/{id}', [LaporanController::class, 'destroy'])->name('deleteusulanlaporan');
    Route::get('/laporan/approve/{id}', [LaporanController::class, 'approve'])->name('approvelaporan');



    // // Route untuk halaman rekap pelatihan
    Route::get('/laporan/rekap', [RekapController::class, 'index'])->name('laporan.rekap');

    // Admin: Evaluasi Alumni
    Route::get('/evaluasi/alumni', [AlumniAdminController::class, 'index'])->name('evaluasi.alumni');
    Route::get('/evaluasi/alumni/export', [AlumniAdminController::class, 'export'])->name('evaluasi.alumni.export');
    Route::get('/evaluasi/viewalumni/{id}', [AlumniAdminController::class, 'view'])->name('evaluasi.viewalumni');
    Route::get('/alumni/edit/{id}', [AlumniAdminController::class, 'edit'])->name('evaluasi.editalumni');
    Route::put('/alumni/{id}', [AlumniAdminController::class, 'update'])->name('evaluasi.updatealumni');
    Route::delete('/evaluasi/destroyalumni/{id}', [AlumniAdminController::class, 'destroy'])->name('evaluasi.destroyalumni');

    // Admin: Evaluasi Atasan
    Route::get('/evaluasi/atasan', [AtasanAdminController::class, 'index'])->name('evaluasi.atasan');
    Route::get('/evaluasi/viewatasan/{id}', [AtasanAdminController::class, 'view'])->name('evaluasi.viewatasan');
    Route::get('/atasan/edit/{id}', [AtasanAdminController::class, 'edit'])->name('evaluasi.editatasan');
    Route::put('/atasan/{id}', [AtasanAdminController::class, 'update'])->name('evaluasi.updateatasan');
    Route::delete('/evaluasi/destroyatasan/{id}', [AtasanAdminController::class, 'destroy'])->name('evaluasi.destroyatasan');

    // Admin: Evaluasi Pelatihan (Pascadiklat)
    Route::prefix('admin/evaluasi/pelatihan')->name('admin.evaluasi.pelatihan.')->group(function() {
        Route::get('/', [EvaluasiPelatihanController::class, 'index'])->name('index');
        Route::get('/create', [EvaluasiPelatihanController::class, 'create'])->name('create');
        Route::post('/', [EvaluasiPelatihanController::class, 'store'])->name('store');
        Route::get('/{id}', [EvaluasiPelatihanController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [EvaluasiPelatihanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EvaluasiPelatihanController::class, 'update'])->name('update');
        Route::delete('/{id}', [EvaluasiPelatihanController::class, 'destroy'])->name('destroy');
        
        // Routes untuk mengelola alumni dalam pelatihan
        Route::get('/{id}/alumni/create', [EvaluasiPelatihanController::class, 'createAlumni'])->name('createAlumni');
        Route::post('/{id}/alumni', [EvaluasiPelatihanController::class, 'storeAlumni'])->name('storeAlumni');
        Route::delete('/{pelatihanId}/alumni/{alumniId}', [EvaluasiPelatihanController::class, 'removeAlumni'])->name('removeAlumni');
        // Update status alumni
        Route::patch('/{pelatihanId}/alumni/{alumniId}/status', [EvaluasiPelatihanController::class, 'updateAlumniStatus'])->name('updateAlumniStatus');
        // Detail jawaban kuesioner seorang alumni pada pelatihan ini
        Route::get('/{pelatihanId}/alumni/{alumniId}/answers', [EvaluasiPelatihanController::class, 'showAlumniAnswers'])->name('alumni.answers');
    });
    
    // Admin: Manajemen Kuesioner
    Route::prefix('admin/kuesioner')->name('admin.kuesioner.')->group(function() {
        Route::get('/', [KuesionerController::class, 'index'])->name('index');
        Route::get('/create', [KuesionerController::class, 'create'])->name('create');
        Route::post('/', [KuesionerController::class, 'store'])->name('store');
        Route::get('/{id}', [KuesionerController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [KuesionerController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KuesionerController::class, 'update'])->name('update');
        Route::delete('/{id}', [KuesionerController::class, 'destroy'])->name('destroy');
        
        // Admin: Manajemen Pertanyaan Kuesioner
        Route::get('/{kuesioner_id}/pertanyaan', [PertanyaanController::class, 'index'])->name('pertanyaan.index');
        Route::get('/{kuesioner_id}/pertanyaan/create', [PertanyaanController::class, 'create'])->name('pertanyaan.create');
        Route::post('/{kuesioner_id}/pertanyaan', [PertanyaanController::class, 'store'])->name('pertanyaan.store');
        Route::get('/{kuesioner_id}/pertanyaan/{id}', [PertanyaanController::class, 'show'])->name('pertanyaan.show');
        Route::get('/{kuesioner_id}/pertanyaan/{id}/edit', [PertanyaanController::class, 'edit'])->name('pertanyaan.edit');
        Route::put('/{kuesioner_id}/pertanyaan/{id}', [PertanyaanController::class, 'update'])->name('pertanyaan.update');
        Route::delete('/{kuesioner_id}/pertanyaan/{id}', [PertanyaanController::class, 'destroy'])->name('pertanyaan.destroy');
        Route::post('/{kuesioner_id}/pertanyaan/update-urutan', [PertanyaanController::class, 'updateUrutan'])->name('pertanyaan.updateUrutan');
        // Routes untuk assign kuesioner ke pelatihan
        Route::get('/{id}/assign', [KuesionerController::class, 'assignForm'])->name('assign.form');
        Route::post('/{id}/assign', [KuesionerController::class, 'assign'])->name('assign');
        Route::delete('/{id}/assign/{pelatihan_id}', [KuesionerController::class, 'unassign'])->name('unassign');
    });


    Route::get('/pertanyaan', [PertanyaanController::class, 'index'])->name('pertanyaan.index');
    Route::delete('/pertanyaan/{id}', [PertanyaanController::class, 'destroy'])->name('pertanyaan.destroy');
    Route::get('/pertanyaan/create', [PertanyaanController::class, 'create'])->name('pertanyaan.create');
    Route::post('/pertanyaan', [PertanyaanController::class, 'store'])->name('pertanyaan.store');
    Route::get('/pertanyaan/{id}/edit', [PertanyaanController::class, 'edit'])->name('pertanyaan.edit');
    Route::put('/pertanyaan/{id}', [PertanyaanController::class, 'update'])->name('pertanyaan.update');

    // Route untuk submenu Dashboard AKPK
    Route::get('/akpk/dashboard', [AkpkAdminController::class, 'dashboard'])->name('Admin.Akpk.dashboard');
    // Route untuk submenu SelfASessment
    Route::get('/akpk/selfassessment', [AkpkAdminController::class, 'tabelSelfAssessment'])->name('Admin.Akpk.selfassessment');
    // Route untuk submenu assessment Atasan
    Route::get('/akpk/asessmentatasan', [AkpkAdminController::class, 'tabelAssessmentAtasan'])->name('Admin.Akpk.asessmentatasan');
    // Route untuk submenu Evaluasi Assessment
    Route::get('/akpk/evaluasiassessment', [AkpkAdminController::class, 'tabelEvaluasiAssessment'])->name('Admin.Akpk.evaluasiassessment');
    // Route untuk submenu usul pelatihan solo wasis
    Route::get('/akpk/usulpelatihansolowasis', [AkpkAdminController::class, 'tabelUsulanPelatihanSolowasis'])->name('Admin.Akpk.Usulan.usulpelatihansolowasis');
    // Route untuk submenu usul kebutuhan pelatihan
    Route::get('/akpk/usulkebutuhanpelatihan', [AkpkAdminController::class, 'tabelUsulanKebutuhanPelatihan'])->name('Admin.Akpk.Usulan.usulkebutuhanpelatihan');

    Route::get('/akpk/pertanyaan', [AkpkAdminController::class, 'manajemenPertanyaan'])->name('Admin.Akpk.ManajemenData.manajemenpertanyaan');
    Route::get('/akpk/komentar', [AkpkAdminController::class, 'manajemenKomentar'])->name('Admin.Akpk.ManajemenData.manajemenkomentar');
    Route::get('/akpk/galeri', [AkpkAdminController::class, 'manajemenGaleri'])->name('Admin.Akpk.ManajemenData.manajemenGaleri');
    Route::get('/akpk/solowasis', [AkpkAdminController::class, 'manajemenSolowasis'])->name('Admin.Akpk.ManajemenData.manajemenSolowasis');
});


use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Umum\EvaluasiPasca\ProfileController;

Route::get('/EvaluasiPasca', [UserEvaluasiController::class, 'index'])->name('EvaluasiPasca.homepage');
Route::post('/login', [UserEvaluasiController::class, 'login'])->name('auth.login');
Route::post('/evaluasi/logout', [UserEvaluasiController::class, 'logout'])->name('evaluasi.logout');

Route::get('/EvaluasiPasca/register', [UserEvaluasiController::class, 'showRegisterForm'])->name('evaluasi.register.form');
Route::post('/EvaluasiPasca/register', [UserEvaluasiController::class, 'register'])->name('evaluasi.register.submit');

Route::get('/EvaluasiPasca/forgot-password', [UserEvaluasiController::class, 'showForgotPasswordForm'])->name('evaluasi.forgot.form');
Route::post('/EvaluasiPasca/forgot-password', [UserEvaluasiController::class, 'resetPassword'])->name('evaluasi.forgot.submit');

// Route Profile (untuk semua role evaluasi)
Route::get('/evaluasi/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/evaluasi/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
Route::delete('/evaluasi/profile/photo', [ProfileController::class, 'removePhoto'])->name('profile.removePhoto');

// Middleware untuk masing-masing role
Route::middleware(['role:alumni'])->group(function () {
    Route::get('/dashboard/alumni', [UserEvaluasiController::class, 'alumni'])->name('dashboard.alumni');
    
    // Route Evaluasi Alumni
    Route::get('/evaluasi/pertanyaanalumni', [EvaluasiAlumniController::class, 'index'])->name('evaluasi.formalumni');
    Route::post('/evaluasi/simpan-alumni', [EvaluasiAlumniController::class, 'store'])->name('evaluasi.simpanalumni');

    Route::get('/evaluasi/alumni/pertanyaan', [EvaluasiAlumniController::class, 'showPertanyaan'])->name('evaluasi.pertanyaanalumni');
    Route::post('/evaluasi/alumni/simpan-jawaban', [EvaluasiAlumniController::class, 'simpanJawaban'])->name('evaluasi.simpanjawaban');
    
    // Route Kuesioner Pascadiklat Alumni
    Route::get('/pascadiklat/kuesioner', [Pelatihan5PascadiklatJawabanController::class, 'index'])->name('pascadiklat.kuesioner.index');
    Route::get('/pascadiklat/kuesioner/{kuesioner_id}', [Pelatihan5PascadiklatJawabanController::class, 'show'])->name('pascadiklat.kuesioner.show');
    Route::get('/pascadiklat/kuesioner/{kuesioner_id}/pelatihan/{pelatihan_id}', [Pelatihan5PascadiklatJawabanController::class, 'show'])->name('pascadiklat.kuesioner.show.pelatihan');
    Route::get('/pascadiklat/kuesioner/{kuesioner_id}/pelatihan/{pelatihan_id}/select-evaluators', [Pelatihan5PascadiklatJawabanController::class, 'showSelectEvaluators'])->name('pascadiklat.kuesioner.select.evaluators');
    Route::post('/pascadiklat/kuesioner/store-evaluators', [Pelatihan5PascadiklatJawabanController::class, 'storeEvaluators'])->name('pascadiklat.kuesioner.store.evaluators');
    Route::post('/pascadiklat/kuesioner/jawaban', [Pelatihan5PascadiklatJawabanController::class, 'store'])->name('pascadiklat.kuesioner.store');
    Route::get('/pascadiklat/kuesioner/{kuesioner_id}/hasil', [Pelatihan5PascadiklatJawabanController::class, 'results'])->name('pascadiklat.kuesioner.results');
});


Route::middleware(['role:atasan'])->group(function () {
    Route::get('/dashboard/atasan', [UserEvaluasiController::class, 'atasan'])->name('dashboard.atasan');
    
    // Route Evaluasi Atasan
    Route::get('/evaluasi/atasan', [EvaluasiAtasanController::class, 'index'])->name('evaluasi.atasan.index');
    Route::get('/evaluasi/atasan/{alumni_id}/kuesioner', [EvaluasiAtasanController::class, 'showKuesioner'])->name('evaluasi.atasan.kuesioner');
    Route::get('/evaluasi/atasan/{alumni_id}/kuesioner/{kuesioner_id}', [EvaluasiAtasanController::class, 'showFormKuesioner'])->name('evaluasi.atasan.form');
    Route::post('/evaluasi/atasan/jawaban', [EvaluasiAtasanController::class, 'store'])->name('evaluasi.atasan.store');
});

Route::middleware(['role:rekan'])->group(function () {
    Route::get('/dashboard/rekan', [UserEvaluasiController::class, 'rekan'])->name('dashboard.rekan');
    
    // Route Evaluasi Rekan Kerja
    Route::get('/evaluasi/rekankerja', [EvaluasiRekanKerjaController::class, 'index'])->name('evaluasi.rekankerja.index');
    Route::get('/evaluasi/rekankerja/{alumni_id}/kuesioner', [EvaluasiRekanKerjaController::class, 'showKuesioner'])->name('evaluasi.rekankerja.kuesioner');
    Route::get('/evaluasi/rekankerja/{alumni_id}/kuesioner/{kuesioner_id}', [EvaluasiRekanKerjaController::class, 'showFormKuesioner'])->name('evaluasi.rekankerja.form');
    Route::post('/evaluasi/rekankerja/jawaban', [EvaluasiRekanKerjaController::class, 'store'])->name('evaluasi.rekankerja.store');
});

// Route for Pelatihan menu
Route::get('/pelatihan', [UmumPelatihanController::class, 'index'])->name('Pelatihan.index');
Route::get('/pelatihan/{id}', [UmumPelatihanController::class, 'show'])->name('Pelatihan.show');

// Route for Self Assessment Index
Route::get('/self-assessment', [SelfAssessmentController::class, 'index'])->name('self-assessment.index');

Route::post('/self-assessment/store', [SelfAssessmentController::class, 'storeData'])->name('self-assessment.store');

// Routes for Usulan Pelatihan
Route::prefix('usulan-kebutuhan-pelatihan')->group(function () {
    Route::get('/', [UsulKebutuhanPelatihanController::class, 'index'])->name('usulan-kebutuhan-pelatihan.index');
    Route::get('/create', [UsulKebutuhanPelatihanController::class, 'create'])->name('usulan-kebutuhan-pelatihan.create'); // New route for creating
    Route::post('/store', [UsulKebutuhanPelatihanController::class, 'store'])->name('usulan-kebutuhan-pelatihan.store');
    Route::get('/edit/{id}', [UsulKebutuhanPelatihanController::class, 'edit'])->name('usulan-kebutuhan-pelatihan.edit'); // New route for editing
    Route::put('/update/{id}', [UsulKebutuhanPelatihanController::class, 'update'])->name('usulan-kebutuhan-pelatihan.update');
    Route::delete('/delete/{id}', [UsulKebutuhanPelatihanController::class, 'destroy'])->name('usulan-kebutuhan-pelatihan.delete');
});
Route::get('/evaluasi/pertanyaan', [EvaluasiAlumniController::class, 'showPertanyaan']);
Route::get('/evaluasi/pertanyaan', [EvaluasiAlumniController::class, 'showPertanyaan']);
Route::get('/evaluasi/pertanyaan', [EvaluasiAlumniController::class, 'showPertanyaan'])->name('MenuUmumMenuUmum.EvaluasiPasca.evaluasi.alumni');
Route::post('/evaluasi/store', [EvaluasiAlumniController::class, 'store'])->name('evaluasi.store');
Route::post('/evaluasi/store', [EvaluasiAlumniController::class, 'store'])->name('evaluasi.store');
Route::get('/alumni', [EvaluasiAlumniController::class, 'index'])->name('alumni');

// Route for Assessment Bawahan
Route::prefix('assessmentBawahan')->group(function () {
    Route::get('/', [AssessmentBawahanController::class, 'index'])->name('assessmentBawahan.index');
    Route::post('/store', [AssessmentBawahanController::class, 'store'])->name('assessmentBawahan.store');
});