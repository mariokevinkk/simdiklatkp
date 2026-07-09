            <!-- Tab Presensi -->
            <div class="tab-pane fade" id="tab-presensi" role="tabpanel">
                <div class="card border-0 shadow-sm rounded-lg p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Manajemen Sesi & Presensi</h5>
                        <button class="btn btn-success btn-sm rounded-pill px-4" onclick="addSesi()">
                            <i class="fas fa-plus me-2"></i> Tambah Sesi
                        </button>
                    </div>

                    <div id="sesiContainer">
                        <div class="card border bg-light mb-3">
                            <div class="card-body p-3">
                                <div class="row g-2 align-items-center">
                                    <div class="col-md-1 text-center"><span class="badge bg-success rounded-circle p-2">1</span></div>
                                    <div class="col-md-3">
                                        <label class="small text-muted d-block">Nama Sesi</label>
                                        <input type="text" class="form-control form-control-sm" value="Sesi Pagi (Pembukaan)">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="small text-muted d-block">Tanggal</label>
                                        <input type="date" class="form-control form-control-sm" value="<?= $p['jadwal_mulai'] ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="small text-muted d-block">Waktu</label>
                                        <input type="time" class="form-control form-control-sm" value="08:00">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small text-muted d-block">Lokasi/Ruang</label>
                                        <input type="text" class="form-control form-control-sm" value="Aula Utama">
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <button class="btn btn-link text-danger p-0"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="<?= base_url('pelatihan/admin/presensi/'.$p['id']) ?>" class="btn btn-outline-success px-5 rounded-pill fw-bold btn-sm">
                            <i class="fas fa-users me-2"></i> Monitoring Kehadiran Peserta
                        </a>
                    </div>
                </div>
            </div>

