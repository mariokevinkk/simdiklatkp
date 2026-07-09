<?= $this->include('Pendidikan/mahasiswa/layout/header') ?>
<?= $this->include('Pendidikan/mahasiswa/layout/sidebar') ?>

<div class="row">
    <div class="col-12 mb-4">
        <h4 class="fw-bold">Manajemen Rotasi Stase</h4>
        <p class="text-muted small mb-0">Daftar stase dan rotasi yang sedang atau akan dijalankan.</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <?php if (!empty($staseList)): ?>
                <?php $i = 1; foreach ($staseList as $s): ?>
                    <?php 
                        $now = time();
                        $start = strtotime($s['tanggal_mulai']);
                        $end = strtotime($s['tanggal_akhir']);
                        
                        if ($now < $start) {
                            $status = 'Mendatang';
                            $badge = 'bg-light text-primary border border-primary';
                            $colorTheme = '#007bff';
                            $iconClass = 'bg-primary text-white';
                            $icon = 'fas fa-truck-medical';
                            $btnClass = 'btn-outline-primary';
                        } elseif ($now > $end) {
                            $status = 'Selesai';
                            $badge = 'bg-success';
                            $colorTheme = '#28a745';
                            $iconClass = 'bg-success text-white';
                            $icon = 'fas fa-check';
                            $btnClass = 'btn-outline-success';
                        } else {
                            $status = 'Berjalan';
                            $badge = 'bg-primary';
                            $colorTheme = 'var(--primary-red)';
                            $iconClass = 'bg-danger text-white';
                            $icon = 'fas fa-stethoscope';
                            $btnClass = 'btn-outline-danger';
                        }
                    ?>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm overflow-hidden" style="border-top: 4px solid <?= $colorTheme ?> !important;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="<?= $iconClass ?> rounded-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="<?= $icon ?> fa-lg"></i>
                                    </div>
                                    <span class="badge <?= $badge ?>"><?= $status ?></span>
                                </div>
                                <h5 class="fw-bold mb-3">STASE <?= $i++ ?>: <?= esc($s['nama_stase']) ?></h5>
                                <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                                    <span class="text-muted small"><i class="far fa-calendar me-1"></i> <?= date('d M Y', $start) ?> - <?= date('d M Y', $end) ?></span>
                                    <a href="<?= base_url('pendidikan/mahasiswa/stase/detail/' . $s['id']) ?>" class="btn btn-sm <?= $btnClass ?>">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-layer-group fa-4x text-muted mb-3 opacity-25"></i>
                    <h5 class="text-muted fw-bold">Belum Ada Stase Ditetapkan</h5>
                    <p class="text-muted small">Anda belum ditugaskan ke stase manapun. Silakan tunggu informasi lebih lanjut.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->include('Pendidikan/mahasiswa/layout/footer') ?>
