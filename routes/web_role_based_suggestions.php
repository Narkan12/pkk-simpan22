<?php

/**
 * SUGGESTED ROLE-BASED ROUTE STRUCTURE FOR web.php
 * 
 * This file contains suggestions for reorganizing routes with proper role-based middleware.
 * Replace the existing route structure in web.php with this organized version.
 */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ManajemenController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\DirectRoleMiddleware;
use App\Http\Middleware\ActionMiddleware;
use Illuminate\Support\Facades\Route;

// ── Public Routes (No Authentication Required) ────────────────────────────────
Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');
Route::post('/search', [App\Http\Controllers\LandingController::class, 'search'])->name('search');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Protected Routes (Authentication Required) ─────────────────────────────────

// ── Routes Accessible by ALL ROLES (Owner, Admin, HRD) ────────────────────────
Route::middleware(['auth'])->group(function () {
    
    // Dashboard - All roles but different views
    Route::get('/dashboard', [DataMasterController::class, 'dashboard'])
        ->name('dashboard')
        ->middleware('role:access-beranda');
    
    // Employee Dashboard (for HRD and other non-admin roles)
    Route::get('/dashboard-pegawai', [DashboardController::class, 'employee'])
        ->name('dashboard.pegawai');
    
    // Data Pegawai - All roles can view, but actions are restricted
    Route::middleware('role:access-data-pegawai')->group(function () {
        Route::get('/data-pegawai', [DataMasterController::class, 'indexPegawai'])->name('data-pegawai');
        
        // CRUD operations restricted to Owner and Admin only
        Route::middleware('action:create,pegawai')->group(function () {
            Route::post('/data-pegawai', [DataMasterController::class, 'storePegawai'])->name('dataPegawai.insert');
        });
        
        Route::middleware('action:edit,pegawai')->group(function () {
            Route::put('/data-pegawai/{pegawai}', [DataMasterController::class, 'updatePegawai'])->name('dataPegawai.update');
        });
        
        Route::middleware('action:delete,pegawai')->group(function () {
            Route::delete('/data-pegawai/{pegawai}', [DataMasterController::class, 'destroyPegawai'])->name('dataPegawai.delete');
        });
    });
    
    // Operasional - All roles can access
    Route::middleware('role:access-operasional')->group(function () {
        
        // Absensi
        Route::get('/absensi', [ManajemenController::class, 'absensi'])
            ->name('absensi')
            ->middleware('role:access-absensi');
        
        Route::post('/absensi/submit', [ManajemenController::class, 'simpanAbsensi'])
            ->name('absensi.simpan')
            ->middleware('action:create,absensi');
        
        // Manajemen Cuti
        Route::get('/manajemen-cuti', [ManajemenController::class, 'cuti'])
            ->name('manajemen-cuti')
            ->middleware('role:access-manajemen-cuti');
        
        Route::post('/cuti/submit', [ManajemenController::class, 'ajukanCuti'])
            ->name('cuti.ajukan')
            ->middleware('action:create,cuti');
        
        // Cuti approval actions (Owner and Admin only)
        Route::middleware('action:approve,cuti')->group(function () {
            Route::patch('/manajemen-cuti/{cuti}/setujui', [ManajemenController::class, 'cutiSetujui'])->name('cuti.setujui');
            Route::patch('/manajemen-cuti/{cuti}/tolak', [ManajemenController::class, 'cutiTolak'])->name('cuti.tolak');
        });
        
        // Manajemen Gaji
        Route::get('/manajemen-gaji', [GajiController::class, 'index'])
            ->name('manajemen-gaji')
            ->middleware('role:access-manajemen-gaji');
        
        // Gaji operations (Owner and Admin only)
        Route::middleware('action:generate,gaji')->group(function () {
            Route::post('/manajemen-gaji/generate', [GajiController::class, 'store'])->name('gaji.store');
        });
        
        Route::middleware('action:edit,gaji')->group(function () {
            Route::put('/manajemen-gaji/{gaji}', [GajiController::class, 'update'])->name('gaji.update');
        });
        
        Route::middleware('action:delete,gaji')->group(function () {
            Route::delete('/manajemen-gaji/{gaji}', [GajiController::class, 'destroy'])->name('gaji.destroy');
        });
    });
    
    // Laporan - Different access levels per role
    Route::prefix('laporan')->group(function () {
        
        // Laporan accessible by all roles
        Route::get('/laporan-pegawai', [LaporanController::class, 'pegawai'])
            ->name('laporan-pegawai')
            ->middleware('role:access-laporan-pegawai');
        
        Route::get('/laporan-gaji', [LaporanController::class, 'gaji'])
            ->name('laporan-gaji')
            ->middleware('role:access-laporan-gaji');
        
        Route::get('/laporan-cuti', [LaporanController::class, 'cuti'])
            ->name('laporan-cuti')
            ->middleware('role:access-laporan-cuti');
        
        // Laporan Jabatan - Owner and Admin only
        Route::get('/laporan-jabatan', [LaporanController::class, 'jabatan'])
            ->name('laporan-jabatan')
            ->middleware('role:access-laporan-jabatan');
    });
});

// ── Routes for OWNER and ADMIN Only ────────────────────────────────────────────
Route::middleware(['auth', 'direct-role:owner,admin'])->group(function () {
    
    // Data Master - Owner and Admin only
    Route::middleware('role:access-data-master')->group(function () {
        
        // Departemen
        Route::get('/departemen', [DataMasterController::class, 'indexDepartemen'])->name('departemen');
        Route::post('/departemen', [DataMasterController::class, 'storeDepartemen'])->name('departemen.insert');
        Route::put('/departemen/{departemen}', [DataMasterController::class, 'updateDepartemen'])->name('departemen.update');
        Route::delete('/departemen/{departemen}', [DataMasterController::class, 'destroyDepartemen'])->name('departemen.delete');
        
        // Status
        Route::get('/status', [DataMasterController::class, 'indexStatus'])->name('status');
        Route::post('/status', [DataMasterController::class, 'storeStatus'])->name('status.insert');
        Route::put('/status/{status}', [DataMasterController::class, 'updateStatus'])->name('status.update');
        Route::delete('/status/{status}', [DataMasterController::class, 'destroyStatus'])->name('status.delete');
        
        // Jabatan
        Route::get('/jabatan', [DataMasterController::class, 'indexJabatan'])->name('jabatan');
        Route::post('/jabatan', [DataMasterController::class, 'storeJabatan'])->name('jabatan.insert');
        Route::put('/jabatan/{jabatan}', [DataMasterController::class, 'updateJabatan'])->name('jabatan.update');
        Route::delete('/jabatan/{jabatan}', [DataMasterController::class, 'destroyJabatan'])->name('jabatan.delete');
        
        // Golongan
        Route::get('/golongan', [DataMasterController::class, 'indexGolongan'])->name('golongan');
        Route::post('/golongan', [DataMasterController::class, 'storeGolongan'])->name('golongan.insert');
        Route::put('/golongan/{golongan}', [DataMasterController::class, 'updateGolongan'])->name('golongan.update');
        Route::delete('/golongan/{golongan}', [DataMasterController::class, 'destroyGolongan'])->name('golongan.delete');
        
        // Pendidikan
        Route::get('/pendidikan', [DataMasterController::class, 'indexPendidikan'])->name('pendidikan');
        Route::post('/pendidikan', [DataMasterController::class, 'storePendidikan'])->name('pendidikan.insert');
        Route::put('/pendidikan/{pendidikan}', [DataMasterController::class, 'updatePendidikan'])->name('pendidikan.update');
        Route::delete('/pendidikan/{pendidikan}', [DataMasterController::class, 'destroyPendidikan'])->name('pendidikan.delete');
        
        // Komponen Gaji
        Route::get('/komponen-gaji', [DataMasterController::class, 'indexKomponenGaji'])->name('komponen-gaji');
        Route::post('/komponen-gaji', [DataMasterController::class, 'storeKomponenGaji'])->name('komponen-gaji.insert');
        Route::put('/komponen-gaji/{komponenGaji}', [DataMasterController::class, 'updateKomponenGaji'])->name('komponen-gaji.update');
        Route::delete('/komponen-gaji/{komponenGaji}', [DataMasterController::class, 'destroyKomponenGaji'])->name('komponen-gaji.delete');
    });
});

// ── Routes for ADMIN Only ──────────────────────────────────────────────────────
Route::middleware(['auth', 'direct-role:admin'])->group(function () {
    
    // Ekspor Data - Admin only
    Route::get('/ekspor-data', function () {
        return view('laporan.ekspor-data');
    })->name('ekspor-data')->middleware('role:access-ekspor-data');
    
    // Export functions - Admin only
    Route::prefix('laporan')->group(function () {
        Route::get('/export-pegawai', [LaporanController::class, 'exportPegawai'])->name('laporan.exportPegawai');
        Route::get('/export-absensi', [LaporanController::class, 'exportAbsensi'])->name('laporan.exportAbsensi');
        Route::get('/export-gaji', [LaporanController::class, 'exportGaji'])->name('laporan.exportGaji');
        Route::get('/export-cuti', [LaporanController::class, 'exportCuti'])->name('laporan.exportCuti');
        Route::get('/export-jabatan', [LaporanController::class, 'exportJabatan'])->name('laporan.exportJabatan');
    });
});

// ── Routes for OWNER Only ──────────────────────────────────────────────────────
Route::middleware(['auth', 'direct-role:owner'])->group(function () {
    
    // System administration routes (if any)
    // Route::get('/system-settings', [SystemController::class, 'settings'])->name('system.settings');
    // Route::get('/user-management', [UserController::class, 'index'])->name('users.index');
    // Route::get('/backup-restore', [BackupController::class, 'index'])->name('backup.index');
    
});

/**
 * MIDDLEWARE REGISTRATION
 * 
 * Add these to app/Http/Kernel.php in the $middlewareAliases array:
 * 
 * 'role' => \App\Http\Middleware\RoleMiddleware::class,
 * 'multi-role' => \App\Http\Middleware\MultiRoleMiddleware::class,
 * 'direct-role' => \App\Http\Middleware\DirectRoleMiddleware::class,
 * 'action' => \App\Http\Middleware\ActionMiddleware::class,
 */

/**
 * USAGE EXAMPLES:
 * 
 * 1. Gate-based middleware (recommended):
 *    ->middleware('role:access-data-master')
 * 
 * 2. Direct role check:
 *    ->middleware('direct-role:admin,owner')
 * 
 * 3. Action-based permissions:
 *    ->middleware('action:create,pegawai')
 *    ->middleware('action:edit,gaji')
 * 
 * 4. Multiple gates (OR condition):
 *    ->middleware('multi-role:access-laporan-pegawai,access-laporan-gaji')
 */

/**
 * ROLE ACCESS SUMMARY:
 * 
 * OWNER:
 * ✅ Beranda, Data Pegawai, Data Master, Operasional, Laporan (except Ekspor Data)
 * ❌ Ekspor Data
 * 
 * ADMIN: 
 * ✅ Full access to all menus and features
 * 
 * HRD:
 * ✅ Beranda, Data Pegawai (view only), Operasional, Laporan Pegawai/Gaji/Cuti
 * ❌ Data Master, Laporan Jabatan, Ekspor Data
 * ❌ CRUD operations on most entities (view only)
 */