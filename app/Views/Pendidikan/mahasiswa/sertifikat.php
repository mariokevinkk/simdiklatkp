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
        <i class="fas fa-medal fa-4x text-warning opacity-25"></i>
    </div>
    <h5 class="fw-bold">Sertifikat Belum Tersedia</h5>
    <p class="text-muted mx-auto mb-4" style="max-width: 400px;">
        Sertifikat akan muncul di sini setelah Anda menyelesaikan masa diklat dan semua penilaian telah diverifikasi oleh pihak Diklat RSUD.
    </p>
    <div class="d-flex justify-content-center gap-2">
        <button class="btn btn-light disabled">Unduh Sertifikat (PDF)</button>
        <button class="btn btn-light disabled">Lihat Transkrip</button>
    </div>
</div>

<?= $this->include('Pendidikan/mahasiswa/layout/footer') ?>
