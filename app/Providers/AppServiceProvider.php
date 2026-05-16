<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force clear compiled view cache on boot (remove after deploy)
        if (app()->environment('production')) {
            \Illuminate\Support\Facades\Artisan::call('view:clear');
            // Buat storage symlink jika belum ada
            if (!file_exists(public_path('storage'))) {
                \Illuminate\Support\Facades\Artisan::call('storage:link');
            }
        }
    }
}
