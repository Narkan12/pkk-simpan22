

<?php $__env->startSection('title', 'SIMPAN - Dashboard Pegawai'); ?>

<?php $__env->startSection('content'); ?>

    
    <?php if(session('success')): ?>
    <div class="alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <?php if(session('error')): ?>
    <div class="alert-error"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
    <div class="alert-error">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    
    <div style="margin-bottom:1.25rem;">
        <h4 style="color:#1a2e1a;font-weight:700;font-size:1.25rem;margin-bottom:2px;">
            <?php echo e($pegawai->nama_lengkap ?? auth()->user()->name); ?>

        </h4>
        <p style="color:#7a9a7a;font-size:0.75rem;">
            <?php echo e($pegawai->jabatan?->nama_jabatan ?? 'Pegawai'); ?> &mdash; <?php echo e(now()->isoFormat('D MMMM Y')); ?>

        </p>
    </div>

    
    <div class="summary-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:0.75rem;margin-bottom:1.25rem;">
        <div class="summary-card">
            <p class="summary-card-label">Hadir Bulan Ini</p>
            <p class="summary-card-value"><?php echo e($hariKerja); ?> / <?php echo e($totalHariKerja); ?></p>
        </div>
        <div class="summary-card">
            <p class="summary-card-label">Sisa Cuti</p>
            <p class="summary-card-value"><?php echo e($pegawai->jatah_cuti ?? 0); ?> hari</p>
        </div>
        <div class="summary-card">
            <p class="summary-card-label">Status Kerja</p>
            <p class="summary-card-value"><?php echo e(ucfirst($pegawai->status->nama_status ?? '-')); ?></p>
        </div>
    </div>

    
    <div class="action-grid" style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.75rem;margin-bottom:1.25rem;">
        <button onclick="openModal('modalAbsensi')" class="action-card action-card-green">
            <i class="bi bi-calendar-check action-card-icon" style="color:#03C950;"></i>
            <span class="action-card-label">Absensi</span>
        </button>
        <button onclick="openModal('modalCuti')" class="action-card action-card-yellow">
            <i class="bi bi-file-earmark-text action-card-icon" style="color:#eab308;"></i>
            <span class="action-card-label">Ajukan Cuti</span>
        </button>
    </div>

    
    <div style="border-radius:0.5rem;overflow:hidden;border:1px solid #e2ece2;">
        <div style="padding:0.75rem 1rem;border-bottom:1px solid #e2ece2;background:#ffffff;">
            <p style="color:#1a2e1a;font-size:0.875rem;font-weight:600;margin:0;">Absensi Terbaru</p>
        </div>
        <table style="width:100%;font-size:0.875rem;background:#ffffff;border-collapse:collapse;">
            <thead>
                <tr style="border-bottom:1px solid #e2ece2;">
                    <th style="padding:0.5rem 1rem;text-align:left;font-size:0.75rem;color:#7a9a7a;font-weight:600;">TANGGAL</th>
                    <th style="padding:0.5rem 1rem;text-align:left;font-size:0.75rem;color:#7a9a7a;font-weight:600;">MASUK</th>
                    <th style="padding:0.5rem 1rem;text-align:left;font-size:0.75rem;color:#7a9a7a;font-weight:600;">KELUAR</th>
                    <th style="padding:0.5rem 1rem;text-align:left;font-size:0.75rem;color:#7a9a7a;font-weight:600;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $absensiTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $absensi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom:1px solid #e2ece2;">
                    <td style="padding:0.625rem 1rem;color:#1a2e1a;"><?php echo e(\Carbon\Carbon::parse($absensi->tanggal)->isoFormat('D MMM')); ?></td>
                    <td style="padding:0.625rem 1rem;color:#1a2e1a;"><?php echo e($absensi->jam_masuk ?? '--:--'); ?></td>
                    <td style="padding:0.625rem 1rem;color:#1a2e1a;"><?php echo e($absensi->jam_keluar ?? '--:--'); ?></td>
                    <td style="padding:0.625rem 1rem;">
                        <?php
                            $statusClass = [
                                'hadir'            => 'badge-hadir',
                                'terlambat'        => 'badge-terlambat',
                                'cuti'             => 'badge-cuti',
                                'tanpa keterangan' => 'badge-alpa',
                            ][$absensi->status] ?? 'badge-default';
                        ?>
                        <span class="<?php echo e($statusClass); ?>"><?php echo e(ucfirst($absensi->status)); ?></span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" style="padding:2.5rem 1rem;text-align:center;color:#7a9a7a;">Belum ada riwayat absensi.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <?php if($riwayatCuti->isNotEmpty()): ?>
    <?php
        $c = $riwayatCuti->first();
        $durasi = \Carbon\Carbon::parse($c->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($c->tanggal_selesai)) + 1;
        $warna  = match($c->status) {
            'disetujui' => ['bg'=>'#f0fdf4','border'=>'#bbf7d0','dot'=>'#16a34a','text'=>'#15803d','label'=>'Disetujui'],
            'ditolak'   => ['bg'=>'#fef2f2','border'=>'#fecaca','dot'=>'#dc2626','text'=>'#b91c1c','label'=>'Ditolak'],
            default     => ['bg'=>'#fefce8','border'=>'#fde68a','dot'=>'#ca8a04','text'=>'#92400e','label'=>'Menunggu'],
        };
    ?>
    <div style="margin-top:1rem;border-radius:0.5rem;overflow:hidden;border:1px solid <?php echo e($warna['border']); ?>;background:<?php echo e($warna['bg']); ?>;padding:0.75rem 1rem;display:flex;align-items:center;gap:0.75rem;">
        <span style="width:8px;height:8px;border-radius:50%;background:<?php echo e($warna['dot']); ?>;flex-shrink:0;display:inline-block;"></span>
        <div style="flex:1;min-width:0;">
            <span style="font-size:0.8125rem;color:#1a2e1a;font-weight:600;">
                <i class="bi bi-bell" style="margin-right:0.25rem;color:<?php echo e($warna['dot']); ?>;"></i><?php echo e($c->jenis_cuti); ?>

            </span>
            <span style="font-size:0.75rem;color:#7a9a7a;margin-left:0.5rem;">
                <?php echo e(\Carbon\Carbon::parse($c->tanggal_mulai)->format('d M')); ?> – <?php echo e(\Carbon\Carbon::parse($c->tanggal_selesai)->format('d M Y')); ?>

                (<?php echo e($durasi); ?> hari)
            </span>
        </div>
        <span style="font-size:0.75rem;font-weight:600;color:<?php echo e($warna['text']); ?>;background:<?php echo e($warna['border']); ?>;padding:2px 10px;border-radius:999px;flex-shrink:0;">
            <?php echo e($warna['label']); ?>

        </span>
    </div>
    <?php endif; ?>

    
    <div id="modalAbsensi" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding:0 1rem;background:rgba(20,83,45,0.35);">
        <form action="<?php echo e(route('absensi.simpan')); ?>" method="POST" class="modal-dark" style="max-width:360px;">
            <?php echo csrf_field(); ?>
            <div class="modal-header">
                <p class="modal-title">Catat Absensi</p>
                <button type="button" onclick="closeModal('modalAbsensi')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
            </div>
            <div class="modal-body" style="display:flex;flex-direction:column;gap:0.75rem;">
                <div style="border-radius:0.5rem;padding:0.75rem;text-align:center;border:1px solid rgba(3,201,80,0.2);background:rgba(3,201,80,0.06);">
                    <p style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;"><?php echo e(now()->isoFormat('dddd, D MMMM Y')); ?></p>
                    <p style="color:#1a2e1a;font-weight:700;font-size:1.25rem;margin:0;" id="jamPegawai">--:--:--</p>
                </div>
                <div>
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis</label>
                    <select name="jenis" class="modal-input">
                        <option value="masuk">Check-in (Masuk)</option>
                        <option value="keluar">Check-out (Keluar)</option>
                    </select>
                </div>
                <div>
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Keterangan</label>
                    <input type="text" name="keterangan" placeholder="Opsional" class="modal-input">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modalAbsensi')" class="modal-btn-cancel">Batal</button>
                <button type="submit" class="modal-btn-submit">Simpan</button>
            </div>
        </form>
    </div>

    
    <div id="modalCuti" class="hidden" style="position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;padding:0 1rem;background:rgba(20,83,45,0.35);">
        <form action="<?php echo e(route('cuti.ajukan')); ?>" method="POST" class="modal-dark" style="max-width:400px;">
            <?php echo csrf_field(); ?>
            <div class="modal-header">
                <p class="modal-title">Ajukan Cuti</p>
                <button type="button" onclick="closeModal('modalCuti')" class="modal-close-btn"><i class="bi bi-x-lg" style="font-size:11px;"></i></button>
            </div>
            <div class="modal-body" style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.75rem;">
                <div style="grid-column:span 2;">
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Jenis Cuti <span style="color:#e05c5c;">*</span></label>
                    <select name="jenis_cuti" required class="modal-input">
                        <option value="">Pilih</option>
                        <option value="Cuti Tahunan">Cuti Tahunan</option>
                        <option value="Cuti Sakit">Cuti Sakit</option>
                        <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                        <option value="Izin Penting">Izin Penting</option>
                    </select>
                </div>
                <div>
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tanggal Mulai <span style="color:#e05c5c;">*</span></label>
                    <input type="date" name="tanggal_mulai" required class="modal-input">
                </div>
                <div>
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Tanggal Selesai <span style="color:#e05c5c;">*</span></label>
                    <input type="date" name="tanggal_selesai" required class="modal-input">
                </div>
                <div style="grid-column:span 2;">
                    <label style="color:#7a9a7a;font-size:0.75rem;margin-bottom:0.25rem;display:block;">Alasan</label>
                    <textarea name="alasan" rows="2" placeholder="Alasan cuti" class="modal-input" style="resize:none;"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modalCuti')" class="modal-btn-cancel">Batal</button>
                <button type="submit" class="modal-btn-primary">Kirim</button>
            </div>
        </form>
    </div>


    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout-pegawai', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\dashboard-pegawai.blade.php ENDPATH**/ ?>