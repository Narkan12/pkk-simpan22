

<?php $__env->startSection('title', 'Laporan Cuti'); ?>

<?php $__env->startSection('content'); ?>

    
    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:1rem;margin-bottom:1rem;flex-wrap:wrap;gap:0.75rem;">
        <h2 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0;">Laporan Cuti</h2>
        <div style="display:flex;align-items:center;gap:0.5rem;">
            <select id="filterCutiTahun" class="modal-input" style="width:85px;" onchange="filterCuti()">
                <?php $__currentLoopData = $tahunList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($t); ?>" <?php if($t == $tahun): ?> selected <?php endif; ?>><?php echo e($t); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button onclick="eksporCuti()"
                style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;border-radius:0.5rem;color:#fff;font-size:0.875rem;font-weight:600;border:none;background:#16a34a;cursor:pointer;white-space:nowrap;">
                <i class="bi bi-download"></i> Ekspor Excel
            </button>
        </div>
    </div>

    
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1rem;">
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Total Pengajuan</p>
            <h3 style="color:#fff;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;"><?php echo e($total); ?></h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Disetujui</p>
            <h3 style="color:#22c55e;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;"><?php echo e($disetujui); ?></h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Pending</p>
            <h3 style="color:#facc15;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;"><?php echo e($pending); ?></h3>
        </div>
        <div class="custom-card" style="border-radius:0.75rem;padding:1.25rem;">
            <p class="custom-paragraph" style="font-size:0.875rem;margin:0;">Ditolak</p>
            <h3 style="color:#f87171;font-size:1.5rem;font-weight:700;margin:0.5rem 0 0;"><?php echo e($ditolak); ?></h3>
        </div>
    </div>

    
    <div class="search-wrapper" style="margin-top:1rem;">
        <i class="bi bi-search"></i>
        <input type="text" id="cari-laporan-cuti" placeholder="Cari nama atau jenis cuti...">
    </div>

    
    <div class="table-dark-custom">
        <table class="w-full datatable" data-search="cari-laporan-cuti">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>NAMA</th>
                    <th>JENIS CUTI</th>
                    <th>TGL MULAI</th>
                    <th>TGL SELESAI</th>
                    <th>DURASI</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $durasi = \Carbon\Carbon::parse($c->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($c->tanggal_selesai)) + 1;
                    ?>
                    <tr>
                        <td><?php echo e(optional($c->pegawai)->NIP ?? '-'); ?></td>
                        <td style="font-weight:600;color:#fff;"><?php echo e(optional($c->pegawai)->nama_lengkap ?? '-'); ?></td>
                        <td><?php echo e($c->jenis_cuti); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($c->tanggal_mulai)->format('d M Y')); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($c->tanggal_selesai)->format('d M Y')); ?></td>
                        <td><span class="status-belum"><?php echo e($durasi); ?> hari</span></td>
                        <td>
                            <?php if($c->status === 'disetujui'): ?>
                                <span class="status-active">Disetujui</span>
                            <?php elseif($c->status === 'pending'): ?>
                                <span class="status-cuti">Pending</span>
                            <?php else: ?>
                                <span class="status-nonaktif">Ditolak</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" style="text-align:center;padding:2rem;color:#8b949e;">Belum ada data cuti untuk tahun <?php echo e($tahun); ?>.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
    function filterCuti() {
        const t = document.getElementById('filterCutiTahun').value;
        window.location.href = '<?php echo e(route("laporan-cuti")); ?>?tahun=' + t;
    }
    function eksporCuti() {
        const t = document.getElementById('filterCutiTahun').value;
        window.location.href = '<?php echo e(route("laporan.exportCuti")); ?>?tahun=' + t;
    }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PKK-Simpan22\resources\views\laporan\laporan-cuti.blade.php ENDPATH**/ ?>