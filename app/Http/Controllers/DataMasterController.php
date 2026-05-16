<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Employees;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\KomponenGaji;
use App\Models\LogActivities;
use App\Models\Pendidikan;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class DataMasterController extends Controller
{
    
    // helper biar gak nulis back()->with() terus
    private function respondSuccess(string $pesan)
    {
        return back()->with('success', $pesan);
    }

    // catat siapa yang ngapain ke log
    private function catatLog(string $deskripsi): void
    {
        $penggunaAktif = Auth::user();
        LogActivities::create([
            'nama_lengkap' => $penggunaAktif->nama_lengkap ?? $penggunaAktif->username ?? 'System',
            'role'         => $penggunaAktif->role ?? '-',
            'deskripsi'    => $deskripsi,
        ]);
    }

    // --- DASHBOARD ---

    public function dashboard()
    {
        Cache::flush();

        $statistikDepartemen = Departemen::withCount('employees')->get();

        $totalPegawai    = Employees::count();
        $jumlahAktif     = Employees::whereHas('status', fn($q) => $q->where('nama_status', 'Aktif'))->count();
        $jumlahNonAktif  = Employees::whereHas('status', fn($q) => $q->whereIn('nama_status', ['Cuti', 'Nonaktif', 'Pensiun']))->count();
        $statusLainnya   = $totalPegawai - ($jumlahAktif + $jumlahNonAktif);

        $totalJabatan    = Jabatan::count();
        $totalDepartemen = Departemen::count();
        $totalStatus     = Status::count();
        $totalGolongan   = Golongan::count();

        $aktivitasTerbaru = LogActivities::with('user')->latest()->take(5)->get();
        $pegawaiAktif    = $jumlahAktif;
        $pegawaiNonAktif = $jumlahNonAktif;
        $departemenStats = $statistikDepartemen;

        return response()
            ->view('dashboard', compact(
                'totalPegawai',
                'pegawaiAktif',
                'pegawaiNonAktif',
                'statusLainnya',
                'totalJabatan',
                'totalDepartemen',
                'totalStatus',
                'totalGolongan',
                'departemenStats',
                'aktivitasTerbaru'
            ))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    // --- DATA PEGAWAI ---

    public function indexPegawai()
    {
        $daftarPegawai = Employees::with(['jabatan', 'departemen', 'status', 'golongan', 'pendidikan'])
            ->orderBy('nama_lengkap')
            ->get();

        $totalPegawai    = $daftarPegawai->count();
        $pegawaiAktif    = $daftarPegawai->filter(fn($p) => strtolower($p->status->nama_status ?? '') === 'aktif')->count();
        $pegawaiNonAktif = $daftarPegawai->filter(fn($p) => in_array(strtolower($p->status->nama_status ?? ''), ['nonaktif', 'cuti', 'pensiun']))->count();
        $pegawaiLainnya  = $totalPegawai - ($pegawaiAktif + $pegawaiNonAktif);

        $jabatanList    = Jabatan::orderBy('nama_jabatan')->get();
        $departemenList = Departemen::orderBy('nama_departemen')->get();
        $statusList     = Status::orderBy('nama_status')->get();
        $golonganList   = Golongan::orderBy('pangkat')->get();
        $pendidikanList = Pendidikan::orderBy('jenjang')->get();

        // $data dipakai di view, jangan dihapus
        $data = $daftarPegawai;

        return view('data-pegawai', compact(
            'data',
            'totalPegawai',
            'pegawaiAktif',
            'pegawaiNonAktif',
            'pegawaiLainnya',
            'jabatanList',
            'departemenList',
            'statusList',
            'golonganList',
            'pendidikanList'
        ));
    }

    public function storePegawai(Request $request)
    {
        // validasi form pegawai + akun login
        $request->validate([
            'NIK'           => 'required|unique:employees,NIK',
            'NIP'           => 'required|unique:employees,NIP',
            'nama_lengkap'  => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_masuk' => 'required|date',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6',
            'id_jabatan'    => 'nullable|exists:jabatan,id',
            'id_departemen' => 'nullable|exists:departemen,id',
            'id_status'     => 'nullable|exists:status_pegawai,id',
            'id_golongan'   => 'nullable|exists:golongan,id',
            'id_pendidikan' => 'nullable|exists:pendidikan,id',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'nama_lengkap.max'      => 'Nama lengkap maksimal 100 karakter.',
            'email.required'        => 'Email harus diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email sudah digunakan oleh akun lain.',
            'password.required'     => 'Password harus diisi.',
            'password.min'          => 'Password minimal :min karakter.',
            'NIK.required'          => 'NIK harus diisi.',
            'NIK.unique'            => 'NIK sudah terdaftar.',
            'NIP.required'          => 'NIP harus diisi.',
            'NIP.unique'            => 'NIP sudah terdaftar.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'tanggal_masuk.required' => 'Tanggal masuk harus diisi.',
        ]);

        // buat akun login dulu, baru data pegawainya
        $akunBaru = User::create([
            'name'     => $request->nama_lengkap,
            'username' => $request->nama_lengkap,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'pegawai',
            'foto'     => null,
        ]);

        // ambil field pegawai dari form
        $dataPegawai = $request->only([
            'NIK',
            'NIP',
            'nama_lengkap',
            'jenis_kelamin',
            'tanggal_lahir',
            'tempat_lahir',
            'agama',
            'alamat',
            'no_telp',
            'status_pernikahan',
            'jenis_pegawai',
            'id_jabatan',
            'id_departemen',
            'id_golongan',
            'id_status',
            'id_pendidikan',
            'tanggal_masuk',
        ]);
        $dataPegawai['id_user'] = $akunBaru->id;

        // upload foto kalau ada
        if ($request->hasFile('foto')) {
            $fileFoto = $request->file('foto');
            $namaFile = time() . '_' . uniqid() . '.' . $fileFoto->getClientOriginalExtension();
            $dataPegawai['foto'] = $fileFoto->storeAs('foto_pegawai', $namaFile, 'public');
        }

        $pegawaiBaru = Employees::create($dataPegawai);
        $this->catatLog("Menambahkan pegawai baru & akun login: {$pegawaiBaru->nama_lengkap}");

        return $this->respondSuccess("Pegawai {$pegawaiBaru->nama_lengkap} berhasil ditambahkan.");
    }

    public function updatePegawai(Request $request, Employees $pegawai)
    {
        $request->validate([
            'NIK'           => 'required|unique:employees,NIK,' . $pegawai->id,
            'NIP'           => 'required|unique:employees,NIP,' . $pegawai->id,
            'nama_lengkap'  => 'required|string|max:150',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_masuk' => 'required|date',
            'id_jabatan'    => 'nullable|exists:jabatan,id',
            'id_departemen' => 'nullable|exists:departemen,id',
            'id_status'     => 'nullable|exists:status_pegawai,id',
            'id_golongan'   => 'nullable|exists:golongan,id',
            'id_pendidikan' => 'nullable|exists:pendidikan,id',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email'         => 'nullable|email|unique:users,email,' . ($pegawai->id_user ?? 'NULL'),
            'password'      => 'nullable|min:6',
        ]);

        $dataBaru = $request->only([
            'NIK',
            'NIP',
            'nama_lengkap',
            'jenis_kelamin',
            'tanggal_lahir',
            'tempat_lahir',
            'agama',
            'alamat',
            'no_telp',
            'status_pernikahan',
            'jenis_pegawai',
            'id_jabatan',
            'id_departemen',
            'id_golongan',
            'id_status',
            'id_pendidikan',
            'tanggal_masuk',
        ]);

        // ganti foto lama kalau ada yang baru
        if ($request->hasFile('foto')) {
            if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            $fileFoto = $request->file('foto');
            $namaFile = time() . '_' . uniqid() . '.' . $fileFoto->getClientOriginalExtension();
            $dataBaru['foto'] = $fileFoto->storeAs('foto_pegawai', $namaFile, 'public');
        }

        $pegawai->update($dataBaru);

        // update email/password akun kalau diisi
        if ($pegawai->id_user) {
            $updateAkun = [];
            if ($request->filled('email')) {
                $updateAkun['email'] = $request->email;
            }
            if ($request->filled('password')) {
                $updateAkun['password'] = Hash::make($request->password);
            }
            if (!empty($updateAkun)) {
                User::where('id', $pegawai->id_user)->update($updateAkun);
            }
        }

        // cek kolom mana yang berubah buat isi log
        $kolomDipantau = [
            'nama_lengkap' => 'Nama',
            'NIK' => 'NIK',
            'NIP' => 'NIP',
            'agama' => 'Agama',
            'alamat' => 'Alamat',
            'id_jabatan' => 'Jabatan',
            'id_departemen' => 'Departemen',
            'id_status' => 'Status Pegawai',
            'foto' => 'Foto',
        ];
        $kolomBerubah = array_values(array_filter(
            array_map(fn($kolom, $label) => $pegawai->wasChanged($kolom) ? $label : null, array_keys($kolomDipantau), $kolomDipantau)
        ));

        if (!empty($kolomBerubah)) {
            $this->catatLog("Memperbarui data {$pegawai->nama_lengkap} (" . implode(', ', $kolomBerubah) . ')');
        }

        return $this->respondSuccess('Data pegawai berhasil diperbarui.');
    }

    public function destroyPegawai(Employees $pegawai)
    {
        $namaPegawai = $pegawai->nama_lengkap;

        if ($pegawai->id_user) {
            \App\Models\User::where('id', $pegawai->id_user)->delete();
        }

        $pegawai->delete();
        $this->catatLog("Menghapus data pegawai dan akun: {$namaPegawai}");

        return $this->respondSuccess('Pegawai dan akun login berhasil dihapus.');
    }

    // --- JABATAN ---

    public function indexJabatan()
    {
        $daftarJabatan = Jabatan::orderBy('level')->get();
        return view('data-master.jabatan', ['data' => $daftarJabatan]);
    }

    public function storeJabatan(Request $request)
    {
        $request->validate([
            'kode_jabatan' => 'required|unique:jabatan',
            'nama_jabatan' => 'required',
            'level'        => 'required|integer',
        ]);

        $jabatanBaru = Jabatan::create($request->all());
        $this->catatLog("Menambahkan jabatan baru: {$jabatanBaru->nama_jabatan}");

        return $this->respondSuccess('Jabatan berhasil ditambahkan.');
    }

    public function updateJabatan(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'kode_jabatan' => "required|unique:jabatan,kode_jabatan,{$jabatan->id}",
            'nama_jabatan' => 'required',
            'level'        => 'required|integer',
            'gaji_pokok'   => 'required',
            'tunjangan'    => 'required',
        ]);

        $jabatan->update($request->all());

        $kolomDipantau = [
            'kode_jabatan' => 'Kode Jabatan',
            'nama_jabatan' => 'Nama Jabatan',
            'level' => 'Level',
            'gaji_pokok' => 'Gaji Pokok',
            'tunjangan' => 'Tunjangan',
        ];
        $kolomBerubah = array_values(array_filter(
            array_map(fn($k, $l) => $jabatan->wasChanged($k) ? $l : null, array_keys($kolomDipantau), $kolomDipantau)
        ));

        if (!empty($kolomBerubah)) {
            $this->catatLog("Memperbarui jabatan {$jabatan->nama_jabatan} (" . implode(', ', $kolomBerubah) . ')');
        }

        return $this->respondSuccess('Jabatan berhasil diperbarui.');
    }

    public function destroyJabatan(Jabatan $jabatan)
    {
        $namaJabatan = $jabatan->nama_jabatan;
        $jabatan->delete();
        $this->catatLog("Menghapus jabatan: {$namaJabatan}");

        return $this->respondSuccess('Jabatan berhasil dihapus.');
    }

    // --- DEPARTEMEN ---

    public function indexDepartemen()
    {
        $daftarDepartemen = Departemen::orderBy('nama_departemen')->get();
        return view('data-master.departemen', ['data' => $daftarDepartemen]);
    }

    public function storeDepartemen(Request $request)
    {
        $request->validate([
            'kode_departemen'   => 'required|unique:departemen',
            'nama_departemen'   => 'required',
            'kepala_departemen' => 'required',
            'lokasi'            => 'required',
        ]);

        $departemenBaru = Departemen::create($request->all());
        $this->catatLog("Menambahkan departemen baru: {$departemenBaru->nama_departemen}");

        return $this->respondSuccess('Departemen berhasil ditambahkan.');
    }

    public function updateDepartemen(Request $request, Departemen $departemen)
    {
        $request->validate([
            'kode_departemen'   => "required|unique:departemen,kode_departemen,{$departemen->id}",
            'nama_departemen'   => 'required',
            'kepala_departemen' => 'required',
            'lokasi'            => 'required',
        ]);

        $departemen->update($request->all());

        $kolomDipantau = [
            'kode_departemen' => 'Kode',
            'nama_departemen' => 'Nama',
            'kepala_departemen' => 'Kepala',
            'lokasi' => 'Lokasi',
        ];
        $kolomBerubah = array_values(array_filter(
            array_map(fn($k, $l) => $departemen->wasChanged($k) ? $l : null, array_keys($kolomDipantau), $kolomDipantau)
        ));

        if (!empty($kolomBerubah)) {
            $this->catatLog("Memperbarui departemen {$departemen->nama_departemen} (" . implode(', ', $kolomBerubah) . ')');
        }

        return $this->respondSuccess('Departemen berhasil diperbarui.');
    }

    public function destroyDepartemen(Departemen $departemen)
    {
        $namaDepartemen = $departemen->nama_departemen;
        $departemen->delete();
        $this->catatLog("Menghapus departemen: {$namaDepartemen}");

        return $this->respondSuccess('Departemen berhasil dihapus.');
    }

    // --- STATUS PEGAWAI ---

    public function indexStatus()
    {
        $daftarStatus = Status::orderBy('nama_status')->get();
        return view('data-master.status', ['data' => $daftarStatus]);
    }

    public function storeStatus(Request $request)
    {
        $request->validate([
            'kode_status' => 'required|unique:status_pegawai',
            'nama_status' => 'required',
        ]);

        $statusBaru = Status::create($request->all());
        $this->catatLog("Menambahkan status pegawai baru: {$statusBaru->nama_status}");

        return $this->respondSuccess('Status berhasil ditambahkan.');
    }

    public function updateStatus(Request $request, Status $status)
    {
        $request->validate([
            'kode_status' => "required|unique:status_pegawai,kode_status,{$status->id}",
            'nama_status' => 'required',
        ]);

        $status->update($request->all());

        $kolomDipantau = ['kode_status' => 'Kode', 'nama_status' => 'Nama', 'deskripsi' => 'Deskripsi'];
        $kolomBerubah  = array_values(array_filter(
            array_map(fn($k, $l) => $status->wasChanged($k) ? $l : null, array_keys($kolomDipantau), $kolomDipantau)
        ));

        if (!empty($kolomBerubah)) {
            $this->catatLog("Memperbarui status {$status->nama_status} (" . implode(', ', $kolomBerubah) . ')');
        }

        return $this->respondSuccess('Status berhasil diperbarui.');
    }

    public function destroyStatus(Status $status)
    {
        $namaStatus = $status->nama_status;
        $status->delete();
        $this->catatLog("Menghapus status: {$namaStatus}");

        return $this->respondSuccess('Status berhasil dihapus.');
    }

    // --- GOLONGAN ---

    public function indexGolongan()
    {
        $daftarGolongan = Golongan::orderBy('pangkat')->get();
        return view('data-master.golongan', ['data' => $daftarGolongan]);
    }

    public function storeGolongan(Request $request)
    {
        $request->validate([
            'kode_golongan' => 'required|unique:golongan',
            'nama_golongan' => 'required',
            'pangkat'       => 'required',
            'ruang'         => 'required',
            'eselon'        => 'required',
        ]);

        $golonganBaru = Golongan::create($request->all());
        $this->catatLog("Menambahkan golongan baru: {$golonganBaru->nama_golongan}");

        return $this->respondSuccess('Golongan berhasil ditambahkan.');
    }

    public function updateGolongan(Request $request, Golongan $golongan)
    {
        $request->validate([
            'kode_golongan' => "required|unique:golongan,kode_golongan,{$golongan->id}",
            'nama_golongan' => 'required',
            'pangkat'       => 'required',
            'ruang'         => 'required',
            'eselon'        => 'required',
        ]);

        $golongan->update($request->all());

        $kolomDipantau = [
            'kode_golongan' => 'Kode',
            'nama_golongan' => 'Nama',
            'pangkat' => 'Pangkat',
            'ruang' => 'Ruang',
            'eselon' => 'Eselon',
        ];
        $kolomBerubah = array_values(array_filter(
            array_map(fn($k, $l) => $golongan->wasChanged($k) ? $l : null, array_keys($kolomDipantau), $kolomDipantau)
        ));

        if (!empty($kolomBerubah)) {
            $this->catatLog("Memperbarui golongan {$golongan->nama_golongan} (" . implode(', ', $kolomBerubah) . ')');
        }

        return $this->respondSuccess('Golongan berhasil diperbarui.');
    }

    public function destroyGolongan(Golongan $golongan)
    {
        $namaGolongan = $golongan->nama_golongan;
        $golongan->delete();
        $this->catatLog("Menghapus golongan: {$namaGolongan}");

        return $this->respondSuccess('Golongan berhasil dihapus.');
    }

    // --- PENDIDIKAN ---

    public function indexPendidikan()
    {
        $daftarPendidikan = Pendidikan::orderBy('jenjang')->get();
        return view('data-master.pendidikan', ['data' => $daftarPendidikan]);
    }

    public function storePendidikan(Request $request)
    {
        $request->validate([
            'kode_pendidikan' => 'required|unique:pendidikan',
            'jenjang'         => 'required',
            'lama_studi'      => 'required|integer',
            'deskripsi'       => 'required',
        ]);

        $pendidikanBaru = Pendidikan::create($request->all());
        $this->catatLog("Menambahkan jenjang pendidikan baru: {$pendidikanBaru->jenjang}");

        return $this->respondSuccess('Pendidikan berhasil ditambahkan.');
    }

    public function updatePendidikan(Request $request, Pendidikan $pendidikan)
    {
        $request->validate([
            'kode_pendidikan' => "required|unique:pendidikan,kode_pendidikan,{$pendidikan->id}",
            'jenjang'         => 'required',
            'lama_studi'      => 'required|integer',
            'deskripsi'       => 'required',
        ]);

        $pendidikan->update($request->all());

        $kolomDipantau = [
            'kode_pendidikan' => 'Kode',
            'jenjang' => 'Jenjang',
            'lama_studi' => 'Lama Studi',
            'deskripsi' => 'Deskripsi',
        ];
        $kolomBerubah = array_values(array_filter(
            array_map(fn($k, $l) => $pendidikan->wasChanged($k) ? $l : null, array_keys($kolomDipantau), $kolomDipantau)
        ));

        if (!empty($kolomBerubah)) {
            $this->catatLog("Memperbarui pendidikan {$pendidikan->jenjang} (" . implode(', ', $kolomBerubah) . ')');
        }

        return $this->respondSuccess('Pendidikan berhasil diperbarui.');
    }

    public function destroyPendidikan(Pendidikan $pendidikan)
    {
        $namaJenjang = $pendidikan->jenjang;
        $pendidikan->delete();
        $this->catatLog("Menghapus pendidikan: {$namaJenjang}");

        return $this->respondSuccess('Pendidikan berhasil dihapus.');
    }

    // --- KOMPONEN GAJI ---

    public function indexKomponenGaji()
    {
        $daftarKomponenGaji = KomponenGaji::orderBy('nama_komponen')->get();
        $daftarJabatan      = \App\Models\Jabatan::all();

        return view('data-master.komponen-gaji', [
            'data'    => $daftarKomponenGaji,
            'jabatan' => $daftarJabatan,
        ]);
    }

    public function storeKomponenGaji(Request $request)
    {
        $request->validate([
            'kode_komponen' => 'required|unique:komponen_gaji',
            'nama_komponen' => 'required',
            'jenis'         => 'required|in:penghasilan,potongan',
            'tipe_nominal'  => 'required|in:fixed,percent',
            'nominal'       => 'required|numeric',
            'id_jabatan'    => 'required|exists:jabatan,id',
        ]);

        $komponenBaru = KomponenGaji::create($request->all());
        $this->catatLog("Menambahkan komponen gaji baru: {$komponenBaru->nama_komponen}");

        return $this->respondSuccess('Komponen Gaji berhasil ditambahkan.');
    }

    public function updateKomponenGaji(Request $request, KomponenGaji $komponenGaji)
    {
        $request->validate([
            'kode_komponen' => "required|unique:komponen_gaji,kode_komponen,{$komponenGaji->id}",
            'nama_komponen' => 'required',
            'nominal'       => 'required|numeric',
            'id_jabatan'    => 'required|exists:jabatan,id',
        ]);

        $komponenGaji->update($request->all());

        $kolomDipantau = [
            'kode_komponen' => 'Kode',
            'nama_komponen' => 'Nama',
            'jenis' => 'Jenis',
            'tipe_nominal' => 'Tipe Nominal',
            'nominal' => 'Nominal',
        ];
        $kolomBerubah = array_values(array_filter(
            array_map(fn($k, $l) => $komponenGaji->wasChanged($k) ? $l : null, array_keys($kolomDipantau), $kolomDipantau)
        ));

        if (!empty($kolomBerubah)) {
            $this->catatLog("Memperbarui komponen gaji {$komponenGaji->nama_komponen} (" . implode(', ', $kolomBerubah) . ')');
        }

        return $this->respondSuccess('Komponen Gaji berhasil diperbarui.');
    }

    public function destroyKomponenGaji(KomponenGaji $komponenGaji)
    {
        $namaKomponen = $komponenGaji->nama_komponen;
        $komponenGaji->delete();
        $this->catatLog("Menghapus komponen gaji: {$namaKomponen}");

        return $this->respondSuccess('Komponen Gaji berhasil dihapus.');
    }
}
