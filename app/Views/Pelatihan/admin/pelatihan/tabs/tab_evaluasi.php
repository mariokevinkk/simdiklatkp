            <div class="tab-pane fade" id="tab-evaluasi" role="tabpanel">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-lg p-4 h-100 border-top border-danger border-4">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="fw-bold text-danger mb-0"><i class="fas fa-file-signature me-2"></i> PRE-TEST</h6>
                                <span class="badge bg-light text-dark border small">Wajib</span>
                            </div>
                            <p class="small text-muted mb-4">Ujian awal untuk mengukur baseline kompetensi peserta.</p>
                            <div class="d-grid">
                                <button class="btn btn-light border btn-sm py-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#modalKelolaQuiz" onclick="setupQuiz('Pre-Test')">
                                    <i class="fas fa-cog me-2"></i> Kelola Soal & KKM
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-lg p-4 h-100 border-top border-warning border-4">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="fw-bold text-warning mb-0"><i class="fas fa-award me-2"></i> POST-TEST</h6>
                                <span class="badge bg-warning-subtle text-warning small">Min. 80</span>
                            </div>
                            <p class="small text-muted mb-4">Ujian penentu kelulusan dan penerbitan sertifikat.</p>
                            <div class="d-grid">
                                <button class="btn btn-light border btn-sm py-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#modalKelolaQuiz" onclick="setupQuiz('Post-Test')">
                                    <i class="fas fa-cog me-2"></i> Kelola Soal & KKM
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

