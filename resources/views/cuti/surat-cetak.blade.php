<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Bukti Cuti — {{ $cuti->nomor_surat }}</title>
    <style>
        /* ── Reset dasar ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Times New Roman', Times, Georgia, serif;
            font-size: 11pt;
            color: #111;
            background: #f0f0f0;
        }

        .halaman {
            width: 210mm;
            height: 297mm;
            margin: 20px auto;
            padding: 1.8cm 2.2cm;
            background: #fff;
            box-shadow: 0 2px 12px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .kop {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 6px;
        }
        .kop-logo {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            border: 3px solid #1a5c2e;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: #e8f5e9;
        }
        .kop-logo span {
            font-size: 18px;
            font-weight: 900;
            color: #1a5c2e;
            letter-spacing: -1px;
        }
        .kop-teks { flex: 1; }
        .kop-instansi {
            font-size: 8pt;
            font-weight: 600;
            color: #555;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .kop-nama {
            font-size: 15pt;
            font-weight: 900;
            color: #1a5c2e;
            line-height: 1.1;
            letter-spacing: 1px;
        }
        .kop-alamat {
            font-size: 8pt;
            color: #777;
            margin-top: 2px;
        }
        .kop-divider {
            border: none;
            border-top: 3px solid #1a5c2e;
            margin: 6px 0 3px;
        }
        .kop-divider-tipis {
            border: none;
            border-top: 1px solid #1a5c2e;
            margin: 0 0 14px;
        }

        .judul-surat {
            text-align: center;
            margin-bottom: 14px;
        }
        .judul-surat h2 {
            font-size: 12pt;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-decoration: underline;
            color: #111;
        }
        .judul-surat .nomor {
            font-size: 9.5pt;
            color: #444;
            margin-top: 3px;
        }

        .badge-status {
            text-align: center;
            margin: 14px 0;
        }
        .badge-status .badge-inner {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 28px;
            border-radius: 6px;
            font-size: 15pt;
            font-weight: 900;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        .badge-disetujui .badge-inner {
            background: #e8f5e9;
            border: 3px solid #1a5c2e;
            color: #1a5c2e;
        }
        .badge-ditolak .badge-inner {
            background: #fdecea;
            border: 3px solid #c62828;
            color: #c62828;
        }
        .badge-status .badge-icon { font-size: 18pt; }

        .pembuka {
            font-size: 10.5pt;
            line-height: 1.7;
            margin-bottom: 12px;
            text-align: justify;
        }

        .tabel-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            font-size: 10.5pt;
        }
        .tabel-data td {
            padding: 3px 6px;
            vertical-align: top;
        }
        .tabel-data td:first-child {
            width: 38%;
            color: #444;
            font-weight: 600;
        }
        .tabel-data td:nth-child(2) {
            width: 4%;
            text-align: center;
            color: #444;
        }
        .tabel-data td:last-child {
            color: #111;
            font-weight: 700;
        }

        .penutup {
            font-size: 10.5pt;
            line-height: 1.7;
            margin-top: 12px;
            margin-bottom: 14px;
            text-align: justify;
        }

        .tanggal-cetak {
            font-size: 9.5pt;
            color: #555;
            margin-bottom: 16px;
            text-align: right;
        }

        .ttd-wrapper {
            display: flex;
            justify-content: flex-end;
        }
        .ttd-blok {
            text-align: center;
            width: 200px;
        }
        .ttd-blok .ttd-kota-tgl {
            font-size: 10pt;
            margin-bottom: 3px;
        }
        .ttd-blok .ttd-jabatan {
            font-size: 10pt;
            font-weight: 700;
            margin-bottom: 48px;
        }
        .ttd-blok .ttd-nama {
            font-size: 10.5pt;
            font-weight: 900;
            border-top: 1px solid #111;
            padding-top: 4px;
        }
        .ttd-blok .ttd-nip {
            font-size: 9pt;
            color: #555;
        }

        .bar-aksi {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: #1e293b;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Segoe UI', sans-serif;
            font-size: 13px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        .bar-aksi .bar-hint {
            flex: 1;
            font-size: 11px;
            color: #94a3b8;
        }
        .btn-cetak {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-cetak:hover { background: #1d4ed8; }
        .btn-tutup {
            background: #475569;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-tutup:hover { background: #334155; }

        body { padding-top: 52px; }

        @media print {
            @page { size: A4; margin: 1.8cm 2.2cm; }
            body { background: #fff; padding-top: 0; }
            .bar-aksi { display: none !important; }
            .halaman {
                margin: 0;
                padding: 0;
                box-shadow: none;
                width: 100%;
                height: auto;
                overflow: visible;
                page-break-after: avoid;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    {{-- Bar aksi (tidak muncul saat dicetak) --}}
    <div class="bar-aksi no-print">
        <button class="btn-cetak" onclick="window.print()">🖨️ Cetak Sekarang</button>
        <button class="btn-tutup" onclick="window.close()">✕ Tutup Tab</button>
        <span class="bar-hint">Halaman ini akan otomatis membuka dialog cetak. Gunakan tombol di atas jika tidak muncul otomatis.</span>
    </div>

    {{-- Halaman surat A4 --}}
    <div class="halaman">

        {{-- Kop surat --}}
        <div class="kop">
            <div class="kop-logo">
                <span>SP</span>
            </div>
            <div class="kop-teks">
                <div class="kop-instansi">Pemerintah Daerah</div>
                <div class="kop-nama">SIMPAN</div>
                <div class="kop-alamat">Sistem Informasi Manajemen Pegawai &mdash; simpan.go.id</div>
            </div>
        </div>
        <hr class="kop-divider">
        <hr class="kop-divider-tipis">

        {{-- Judul surat --}}
        <div class="judul-surat">
            <h2>Surat Bukti Cuti</h2>
            <div class="nomor">Nomor: {{ $cuti->nomor_surat }}</div>
        </div>

        {{-- Kalimat pembuka --}}
        <p class="pembuka">
            Yang bertanda tangan di bawah ini, Pimpinan SIMPAN &mdash; Sistem Informasi Manajemen Pegawai,
            dengan ini menerangkan bahwa pegawai yang namanya tercantum di bawah ini telah mengajukan
            permohonan cuti dengan rincian sebagai berikut:
        </p>

        {{-- Tabel data cuti --}}
        @php
            $durasi = $cuti->tanggal_mulai->diffInDays($cuti->tanggal_selesai) + 1;
            $bulanId = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
            ];
            // Helper format tanggal ke Bahasa Indonesia
            $formatTgl = fn($tgl) => $tgl->day . ' ' . $bulanId[$tgl->month] . ' ' . $tgl->year;
            $hariIni   = now();
            $tglCetak  = $hariIni->day . ' ' . $bulanId[$hariIni->month] . ' ' . $hariIni->year;

            // Hitung lama cuti dalam hari kalender
            $lamaHari = $durasi;
            // Hitung lama dalam minggu + sisa hari untuk tampilan hierarki
            $minggu   = intdiv($lamaHari, 7);
            $sisaHari = $lamaHari % 7;
            $lamaTeks = $minggu > 0
                ? $minggu . ' minggu' . ($sisaHari > 0 ? ' ' . $sisaHari . ' hari' : '')
                : $lamaHari . ' hari';
        @endphp

        <table class="tabel-data">
            <tr>
                <td>Nama Pegawai</td><td>:</td>
                <td>{{ $cuti->pegawai?->nama_lengkap ?? '-' }}</td>
            </tr>
            <tr>
                <td>NIP / ID Pegawai</td><td>:</td>
                <td>{{ $cuti->pegawai?->NIP ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jabatan</td><td>:</td>
                <td>{{ $cuti->pegawai?->jabatan?->nama_jabatan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Departemen</td><td>:</td>
                <td>{{ $cuti->pegawai?->departemen?->nama_departemen ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jenis Cuti</td><td>:</td>
                <td>{{ $cuti->jenis_cuti }}</td>
            </tr>
            <tr>
                <td>Tanggal Mulai</td><td>:</td>
                <td>{{ $formatTgl($cuti->tanggal_mulai) }}</td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td><td>:</td>
                <td>{{ $formatTgl($cuti->tanggal_selesai) }}</td>
            </tr>
            <tr>
                <td>Lama Cuti</td><td>:</td>
                <td>{{ $lamaTeks }} ({{ $lamaHari }} hari kalender)</td>
            </tr>
            <tr>
                <td>Alasan</td><td>:</td>
                <td>{{ $cuti->alasan ?? '-' }}</td>
            </tr>
        </table>

        {{-- Badge status — paling mencolok agar pegawai langsung paham ── --}}
        <div class="badge-status {{ $cuti->status === 'disetujui' ? 'badge-disetujui' : 'badge-ditolak' }}">
            <div class="badge-inner">
                @if($cuti->status === 'disetujui')
                    <span class="badge-icon">✔</span> DISETUJUI
                @else
                    <span class="badge-icon">✘</span> DITOLAK
                @endif
            </div>
        </div>

        {{-- Kalimat penutup sesuai status --}}
        <p class="penutup">
            @if($cuti->status === 'disetujui')
                Permohonan cuti tersebut di atas telah <strong>disetujui</strong>. Pegawai yang bersangkutan
                diperkenankan untuk melaksanakan cuti sesuai dengan periode yang telah ditetapkan.
                Diharapkan setelah masa cuti berakhir, pegawai dapat kembali melaksanakan tugas dan
                tanggung jawabnya dengan baik.
            @else
                Permohonan cuti tersebut di atas <strong>tidak dapat disetujui</strong> pada saat ini.
                Pegawai yang bersangkutan diharapkan untuk tetap melaksanakan tugas dan tanggung jawabnya
                sebagaimana mestinya. Apabila ada pertanyaan lebih lanjut, silakan menghubungi bagian HRD.
            @endif
        </p>

        {{-- Catatan keputusan dari pimpinan (hierarki) --}}
        @if($cuti->catatan_keputusan || $cuti->diputuskan_oleh)
        <table class="tabel-data" style="margin-top:8px;border-top:1px solid #ddd;padding-top:8px;">
            @if($cuti->diputuskan_oleh)
            <tr>
                <td>Diputuskan oleh</td><td>:</td>
                <td>{{ $cuti->diputuskan_oleh }}</td>
            </tr>
            @endif
            @if($cuti->diputuskan_pada)
            <tr>
                <td>Tanggal Keputusan</td><td>:</td>
                <td>{{ $formatTgl($cuti->diputuskan_pada) }}</td>
            </tr>
            @endif
            @if($cuti->catatan_keputusan)
            <tr>
                <td>Catatan Pimpinan</td><td>:</td>
                <td style="font-style:italic;">{{ $cuti->catatan_keputusan }}</td>
            </tr>
            @endif
        </table>
        @endif

        {{-- Tanggal cetak --}}
        <div class="tanggal-cetak" style="margin-top:20px;">Dicetak pada: {{ $tglCetak }}</div>

        {{-- Blok tanda tangan — nama pimpinan dari data keputusan jika ada --}}
        <div class="ttd-wrapper">
            <div class="ttd-blok">
                <div class="ttd-kota-tgl">Cimahi, {{ $tglCetak }}</div>
                <div class="ttd-jabatan">Mengetahui / Pimpinan</div>
                <div class="ttd-nama">
                    ( {{ $cuti->diputuskan_oleh ?? '________________________' }} )
                </div>
                <div class="ttd-nip">NIP. ____________________</div>
            </div>
        </div>

    </div>{{-- akhir .halaman --}}

    {{-- Buka dialog cetak otomatis saat halaman dimuat --}}
    <script>
        window.addEventListener('load', function () {
            // Tunggu sebentar agar halaman selesai render sebelum dialog cetak muncul
            setTimeout(function () { window.print(); }, 600);
        });
    </script>

</body>
</html>
