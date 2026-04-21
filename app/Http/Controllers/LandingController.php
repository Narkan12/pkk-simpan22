<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Departemen;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display landing page with data
     */

    public function index()
    {
        $departemen = Departemen::all();
        $jabatan = Jabatan::all();
        
        return view('landing', compact('departemen', 'jabatan'));
    }

    public function search(Request $request)
    {
        // Cek input kosong
        $inputs = $request->only(['nip', 'nama', 'departemen', 'jabatan']);

        $filledInputs = array_filter($inputs, function ($value) {
            return !empty($value);
        });

        if (empty($filledInputs)) {
            return redirect()->to(url()->previous() . '#search')
                ->withErrors(['search' => 'Silakan masukkan minimal satu kriteria pencarian (NIP, Nama, dll).'])
                ->withInput();
        }

        $departemen = Departemen::all();
        $jabatan = Jabatan::all();

        $query = Employees::query();

        if ($request->filled('nip')) {
            $query->where('NIP', 'like', '%' . $request->nip . '%');
        }

        if ($request->filled('nama')) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama . '%');
        }

        if ($request->filled('departemen')) {
            $query->where('id_departemen', $request->departemen);
        }

        if ($request->filled('jabatan')) {
            $query->where('id_jabatan', $request->jabatan);
        }

        $hasil = $query->with(['departemen', 'jabatan'])->get();

        return view('landing', compact('departemen', 'jabatan', 'hasil'));
    }
}
