<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        // --- Menu Access ---

        Gate::define('access-beranda', fn($user) => in_array($user->role, ['owner', 'admin', 'hrd']));
        Gate::define('access-data-pegawai', fn($user) => in_array($user->role, ['owner', 'admin', 'hrd']));

        // Data Master → 
        Gate::define('access-data-master', fn($user) => $user->role === 'admin');
        Gate::define('access-jabatan',      fn($user) => $user->role === 'admin');
        Gate::define('access-departemen',   fn($user) => $user->role === 'admin');
        Gate::define('access-status',       fn($user) => $user->role === 'admin');
        Gate::define('access-golongan',     fn($user) => $user->role === 'admin');
        Gate::define('access-pendidikan',   fn($user) => $user->role === 'admin');
        Gate::define('access-komponen-gaji',fn($user) => $user->role === 'admin');

        // Operasional → 
        Gate::define('access-operasional',    fn($user) => in_array($user->role, ['admin', 'hrd']));
        Gate::define('access-absensi',        fn($user) => in_array($user->role, ['admin', 'hrd']));
        Gate::define('access-manajemen-cuti', fn($user) => in_array($user->role, ['admin', 'hrd']));

        // Gaji → 
        Gate::define('access-manajemen-gaji', fn($user) => in_array($user->role, ['owner', 'admin']));

        // --- Laporan ---

        Gate::define('access-laporan-pegawai', fn($user) => in_array($user->role, ['owner', 'admin', 'hrd']));
        Gate::define('access-laporan-gaji',    fn($user) => in_array($user->role, ['owner', 'admin', 'hrd']));
        Gate::define('access-laporan-cuti',    fn($user) => in_array($user->role, ['owner', 'admin', 'hrd']));
        Gate::define('access-laporan-jabatan', fn($user) => in_array($user->role, ['owner', 'admin', 'hrd']));
        Gate::define('access-ekspor-data',     fn($user) => in_array($user->role, ['admin', 'hrd']));

        // --- CRUD Actions ---

        // Pegawai 
        Gate::define('create-pegawai', fn($user) => in_array($user->role, ['admin', 'hrd']));
        Gate::define('edit-pegawai',   fn($user) => in_array($user->role, ['admin', 'hrd']));
        Gate::define('delete-pegawai', fn($user) => in_array($user->role, ['admin', 'hrd']));

        // Data Master 
        Gate::define('create-data-master', fn($user) => $user->role === 'admin');
        Gate::define('edit-data-master',   fn($user) => $user->role === 'admin');
        Gate::define('delete-data-master', fn($user) => $user->role === 'admin');

        // Absensi
        Gate::define('create-absensi', fn($user) => in_array($user->role, ['admin', 'hrd']));
        Gate::define('edit-absensi',   fn($user) => in_array($user->role, ['admin', 'hrd']));
        Gate::define('delete-absensi', fn($user) => in_array($user->role, ['admin', 'hrd']));

        // Cuti
        Gate::define('create-cuti',  fn($user) => in_array($user->role, ['admin', 'hrd']));
        Gate::define('approve-cuti', fn($user) => in_array($user->role, ['admin', 'hrd']));
        Gate::define('delete-cuti',  fn($user) => in_array($user->role, ['admin', 'hrd']));

        // Gaji 
        Gate::define('generate-gaji', fn($user) => in_array($user->role, ['admin', 'hrd']));
        Gate::define('edit-gaji',     fn($user) => in_array($user->role, ['admin', 'hrd']));
        Gate::define('delete-gaji',   fn($user) => in_array($user->role, ['admin', 'hrd']));

        // Manajemen HRD 
        Gate::define('access-manajemen-hrd', fn($user) => in_array($user->role, ['admin', 'owner']));
        Gate::define('create-hrd',           fn($user) => $user->role === 'admin');
        Gate::define('edit-hrd',             fn($user) => $user->role === 'admin');
        Gate::define('delete-hrd',           fn($user) => $user->role === 'admin');

        // --- System Administration 

        Gate::define('manage-users',    fn($user) => $user->role === 'owner');
        Gate::define('view-system-logs',fn($user) => $user->role === 'owner');
        Gate::define('backup-restore',  fn($user) => $user->role === 'owner');
    }
}
