<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Gaji;
use App\Models\KomponenGaji;
use Illuminate\Http\Request;

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

        // Alias agar view tetap kompatibel
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

        // Ambil semua pegawai aktif beserta jabatannya
        $daftarPegawaiAktif = Employees::with('jabatan')
            ->whereHas('status', fn($q) => $q->where('nama_status', 'Aktif'))
            ->get();

        $jumlahDigenerate = 0;

        foreach ($daftarPegawaiAktif as $pegawai) {
            // Lewati jika gaji bulan ini sudah ada
            $sudahAda = Gaji::where('id_pegawai', $pegawai->id)
                ->where('bulan', $request->bulan)
                ->where('tahun', $request->tahun)
                ->exists();

            if ($sudahAda) {
                continue;
            }

            // Hitung tunjangan & potongan dari komponen gaji jabatan
            $gajiPokokDasar  = $pegawai->jabatan->gaji_pokok ?? 0;
            $daftarKomponen  = KomponenGaji::where('id_jabatan', $pegawai->id_jabatan)->get();
            $totalTunjangan  = 0;
            $totalPotongan   = 0;

            foreach ($daftarKomponen as $komponen) {
                $nominalHasil = strtolower($komponen->tipe_nominal) === 'percent'
                    ? ($komponen->nominal / 100) * $gajiPokokDasar
                    : $komponen->nominal;

                if (strtolower($komponen->jenis) === 'penghasilan') {
                    $totalTunjangan += $nominalHasil;
                } else {
                    $totalPotongan += $nominalHasil;
                }
            }

            Gaji::create([
                'id_pegawai'   => $pegawai->id,
                'bulan'        => $request->bulan,
                'tahun'        => $request->tahun,
                'gaji_pokok'   => $gajiPokokDasar,
                'tunjangan'    => $totalTunjangan,
                'potongan'     => $totalPotongan,
                'status_bayar' => 'Belum Dibayar',
            ]);

            $jumlahDigenerate++;
        }

        return back()->with('success', "Berhasil generate gaji untuk {$jumlahDigenerate} pegawai.");
    }

    /** Perbarui status pembayaran gaji */
    public function update(Request $request, Gaji $gaji)
    {
        $request->validate([
            'status_bayar' => 'required|in:Belum Dibayar,Sudah Dibayar',
        ]);

        $dataUpdate = ['status_bayar' => $request->status_bayar];

        // Catat tanggal bayar jika status diubah menjadi sudah dibayar
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
