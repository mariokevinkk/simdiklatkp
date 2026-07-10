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
                                <th class="text-center">Nilai Evaluasi</th>
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
                                            <?php 
                                                $totalNilai = 0; 
                                                $count = count($stase['penilaian']); 
                                                foreach($stase['penilaian'] as $p) { $totalNilai += $p['nilai_angka']; }
                                                $rataRata = $count > 0 ? number_format($totalNilai / $count, 2) : null;
                                            ?>
                                            <?php if ($rataRata !== null): ?>
                                                <span class="badge bg-success" style="font-size: 1.1em;"><?= $rataRata ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-light text-muted border">Belum Ada Nilai</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="small">
                                            <?php if ($rataRata !== null): ?>
                                                Berdasarkan <?= $count ?> aspek penilaian.
                                            <?php elseif ($isSelesai): ?>
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

<div class="row mt-4">
    <div class="col-12">
        <h5 class="fw-bold mb-3">Nilai Tugas & Penugasan</h5>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">Stase</th>
                                <th>Tugas</th>
                                <th>Pembimbing (CI)</th>
                                <th class="text-center">Nilai Tugas</th>
                                <th>Catatan CI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($tugasList)): ?>
                                <?php foreach ($tugasList as $tugas): ?>
                                    <tr>
                                        <td class="px-4"><span class="fw-bold"><?= esc($tugas['nama_stase']) ?></span></td>
                                        <td><?= esc($tugas['nama_tugas']) ?></td>
                                        <td><?= esc($tugas['ci_name']) ?></td>
                                        <td class="text-center">
                                            <span class="badge bg-primary" style="font-size: 1em;"><?= esc($tugas['nilai']) ?></span>
                                        </td>
                                        <td class="small text-muted">
                                            <?= esc($tugas['catatan_ci'] ?: '-') ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada tugas yang dinilai.</td>
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
