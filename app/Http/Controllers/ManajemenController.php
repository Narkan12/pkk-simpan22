<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Employees;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajemenController extends Controller
{
    // =========================================================================
    // ABSENSI (Admin)
    // =========================================================================

    /** Tampilkan halaman kelola absensi dengan filter tanggal, status, dan pencarian */
    public function absensi(Request $request)
    {
        $tanggalDipilih = $request->tanggal ?? today()->toDateString();
        $statusDipilih  = $request->status;
        $kataCari       = $request->search;

        $queryAbsensi = Absensi::with(['pegawai.jabatan', 'pegawai.departemen'])
            ->whereDate('tanggal', $tanggalDipilih);

        if ($statusDipilih && $statusDipilih !== 'semua') {
            $queryAbsensi->where('status', $statusDipilih);
        }

        if ($kataCari) {
            $queryAbsensi->whereHas('pegawai', function ($q) use ($kataCari) {
                $q->where('nama_lengkap', 'like', "%{$kataCari}%")
                  ->orWhere('NIP', 'like', "%{$kataCari}%");
            });
        }

        $daftarAbsensi = $queryAbsensi->orderByDesc('created_at')->get();

        // Hitung ringkasan kehadiran hari ini
        $jumlahHadir     = Absensi::whereDate('tanggal', $tanggalDipilih)->where('status', 'hadir')->count();
        $jumlahTerlambat = Absensi::whereDate('tanggal', $tanggalDipilih)->where('status', 'terlambat')->count();
        $jumlahCuti      = Absensi::whereDate('tanggal', $tanggalDipilih)->where('status', 'cuti')->count();
        $jumlahAlpa      = Absensi::whereDate('tanggal', $tanggalDipilih)->where('status', 'tanpa keterangan')->count();

        // Alias agar view tetap kompatibel
        $absensi  = $daftarAbsensi;
        $tanggal  = $tanggalDipilih;
        $status   = $statusDipilih;
        $search   = $kataCari;
        $hadir    = $jumlahHadir;
        $terlambat = $jumlahTerlambat;
        $cuti     = $jumlahCuti;
        $alpa     = $jumlahAlpa;

        return view('manajemen.absensi', compact(
            'absensi', 'tanggal', 'status', 'search',
            'hadir', 'terlambat', 'cuti', 'alpa'
        ));
    }

    // =========================================================================
    // CUTI (Admin)
    // =========================================================================

    /** Tampilkan halaman kelola pengajuan cuti */
    public function cuti(Request $request)
    {
        $statusDipilih = $request->status;
        $kataCari      = $request->search;

        $queryCuti = Cuti::with(['pegawai.jabatan', 'pegawai.departemen']);

        if ($statusDipilih && $statusDipilih !== 'semua') {
            $queryCuti->where('status', $statusDipilih);
        }

        if ($kataCari) {
            $queryCuti->whereHas('pegawai', function ($q) use ($kataCari) {
                $q->where('nama_lengkap', 'like', "%{$kataCari}%")
                  ->orWhere('NIP', 'like', "%{$kataCari}%");
            });
        }

        $cutiList  = $queryCuti->orderByDesc('created_at')->get();
        $pending   = Cuti::where('status', 'pending')->count();
        $disetujui = Cuti::where('status', 'disetujui')->count();
        $ditolak   = Cuti::where('status', 'ditolak')->count();

        $status = $statusDipilih;
        $search = $kataCari;

        return view('manajemen.manajemen-cuti', compact(
            'cutiList', 'status', 'search', 'pending', 'disetujui', 'ditolak'
        ));
    }

    /** Setujui pengajuan cuti */
    public function cutiSetujui(Cuti $cuti)
    {
        $cuti->update(['status' => 'disetujui']);
        return back()->with('success', 'Pengajuan cuti disetujui.');
    }

    /** Tolak pengajuan cuti */
    public function cutiTolak(Cuti $cuti)
    {
        $cuti->update(['status' => 'ditolak']);
        return back()->with('danger', 'Pengajuan cuti ditolak.');
    }

    // =========================================================================
    // ABSENSI PEGAWAI (dari dashboard pegawai)
    // =========================================================================

    /** Catat absensi masuk atau keluar dari dashboard pegawai */
    public function simpanAbsensi(Request $request)
    {
        $request->validate([
            'jenis'      => 'required|in:masuk,keluar',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $idPengguna = Auth::id();
        if (!$idPengguna) {
            return back()->with('error', 'User tidak terotentikasi.');
        }

        $pegawai = Employees::where('id_user', $idPengguna)->first();
        if (!$pegawai) {
            return back()->with('error', 'Data pegawai tidak ditemukan untuk akun ini.');
        }

        $hariIni     = Carbon::today();
        $jamSekarang = Carbon::now()->format('H:i:s');

        $catatanAbsensi = Absensi::firstOrNew([
            'id_pegawai' => $pegawai->id,
            'tanggal'    => $hariIni,
        ]);

        if ($request->jenis === 'masuk') {
            if ($catatanAbsensi->jam_masuk) {
                return back()->with('error', 'Anda sudah melakukan absen masuk hari ini.');
            }
            $catatanAbsensi->jam_masuk  = $jamSekarang;
            $catatanAbsensi->keterangan = $request->keterangan;
            $catatanAbsensi->status     = Carbon::now()->gt(Carbon::today()->setTime(8, 0)) ? 'terlambat' : 'hadir';
        } else {
            if (!$catatanAbsensi->jam_masuk) {
                return back()->with('error', 'Anda harus absen masuk terlebih dahulu.');
            }
            $catatanAbsensi->jam_keluar = $jamSekarang;
        }

        $catatanAbsensi->save();

        return back()->with('success', 'Absensi ' . $request->jenis . ' berhasil dicatat.');
    }

    // =========================================================================
    // CUTI PEGAWAI (dari dashboard pegawai)
    // =========================================================================

    /** Kirim pengajuan cuti dari dashboard pegawai */
    public function ajukanCuti(Request $request)
    {
        $request->validate([
            'jenis_cuti'      => 'required|string',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan'          => 'nullable|string|max:500',
        ]);

        $idPengguna = Auth::id();
        if (!$idPengguna) {
            return back()->with('error', 'User tidak terotentikasi.');
        }

        $pegawai = Employees::where('id_user', $idPengguna)->first();
        if (!$pegawai) {
            return back()->with('error', 'Data pegawai tidak ditemukan untuk akun ini.');
        }

        Cuti::create([
            'id_pegawai'      => $pegawai->id,
            'jenis_cuti'      => $request->jenis_cuti,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan'          => $request->alasan,
            'status'          => 'pending',
        ]);

        return back()->with('warning', 'Pengajuan cuti berhasil dikirim.');
    }
}
