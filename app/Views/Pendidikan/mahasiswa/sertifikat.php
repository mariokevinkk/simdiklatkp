<?= $this->include('Pendidikan/mahasiswa/layout/header') ?>
<?= $this->include('Pendidikan/mahasiswa/layout/sidebar') ?>

<div class="row">
    <div class="col-12 mb-4">
        <h4 class="fw-bold">Sertifikat Diklat</h4>
        <p class="text-muted small mb-0">Unduh sertifikat setelah menyelesaikan masa diklat.</p>
    </div>
</div>

<div class="card border-0 shadow-sm text-center p-5">
    <div class="mb-4">
        <i class="fas fa-medal fa-4x text-success"></i>
    </div>
    <h5 class="fw-bold">Sertifikat Tersedia</h5>
    <p class="text-muted mx-auto mb-4" style="max-width: 400px;">
        Selamat! Anda telah menyelesaikan masa diklat dan semua penilaian telah diverifikasi. Anda sekarang dapat mengunduh sertifikat Anda.
    </p>
    <div class="d-flex justify-content-center gap-2">
        <a href="<?= base_url('pendidikan/mahasiswa/sertifikat/download') ?>" target="_blank" class="btn btn-primary">
            <i class="fas fa-download me-1"></i> Unduh Sertifikat (PDF)
        </a>
    </div>
</div>

<?= $this->include('Pendidikan/mahasiswa/layout/footer') ?>
