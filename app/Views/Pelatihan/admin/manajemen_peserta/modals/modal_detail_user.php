<div class="modal fade" id="modalDetailUser" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-lg overflow-hidden">
            <div class="modal-header bg-dark text-white border-0 p-4 border-bottom border-danger border-4">
                <h5 class="modal-title fw-bold text-uppercase"><i class="fas fa-id-card me-2 text-warning"></i> PROFIL LENGKAP PESERTA</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                
                <div class="section-title">Role & Status Akun</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">ROLE SISTEM</label>
                        <input type="text" class="form-control bg-white fw-bold" id="det_role" readonly style="color: #64748b;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">STATUS AKTIVASI</label>
                        <input type="text" class="form-control bg-white fw-bold text-success" value="AKTIF / TERVERIFIKASI" readonly>
                    </div>
                </div>

                <div class="section-title">Informasi Dasar</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">NAMA LENGKAP</label>
                        <input type="text" class="form-control bg-white fw-bold" id="det_nama" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">NIK (16 DIGIT)</label>
                        <input type="text" class="form-control bg-white fw-bold" id="det_nik" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">EMAIL AKTIF</label>
                        <input type="email" class="form-control bg-white fw-bold" id="det_email" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">NO. WHATSAPP</label>
                        <input type="tel" class="form-control bg-white fw-bold" id="det_wa" readonly>
                    </div>
                </div>

                <div class="section-title">Informasi Profesi</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">UNIT KERJA / INSTANSI</label>
                        <input type="text" class="form-control bg-white fw-bold" id="det_instansi" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">PROFESI</label>
                        <input type="text" class="form-control bg-white fw-bold" id="det_profesi" readonly>
                    </div>
                </div>

                <div class="section-title">Target & Capaian JPL</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">TARGET JPL TAHUNAN</label>
                        <input type="text" class="form-control bg-white fw-bold" id="det_target_jpl" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold mb-1">CAPAIAN JPL SEKARANG</label>
                        <input type="text" class="form-control bg-white fw-bold" id="det_capaian_jpl" readonly>
                    </div>
                </div>

                <div class="section-title" id="jpl_tracking_title">Capaian JPL Tahunan</div>
                <div class="row g-3 mb-2" id="jpl_tracking_box">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center gap-3 px-4 py-3 bg-white border shadow-sm" style="border-radius: 12px; border-color: #f1f5f9 !important;">
                            <div class="progress flex-grow-1" style="height: 12px; border-radius: 6px; background: #e2e8f0;">
                                <div class="progress-bar bg-danger shadow-sm" id="det_jpl_bar" style="width: 0%"></div>
                            </div>
                            <div class="fw-bold text-dark" id="det_jpl_val">0%</div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="button" class="btn btn-dark w-100 btn-register-submit" style="background:#1e293b; box-shadow: 0 8px 16px rgba(30, 41, 59, 0.2);" data-bs-dismiss="modal">
                        TUTUP PROFIL <i class="fas fa-times ms-2"></i>
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</div>

