<?= $this->extend('Riset/admin/layout/template') ?>

<?= $this->section('content') ?>

<?php /** @var array $daftar */ ?>

<div class="card shadow-sm border-0 rounded-4 bg-white">
    <div class="card-header bg-transparent border-bottom border-light py-3 px-4 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-dark" style="font-size: 15px;">Daftar Pengajuan Riset Menunggu Review</h6>
        <div class="input-group" style="width: 320px;">
            <input type="text" class="form-control" placeholder="Cari peneliti atau judul..." style="font-size: 12px; border-color: #eee; border-radius: 8px 0 0 8px;">
            <button class="btn btn-danger" type="button" style="border-radius: 0 8px 8px 0; font-size: 12px;"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 border-white">
                <thead class="bg-light bg-opacity-50">
                    <tr style="font-size: 11px; letter-spacing: 0.5px;" class="text-muted text-uppercase fw-bold">
                        <th class="ps-4 border-0" width="50">No</th>
                        <th class="border-0">Peneliti</th>
                        <th class="border-0 text-nowrap">Kategori</th>
                        <th class="border-0">Judul Penelitian</th>
                        <th class="text-center border-0 text-nowrap">Tanggal</th>
                        <th class="text-center border-0 text-nowrap">Status</th>
                        <th class="pe-4 text-center border-0 text-nowrap" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftar)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted border-light" style="font-size: 13px;">Belum ada pengajuan Studi Pendahuluan.</td>
                    </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($daftar as $p): ?>
                        <tr>
                            <td class="ps-4 border-light" style="font-size: 13px;"><?= $no++ ?></td>
                            <td class="border-light">
                                <div class="fw-bold text-dark" style="font-size: 13px;"><?= $p['nama'] ?></div>
                                <div class="text-muted" style="font-size: 11px;"><?= $p['institusi'] ?></div>
                            </td>
                            <td class="border-light"><span class="badge bg-white text-danger border border-danger rounded-pill fw-medium" style="font-size: 11px; padding: 6px 12px;">Studi Pendahuluan</span></td>
                            <td class="border-light">
                                <div class="text-truncate" style="max-width: 280px; font-size: 13px; color: #444;"><?= (strlen($p['judul']) > 40) ? substr($p['judul'], 0, 40) . '...' : $p['judul'] ?></div>
                            </td>
                            <td class="text-center border-light" style="font-size: 12px; color: #666;"><?= date('d/m/Y', strtotime($p['created_at'])) ?></td>
                            <td class="text-center border-light text-nowrap">
                                <?php 
                                    $statusBadge = '';
                                    $statusIcon = '';
                                    if ($p['status'] == 'dalam review') {
                                        $statusBadge = 'text-warning border-warning';
                                        $statusIcon = 'fa-clock';
                                    } elseif ($p['status'] == 'menunggu_pembayaran') {
                                        $statusBadge = 'text-info border-info';
                                        $statusIcon = 'fa-file-invoice-dollar';
                                    } elseif ($p['status'] == 'direvisi') {
                                        $statusBadge = 'text-secondary border-secondary';
                                        $statusIcon = 'fa-undo';
                                    } elseif ($p['status'] == 'selesai') {
                                        $statusBadge = 'text-success border-success';
                                        $statusIcon = 'fa-check-circle';
                                    } else {
                                        $statusBadge = 'text-secondary border-secondary';
                                        $statusIcon = 'fa-info-circle';
                                    }
                                ?>
                                <span class="badge bg-white border rounded-pill fw-medium <?= $statusBadge ?>" style="font-size: 11px; padding: 6px 12px;">
                                    <i class="fas <?= $statusIcon ?> me-1"></i> <?= ucwords(str_replace('_', ' ', $p['status'])) ?>
                                </span>
                            </td>
                            <td class="pe-4 text-center border-light text-nowrap">
                                <a href="<?= base_url('riset/admin/review/detail/' . $p['id']) ?>" class="btn btn-sm btn-outline-danger rounded-pill shadow-sm fw-bold px-3 py-1" style="font-size: 11px;">
                                    <i class="fas fa-search me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-transparent py-3 px-4 border-top border-light d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <div class="text-muted text-center text-md-start" style="font-size: 12px;">
            Menampilkan <?= count($daftar) ?> data pengajuan.
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm mb-0 gap-1 flex-wrap justify-content-center" style="font-size: 12px;">
                <li class="page-item disabled">
                    <a class="page-link text-muted bg-light border-0 rounded-3 px-3 fw-medium text-nowrap" href="#" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                </li>
                <li class="page-item active">
                    <a class="page-link bg-danger text-white border-0 rounded-3 fw-bold shadow-sm" href="#">1</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link text-muted bg-light border-0 rounded-3 px-3 fw-medium text-nowrap" href="#" tabindex="-1" aria-disabled="true">Selanjutnya <i class="fas fa-angle-right ms-1"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?= $this->endSection() ?>