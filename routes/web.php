<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ManajemenController;
use Illuminate\Support\Facades\Route;


// ── Public ────────────────────────────────────────────────────────────────────
Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');
Route::post('/search', [App\Http\Controllers\LandingController::class, 'search'])->name('search');




Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==== ADMIN ===== //
    Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DataMasterController::class, 'dashboard'])->name('dashboard');
    
    // Route Data Pegawai + CRUD

    Route::get('/data-pegawai',              [DataMasterController::class, 'dataPegawai'])->name('data-pegawai');
    Route::post('/data-pegawai',             [DataMasterController::class, 'dataPegawaiInsert'])->name('dataPegawai.insert');
    Route::put('/data-pegawai/{pegawai}',    [DataMasterController::class, 'dataPegawaiUpdate'])->name('dataPegawai.update');
    Route::delete('/data-pegawai/{pegawai}', [DataMasterController::class, 'dataPegawaiDelete'])->name('dataPegawai.delete');

    //== Data Master ==//

    // Route Departemen + CRUD

    Route::get('/departemen', [DataMasterController::class, 'departemen'])->name('departemen');
    Route::post('/departemen', [DataMasterController::class, 'departemenInsert'])->name('departemen.insert');
    Route::put('/departemen/{departemen}', [DataMasterController::class, 'departemenUpdate'])->name('departemen.update');
    Route::delete('/departemen/{departemen}', [DataMasterController::class, 'departemenDelete'])->name('departemen.delete');
    

    // Route Status + CRUD
    Route::get('/status', [DataMasterController::class, 'status'])->name('status');
    Route::post('/status', [DataMasterController::class, 'statusInsert'])->name('status.insert');
    Route::put('/status/{status}', [DataMasterController::class, 'statusUpdate'])->name('status.update');
    Route::delete('/status/{status}', [DataMasterController::class, 'statusDelete'])->name('status.delete');

    // Route Jabatan + CRUD
    Route::get('/jabatan', [DataMasterController::class, 'jabatan'])->name('jabatan');
    Route::post('/jabatan', [DataMasterController::class, 'jabatanInsert'])->name('jabatan.insert');
    Route::put('/jabatan/{jabatan}', [DataMasterController::class, 'jabatanUpdate'])->name('jabatan.update');
    Route::delete('/jabatan/{jabatan}', [DataMasterController::class, 'jabatanDelete'])->name('jabatan.delete');

    // Route Golongan + CRUD
    Route::get('/golongan', [DataMasterController::class, 'golongan'])->name('golongan');
    Route::post('/golongan', [DataMasterController::class, 'golonganInsert'])->name('golongan.insert');
    Route::put('/golongan/{golongan}', [DataMasterController::class, 'golonganUpdate'])->name('golongan.update');
    Route::delete('/golongan/{golongan}', [DataMasterController::class, 'golonganDelete'])->name('golongan.delete');

    // Route Pendidikan + CRUD
    Route::get('/pendidikan', [DataMasterController::class, 'pendidikan'])->name('pendidikan');
    Route::post('/pendidikan', [DataMasterController::class, 'pendidikanInsert'])->name('pendidikan.insert');
    Route::put('/pendidikan/{pendidikan}', [DataMasterController::class, 'pendidikanUpdate'])->name('pendidikan.update');
    Route::delete('/pendidikan/{pendidikan}', [DataMasterController::class, 'pendidikanDelete'])->name('pendidikan.delete');

    // Route Komponen Gaji + CRUD
    Route::get('/komponen-gaji', [DataMasterController::class, 'komponenGaji'])->name('komponen-gaji');
    Route::post('/komponen-gaji', [DataMasterController::class, 'komponenGajiInsert'])->name('komponen-gaji.insert');
    Route::put('/komponen-gaji/{komponenGaji}', [DataMasterController::class, 'komponenGajiUpdate'])->name('komponen-gaji.update');
    Route::delete('/komponen-gaji/{komponenGaji}', [DataMasterController::class, 'komponenGajiDelete'])->name('komponen-gaji.delete');

    // Manajemen
    Route::get('/absensi',        [ManajemenController::class, 'absensi'])->name('absensi');
    Route::get('/manajemen-cuti', [ManajemenController::class, 'cuti'])->name('manajemen-cuti');
    Route::patch('/manajemen-cuti/{cuti}/setujui', [ManajemenController::class, 'cutiSetujui'])->name('cuti.setujui');
    Route::patch('/manajemen-cuti/{cuti}/tolak',   [ManajemenController::class, 'cutiTolak'])->name('cuti.tolak');

    Route::get('/manajemen-gaji', [GajiController::class, 'index'])->name('manajemen-gaji');
    Route::post('/manajemen-gaji/generate', [GajiController::class, 'store'])->name('gaji.store');
    Route::put('/manajemen-gaji/{gaji}', [GajiController::class, 'update'])->name('gaji.update');
    Route::delete('/manajemen-gaji/{gaji}', [GajiController::class, 'destroy'])->name('gaji.destroy');

    // Laporan
    Route::get('/ekspor-data', function () {
        return view('laporan.ekspor-data');
    })->name('ekspor-data');

    Route::get('/laporan/export-pegawai', [LaporanController::class, 'exportPegawai'])->name('laporan.exportPegawai');
    Route::get('/laporan/export-absensi', [LaporanController::class, 'exportAbsensi'])->name('laporan.exportAbsensi');
    Route::get('/laporan/export-gaji',    [LaporanController::class, 'exportGaji'])->name('laporan.exportGaji');
    Route::get('/laporan/export-cuti',    [LaporanController::class, 'exportCuti'])->name('laporan.exportCuti');
    Route::get('/laporan/export-jabatan', [LaporanController::class, 'exportJabatan'])->name('laporan.exportJabatan');

    Route::get('/laporan-jabatan', [LaporanController::class, 'jabatan'])->name('laporan-jabatan');
    Route::get('/laporan-cuti',    [LaporanController::class, 'cuti'])->name('laporan-cuti');
    Route::get('/laporan-gaji',    [LaporanController::class, 'gaji'])->name('laporan-gaji');
    Route::get('/laporan-pegawai', [LaporanController::class, 'pegawai'])->name('laporan-pegawai');
});


// Route Pegawai
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-pegawai', [DashboardController::class, 'employee'])->name('dashboard.pegawai');
    Route::post('/absensi/submit', [ManajemenController::class, 'simpanAbsensi'])->name('absensi.simpan');
    Route::post('/cuti/submit', [ManajemenController::class, 'ajukanCuti'])->name('cuti.ajukan');
});

