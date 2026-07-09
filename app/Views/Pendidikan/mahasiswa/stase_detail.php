<?= $this->include('Pendidikan/mahasiswa/layout/header') ?>
<?= $this->include('Pendidikan/mahasiswa/layout/sidebar') ?>

<div class="row">
    <div class="col-12 mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="fw-bold">Detail Stase</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('pendidikan/mahasiswa/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('pendidikan/mahasiswa/stase') ?>">Rotasi Stase</a></li>
                        <li class="breadcrumb-item active"><?= esc($stase['nama_stase']) ?></li>
                    </ol>
                </nav>
            </div>
            <a href="<?= base_url('pendidikan/mahasiswa/stase') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

<?php
$now = time();
$start = strtotime($stase['tanggal_mulai']);
$end = strtotime($stase['tanggal_akhir']);

if ($now < $start) {
    $status = "Mendatang";
    $badgeClass = "bg-primary";
} elseif ($now > $end) {
    $status = "Selesai";
    $badgeClass = "bg-success";
} else {
    $status = "Berjalan";
    $badgeClass = "bg-danger";
}

$staseName = esc($stase['nama_stase']);
$periode = date('d M Y', $start) . ' - ' . date('d M Y', $end);
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4 border-0 shadow-sm" style="border-top: 4px solid var(--primary-red) !important;">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Informasi Stase</h6>
                <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
            </div>
            <div class="card-body">
                <h4 class="fw-bold mb-3 text-danger"><?= $staseName ?></h4>
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="p-3 bg-light rounded-3">
                            <p class="text-muted small mb-1 text-uppercase fw-bold"><i class="far fa-calendar-alt me-2"></i>Periode Pelaksanaan</p>
                            <h6 class="mb-0 fw-bold"><?= $periode ?></h6>
                        </div>
                    </div>
                </div>

                <h6 class="fw-bold mb-3"><i class="fas fa-sitemap me-2 text-danger"></i>Daftar Ruangan & CI di <?= $staseName ?></h6>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;" class="text-center">#</th>
                                <th>Nama Ruangan</th>
                                <th>Clinical Instructor (CI)</th>
                                <th class="text-center">Logbook</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($rooms)): ?>
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">Belum ada ruangan yang ditugaskan.</td>
                            </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($rooms as $room): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= esc($room['nama_ruangan'] ?: 'Ruangan Utama') ?></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <?php $ciName = esc($room['ci_name'] ?: 'Belum Ditugaskan'); ?>
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($ciName) ?>&background=random&color=fff" class="rounded-circle" width="30">
                                            <span><?= $ciName ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column gap-2 align-items-center">
                                            <?php if (isset($penempatan['file_logbook']) && $penempatan['file_logbook']): ?>
                                                <a href="<?= base_url('uploads/dokumen_pengajuan/' . $penempatan['file_logbook']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-download me-1"></i>Template Logbook
                                                </a>
                                            <?php endif; ?>

                                            <?php $logbook = $room['logbook'] ?? null; ?>
                                            <?php if ($logbook && $logbook['file_lampiran']): ?>
                                                <div class="mb-1">
                                                    <a href="<?= base_url('uploads/pendidikan/logbookmhs/' . $logbook['file_lampiran']) ?>" target="_blank" class="small text-decoration-none fw-bold text-success">
                                                        <i class="fas fa-file-pdf me-1"></i>Lihat Logbook
                                                    </a>
                                                </div>
                                                <span class="badge bg-secondary mb-1">Status: <?= esc($logbook['status_validasi']) ?></span>
                                                <?php if ($status === 'Berjalan'): ?>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalUploadLogbook<?= $room['ruangan_id'] ?>">
                                                        <i class="fas fa-upload me-1"></i>Upload Ulang
                                                    </button>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if ($status === 'Berjalan'): ?>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUploadLogbook<?= $room['ruangan_id'] ?>">
                                                        <i class="fas fa-upload me-1"></i>Upload Logbook
                                                    </button>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"><?= $status === 'Mendatang' ? 'Belum Bisa Upload' : 'Periode Sudah Lewat' ?></span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Modal Upload Logbook -->
                                        <div class="modal fade text-start" id="modalUploadLogbook<?= $room['ruangan_id'] ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="<?= base_url('pendidikan/mahasiswa/logbook/upload') ?>" method="POST" enctype="multipart/form-data" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold">Upload Logbook</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="penempatan_id" value="<?= isset($penempatan) ? $penempatan['penempatan_id'] : '' ?>">
                                                        <input type="hidden" name="stase_id" value="<?= $id ?>">
                                                        <input type="hidden" name="ruangan_id" value="<?= $room['ruangan_id'] ?>">
                                                        
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Stase / Ruangan</label>
                                                            <input type="text" class="form-control bg-light" value="<?= esc($stase['nama_stase']) ?> - <?= esc($room['nama_ruangan']) ?>" readonly>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">File Logbook (PDF) <span class="text-danger">*</span></label>
                                                            <input type="file" name="file_lampiran" class="form-control" accept=".pdf" required>
                                                            <small class="text-muted">Maksimal ukuran file 2MB.</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Upload Logbook</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mb-4 border-0 shadow-sm" style="border-top: 4px solid #198754 !important;">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="fas fa-tasks text-success me-2"></i>Tugas & Penugasan</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Detail Tugas</th>
                                <th>Batas Waktu</th>
                                <th>Status Pengumpulan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($tasks)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada tugas yang diberikan oleh CI.</td>
                            </tr>
                            <?php else: ?>
                                <?php $no=1; foreach($tasks as $t): 
                                    $sub = $t['submission'] ?? null;
                                    $isLate = false;
                                    if (!$sub && strtotime($t['deadline']) < time()) {
                                        $isLate = true;
                                    }
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <strong class="text-dark"><?= esc($t['nama_tugas']) ?></strong><br>
                                        <small class="text-muted"><?= esc($t['deskripsi']) ?></small><br>
                                        <small class="text-primary"><i class="fas fa-user-md"></i> CI: <?= esc($t['ci_name_giver']) ?> &nbsp;|&nbsp; <i class="fas fa-hospital"></i> <?= esc($t['ruangan_name']) ?></small>
                                    </td>
                                    <td>
                                        <span class="badge <?= $isLate ? 'bg-danger' : 'bg-secondary' ?>">
                                            <i class="far fa-clock me-1"></i> <?= date('d M Y, H:i', strtotime($t['deadline'])) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($sub): ?>
                                            <div class="d-flex flex-column align-items-start">
                                                <span class="badge bg-success mb-1"><i class="fas fa-check-circle me-1"></i> Telah Dikumpulkan</span>
                                                <a href="<?= base_url('uploads/pendidikan/tugasmhs/' . $sub['file_tugas']) ?>" target="_blank" class="small text-decoration-none fw-bold text-success">
                                                    <i class="fas fa-file-pdf me-1"></i> Lihat File
                                                </a>
                                                <?php if($sub['nilai'] !== null): ?>
                                                    <?php if (($mahasiswa['payment_status'] ?? '') === 'Lunas'): ?>
                                                        <span class="badge bg-primary mt-1">Nilai: <?= esc($sub['nilai']) ?></span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary mt-1" title="Selesaikan pembayaran administrasi untuk melihat nilai" data-bs-toggle="tooltip"><i class="fas fa-lock me-1"></i> Nilai Terkunci</span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="badge <?= $isLate ? 'bg-danger' : 'bg-warning text-dark' ?>">
                                                <?= $isLate ? 'Terlambat' : 'Belum Mengumpulkan' ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm <?= $sub ? 'btn-outline-secondary' : 'btn-primary' ?>" data-bs-toggle="modal" data-bs-target="#modalUploadTugas<?= $t['id'] ?>">
                                            <i class="fas fa-upload me-1"></i> <?= $sub ? 'Upload Ulang' : 'Upload Tugas' ?>
                                        </button>

                                        <!-- Modal Upload Tugas -->
                                        <div class="modal fade text-start" id="modalUploadTugas<?= $t['id'] ?>" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="<?= base_url('pendidikan/mahasiswa/tugas/upload') ?>" method="POST" enctype="multipart/form-data" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold">Upload Tugas</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="tugas_id" value="<?= $t['id'] ?>">
                                                        <input type="hidden" name="stase_id" value="<?= $id ?>">
                                                        
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Tugas</label>
                                                            <input type="text" class="form-control bg-light" value="<?= esc($t['nama_tugas']) ?>" readonly>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">File Tugas (PDF) <span class="text-danger">*</span></label>
                                                            <input type="file" name="file_tugas" class="form-control" accept=".pdf" required>
                                                            <small class="text-muted">Maksimal ukuran file 2MB.</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Tugas</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
</div>

<?= $this->include('Pendidikan/mahasiswa/layout/footer') ?>
