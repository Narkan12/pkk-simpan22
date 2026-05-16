<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $gate): Response
    {
        // belum login, redirect ke halaman login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // cek gate, kalau tidak punya akses tolak
        if (!Gate::allows($gate)) {
            $user = auth()->user();
            $roleName = $this->getRoleName($user->role);
            
            return redirect()->route('dashboard')->with('error', 
                "Akses ditolak. Role {$roleName} tidak memiliki izin untuk mengakses halaman ini."
            );
        }

        return $next($request);
    }

    // konversi role ke nama yang lebih ramah
    private function getRoleName(string $role): string
    {
        return match($role) {
            'owner' => 'Owner',
            'admin' => 'Administrator',
            'hrd' => 'HRD',
            default => 'Unknown'
        };
    }
}

// middleware untuk cek beberapa gate sekaligus (OR)
class MultiRoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$gates): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // lolos kalau minimal satu gate diizinkan
        $hasPermission = false;
        foreach ($gates as $gate) {
            if (Gate::allows($gate)) {
                $hasPermission = true;
                break;
            }
        }

        if (!$hasPermission) {
            $user = auth()->user();
            $roleName = match($user->role) {
                'owner' => 'Owner',
                'admin' => 'Administrator', 
                'hrd' => 'HRD',
                default => 'Unknown'
            };
            
            return redirect()->route('dashboard')->with('error', 
                "Akses ditolak. Role {$roleName} tidak memiliki izin untuk mengakses halaman ini."
            );
        }

        return $next($request);
    }
}

// middleware cek role langsung (tanpa gate)
class DirectRoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$allowedRoles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $userRole = auth()->user()->role;
        
        if (!in_array($userRole, $allowedRoles)) {
            $roleName = match($userRole) {
                'owner' => 'Owner',
                'admin' => 'Administrator',
                'hrd' => 'HRD', 
                default => 'Unknown'
            };
            
            return redirect()->route('dashboard')->with('error', 
                "Akses ditolak. Role {$roleName} tidak memiliki izin untuk mengakses halaman ini."
            );
        }

        return $next($request);
    }
}

// middleware cek permission per aksi (create, edit, delete, dll)
class ActionMiddleware
{
    public function handle(Request $request, Closure $next, string $action, string $resource = null): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // gabungkan action + resource jadi nama gate, misal: "create-pegawai"
        $gateName = $resource ? "{$action}-{$resource}" : $action;
        
        if (!Gate::allows($gateName)) {
            $user = auth()->user();
            $roleName = match($user->role) {
                'owner' => 'Owner',
                'admin' => 'Administrator',
                'hrd' => 'HRD',
                default => 'Unknown'
            };
            
            $actionName = match($action) {
                'create' => 'menambah',
                'edit' => 'mengedit', 
                'delete' => 'menghapus',
                'view' => 'melihat',
                'approve' => 'menyetujui',
                'generate' => 'menggenerate',
                default => $action
            };
            
            $resourceName = $resource ? " {$resource}" : '';
            
            return redirect()->back()->with('error', 
                "Akses ditolak. Role {$roleName} tidak memiliki izin untuk {$actionName}{$resourceName}."
            );
        }

        return $next($request);
    }
}