<?= $this->include('Pendidikan/mahasiswa/layout/header') ?>
<?= $this->include('Pendidikan/mahasiswa/layout/sidebar') ?>

<div class="row">
    <div class="col-12 mb-4">
        <h4 class="fw-bold">Jadwal Diklat</h4>
        <p class="text-muted small mb-0">Rencana rotasi stase Anda di RSUD.</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="fas fa-calendar-alt me-2 text-danger"></i> Agenda Rotasi Stase</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr class="small text-uppercase">
                                <th class="ps-4">Periode</th>
                                <th>Stase / Unit</th>
                                <th>Pembimbing (CI)</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-light-danger" style="background: rgba(198, 40, 40, 0.03);">
                                <td class="ps-4 fw-bold">01 Mei - 31 Mei 2026</td>
                                <td class="fw-bold">Poli Bedah</td>
                                <td>dr. H. Ahmad Fauzi, Sp.B</td>
                                <td><span class="badge bg-primary">Berjalan</span></td>
                            </tr>
                            <tr>
                                <td class="ps-4">01 Jun - 30 Jun 2026</td>
                                <td>Instalasi Gawat Darurat (IGD)</td>
                                <td>dr. Riska Amelia, Sp.EM</td>
                                <td><span class="badge bg-light text-muted">Mendatang</span></td>
                            </tr>
                            <tr>
                                <td class="ps-4">01 Jul - 31 Jul 2026</td>
                                <td>Poli Penyakit Dalam</td>
                                <td>dr. Budi Santoso, Sp.PD</td>
                                <td><span class="badge bg-light text-muted">Mendatang</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3 small text-uppercase text-muted">Stase Saat Ini</h6>
                <div class="p-3 rounded-3 mb-3" style="background: linear-gradient(135deg, var(--primary-red) 0%, #b71c1c 100%); color: white;">
                    <h5 class="fw-bold mb-1">Poli Bedah</h5>
                    <p class="small opacity-75 mb-0">Hingga 31 Mei 2026</p>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="fas fa-user-doctor text-muted"></i>
                    <span class="small fw-semibold">dr. H. Ahmad Fauzi, Sp.B</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-location-dot text-muted"></i>
                    <span class="small text-muted">Gedung B, Lantai 2</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('Pendidikan/mahasiswa/layout/footer') ?>
