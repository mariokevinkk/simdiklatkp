<?= $this->include('Pendidikan/mahasiswa/layout/header') ?>
<?= $this->include('Pendidikan/mahasiswa/layout/sidebar') ?>

<div class="row">
    <div class="col-12 mb-4">
        <h4 class="fw-bold">Daftar Nilai Mahasiswa</h4>
        <p class="text-muted small mb-0">Berikut adalah daftar nilai dan evaluasi dari setiap stase yang telah dan sedang Anda jalani.</p>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3">
                    <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center fw-bold me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                        <span><?= isset($mahasiswa['nama']) ? substr($mahasiswa['nama'], 0, 1) : 'B' ?></span>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark"><?= $mahasiswa['nama'] ?? 'Budi Sudarsono' ?></h6>
                        <span class="text-muted small">NIM: <?= $mahasiswa['nim'] ?? '123458' ?></span>
                    </div>
                    <div class="ms-auto">
                        <button class="btn btn-danger btn-sm fw-bold">
                            <i class="fas fa-download me-1"></i> Download Semua Nilai (PDF)
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr class="small text-uppercase">
                                <th>Stase & Ruangan</th>
                                <th>Pembimbing (CI)</th>
                                <th class="text-center">File Nilai (CI)</th>
                                <th class="text-center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($staseList)): ?>
                                <?php foreach ($staseList as $stase): ?>
                                    <?php 
                                        $now = time();
                                        $end = strtotime($stase['tanggal_akhir']);
                                        $isSelesai = $now > $end;
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold d-block"><?= esc($stase['nama_stase']) ?></span>
                                            <span class="text-muted small"><?= esc($stase['nama_ruangan'] ?: 'Ruangan Utama') ?></span>
                                        </td>
                                        <td class="fw-medium text-primary"><?= esc($stase['ci_name'] ?: 'Belum Ditugaskan') ?></td>
                                        <td class="text-center">
                                            <?php if ($isSelesai): ?>
                                                <a href="#" class="btn btn-sm btn-outline-danger px-3 fw-bold" onclick="alert('Fitur download PDF nilai (dummy)')">
                                                    <i class="fas fa-file-download me-1"></i> Download
                                                </a>
                                            <?php else: ?>
                                                <span class="badge bg-light text-muted border">Belum Tersedia</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="small">
                                            <?php if ($isSelesai): ?>
                                                Menunggu rilis nilai dari CI.
                                            <?php else: ?>
                                                <span class="text-center small text-muted">Stase belum selesai</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Belum ada data stase.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('Pendidikan/mahasiswa/layout/footer') ?>
