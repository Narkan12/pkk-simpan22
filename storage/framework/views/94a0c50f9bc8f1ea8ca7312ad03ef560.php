

<?php $__env->startSection('title', 'Kelola Absensi'); ?>

<?php $__env->startSection('content'); ?>

    
    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:1rem;margin-bottom:1rem;">
        <div>
            <h4 style="color:#fff;font-weight:700;font-size:1.5rem;margin-bottom:0.25rem;">Kelola Absensi</h4>
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Monitoring dan verifikasi kehadiran pegawai</p>
        </div>
    </div>

    <?php if(session('success')): ?>
    <div class="alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <div class="cards-grid-4" style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1rem;">
        <div class="custom-card rounded-xl p-4" style="display:flex;align-items:center;gap:1rem;">
            <div style="width:44px;height:44px;border-radius:50%;background:rgba(34,197,94,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-check-circle" style="color:#4ade80;font-size:1.25rem;"></i>
            </div>
            <div>
                <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Hadir</p>
                <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.25rem 0 0;"><?php echo e($hadir); ?></h3>
            </div>
        </div>
        <div class="custom-card rounded-xl p-4" style="display:flex;align-items:center;gap:1rem;">
            <div style="width:44px;height:44px;border-radius:50%;background:rgba(234,179,8,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-clock" style="color:#facc15;font-size:1.25rem;"></i>
            </div>
            <div>
                <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Terlambat</p>
                <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.25rem 0 0;"><?php echo e($terlambat); ?></h3>
            </div>
        </div>
        <div class="custom-card rounded-xl p-4" style="display:flex;align-items:center;gap:1rem;">
            <div style="width:44px;height:44px;border-radius:50%;background:rgba(59,130,246,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-calendar-x" style="color:#60a5fa;font-size:1.25rem;"></i>
            </div>
            <div>
                <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Cuti</p>
                <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.25rem 0 0;"><?php echo e($cuti); ?></h3>
            </div>
        </div>
        <div class="custom-card rounded-xl p-4" style="display:flex;align-items:center;gap:1rem;">
            <div style="width:44px;height:44px;border-radius:50%;background:rgba(239,68,68,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-x-circle" style="color:#f87171;font-size:1.25rem;"></i>
            </div>
            <div>
                <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Alpa</p>
                <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.25rem 0 0;"><?php echo e($alpa); ?></h3>
            </div>
        </div>
    </div>

    
    <form method="GET" action="<?php echo e(route('absensi')); ?>" class="custom-card rounded-xl p-4" style="margin-bottom:1rem;">
        <div class="filter-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;">
            <div>
                <label class="custom-paragraph" style="font-size:0.875rem;margin-bottom:0.25rem;display:block;">Tanggal</label>
                <input type="date" name="tanggal" value="<?php echo e($tanggal); ?>" class="modal-input w-full">
            </div>
            <div>
                <label class="custom-paragraph" style="font-size:0.875rem;margin-bottom:0.25rem;display:block;">Cari Pegawai</label>
                <div style="display:flex;align-items:center;gap:0.5rem;" class="modal-input">
                    <i class="bi bi-search" style="color:#7a9a7a;"></i>
                    <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Nama atau NIP..."
                        style="background:transparent;border:none;outline:none;color:#1a2e1a;font-size:0.875rem;width:100%;">
                </div>
            </div>
            <div>
                <label class="custom-paragraph" style="font-size:0.875rem;margin-bottom:0.25rem;display:block;">Status</label>
                <select name="status" class="modal-input w-full" onchange="this.form.submit()">
                    <option value="semua" <?php echo e($status == 'semua' || !$status ? 'selected' : ''); ?>>Semua Status</option>
                    <option value="hadir"             <?php echo e($status == 'hadir'             ? 'selected' : ''); ?>>Hadir</option>
                    <option value="terlambat"         <?php echo e($status == 'terlambat'         ? 'selected' : ''); ?>>Terlambat</option>
                    <option value="cuti"              <?php echo e($status == 'cuti'              ? 'selected' : ''); ?>>Cuti</option>
                    <option value="tanpa keterangan"  <?php echo e($status == 'tanpa keterangan'  ? 'selected' : ''); ?>>Alpa</option>
                </select>
            </div>
        </div>
        <button type="submit" style="margin-top:0.75rem;padding:0.5rem 1rem;border-radius:0.5rem;color:#fff;font-size:0.875rem;font-weight:600;border:none;cursor:pointer;background:#1a6fdf;">
            <i class="bi bi-search me-1"></i> Cari
        </button>
    </form>

    
    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="search-absensi">
            <thead>
                <tr>
                    <th>TANGGAL</th>
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>JAM MASUK</th>
                    <th>JAM KELUAR</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $absensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e(\Carbon\Carbon::parse($a->tanggal)->isoFormat('D MMM Y')); ?></td>
                    <td><?php echo e($a->pegawai?->NIP ?? '-'); ?></td>
                    <td style="font-weight:600;color:#fff;"><?php echo e($a->pegawai?->nama_lengkap ?? '-'); ?></td>
                    <td><?php echo e($a->jam_masuk ?? '--:--'); ?></td>
                    <td><?php echo e($a->jam_keluar ?? '--:--'); ?></td>
                    <td>
                        <?php
                            $cls = [
                                'hadir'            => 'status-active',
                                'terlambat'        => 'status-cuti',
                                'cuti'             => 'status-cuti',
                                'tanpa keterangan' => 'status-inactive',
                            ][$a->status] ?? 'status-cuti';
                        ?>
                        <span class="<?php echo e($cls); ?>"><?php echo e(ucfirst($a->status)); ?></span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" style="text-align:center;padding:2.5rem 1rem;color:#7a9a7a;">Tidak ada data absensi untuk tanggal ini.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\manajemen\absensi.blade.php ENDPATH**/ ?>