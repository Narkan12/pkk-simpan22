<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class HrdController extends Controller
{
    public function index()
    {
        Gate::authorize('access-manajemen-hrd');

        $hrdList = User::where('role', 'hrd')->orderBy('name')->get();

        return view('manajemen.manajemen-hrd', compact('hrdList'));
    }

    // tambah akun HRD baru
    public function store(Request $request)
    {
        Gate::authorize('create-hrd');

        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'name.required'      => 'Nama lengkap harus diisi.',
            'username.required'  => 'Username harus diisi.',
            'username.unique'    => 'Username sudah digunakan.',
            'email.required'     => 'Email harus diisi.',
            'email.unique'       => 'Email sudah digunakan.',
            'password.required'  => 'Password harus diisi.',
            'password.min'       => 'Password minimal :min karakter.',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'hrd',
        ]);

        return back()->with('success', "Akun HRD {$request->name} berhasil ditambahkan.");
    }

    // edit akun HRD
    public function update(Request $request, User $user)
    {
        Gate::authorize('edit-hrd');

        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:users,username,' . $user->id,
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', "Akun HRD {$user->name} berhasil diperbarui.");
    }

    public function destroy(User $user)
    {
        Gate::authorize('delete-hrd');

        $nama = $user->name;
        $user->delete();

        return back()->with('success', "Akun HRD {$nama} berhasil dihapus.");
    }
}
