            <div class="tab-pane fade" id="tab-feedback" role="tabpanel">
                <div class="card border-0 shadow-sm rounded-lg p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Evaluasi Pelatihan (Kuesioner)</h5>
                        <button class="btn btn-secondary btn-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalKelolaFeedback">
                            <i class="fas fa-edit me-2"></i> Edit Kuesioner
                        </button>
                    </div>
                    <div class="row g-3" id="kuesionerTabContainer">
                        <?php if (empty($kuesioner)): ?>
                            <div class="col-12 text-center text-muted py-5">
                                <i class="fas fa-inbox fa-3x mb-3 text-light"></i>
                                <h6>Belum ada pertanyaan kuesioner.</h6>
                                <p class="small mb-0">Klik "Edit Kuesioner" untuk menambahkan atau menggunakan template.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($kuesioner as $kat => $pertanyaanList): ?>
                                <div class="col-md-4">
                                    <div class="p-3 border rounded-lg bg-light h-100">
                                        <h6 class="fw-bold small text-primary text-uppercase mb-3"><i class="fas fa-list-ul me-2"></i> <?= esc($kat) ?></h6>
                                        <ul class="list-unstyled small text-muted">
                                            <?php foreach ($pertanyaanList as $p): ?>
                                                <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> <?= esc($p['pertanyaan']) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

