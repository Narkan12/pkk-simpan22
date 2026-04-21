<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Employees; 
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalPegawai  = Employees::count();
        $pegawaiAktif  = Employees::where('status', 'aktif')->count();
        $nonAktifCuti  = Employees::whereIn('status', ['nonaktif', 'cuti'])->count();
        $totalJabatan  = Employees::distinct('jabatan')->count('jabatan');
        $cutiPending   = Cuti::where('status', 'pending')->count();
        
        $absensiTerbaru = Absensi::with('employees')
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->take(3)
            ->get()
            ->map(fn($a) => [
                'nama'    => $a->employees->nama ?? 'Unknown',
                'desc'    => 'Absensi ' . ucfirst($a->status) . ' — ' . Carbon::parse($a->tanggal)->isoFormat('D MMM'),
                'waktu'   => $a->created_at->diffForHumans(),
                'inisial' => strtoupper(substr($a->employees->nama ?? 'U', 0, 1)),
            ]);

        $cutiTerbaru = Cuti::with('employees')
            ->orderByDesc('created_at')
            ->take(2)
            ->get()
            ->map(fn($c) => [
                'nama'    => $c->employees->nama ?? 'Unknown',
                'desc'    => 'Pengajuan ' . $c->jenis_cuti . ' — ' . ucfirst($c->status),
                'waktu'   => $c->created_at->diffForHumans(),
                'inisial' => strtoupper(substr($c->employees->nama ?? 'U', 0, 1)),
            ]);

        $aktivitas = $absensiTerbaru->merge($cutiTerbaru)->take(5);

        $bulanIni    = Carbon::now()->month;
        $tahunIni    = Carbon::now()->year;
        $pegawaiBaru = Employees::whereMonth('created_at', $bulanIni)->whereYear('created_at', $tahunIni)->count();

        return view('dashboard', compact(
            'totalPegawai', 'pegawaiAktif', 'nonAktifCuti',
            'totalJabatan', 'cutiPending', 'aktivitas', 'pegawaiBaru'
        ));
    }


    public function employee()
    {
        $user    = Auth::user();
        $pegawai = Employees::where('id_user', $user->id)->first();

        if (!$pegawai) {
            return view('dashboard-pegawai', [
                'pegawai'        => null,
                'hariKerja'      => 0,
                'totalHariKerja' => 0,
                'absensiTerbaru' => collect([]),
                'riwayatCuti'    => collect([]),
            ]);
        }

        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $hariKerja = Absensi::where('id_pegawai', $pegawai->id)
            ->whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->whereIn('status', ['hadir', 'terlambat'])
            ->count();

        $totalHariKerja = (int) round(Carbon::now()->daysInMonth - (Carbon::now()->daysInMonth / 7 * 2));

        $absensiTerbaru = Absensi::where('id_pegawai', $pegawai->id)
            ->orderByDesc('tanggal')
            ->take(5)
            ->get();

        $riwayatCuti = Cuti::where('id_pegawai', $pegawai->id)
            ->orderByDesc('updated_at')
            ->take(1)
            ->get();

        return view('dashboard-pegawai', compact(
            'pegawai', 'hariKerja', 'totalHariKerja', 'absensiTerbaru', 'riwayatCuti'
        ));
    }

    // Absensi Kehadiran
    public function simpanAbsensi(Request $request)
    {
        $request->validate([
            'jenis'      => 'required|in:masuk,keluar',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $pegawai = Employees::where('id_user', Auth::id())->firstOrFail();
        $today   = Carbon::today();
        $jamSekarang = Carbon::now()->format('H:i:s');

        $absensi = Absensi::firstOrNew([
            'id_pegawai' => $pegawai->id, 
            'tanggal'    => $today
        ]);

        if ($request->jenis === 'masuk') {
            if ($absensi->jam_masuk) {
                return back()->with('error', 'Anda sudah melakukan absen masuk hari ini.');
            }
            
            $absensi->jam_masuk   = $jamSekarang;
            $absensi->keterangan  = $request->keterangan;
            $absensi->status = Carbon::now()->gt(Carbon::today()->setTime(8, 0)) ? 'terlambat' : 'hadir';
        } else {
            if (!$absensi->jam_masuk) {
                return back()->with('error', 'Anda harus absen masuk terlebih dahulu.');
            }
            $absensi->jam_keluar = $jamSekarang;
        }

        $absensi->save();

        return back()->with('success', 'Absensi ' . $request->jenis . ' berhasil dicatat.');
    }

    // Pengajuan Cuti
    public function ajukanCuti(Request $request)
    {
        $request->validate([
            'jenis_cuti'      => 'required|string',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan'          => 'nullable|string|max:500',
        ]);

        $pegawai = Employees::where('id_user', Auth::id())->firstOrFail();

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