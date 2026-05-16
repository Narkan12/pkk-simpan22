<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Property 1: Bug Condition — Exploration Tests
 *
 * CRITICAL: Test ini HARUS GAGAL pada kode yang belum diperbaiki.
 * Kegagalan membuktikan bug ada. Setelah fix diterapkan, test harus LULUS.
 *
 * Bug Conditions yang diuji:
 * - C1: AuthController::login() memvalidasi 'email' padahal form mengirim 'username'
 * - C2: Link "Lupa Kata Sandi?" di login.blade.php memiliki href="#"
 * - C3: View forgot.password.blade.php berisi form login bukan form email
 * - C4: GajiController tidak memiliki guard skip + Log::warning() untuk pegawai tanpa jabatan
 * - C5: DataMasterController::storePegawai() menggunakan disk 'public' bukan 's3'
 */
class BugConditionExplorationTest extends TestCase
{
    /**
     * C1: Login Field Mismatch
     *
     * Bug Condition: controller memvalidasi 'email' padahal form mengirim 'username'
     * Expected (setelah fix): login dengan username berhasil jika kredensial valid
     *
     * Pada kode UNFIXED: test ini GAGAL karena controller menggunakan 'email'
     * Setelah fix: test LULUS karena controller menggunakan 'username'
     */
    public function test_login_controller_validates_username_not_email(): void
    {
        $controllerSource = file_get_contents(app_path('Http/Controllers/AuthController.php'));

        // Setelah fix: controller harus memvalidasi 'username', bukan 'email'
        $this->assertStringContainsString(
            "'username' => 'required|string'",
            $controllerSource,
            'Bug C1: AuthController::login() masih memvalidasi field "email" padahal form mengirim "username". ' .
            'Fix: ubah validasi dari "email" ke "username".'
        );

        // Setelah fix: credentials array harus menggunakan 'username'
        $this->assertStringContainsString(
            "'username' => \$request->username",
            $controllerSource,
            'Bug C1: credentials array masih menggunakan "email" bukan "username".'
        );
    }

    /**
     * C2: Link "Lupa Kata Sandi?" masih href="#"
     *
     * Bug Condition: href="#" — link tidak mengarah ke route yang valid
     * Expected (setelah fix): href mengarah ke route('password.request')
     *
     * Pada kode UNFIXED: test ini GAGAL karena href masih "#"
     * Setelah fix: test LULUS karena href menggunakan route('password.request')
     */
    public function test_forgot_password_link_uses_route_not_hash(): void
    {
        $loginViewSource = file_get_contents(resource_path('views/auth/login.blade.php'));

        // Setelah fix: link harus menggunakan route('password.request')
        $this->assertStringContainsString(
            "route('password.request')",
            $loginViewSource,
            'Bug C2: Link "Lupa Kata Sandi?" di login.blade.php masih menggunakan href="#". ' .
            'Fix: ubah ke href="{{ route(\'password.request\') }}".'
        );

        // Setelah fix: tidak boleh ada href="#" untuk link lupa password
        $this->assertStringNotContainsString(
            '<a href="#" class="forgot-link">',
            $loginViewSource,
            'Bug C2: Link "Lupa Kata Sandi?" masih menggunakan href="#".'
        );
    }

    /**
     * C3: View forgot.password.blade.php berisi form login bukan form email
     *
     * Bug Condition: view berisi konten form login (action ke route('login'))
     * Expected (setelah fix): view berisi form input email (action ke route('password.email'))
     *
     * Pada kode UNFIXED: test ini GAGAL karena view berisi form login
     * Setelah fix: test LULUS karena view berisi form email reset
     */
    public function test_forgot_password_view_contains_email_form_not_login_form(): void
    {
        $forgotViewSource = file_get_contents(resource_path('views/auth/forgot.password.blade.php'));

        // Setelah fix: view harus memiliki action ke route('password.email')
        $this->assertStringContainsString(
            "route('password.email')",
            $forgotViewSource,
            'Bug C3: View forgot.password.blade.php masih berisi form login bukan form input email. ' .
            'Fix: ganti konten dengan form input email yang action-nya ke route("password.email").'
        );

        // Setelah fix: view tidak boleh memiliki action ke route('login')
        $this->assertStringNotContainsString(
            "route('login')",
            $forgotViewSource,
            'Bug C3: View forgot.password.blade.php masih memiliki action ke route("login") — ini adalah form login, bukan form reset password.'
        );
    }

    /**
     * C4: GajiController tidak memiliki guard skip + Log::warning() untuk pegawai tanpa jabatan
     *
     * Bug Condition: tidak ada guard eksplisit dan Log::warning() untuk pegawai tanpa jabatan
     * Expected (setelah fix): ada guard if (!$pegawai->jabatan) dengan Log::warning()
     *
     * Pada kode UNFIXED: test ini GAGAL karena tidak ada guard + log
     * Setelah fix: test LULUS karena ada guard eksplisit dengan Log::warning()
     */
    public function test_gaji_controller_has_null_jabatan_guard_with_warning_log(): void
    {
        $gajiControllerSource = file_get_contents(app_path('Http/Controllers/GajiController.php'));

        // Setelah fix: harus ada guard untuk null jabatan
        $this->assertStringContainsString(
            '!$pegawai->jabatan',
            $gajiControllerSource,
            'Bug C4: GajiController::store() tidak memiliki guard eksplisit untuk pegawai tanpa jabatan. ' .
            'Fix: tambahkan if (!$pegawai->jabatan) { Log::warning(...); continue; }'
        );

        // Setelah fix: harus ada Log::warning()
        $this->assertStringContainsString(
            'Log::warning(',
            $gajiControllerSource,
            'Bug C4: GajiController::store() tidak memanggil Log::warning() untuk pegawai tanpa jabatan.'
        );
    }

    /**
     * C5: DataMasterController::storePegawai() menggunakan disk 'public' bukan 's3'
     *
     * Bug Condition: disk 'public' digunakan di lingkungan Laravel Cloud (ephemeral)
     * Expected (setelah fix): disk 's3' digunakan agar file persisten
     *
     * Pada kode UNFIXED: test ini GAGAL karena masih menggunakan disk 'public'
     * Setelah fix: test LULUS karena menggunakan disk 's3'
     */
    public function test_data_master_controller_uses_s3_disk_not_public(): void
    {
        $controllerSource = file_get_contents(app_path('Http/Controllers/DataMasterController.php'));

        // Setelah fix: harus menggunakan disk 's3'
        $this->assertStringContainsString(
            "'s3'",
            $controllerSource,
            'Bug C5: DataMasterController masih menggunakan disk "public" untuk upload foto. ' .
            'Fix: ubah semua storeAs(..., "public") dan Storage::disk("public") ke "s3".'
        );

        // Setelah fix: tidak boleh ada storeAs dengan disk 'public' untuk foto
        $this->assertStringNotContainsString(
            "storeAs('foto_pegawai', \$namaFile, 'public')",
            $controllerSource,
            'Bug C5: storePegawai() masih menggunakan disk "public" untuk menyimpan foto.'
        );
    }

    /**
     * C5b: View data-pegawai.blade.php masih menggunakan asset('storage/...') bukan Storage::disk('s3')->url()
     *
     * Bug Condition: URL foto menggunakan asset() yang tidak valid untuk S3
     * Expected (setelah fix): URL foto menggunakan Storage::disk('s3')->url()
     */
    public function test_data_pegawai_view_uses_s3_url_not_asset_storage(): void
    {
        $viewSource = file_get_contents(resource_path('views/data-pegawai.blade.php'));

        // Setelah fix: harus menggunakan Storage::disk('s3')->url()
        $this->assertStringContainsString(
            "disk('s3')->url(",
            $viewSource,
            'Bug C5b: View data-pegawai.blade.php masih menggunakan asset("storage/...") untuk URL foto. ' .
            'Fix: ubah ke Storage::disk("s3")->url($pegawai->foto).'
        );

        // Setelah fix: tidak boleh ada asset('storage/' . $pegawai->foto)
        $this->assertStringNotContainsString(
            "asset('storage/' . \$pegawai->foto)",
            $viewSource,
            'Bug C5b: View masih menggunakan asset("storage/...") yang tidak valid untuk S3.'
        );
    }
}
