<?php

/**
 * MIDDLEWARE REGISTRATION FOR LARAVEL 11
 * 
 * Add these middleware registrations to your bootstrap/app.php file
 * in the withMiddleware() method.
 */

// In bootstrap/app.php, add this to the withMiddleware() method:

/*
->withMiddleware(function (Middleware $middleware) {
    // Register role-based middleware aliases
    $middleware->alias([
        'role' => \App\Http\Middleware\RoleMiddleware::class,
        'multi-role' => \App\Http\Middleware\MultiRoleMiddleware::class,
        'direct-role' => \App\Http\Middleware\DirectRoleMiddleware::class,
        'action' => \App\Http\Middleware\ActionMiddleware::class,
    ]);
    
    // Optional: Add global middleware if needed
    // $middleware->append(\App\Http\Middleware\RoleMiddleware::class);
})
*/

/**
 * ALTERNATIVE FOR OLDER LARAVEL VERSIONS (Laravel 10 and below)
 * 
 * If using Laravel 10 or below, add these to app/Http/Kernel.php
 * in the $middlewareAliases array:
 */

/*
protected $middlewareAliases = [
    // ... existing middleware aliases ...
    
    // Role-based middleware
    'role' => \App\Http\Middleware\RoleMiddleware::class,
    'multi-role' => \App\Http\Middleware\MultiRoleMiddleware::class,
    'direct-role' => \App\Http\Middleware\DirectRoleMiddleware::class,
    'action' => \App\Http\Middleware\ActionMiddleware::class,
];
*/

/**
 * USAGE IN ROUTES:
 * 
 * 1. Single gate check:
 *    Route::get('/dashboard', [Controller::class, 'method'])->middleware('role:access-beranda');
 * 
 * 2. Multiple role check:
 *    Route::get('/admin-only', [Controller::class, 'method'])->middleware('direct-role:admin,owner');
 * 
 * 3. Action-based permission:
 *    Route::post('/pegawai', [Controller::class, 'store'])->middleware('action:create,pegawai');
 * 
 * 4. Multiple gates (OR condition):
 *    Route::get('/reports', [Controller::class, 'method'])->middleware('multi-role:access-laporan-pegawai,access-laporan-gaji');
 */