<div class="modal fade" id="modalKelolaFeedback" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow rounded-lg">
            <div class="modal-header bg-dark text-white border-0">
                <h5 class="modal-title fw-bold small"><i class="fas fa-edit me-2"></i> Pengaturan Kuesioner Evaluasi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 bg-light" style="max-height: 70vh; overflow-y: auto;">
                <div class="alert alert-warning border-0 small shadow-sm mb-4">
                    <i class="fas fa-info-circle me-2"></i> Kuesioner ini menggunakan skala Likert (1-5) untuk mengukur tingkat kepuasan peserta.
                </div>

                <!-- Form Tambah Pertanyaan -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-bold small text-primary"><i class="fas fa-plus me-1"></i> Tambah Pertanyaan Kuesioner</div>
                    <div class="card-body">
                        <form id="formTambahKuesioner" onsubmit="simpanKuesioner(event)">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Pilih Kategori</label>
                                    <select class="form-select form-select-sm" name="kategori" id="kuesioner_kategori" onchange="toggleKategoriBaru(this.value)">
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="baru">+ Buat Kategori Baru</option>
                                    </select>
                                </div>
                                <div class="col-md-6" id="kategori_baru_container" style="display: none;">
                                    <label class="form-label small fw-bold">Nama Kategori Baru</label>
                                    <input type="text" class="form-control form-control-sm" name="kategori_baru" id="kuesioner_kategori_baru" placeholder="Contoh: Fasilitator">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Pertanyaan</label>
                                <textarea class="form-control form-control-sm" name="pertanyaan" rows="2" placeholder="Masukkan pertanyaan..." required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4"><i class="fas fa-save me-1"></i> Simpan Pertanyaan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <hr>

                <!-- Daftar Kuesioner -->
                <div id="kuesionerContainer">
                    <div class="text-center text-muted small py-4"><i class="fas fa-spinner fa-spin me-2"></i> Memuat kuesioner...</div>
                </div>

            </div>
            <div class="modal-footer border-0 bg-white d-flex justify-content-between">
                <button type="button" class="btn btn-info text-white rounded-pill px-4 shadow-sm" onclick="previewKuesioner()"><i class="fas fa-eye me-1"></i> Preview Kuesioner</button>
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Kuesioner -->
