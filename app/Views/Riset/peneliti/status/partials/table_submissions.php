<?php
/**
 * @var array<array{id: string, judul: string, status: string, tanggal: string}> $submissions
 * @var string $type
 * @var string|null $detail_route
 * @var string|null $print_route
 * @var string|null $revisi_route
 */
?>
<div class="table-responsive">
    <table class="table table-hover align-middle mb-0" style="border-bottom: 1px solid #f1f3f5;">
        <thead>
            <tr style="font-size: 11px; letter-spacing: 0.5px; background-color: #f8f9fa;" class="text-muted text-uppercase fw-bold">
                <th class="ps-4 py-3 border-0 rounded-start" width="60">No</th>
                <th class="py-3 border-0">ID Pengajuan</th>
                <th class="py-3 border-0">Judul Pengajuan</th>
                <th class="py-3 border-0" width="160">Status</th>
                <th class="pe-4 py-3 border-0 rounded-end" width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($submissions)): ?>
                <?php $no = 1; foreach ($submissions as $row): ?>
                    <tr style="transition: all 0.2s ease;">
                        <td class="ps-4 py-3 border-light border-bottom"><?= $no++ ?></td>
                        <td class="fw-bold border-light border-bottom" style="font-size: 13px; color: #e53935;">
                            <?php
                                $id_prefix = '';
                                if ($type == 'studi') $id_prefix = 'SP';
                                elseif ($type == 'izin') $id_prefix = 'IP';
                                elseif ($type == 'publikasi') $id_prefix = 'PB';
                            ?>
                            <?= $id_prefix . $row['id'] ?>
                        </td>
                        <td class="border-light border-bottom">
                            <div class="fw-bold text-dark mb-1" style="font-size: 13px; line-height: 1.4; max-width: 500px;"><?= (string) esc($row['judul']) ?></div>
                            <div class="text-muted" style="font-size: 11px;"><i class="far fa-calendar-alt me-1 text-danger"></i> Diajukan: <span class="fw-medium text-dark"><?= $row['tanggal'] ?></span></div>
                        </td>
                        <td class="border-light border-bottom">
                            <?php 
                                $status_lower = strtolower($row['status']);
                                if ($status_lower == 'menunggu_pembayaran'): 
                                    if (!empty($row['catatan_revisi'])):
                            ?>
                                <span class="badge py-1 px-2 rounded-2 fw-bold shadow-sm" style="font-size: 11px; background-color: #fd7e14; color: white;">
                                    <i class="fas fa-edit me-1"></i> Revisi Bayar
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark py-1 px-2 rounded-2 fw-bold shadow-sm" style="font-size: 11px;">
                                    <i class="fas fa-wallet me-1"></i> Menunggu Bayar
                                </span>
                            <?php endif; ?>
                            <?php elseif ($status_lower == 'review' || $status_lower == 'dalam_review' || $status_lower == 'dalam review'): ?>
                                <span class="badge bg-primary text-white py-1 px-2 rounded-2 fw-bold shadow-sm" style="font-size: 11px;">
                                    <i class="fas fa-search me-1"></i> Review Admin
                                </span>

                            <?php elseif ($status_lower == 'direvisi' || $status_lower == 'revisi'): ?>
                                <span class="badge text-white py-1 px-2 rounded-2 fw-bold shadow-sm" style="font-size: 11px; background-color: #fd7e14;">
                                    <i class="fas fa-edit me-1"></i> Perlu Revisi
                                </span>
                            <?php elseif ($status_lower == 'selesai' || $status_lower == 'disetujui'): ?>
                                <span class="badge bg-success text-white py-1 px-2 rounded-2 fw-bold shadow-sm" style="font-size: 11px;">
                                    <i class="fas fa-check-circle me-1"></i> Selesai
                                </span>
                            <?php elseif ($status_lower == 'ditolak'): ?>
                                <span class="badge bg-danger text-white py-1 px-2 rounded-2 fw-bold shadow-sm" style="font-size: 11px;">
                                    <i class="fas fa-times-circle me-1"></i> Ditolak
                                </span>
                            <?php else: ?>
                                <span class="badge bg-secondary text-white py-1 px-2 rounded-2 fw-bold shadow-sm" style="font-size: 11px;">
                                    <?= (string) esc($row['status']) ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="pe-4 border-light border-bottom">
                            <div class="d-flex justify-content-start gap-2">
                                <?php 
                                    $link_url = ($type == 'publikasi') 
                                        ? base_url($detail_route . '?id=' . $row['id']) 
                                        : base_url($detail_route . '/' . $row['id']);
                                ?>
                                <a href="<?= $link_url ?>" class="btn btn-sm btn-outline-danger rounded-2 fw-bold" style="font-size: 11px;">Detail</a>
                                
                                <?php if ($row['status'] == 'selesai' && !empty($print_route) && (!isset($row['tujuan_laporan']) || $row['tujuan_laporan'] !== 'upload')): ?>
                                    <a href="<?= base_url($print_route . '/' . $row['id']) ?>" class="btn btn-sm btn-success rounded-2 fw-bold text-nowrap" style="font-size: 11px;"><i class="fas fa-print me-1"></i> Cetak</a>
                                <?php elseif ($row['status'] == 'direvisi' && !empty($revisi_route)): ?>
                                    <a href="<?= base_url($revisi_route . '?id=' . $row['id'] . '&revisi=1') ?>" class="btn btn-sm btn-warning rounded-2 fw-bold text-dark text-nowrap" style="font-size: 11px;"><i class="fas fa-edit me-1"></i> Revisi</a>
                                <?php elseif (strtolower($row['status']) == 'menunggu_pembayaran'): ?>
                                    <?php if (!empty($row['catatan_revisi'])): ?>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#paymentModal<?= $id_prefix . $row['id'] ?>" class="btn btn-sm rounded-2 fw-bold text-white text-nowrap" style="font-size: 11px; background-color: #fd7e14;"><i class="fas fa-edit me-1"></i> Revisi Bayar</button>
                                    <?php else: ?>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#paymentModal<?= $id_prefix . $row['id'] ?>" class="btn btn-sm btn-warning rounded-2 fw-bold text-dark text-nowrap" style="font-size: 11px;"><i class="fas fa-upload me-1"></i> Upload Bayar</button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="py-5 text-center text-muted border-0">
                        <div class="text-center p-5 bg-light rounded-4 mx-3 my-2" style="border: 2px dashed #dee2e6;">
                            <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 70px; height: 70px;">
                                <i class="fas fa-file-alt text-danger opacity-75" style="font-size: 30px;"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1" style="font-size: 14px;">Belum Ada Pengajuan</h6>
                            <p class="mb-0" style="font-size: 12px;">Anda belum memiliki riwayat pengajuan dokumen untuk kategori ini.</p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<style>
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.6; }
        100% { opacity: 1; }
    }
    .animate-pulse {
        animation: pulse 1.5s infinite ease-in-out;
    }
</style>

<!-- Modals for Pembayaran -->
<?php if (!empty($submissions)): ?>
    <?php foreach ($submissions as $row): ?>
        <?php if (strtolower($row['status']) == 'menunggu_pembayaran'): ?>
            <?php
                $id_prefix = '';
                if ($type == 'studi') $id_prefix = 'SP';
                elseif ($type == 'izin') $id_prefix = 'IP';
                elseif ($type == 'publikasi') $id_prefix = 'PB';
                
                $post_url = '';
                if ($type == 'studi') $post_url = base_url('riset/peneliti/pengajuan/stupen/bayar');
                elseif ($type == 'izin') $post_url = base_url('riset/peneliti/pengajuan/izin/bayar');
                elseif ($type == 'publikasi') $post_url = base_url('riset/peneliti/publikasi/bayar');
            ?>
            <div class="modal fade" id="paymentModal<?= $id_prefix . $row['id'] ?>" tabindex="-1" aria-labelledby="paymentModalLabel<?= $id_prefix . $row['id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                        <form action="<?= $post_url ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <div class="modal-header bg-warning text-dark border-0 py-3">
                                <h5 class="modal-title fw-bold" id="paymentModalLabel<?= $id_prefix . $row['id'] ?>" style="font-size: 15px;"><i class="fas fa-file-invoice-dollar me-2"></i> Informasi Pembayaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4 bg-light">
                                <?php if (!empty($row['catatan_revisi'])): ?>
                                    <div class="alert alert-warning mb-4 p-3 text-start border-warning" style="font-size: 12px; border-radius: 8px;">
                                        <strong>Catatan Admin:</strong><br><?= esc($row['catatan_revisi']) ?>
                                    </div>
                                <?php endif; ?>
                                <div class="card border-0 shadow-sm rounded-4 mb-4">
                                    <div class="card-body p-4">
                                        <div class="text-center mb-4">
                                            <p class="text-muted small fw-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 1px;">Total Tagihan Pelaksanaan Riset</p>
                                            <?php if (!empty($row['nominal_bayar'])): ?>
                                                <h3 class="fw-bold text-dark mb-0">Rp <?= number_format($row['nominal_bayar'], 0, ',', '.') ?></h3>
                                                <p class="text-muted small mt-1 mb-0" style="font-size: 11px;">Sesuai dengan tagihan dari admin.</p>
                                            <?php else: ?>
                                                <h3 class="fw-bold text-dark mb-0">Sesuai Tarif Layanan</h3>
                                                <p class="text-muted small mt-1 mb-0" style="font-size: 11px;">Silakan konfirmasi ke admin untuk detail tagihan.</p>
                                            <?php endif; ?>
                                        </div>
            
                                        <div class="bg-light p-3 rounded-3 border mb-0">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="text-muted small" style="font-size: 11px;">Bank Tujuan</span>
                                                <span class="fw-bold text-dark" style="font-size: 12px;"><?= isset($pengaturan['nama_bank']) && !empty($pengaturan['nama_bank']) ? esc($pengaturan['nama_bank']) : 'Bank BPD DIY' ?></span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="text-muted small" style="font-size: 11px;">Nomor Rekening</span>
                                                <span class="fw-bold text-primary" style="font-size: 14px; letter-spacing: 1px;"><?= isset($pengaturan['nomor_rekening']) && !empty($pengaturan['nomor_rekening']) ? esc($pengaturan['nomor_rekening']) : '1122334455' ?></span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted small" style="font-size: 11px;">Atas Nama</span>
                                                <span class="fw-bold text-dark" style="font-size: 12px;"><?= isset($pengaturan['nama_rekening']) && !empty($pengaturan['nama_rekening']) ? esc($pengaturan['nama_rekening']) : 'RSUD Kota Yogyakarta' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="mb-0 text-start">
                                    <label class="fw-bold text-dark mb-2" style="font-size: 12px;">Upload Bukti Pembayaran</label>
                                    <input type="file" name="bukti_bayar" id="buktiBayar<?= $id_prefix . $row['id'] ?>" class="form-control" style="font-size: 12px; border-radius: 8px;" required>
                                    <small class="text-muted mt-2 d-block" style="font-size: 10px;">Format PDF/JPG, maks 2MB. Pastikan nominal dan referensi terlihat jelas.</small>
                                </div>
                            </div>
                            <div class="modal-footer border-0 bg-white py-3">
                                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal" style="font-size: 12px; font-weight: 600;">Kembali</button>
                                <button type="submit" class="btn btn-warning text-dark rounded-pill px-4 fw-bold shadow-sm" style="font-size: 12px;">
                                    <i class="fas fa-check-circle me-2"></i> Kirim Bukti Bayar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
