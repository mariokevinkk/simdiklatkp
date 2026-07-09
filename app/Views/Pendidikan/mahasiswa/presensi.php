<?= $this->include('Pendidikan/mahasiswa/layout/header') ?>
<?= $this->include('Pendidikan/mahasiswa/layout/sidebar') ?>

<div class="row">
    <div class="col-12 mb-4">
        <h4 class="fw-bold">Presensi Mahasiswa</h4>
        <p class="text-muted small mb-0">Riwayat kehadiran Anda selama masa diklat.</p>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 fw-bold">24 Apr 2026</td>
                                <td>07:15 WIB</td>
                                <td>16:05 WIB</td>
                                <td><span class="badge bg-success">Hadir</span></td>
                            </tr>
                            <tr>
                                <td class="ps-4 fw-bold">23 Apr 2026</td>
                                <td>07:10 WIB</td>
                                <td>16:00 WIB</td>
                                <td><span class="badge bg-success">Hadir</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-4">
            <h6 class="fw-bold text-muted mb-3 text-uppercase small">Status Hari Ini</h6>
            <div class="mb-3">
                <i class="fas fa-clock fa-3x text-light-danger mb-2" style="color: rgba(198, 40, 40, 0.2);"></i>
                <h5 class="fw-bold mb-0"><?= date('H:i') ?> WIB</h5>
                <p class="text-muted small"><?= date('d M Y') ?></p>
            </div>
            <hr>
            <div class="d-grid gap-2">
                <button class="btn btn-danger py-3 fw-bold shadow-sm" onclick="alert('Berhasil Absen Masuk!')">
                    <i class="fas fa-sign-in-alt me-2"></i> ABSEN MASUK
                </button>
                <button class="btn btn-outline-danger py-3 fw-bold" onclick="alert('Berhasil Absen Pulang!')" disabled>
                    <i class="fas fa-sign-out-alt me-2"></i> ABSEN PULANG
                </button>
            </div>
            <p class="text-muted small mt-3 italic">*Absen pulang dapat dilakukan minimal 8 jam setelah absen masuk.</p>
        </div>
</div>

<?= $this->include('Pendidikan/mahasiswa/layout/footer') ?>
