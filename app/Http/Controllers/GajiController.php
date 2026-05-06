<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Gaji;
use App\Models\KomponenGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GajiController extends Controller
{
    /** Tampilkan halaman manajemen gaji dengan filter bulan & tahun */
    public function index(Request $request)
    {
        $bulanDipilih = $request->bulan ?? now()->month;
        $tahunDipilih = $request->tahun ?? now()->year;

        $daftarGaji = Gaji::with(['pegawai.jabatan'])
            ->where('bulan', $bulanDipilih)
            ->where('tahun', $tahunDipilih)
            ->get()
            ->sortBy(fn($g) => optional($g->pegawai)->nama_lengkap)
            ->values();

        $totalPegawai = $daftarGaji->count();
        $sudahDibayar = $daftarGaji->where('status_bayar', 'Sudah Dibayar')->count();
        $belumDibayar = $daftarGaji->where('status_bayar', 'Belum Dibayar')->count();

        $bulanList = range(1, 12);
        $tahunList = range(now()->year - 2, now()->year + 1);

        $gaji  = $daftarGaji;
        $bulan = $bulanDipilih;
        $tahun = $tahunDipilih;

        return view('manajemen.manajemen-gaji', compact(
            'gaji', 'bulan', 'tahun', 'bulanList', 'tahunList',
            'totalPegawai', 'sudahDibayar', 'belumDibayar'
        ));
    }

    /** Generate data gaji untuk semua pegawai aktif pada bulan & tahun tertentu */
    public function store(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer|min:2020',
        ]);

        $daftarPegawaiAktif = Employees::with(['jabatan'])
            ->whereHas('status', fn($q) => $q->where('nama_status', 'Aktif'))
            ->get();

        if ($daftarPegawaiAktif->isEmpty()) {
            return back()->with('error', 'Tidak ada pegawai dengan status Aktif.');
        }

        $jumlahDigenerate = 0;
        $jumlahDilewati   = 0;
        $jumlahError      = 0;

        foreach ($daftarPegawaiAktif as $pegawai) {
            $sudahAda = Gaji::where('id_pegawai', $pegawai->id)
                ->where('bulan', $request->bulan)
                ->where('tahun', $request->tahun)
                ->exists();

            if ($sudahAda) {
                $jumlahDilewati++;
                continue;
            }

            $jabatan        = $pegawai->jabatan;
            $gajiPokokDasar = (float) (optional($jabatan)->gaji_pokok ?? 0);
            $idJabatan      = $pegawai->id_jabatan;

            $daftarKomponen = $idJabatan
                ? KomponenGaji::where('id_jabatan', $idJabatan)->get()
                : collect();

            $totalTunjangan = 0.0;
            $totalPotongan  = 0.0;

            foreach ($daftarKomponen as $komponen) {
                $nominal     = (float) ($komponen->nominal ?? 0);
                $tipeNominal = strtolower(trim($komponen->tipe_nominal ?? 'fixed'));

                $jenis = strtolower(trim($komponen->jenis ?? ''));

                $nominalHasil = $tipeNominal === 'percent'
                    ? ($nominal / 100) * $gajiPokokDasar
                    : $nominal;

                if (in_array($jenis, ['penghasilan', 'tunjangan', 'income', 'allowance'])) {
                    $totalTunjangan += $nominalHasil;
                } elseif (in_array($jenis, ['potongan', 'deduction', 'deduksi', 'potong'])) {
                    $totalPotongan += $nominalHasil;
                } else {
                    Log::warning("GajiController: Komponen '{$komponen->nama_komponen}' " .
                        "memiliki jenis tidak dikenal: '{$komponen->jenis}'. Diabaikan.");
                }
            }

            try {
                Gaji::create([
                    'id_pegawai'   => $pegawai->id,
                    'bulan'        => (int) $request->bulan,
                    'tahun'        => (int) $request->tahun,
                    'gaji_pokok'   => (int) round($gajiPokokDasar),
                    'tunjangan'    => (int) round($totalTunjangan),
                    'potongan'     => (int) round($totalPotongan),
                    'status_bayar' => 'Belum Dibayar',
                ]);

                $jumlahDigenerate++;

                Log::info("Gaji generated — {$pegawai->nama_lengkap} | " .
                    "Pokok: " . (int)round($gajiPokokDasar) .
                    " | Tunjangan: " . (int)round($totalTunjangan) .
                    " | Potongan: " . (int)round($totalPotongan));

            } catch (\Exception $e) {
                $jumlahError++;
                Log::error("GajiController: Gagal simpan gaji pegawai ID {$pegawai->id} " .
                    "({$pegawai->nama_lengkap}). Error: " . $e->getMessage());
            }
        }

        $pesan = "Berhasil generate gaji untuk {$jumlahDigenerate} pegawai.";
        if ($jumlahDilewati > 0) $pesan .= " {$jumlahDilewati} sudah ada, dilewati.";
        if ($jumlahError > 0)    $pesan .= " {$jumlahError} gagal (cek log).";

        return back()->with('success', $pesan);
    }

    /** Perbarui status pembayaran gaji */
    public function update(Request $request, Gaji $gaji)
    {
        $request->validate([
            'status_bayar' => 'required|in:Belum Dibayar,Sudah Dibayar',
        ]);

        $dataUpdate = ['status_bayar' => $request->status_bayar];

        if ($request->status_bayar === 'Sudah Dibayar') {
            $dataUpdate['tanggal_bayar'] = now()->toDateString();
        }

        $gaji->update($dataUpdate);

        return back()->with('success', 'Status gaji berhasil diperbarui.');
    }

    /** Hapus data gaji */
    public function destroy(Gaji $gaji)
    {
        $gaji->delete();
        return back()->with('success', 'Data gaji berhasil dihapus.');
    }
}