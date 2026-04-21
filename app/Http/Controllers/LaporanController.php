<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Gaji;
use App\Models\Jabatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

class LaporanController extends Controller
{
    // =========================================================================
    // HALAMAN LAPORAN
    // =========================================================================

    /** Tampilkan halaman laporan data pegawai */
    public function pegawai()
    {
        $data      = Employees::with(['jabatan', 'departemen', 'status'])->orderBy('nama_lengkap')->get();
        $total     = $data->count();
        $aktif     = $data->filter(fn($p) => strtolower(optional($p->status)->nama_status ?? '') === 'aktif')->count();
        $nonAktif  = $total - $aktif;
        $totalDept = $data->pluck('id_departemen')->unique()->count();

        return view('laporan.laporan-pegawai', compact('data', 'total', 'aktif', 'nonAktif', 'totalDept'));
    }

    /** Tampilkan halaman laporan gaji dengan filter bulan & tahun */
    public function gaji(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $data         = Gaji::with(['pegawai.jabatan'])
            ->where('bulan', $bulan)->where('tahun', $tahun)
            ->get()->sortBy(fn($g) => optional($g->pegawai)->nama_lengkap)->values();

        $totalGaji    = $data->sum('total_gaji');
        $sudahDibayar = $data->where('status_bayar', 'Sudah Dibayar')->count();
        $belumDibayar = $data->where('status_bayar', 'Belum Dibayar')->count();
        $rataRata     = $data->count() ? round($data->avg('total_gaji')) : 0;
        $bulanList    = range(1, 12);
        $tahunList    = range(now()->year - 2, now()->year + 1);

        return view('laporan.laporan-gaji', compact(
            'data', 'bulan', 'tahun', 'bulanList', 'tahunList',
            'totalGaji', 'sudahDibayar', 'belumDibayar', 'rataRata'
        ));
    }

    /** Tampilkan halaman laporan cuti dengan filter tahun */
    public function cuti(Request $request)
    {
        $tahun     = $request->tahun ?? now()->year;
        $data      = Cuti::with('pegawai')->whereYear('tanggal_mulai', $tahun)->orderByDesc('tanggal_mulai')->get();
        $total     = $data->count();
        $disetujui = $data->where('status', 'disetujui')->count();
        $pending   = $data->where('status', 'pending')->count();
        $ditolak   = $data->where('status', 'ditolak')->count();
        $tahunList = range(now()->year - 2, now()->year + 1);

        return view('laporan.laporan-cuti', compact(
            'data', 'tahun', 'tahunList', 'total', 'disetujui', 'pending', 'ditolak'
        ));
    }

    /** Tampilkan halaman laporan jabatan */
    public function jabatan()
    {
        $data         = Jabatan::withCount('employees')->orderBy('level')->get();
        $totalJabatan = $data->count();
        $totalPegawai = $data->sum('employees_count');
        $maxLevel     = $data->max('level') ?? 0;
        $rataRata     = $totalJabatan ? round($totalPegawai / $totalJabatan) : 0;

        return view('laporan.laporan-jabatan', compact(
            'data', 'totalJabatan', 'totalPegawai', 'maxLevel', 'rataRata'
        ));
    }

    // =========================================================================
    // EKSPOR EXCEL (.xlsx)
    // =========================================================================

    /** Ekspor seluruh data pegawai ke Excel */
    public function exportPegawai()
    {
        $data = Employees::with(['jabatan', 'departemen', 'golongan', 'status', 'pendidikan'])
            ->orderBy('nama_lengkap')->get();

        $headers = ['No', 'NIP', 'NIK', 'Nama Lengkap', 'Jenis Kelamin', 'Jabatan',
                    'Departemen', 'Golongan', 'Pendidikan', 'Status', 'Jenis Pegawai', 'Tanggal Masuk'];

        $baris = $data->values()->map(fn($p, $i) => [
            $i + 1,
            $p->NIP,
            $p->NIK,
            $p->nama_lengkap,
            $p->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
            optional($p->jabatan)->nama_jabatan    ?? '-',
            optional($p->departemen)->nama_departemen ?? '-',
            optional($p->golongan)->nama_golongan  ?? '-',
            optional($p->pendidikan)->jenjang      ?? '-',
            optional($p->status)->nama_status      ?? '-',
            $p->jenis_pegawai ?? '-',
            $p->tanggal_masuk ? Carbon::parse($p->tanggal_masuk)->format('d/m/Y') : '-',
        ])->toArray();

        return $this->eksporExcel(
            'Laporan Data Pegawai',
            'SIMPAN — Laporan Data Pegawai',
            'laporan_pegawai_' . now()->format('Ymd'),
            $headers,
            $baris,
            '1B5E20' // hijau tua
        );
    }

    /** Ekspor data absensi berdasarkan bulan & tahun ke Excel */
    public function exportAbsensi(Request $request)
    {
        $bulan = (int) ($request->bulan ?? now()->month);
        $tahun = (int) ($request->tahun ?? now()->year);

        // FIX: Carbon::createFromDate agar kompatibel dengan Carbon 3.x / PHP 8.5
        $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F');

        $data = Absensi::with('pegawai')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal')->get();

        $headers = ['No', 'NIP', 'Nama Pegawai', 'Tanggal', 'Hari', 'Status', 'Jam Masuk', 'Jam Keluar', 'Keterangan'];

        $baris = $data->values()->map(fn($a, $i) => [
            $i + 1,
            optional($a->pegawai)->NIP          ?? '-',
            optional($a->pegawai)->nama_lengkap ?? '-',
            Carbon::parse($a->tanggal)->format('d/m/Y'),
            Carbon::parse($a->tanggal)->translatedFormat('l'),
            ucfirst($a->status),
            $a->jam_masuk  ?? '-',
            $a->jam_keluar ?? '-',
            $a->keterangan ?? '-',
        ])->toArray();

        return $this->eksporExcel(
            "Laporan Absensi — {$namaBulan} {$tahun}",
            "SIMPAN — Laporan Absensi {$namaBulan} {$tahun}",
            "laporan_absensi_{$namaBulan}_{$tahun}",
            $headers,
            $baris,
            '1565C0' // biru
        );
    }

    /** Ekspor data cuti berdasarkan tahun ke Excel */
    public function exportCuti(Request $request)
    {
        $tahun = (int) ($request->tahun ?? now()->year);

        $data = Cuti::with('pegawai')
            ->whereYear('tanggal_mulai', $tahun)
            ->orderBy('tanggal_mulai')->get();

        $headers = ['No', 'NIP', 'Nama Pegawai', 'Jenis Cuti', 'Tanggal Mulai',
                    'Tanggal Selesai', 'Durasi (Hari)', 'Alasan', 'Status'];

        $baris = $data->values()->map(fn($c, $i) => [
            $i + 1,
            optional($c->pegawai)->NIP          ?? '-',
            optional($c->pegawai)->nama_lengkap ?? '-',
            $c->jenis_cuti,
            Carbon::parse($c->tanggal_mulai)->format('d/m/Y'),
            Carbon::parse($c->tanggal_selesai)->format('d/m/Y'),
            Carbon::parse($c->tanggal_mulai)->diffInDays(Carbon::parse($c->tanggal_selesai)) + 1,
            $c->alasan ?? '-',
            ucfirst($c->status),
        ])->toArray();

        return $this->eksporExcel(
            "Laporan Cuti Tahun {$tahun}",
            "SIMPAN — Laporan Cuti {$tahun}",
            "laporan_cuti_{$tahun}",
            $headers,
            $baris,
            'B45309' // oranye
        );
    }

    /** Ekspor data jabatan beserta jumlah pegawai ke Excel */
    public function exportJabatan()
    {
        $data = Jabatan::withCount('employees')->orderBy('level')->get();

        $headers = ['No', 'Kode Jabatan', 'Nama Jabatan', 'Level', 'Jumlah Pegawai',
                    'Gaji Pokok (Rp)', 'Tunjangan (Rp)', 'Total Beban Gaji (Rp)'];

        $baris = $data->values()->map(fn($j, $i) => [
            $i + 1,
            $j->kode_jabatan,
            $j->nama_jabatan,
            $j->level,
            $j->employees_count,
            (float) $j->gaji_pokok,
            (float) $j->tunjangan,
            (float) (($j->gaji_pokok + $j->tunjangan) * $j->employees_count),
        ])->toArray();

        return $this->eksporExcel(
            'Laporan Data Jabatan',
            'SIMPAN — Laporan Data Jabatan',
            'laporan_jabatan_' . now()->format('Ymd'),
            $headers,
            $baris,
            '6B21A8' // ungu
        );
    }

    /** Ekspor data gaji berdasarkan bulan & tahun ke Excel */
    public function exportGaji(Request $request)
    {
        $bulan = (int) ($request->bulan ?? now()->month);
        $tahun = (int) ($request->tahun ?? now()->year);

        // FIX: Carbon::createFromDate agar kompatibel dengan Carbon 3.x / PHP 8.5
        $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F');

        $data = Gaji::with(['pegawai.jabatan', 'pegawai.departemen'])
            ->where('bulan', $bulan)->where('tahun', $tahun)
            ->get()->sortBy(fn($g) => optional($g->pegawai)->nama_lengkap)->values();

        $headers = ['No', 'NIP', 'Nama Pegawai', 'Jabatan', 'Departemen', 'Bulan', 'Tahun',
                    'Gaji Pokok (Rp)', 'Tunjangan (Rp)', 'Potongan (Rp)', 'Total Gaji (Rp)', 'Status', 'Tanggal Bayar'];

        $baris = $data->map(fn($g, $i) => [
            $i + 1,
            optional($g->pegawai)->NIP                       ?? '-',
            optional($g->pegawai)->nama_lengkap              ?? '-',
            optional($g->pegawai->jabatan)->nama_jabatan     ?? '-',
            optional($g->pegawai->departemen)->nama_departemen ?? '-',
            $namaBulan,
            $tahun,
            (float) $g->gaji_pokok,
            (float) $g->tunjangan,
            (float) $g->potongan,
            (float) $g->total_gaji,
            $g->status_bayar,
            $g->tanggal_bayar ? Carbon::parse($g->tanggal_bayar)->format('d/m/Y') : '-',
        ])->toArray();

        return $this->eksporExcel(
            "Laporan Gaji — {$namaBulan} {$tahun}",
            "SIMPAN — Laporan Gaji {$namaBulan} {$tahun}",
            "laporan_gaji_{$namaBulan}_{$tahun}",
            $headers,
            $baris,
            '065F46' // hijau gelap
        );
    }

    // =========================================================================
    // HELPER — BUAT FILE EXCEL DENGAN FORMAT RAPI
    // =========================================================================

    /**
     * Buat dan kirim file .xlsx dengan judul, header berwarna, dan data terformat.
     *
     * @param string $judulSheet  Judul di baris pertama (merge cell)
     * @param string $judulFile   Teks di properti dokumen
     * @param string $namaFile    Nama file tanpa ekstensi
     * @param array  $headers     Array nama kolom
     * @param array  $baris       Array of array data
     * @param string $warnaHeader Hex warna background header (tanpa #)
     */
    private function eksporExcel(
        string $judulSheet,
        string $judulFile,
        string $namaFile,
        array  $headers,
        array  $baris,
        string $warnaHeader = '1B5E20'
    ) {
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan');

        // Properti dokumen
        $spreadsheet->getProperties()
            ->setTitle($judulFile)
            ->setCreator('SIMPAN')
            ->setCompany('SIMPAN — Sistem Informasi Kepegawaian');

        $jumlahKolom = count($headers);
        $kolomAkhir  = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($jumlahKolom);

        // ── Baris 1: Judul ──────────────────────────────────────────────────
        $sheet->mergeCells("A1:{$kolomAkhir}1");
        $sheet->setCellValue('A1', $judulSheet);
        $sheet->getStyle('A1')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $warnaHeader]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // ── Baris 2: Tanggal cetak ──────────────────────────────────────────
        $sheet->mergeCells("A2:{$kolomAkhir}2");
        $sheet->setCellValue('A2', 'Dicetak: ' . now()->format('d/m/Y H:i'));
        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['italic' => true, 'size' => 10, 'color' => ['rgb' => '555555']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F3F4F6']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getRowDimension(2)->setRowHeight(18);

        // ── Baris 3: Kosong sebagai pemisah ────────────────────────────────
        $sheet->getRowDimension(3)->setRowHeight(6);

        // ── Baris 4: Header kolom ───────────────────────────────────────────
        foreach ($headers as $idx => $namaKolom) {
            $kolom = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($idx + 1);
            $sheet->setCellValue("{$kolom}4", $namaKolom);
        }
        $sheet->getStyle("A4:{$kolomAkhir}4")->applyFromArray([
            'font'      => ['bold' => true, 'size' => 10, 'color' => ['rgb' => 'FFFFFF']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $warnaHeader]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);
        $sheet->getRowDimension(4)->setRowHeight(22);

        // ── Baris 5+: Data ──────────────────────────────────────────────────
        foreach ($baris as $noUrut => $barisDatum) {
            $noBaris = $noUrut + 5; // mulai dari baris ke-5
            $warnaZebra = ($noUrut % 2 === 0) ? 'FFFFFF' : 'F0FDF4';

            foreach ($barisDatum as $idx => $nilai) {
                $kolom = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($idx + 1);
                $sheet->setCellValue("{$kolom}{$noBaris}", $nilai);
            }

            // Warna zebra & border tipis
            $sheet->getStyle("A{$noBaris}:{$kolomAkhir}{$noBaris}")->applyFromArray([
                'fill'    => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $warnaZebra]],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D1D5DB']]],
                'font'    => ['size' => 10],
            ]);

            // Kolom pertama (No) rata tengah
            $sheet->getStyle("A{$noBaris}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // ── Baris total (jika ada data) ─────────────────────────────────────
        if (!empty($baris)) {
            $noBarisTerakhir = count($baris) + 5;
            $sheet->mergeCells("A{$noBarisTerakhir}:{$kolomAkhir}{$noBarisTerakhir}");
            $sheet->setCellValue("A{$noBarisTerakhir}", 'Total: ' . count($baris) . ' data');
            $sheet->getStyle("A{$noBarisTerakhir}")->applyFromArray([
                'font'      => ['bold' => true, 'size' => 10, 'color' => ['rgb' => 'FFFFFF']],
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $warnaHeader]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT],
            ]);
            $sheet->getRowDimension($noBarisTerakhir)->setRowHeight(20);
        }

        // ── Auto-width kolom ────────────────────────────────────────────────
        foreach (range(1, $jumlahKolom) as $idx) {
            $kolom = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($idx);
            $sheet->getColumnDimension($kolom)->setAutoSize(true);
        }

        // ── Freeze pane di baris data (baris 5) ────────────────────────────
        $sheet->freezePane('A5');

        // ── Kirim sebagai download ──────────────────────────────────────────
        $writer   = new Xlsx($spreadsheet);
        $filename = $namaFile . '.xlsx';

        return response()->stream(
            function () use ($writer) { $writer->save('php://output'); },
            200,
            [
                'Content-Type'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
                'Cache-Control'       => 'no-cache, no-store, must-revalidate',
                'Pragma'              => 'no-cache',
            ]
        );
    }
}
