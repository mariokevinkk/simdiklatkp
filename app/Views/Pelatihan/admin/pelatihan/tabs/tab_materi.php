            <!-- Tab Materi -->
            <div class="tab-pane fade" id="tab-materi" role="tabpanel">
                <div class="card border-0 shadow-sm rounded-lg p-0 bg-white overflow-hidden border-top border-danger border-4">
                    <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-layer-group me-2 text-danger"></i> Daftar Materi Pembelajaran</h5>
                        <button class="btn btn-dark btn-sm rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahMateri">
                            <i class="fas fa-plus me-2 text-warning"></i> TAMBAH MATERI
                        </button>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr class="text-dark small fw-bold">
                                    <th class="ps-4 py-3">JUDUL & DESKRIPSI</th>
                                    <th class="text-center">TIPE</th>
                                    <th class="pe-4 text-end">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($materi)): ?>
                                    <tr><td colspan="3" class="text-center py-5 text-muted fw-bold">BELUM ADA MATERI TERSEDIA</td></tr>
                                <?php else: foreach($materi as $m): ?>
                                    <tr class="hover-bg-light">
                                        <td class="ps-4 py-3">
                                            <div class="fw-bold text-dark fs-6">
                                                <?= strtoupper($m['judul']) ?>
                                                <?php 
                                                    if (!empty($m['sesi_id']) && !empty($sesiList)) {
                                                        foreach ($sesiList as $s) {
                                                            if ($s['id'] == $m['sesi_id']) {
                                                                echo ' <span class="badge bg-light text-dark border ms-2" style="font-size:0.6rem;"><i class="fas fa-video me-1"></i> ' . htmlspecialchars($s['nama_sesi']) . '</span>';
                                                                break;
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </div>
                                            <div class="text-muted fw-bold mt-1" style="font-size: 0.65rem; max-width: 400px;"><?= $m['deskripsi'] ?? 'Tidak ada deskripsi' ?></div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-dark text-white rounded-pill px-3 py-2 fw-bold" style="font-size: 0.6rem; border: 1px solid var(--primary-yellow);"><?= strtoupper($m['tipe'] ?? 'N/A') ?></span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <?php if(!empty($m['file_path'])): ?>
                                                <a href="<?= base_url($m['file_path']) ?>" target="_blank" class="btn btn-white btn-sm rounded-pill shadow-sm border px-3 fw-bold text-primary" title="Preview"><i class="fas fa-eye me-1"></i> PREVIEW</a>
                                                <?php endif; ?>
                                                <button onclick="editMateri(<?= htmlspecialchars(json_encode($m)) ?>)" class="btn btn-white btn-sm rounded-pill shadow-sm border px-3 fw-bold text-dark" title="Edit"><i class="fas fa-edit me-1 text-danger"></i> EDIT</button>
                                                <a href="<?= base_url('pelatihan/admin/pelatihan/materi/hapus/' . $m['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')" class="btn btn-white btn-sm rounded-pill shadow-sm border px-3 fw-bold text-danger" title="Hapus"><i class="fas fa-trash me-1"></i> HAPUS</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

