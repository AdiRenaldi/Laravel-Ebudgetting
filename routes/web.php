<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\renmiController;
use App\Http\Controllers\spnController;
use App\Http\Controllers\stafController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/login', [authController::class, 'login'])->name('login');
//         Route::post('/login', [authController::class, 'prosesLogin']);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('guest:admin,renmi,spn,staf')->group(function () {
    Route::controller(authController::class)->group(function () {
        Route::get('/', 'login')->name('login');
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'prosesLogin');
    });
});

// auth = membatasi akses jika belum login
Route::middleware('auth:admin,renmi,spn,staf')->group(function(){
    // logout
    Route::get('/logout', [authController::class, 'logout']);
    // admin
    Route::middleware('admin')->group(function () {
        Route::controller(adminController::class)->group(function () {
            Route::get('/dashboard', 'dashboard');
    
            Route::get('/renmi-data', 'renmiData');
            Route::get('/renmi-add', 'renmiAdd');
            Route::post('/renmi-add', 'renmiProsesAdd');
            Route::get('/renmi-edit/{slug}', 'renmiEdit');
            Route::put('/renmi-update/{slug}', 'renminUpdate');
            Route::get('renmi-delete/{slug}', 'renminDelete');
    
            Route::get('/spn-data', 'SpnData');
            Route::get('/spn-add', 'spnAdd');
            Route::post('/spn-add', 'spnProsesAdd');
            Route::get('/spn-edit/{slug}', 'spnEdit');
            Route::put('/spn-update/{slug}', 'spnUpdate');
            Route::get('spn-delete/{slug}', 'spnDelete');
    
            Route::get('/staf-data', 'stafData');
            Route::get('/staf-add', 'stafAdd');
            Route::post('/staf-add', 'stafProsesAdd');
            Route::get('/staf-edit/{slug}', 'stafEdit');
            Route::put('/staf-update/{slug}', 'stafUpdate');
            Route::get('staf-delete/{slug}', 'stafDelete');
        });
    });

    // renmin
    Route::middleware('renmi')->group(function () {
        Route::controller(renmiController::class)->group(function () {
            Route::get('/renmi-dashboard', 'dashboard');
    
            Route::get('/dipa', 'Dipa');
            Route::get('/dipa-add', 'dipaAdd');
            Route::post('/dipa-add', 'dipaAddproses');
            Route::get('/dipa-edit/{slug}', 'dipaEdit');
            Route::put('/dipa-update/{slug}', 'dipaUpdate');
            Route::get('/dipa-delete/{slug}', 'dipaDelete');
            Route::get('/dipa-ajukan/{slug}', 'dipaAjukan');

            // revisi dana dipa jika ada penambahan atau pengurangan dana
            Route::get('/tambah-dana-dipa/{slug}', 'tambahDanaDipa');
            Route::get('/kurang-dana-dipa/{slug}', 'kurangDanaDipa');
            Route::put('/tambah-dana-dipa/{slug}', 'prosesTambahDipa');
            Route::put('/kurang-dana-dipa/{slug}', 'prosesKurangDipa');

            Route::get('/dipa-diajukan', 'dipaDiAjukan');
            Route::get('/dipa-disetujui', 'dipaDisetujui');
            Route::get('/anggaranStaf', 'danaStaf');

            Route::get('/dana-staf', 'danaStaf');
            Route::get('/penyaluran-dana', 'penyaluranDana');
            Route::post('/staf-dana-add', 'stafDanaAdd');
            Route::get('/edit-dana-staf/{id}', 'editDanaStaf');
            Route::put('/update-staf-dana/{id}', 'updateStafDana');
            Route::get('/delete-dana-staf/{id}', 'deleteDanaStaf');

            // penambahan dan pengurangan dana staf
            Route::get('/tambah-dana-staf/{id}', 'tambahDanastaf');
            Route::get('/kurang-dana-staf/{id}', 'kurangDanastaf');
            Route::put('/tambah-dana-staf/{id}', 'prosesTambahStaf');
            Route::put('/kurang-dana-staf/{id}', 'prosesKurangStaf');

            Route::get('/kegiatan', 'kegiatan');
            Route::get('/kegiatan-add', 'kegiatanAdd');
            Route::post('/kegiatan-add', 'prosesAddkegiatan');
            Route::get('/edit-kegiatan/{slug}', 'kegiatanEdit');
            Route::put('/update-kegiatan/{slug}', 'kegiatanUpdate');
            Route::get('/hapus-kegiatan/{slug}', 'kegiatanDeleted');

            Route::get('/program-kegiatan', 'programKegiatan');
            Route::get('/program-add', 'programAdd');
            Route::post('/program-add', 'prosesAddProgram');
            Route::get('/edit-program/{slug}', 'programEdit' );
            Route::put('/update-program/{slug}', 'programUpdate');
            Route::get('/hapus-program/{slug}', 'programDelete');

            Route::get('/anggaran', 'anggaran');
            
            Route::get('/halaman-realisasi', 'halamanRealisasi');

            Route::get('/realisasi-anggaran/{slug}', 'realisasiAnggaran');
            Route::put('/update-realisasiAnggaran/{slug}', 'updateAnggaran');



            Route::get('/hapus-realisasi/{slug}', 'realisasiDelete');
            // Route::get('/laporan', 'pencarianRealisasi');

    
    
            Route::get('/laporan', 'Laporan');
            Route::get('/laporan-delete/{slug}', 'hapusLaporan');
            Route::get('/laporan-revisi', 'LaporanRevisi');
            Route::get('/cetak-laporan', 'cetakLaporan');
            Route::get('/cetak-excel', 'exportExcel');
        });
    });
    

    // staff
    Route::middleware('staf')->group(function () {
        Route::get('/staf-dashboard', [renmiController::class, 'dashboard']);
        Route::controller(stafController::class)->group(function () {
            // Route::get('/staf-dashboard', 'dashboard');

            Route::get('/staf-kebutuhan-anggaran', 'anggaranDirealisasikan');
            Route::get('/Staf_add_kebutuhan_anggaran', 'addKebutuhanAnggaran');
            Route::post('/tambah-kebutuhan-anggaran', 'prosesAddKebutuhanAnggaran');
            Route::get('/edit-kebutuhan-anggaran/{slug}', 'editKebutuhanAnggaran');
            Route::put('/update-kebutuhan-anggaran/{slug}', 'updateKebutuhanAnggaran');
            Route::get('/delete-kebutuhan-anggaran/{slug}', 'deletedKebutuhanAnggaran');
            Route::get('/ajukan_kebutuhan_anggaran/{slug}', 'ajukanKebutuhanAnggaran');
            Route::get('/anggaran-disetujui', 'AnggaranDisetujui');

            Route::get('/anggaran-diajukan', 'anggaranDiajukan');
        });
    });

    // spn
    Route::middleware('spn')->group(function () {
        Route::get('/dipa-spn', [renmiController::class, 'Dipa']);
        Route::get('/rekap-laporan', [renmiController::class, 'laporan']);
        Route::get('/print-laporan', [renmiController::class, 'cetakLaporan']);
        Route::get('/unduh-excel', [renmiController::class, 'exportExcel']);
        Route::get('/spn-dashboard', [renmiController::class, 'dashboard']);
        Route::get('/laporan-revisi-spn', [renmiController::class, 'LaporanRevisi']);
        Route::get('/meyetujui-anggaran', [stafController::class, 'AnggaranDisetujui']);

        Route::controller(spnController::class)->group(function () {
            Route::get('/pengajuan-dipa-spn', 'pengajuanDipa');
            Route::get('/tolak-dipa/{slug}', 'tolakDipa');
            Route::put('/dipa-revisi/{slug}', 'DipaRevisi');
            Route::get('/setuju-dipa/{slug}', 'setujuDipa');

            Route::get('/anggaran-disetuju-spn', 'halamanAnggaran');
            Route::get('/tolak-anggaran/{slug}', 'tolakAnggaran');
            Route::put('/staf-revisi/{slug}', 'StafRevisi');
            Route::get('/setuju_kebutuhan_anggaran/{slug}', 'setujuKebutuhanAnggaran');
        });
    });
});