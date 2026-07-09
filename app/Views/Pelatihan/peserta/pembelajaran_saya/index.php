<?php echo $this->extend('pelatihan/layout/peserta_layout'); ?>
<?php echo $this->section('content'); ?>
<?php
/**
 * @var array $minta_akses
 * @var array $belum_dimulai
 * @var array $berjalan
 * @var array $selesai
 * @var array $dibatalkan
 */
?>

<style>
    :root {
        --primary-red: #ce2127;
        --primary-dark: #0f172a;
        --primary-yellow: #ffc107;
        --soft-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .nav-pills .nav-link {
        border-radius: 12px;
        font-weight: 800;
        color: #fff !important;
        background: #475569 !important; /* Muted Slate */
        padding: 12px 25px;
        transition: all 0.3s;
        border: 1px solid #334155;
        margin-right: 10px;
        opacity: 0.7;
    }
    .nav-pills .nav-link:hover {
        background: #1e293b !important;
        opacity: 1;
    }
    .nav-pills .nav-link.active {
        background-color: var(--primary-dark) !important;
        color: #fff !important;
        opacity: 1;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.3);
        border-color: var(--primary-dark);
    }
    .card {
        border: 2px solid #f1f5f9;
        border-radius: 20px;
        box-shadow: var(--soft-shadow);
        transition: all 0.3s;
    }
    .card:hover {
        transform: translateY(-8px);
        border-color: var(--primary-red);
    }
    .badge-status {
        font-size: 0.75rem;
        padding: 8px 15px;
        border-radius: 100px;
    }
    .btn-green {
        background-color: #10b981;
        color: white;
        border: none;
    }
    .btn-green:hover {
        background-color: #059669;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }
</style>

<div class="pt-1 mb-5">
    <!-- Header Section -->
    <div class="mb-4 animate__animated animate__fadeIn">
        <h3 class="fw-bold mb-1 text-dark"><i class="fas fa-book-open me-2 text-danger"></i> Pembelajaran Saya</h3>
        <p class="text-muted mb-0 fw-medium">Berikut daftar program pembelajaran yang Anda ambil beserta status pelaksanaannya.</p>
    </div>
    <ul class="nav nav-pills mb-5 p-2 bg-light rounded-lg d-inline-flex border" id="ps-tab" role="tablist">
        <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#minta-akses" type="button" role="tab">MINTA AKSES</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#belum-dimulai" type="button" role="tab">BELUM DIMULAI</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#sedang-berjalan" type="button" role="tab">SEDANG BERJALAN</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#selesai" type="button" role="tab">SELESAI</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#dibatalkan" type="button" role="tab">DIBATALKAN</button></li>
    </ul>
    <div class="tab-content">
        <!-- Minta Akses -->
        <div class="tab-pane fade show active" id="minta-akses" role="tabpanel">
            <div class="row g-4">
                <?php foreach ($minta_akses as $p): ?>
                <div class="col-md-4">
                    <div class="card h-100 border-top border-danger border-4">
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark text-uppercase"><?= $p['nama'] ?></h5>
                            <p class="card-text small text-muted fw-bold mb-3"><i class="fas fa-hospital me-1 text-danger"></i> <?= strtoupper($p['penyelenggara']) ?></p>
                            <span class="badge bg-dark text-white badge-status fw-bold border border-white mb-4">MENUNGGU VERIFIKASI</span>
                            <div class="d-flex gap-2 mt-auto">
                                <a href="<?= base_url('pelatihan/peserta/detail_pelatihan/'.$p['id']) ?>" class="btn btn-dark flex-grow-1 rounded-pill fw-bold shadow-sm">DETAIL</a>
                                <a href="javascript:void(0)" class="btn btn-outline-danger flex-grow-1 rounded-pill fw-bold shadow-sm" onclick="confirmBatalkan('<?= base_url('pelatihan/peserta/batalkan_pelatihan/'.$p['pelatihan_id']) ?>', '<?= esc($p['nama'], 'js') ?>')">BATALKAN</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Belum Dimulai -->
        <div class="tab-pane fade" id="belum-dimulai" role="tabpanel">
            <div class="row g-4">
                <?php foreach ($belum_dimulai as $p): ?>
                <div class="col-md-4">
                    <div class="card h-100 border-top border-success border-4">
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark text-uppercase"><?= $p['nama'] ?></h5>
                            <p class="card-text small text-muted fw-bold mb-3"><i class="fas fa-hospital me-1 text-danger"></i> <?= strtoupper($p['penyelenggara']) ?></p>
                            <span class="badge bg-success text-white badge-status fw-bold border border-white mb-4">DISETUJUI</span>
                            <div class="d-flex flex-column gap-2 mt-auto">
                                <?php 
                                    $now = date('Y-m-d H:i:s');
                                    $mulai = $p['jadwal_mulai'] . ' ' . ($p['jam_mulai'] ?: '00:00:00');
                                    $waktu_selesai = $p['jadwal_selesai'] . ' ' . ($p['jam_selesai'] ?: '23:59:59');
                                    if ($now >= $mulai && $now <= $waktu_selesai):
                                ?>
                                    <a href="<?= base_url('pelatihan/peserta/belajar/'.$p['id']) ?>" class="btn w-100 rounded-pill fw-bold shadow-sm" style="background-color: var(--primary-red); color: white;">MULAI BELAJAR</a>
                                <?php elseif ($now < $mulai): ?>
                                    <button class="btn btn-secondary w-100 rounded-pill fw-bold shadow-sm" disabled>BELUM MULAI</button>
                                <?php else: ?>
                                    <button class="btn btn-secondary w-100 rounded-pill fw-bold shadow-sm" disabled>WAKTU HABIS</button>
                                <?php endif; ?>
                                <a href="javascript:void(0)" class="btn btn-outline-dark w-100 rounded-pill fw-bold shadow-sm" onclick="confirmBatalkan('<?= base_url('pelatihan/peserta/batalkan_pelatihan/'.$p['pelatihan_id']) ?>', '<?= esc($p['nama'], 'js') ?>')">BATALKAN</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Sedang Berjalan -->
        <div class="tab-pane fade" id="sedang-berjalan" role="tabpanel">
            <div class="row g-4">
                <?php foreach ($berjalan as $p): ?>
                <div class="col-md-4">
                    <div class="card h-100 border-top border-dark border-4">
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark text-uppercase"><?= $p['nama'] ?></h5>
                            <p class="card-text small text-muted fw-bold mb-3"><i class="fas fa-hospital me-1 text-danger"></i> <?= strtoupper($p['penyelenggara']) ?></p>
                            <div class="progress mb-2" style="height:12px; border-radius: 10px; background: #e2e8f0;"><div class="progress-bar bg-danger shadow-sm" style="width: <?= $p['progress'] ?>%;"></div></div>
                            <div class="d-flex justify-content-between mb-3">
                                <small class="text-dark fw-bold">PROGRES BELAJAR</small>
                                <small class="text-danger fw-bold"><?= round($p['progress']) ?>%</small>
                            </div>
                            <?php 
                                $now = date('Y-m-d H:i:s');
                                $mulai = $p['jadwal_mulai'] . ' ' . ($p['jam_mulai'] ?: '00:00:00');
                                $waktu_selesai = $p['jadwal_selesai'] . ' ' . ($p['jam_selesai'] ?: '23:59:59');
                                if ($now >= $mulai && $now <= $waktu_selesai):
                            ?>
                                <a href="<?= base_url('pelatihan/peserta/belajar/'.$p['id']) ?>" class="btn w-100 mt-auto rounded-pill fw-bold shadow-sm" style="background-color: var(--primary-red); color: white;">LANJUTKAN</a>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100 mt-auto rounded-pill fw-bold shadow-sm" disabled>MASA BERAKHIR</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Selesai -->
        <div class="tab-pane fade" id="selesai" role="tabpanel">
            <div class="row g-4">
                <?php foreach ($selesai as $p): ?>
                <div class="col-md-4">
                    <div class="card h-100 border-top border-primary-custom border-4">
                        <div class="card-body p-4 text-center">
                            <div class="bg-light p-3 rounded-circle d-inline-block mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-medal text-dark fs-4"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark text-uppercase"><?= $p['nama'] ?></h5>
                            <p class="card-text small text-muted fw-bold mb-3"><?= strtoupper($p['penyelenggara']) ?></p>
                            <span class="badge bg-dark text-white badge-status fw-bold px-4 py-2 rounded-pill">DIKULIAH SELESAI</span>
                            <a href="<?= base_url('pelatihan/peserta/sertifikat_saya') ?>" class="btn btn-primary-custom w-100 mt-4 rounded-pill fw-bold shadow-sm">LIHAT SERTIFIKAT</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Dibatalkan -->
        <div class="tab-pane fade" id="dibatalkan" role="tabpanel">
            <div class="row g-4">
                <?php foreach ($dibatalkan as $p): ?>
                <div class="col-md-4">
                    <div class="card h-100 bg-light border-0">
                        <div class="card-body p-4 text-center opacity-50">
                            <i class="fas fa-times-circle text-danger fs-1 mb-3"></i>
                            <h5 class="card-title fw-bold text-dark text-uppercase"><?= $p['nama'] ?></h5>
                            <p class="card-text small text-muted fw-bold"><?= strtoupper($p['penyelenggara']) ?></p>
                            <span class="badge bg-danger text-white badge-status fw-bold">DIBATALKAN</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>
    function confirmBatalkan(url, nama) {
        Swal.fire({
            title: '<span class="fw-bold fs-5 d-block mt-2">Batalkan Pelatihan?</span>',
            html: `<p class="text-muted fw-bold px-2">Apakah Anda yakin ingin membatalkan pendaftaran pelatihan <b>${nama}</b>?</p>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-times me-1"></i> Ya, Batalkan!',
            cancelButtonText: 'Kembali',
            customClass: { popup: 'rounded-4 shadow-lg border-0', confirmButton: 'rounded-pill px-4 py-2 fw-bold', cancelButton: 'rounded-pill px-4 py-2 fw-bold' }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
<?php echo $this->endSection(); ?>
