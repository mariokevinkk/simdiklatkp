<?= $this->extend('Riset/admin/layout/template') ?>

<?php
/**
 * @var array $stats
 * @var array $pengajuan_terbaru
 */
?>

<?= $this->section('content') ?>

<!-- Header Section -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="card-body p-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(120deg, #fff 0%, #f8f9fa 100%);">
                <div>
                    <h5 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">Selamat Datang, Admin Studi & Publikasi</h5>
                    <p class="mb-0 text-muted small" style="font-size: 11px;">Kelola antrean studi pendahuluan, perizinan, dan publikasi riset secara terpadu.</p>
                </div>
                <div class="text-end d-none d-md-block text-muted" style="font-size: 12px; font-weight: 600;">
                    <?php
                        $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        $tanggal = date('d') . ' ' . $bulan[(int)date('m')] . ' ' . date('Y');
                    ?>
                    <i class="fas fa-calendar-alt me-1 text-danger"></i> <?= $tanggal ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Stats Row -->
<div class="row g-3 mb-3">
    <!-- Big Stat Card (Total) -->
    <div class="col-12 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 text-center p-3 bg-white transition-hover d-flex flex-column justify-content-center">
            <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 0.5px;">Total Pengajuan</div>
            <h1 class="fw-bold mb-1 text-danger" style="font-size: 32px; line-height: 1;"><?= $stats['total_all'] ?></h1>
            <div class="text-danger small fw-bold mb-1 d-flex align-items-center justify-content-center" style="font-size: 11px;">
                Riset Terdaftar
            </div>
            <div class="text-muted" style="font-size: 9px;">Berdasarkan rekapitulasi sistem</div>
        </div>
    </div>

    <!-- Detail Cards -->
    <div class="col-12 col-lg-9">
        <div class="row g-2">
            <div class="col-4 col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-2 p-md-3 bg-white transition-hover d-flex flex-column justify-content-center align-items-center text-center">
                    <div class="small fw-bold text-muted text-uppercase mb-1" style="font-size: 8px; letter-spacing: 0.5px;">Pending</div>
                    <h2 class="fw-bold text-dark mb-0" style="font-size: 24px; line-height: 1;"><?= $stats['total_pending'] ?></h2>
                    <p class="text-muted mb-0 d-none d-md-block mt-1" style="font-size: 10px;">Berkas butuh verifikasi.</p>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-2 p-md-3 bg-white transition-hover d-flex flex-column justify-content-center align-items-center text-center">
                    <div class="small fw-bold text-muted text-uppercase mb-1" style="font-size: 8px; letter-spacing: 0.5px;">Tuntas</div>
                    <h2 class="fw-bold text-dark mb-0" style="font-size: 24px; line-height: 1;"><?= $stats['total_selesai'] ?></h2>
                    <p class="text-muted mb-0 d-none d-md-block mt-1" style="font-size: 10px;">Izin meneliti telah terbit.</p>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-2 p-md-3 bg-white transition-hover d-flex flex-column justify-content-center align-items-center text-center">
                    <div class="small fw-bold text-muted text-uppercase mb-1" style="font-size: 8px; letter-spacing: 0.5px;">Revisi</div>
                    <h2 class="fw-bold text-dark mb-0" style="font-size: 24px; line-height: 1;"><?= $stats['total_revisi'] ?></h2>
                    <p class="text-muted mb-0 d-none d-md-block mt-1" style="font-size: 10px;">Dikembalikan ke peneliti.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Section -->
<div class="row g-3">
    <!-- Activity Table -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
            <div class="card-header bg-transparent border-bottom border-light py-2 px-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark" style="font-size: 13px;">
                    <i class="fas fa-list-ul me-2 text-danger"></i> Antrean Pengajuan Riset Terbaru
                </h6>
                <a href="<?= base_url('riset/admin/review') ?>" class="text-danger fw-bold text-decoration-none" style="font-size: 10px;">Lihat Semua <i class="fas fa-angle-right ms-1"></i></a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light bg-opacity-50">
                            <tr style="font-size: 9px; letter-spacing: 0.5px;" class="text-muted text-uppercase fw-bold">
                                <th class="ps-3 py-2 border-0">Data Peneliti</th>
                                <th class="border-0">Topik / Judul</th>
                                <th class="border-0">Jenis</th>
                                <th class="text-center border-0">Tgl Masuk</th>
                                <th class="pe-3 text-center border-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pengajuan_terbaru)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted border-light" style="font-size: 11px;">Belum ada pengajuan.</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($pengajuan_terbaru as $p): ?>
                                <tr>
                                    <td class="ps-3 py-2 border-light">
                                        <div class="fw-bold text-dark" style="font-size: 11px;"><?= $p['nama'] ?></div>
                                        <div class="text-muted" style="font-size: 9px;"><?= $p['institusi'] ?></div>
                                    </td>
                                    <td style="font-size: 11px; color: #444;" class="border-light"><?= (strlen($p['judul']) > 30) ? substr($p['judul'], 0, 30) . '...' : $p['judul'] ?></td>
                                    <td class="border-light">
                                        <?php if ($p['jenis_pengajuan'] == 'publikasi_riset'): ?>
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill" style="font-size: 9px;">Publikasi</span>
                                        <?php elseif ($p['jenis_pengajuan'] == 'penelitian'): ?>
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill" style="font-size: 9px;">Izin Riset</span>
                                        <?php else: ?>
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill" style="font-size: 9px;">Studi Pend.</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center border-light" style="font-size: 10px; color: #666;"><?= date('d/m/Y', strtotime($p['created_at'])) ?></td>
                                    <td class="pe-3 text-center border-light">
                                        <?php if ($p['jenis_pengajuan'] == 'publikasi_riset'): ?>
                                            <a href="<?= base_url('riset/admin/publikasi/detail/' . $p['id']) ?>" class="btn btn-sm btn-outline-danger rounded-pill fw-bold px-2 py-1" style="font-size: 9px;">Review</a>
                                        <?php else: ?>
                                            <a href="<?= base_url('riset/admin/review/detail/' . $p['id']) ?>" class="btn btn-sm btn-outline-danger rounded-pill fw-bold px-2 py-1" style="font-size: 9px;">Review</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Log Section -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
            <div class="card-header bg-transparent border-bottom border-light py-2 px-3">
                <h6 class="fw-bold mb-0 text-dark" style="font-size: 13px;">Log Aktivitas Riset</h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <?php if (empty($pengajuan_terbaru)): ?>
                        <div class="list-group-item d-flex px-3 py-4 border-0 justify-content-center text-muted" style="font-size: 11px;">
                            Belum ada aktivitas.
                        </div>
                    <?php else: ?>
                        <?php foreach (array_slice($pengajuan_terbaru, 0, 3) as $log): ?>
                        <div class="list-group-item d-flex px-3 py-2 border-0 transition-hover">
                            <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; min-width: 32px;">
                                <i class="fas <?= $log['jenis_pengajuan'] == 'publikasi_riset' ? 'fa-book-open' : ($log['jenis_pengajuan'] == 'penelitian' ? 'fa-file-alt' : 'fa-file-import') ?>" style="font-size: 13px;"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark mb-1" style="font-size: 11px;">Pengajuan <?= ucwords(str_replace('_', ' ', $log['jenis_pengajuan'])) ?></div>
                                <div class="text-muted mb-1" style="font-size: 10px; line-height: 1.3;">Dari <?= explode(' ', trim($log['nama']))[0] ?> masuk ke antrean.</div>
                                <div class="text-muted" style="font-size: 9px;"><i class="far fa-clock me-1"></i> <?= date('d M Y H:i', strtotime($log['created_at']) + (7 * 3600)) ?> WIB</div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-hover {
        transition: all 0.2s ease-in-out;
    }
    .transition-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.05) !important;
    }
</style>

<?= $this->endSection() ?>