<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; color: #2c3e50; }
        .dashboard-header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white; padding: 2rem 0; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-custom {
            background: white; border-radius: 15px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.05); margin-bottom: 2rem;
        }
        .nav-pills .nav-link {
            border-radius: 50px; font-weight: 600; color: #6c757d; padding: 0.5rem 1.5rem; margin-right: 0.5rem;
        }
        .nav-pills .nav-link.active {
            background-color: #3498db; color: white;
        }
        .status-badge {
            font-size: 0.75rem; padding: 0.35em 0.65em; border-radius: 50px; font-weight: 700;
        }
        .status-Disetujui, .status-Selesai { background-color: #d1e7dd; color: #0f5132; }
        .status-Revisi { background-color: #f8d7da; color: #842029; }
        .status-Pending, .status-Belum { background-color: #fff3cd; color: #664d03; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand text-primary fw-bold" href="<?= site_url('pendidikan/ci/room/' . $stase['id'] . '/' . $ruangan['id_unit_kerja']) ?>">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Ruangan
            </a>
            <div class="d-flex align-items-center">
                <span class="text-muted fw-medium">Halo, <?= esc($ci_name) ?></span>
            </div>
        </div>
    </nav>

    <div class="dashboard-header mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1"><?= esc($student['nama_lengkap']) ?></h3>
                <p class="text-white-50 mb-0"><?= esc($student['nim']) ?> • <?= esc($student['nama_institusi'] ?? '-') ?></p>
            </div>
            <div class="text-end text-white-50">
                <small class="d-block">Stase: <?= esc($stase['nama_stase']) ?></small>
                <small class="d-block">Ruangan: <?= esc($ruangan['nama_unit']) ?></small>
            </div>
        </div>
    </div>

    <div class="container">
        
        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active shadow-sm" id="pills-logbook-tab" data-bs-toggle="pill" data-bs-target="#pills-logbook" type="button">Logbook Mahasiswa</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link shadow-sm" id="pills-tugas-tab" data-bs-toggle="pill" data-bs-target="#pills-tugas" type="button">Tugas & Nilai</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <!-- LOGBOOK TAB -->
            <div class="tab-pane fade show active" id="pills-logbook">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <?php if(empty($logbooks)): ?>
                            <div class="text-center py-5 text-muted">
                                <i class="fas fa-book-open fa-3x mb-3 text-light"></i>
                                <h5>Belum ada logbook yang diisi</h5>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Terakhir Diperbarui</th>
                                            <th>Detail Laporan</th>
                                            <th>Lampiran PDF</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($logbooks as $lb): ?>
                                            <tr>
                                                <td>
                                                    <?= date('d M Y, H:i', strtotime($lb['updated_at'])) ?>
                                                    <?php if($lb['updated_at'] !== $lb['created_at']): ?>
                                                        <br><small class="text-primary">(Diperbarui)</small>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <strong><?= esc($lb['judul_kegiatan']) ?></strong><br>
                                                    <small class="text-muted"><?= esc(word_limiter($lb['deskripsi_kegiatan'], 10)) ?></small>
                                                </td>
                                                <td>
                                                    <?php if($lb['file_lampiran']): ?>
                                                        <a href="<?= base_url('uploads/pendidikan/logbookmhs/' . $lb['file_lampiran']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="fas fa-paperclip"></i> Lihat</a>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="status-badge status-<?= $lb['status_validasi'] ?? 'Pending' ?>">
                                                        <?= esc($lb['status_validasi'] ?? 'Pending') ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary rounded-pill px-3" onclick="openValidateModal(<?= $lb['id'] ?>, '<?= esc(htmlspecialchars($lb['judul_kegiatan'], ENT_QUOTES)) ?>', '<?= $lb['status_validasi'] ?>', '<?= esc(htmlspecialchars($lb['catatan_ci'] ?? '', ENT_QUOTES)) ?>')">Validasi</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- TUGAS TAB -->
            <div class="tab-pane fade" id="pills-tugas">
                <div class="card card-custom">
                    <div class="card-body p-4">
                        <?php if(empty($tasks)): ?>
                            <div class="text-center py-5 text-muted">
                                <i class="fas fa-tasks fa-3x mb-3 text-light"></i>
                                <h5>Belum ada tugas di ruangan ini</h5>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tugas</th>
                                            <th>Berkas Mahasiswa</th>
                                            <th>Status</th>
                                            <th>Nilai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($tasks as $t): ?>
                                            <?php $sub = $t['submission']; ?>
                                            <tr>
                                                <td>
                                                    <strong><?= esc($t['nama_tugas']) ?></strong><br>
                                                    <small class="text-danger"><i class="fas fa-clock"></i> Deadline: <?= date('d M Y H:i', strtotime($t['deadline'])) ?></small><br>
                                                    <small class="text-muted"><i class="fas fa-user-md text-primary"></i> CI: <?= esc($t['ci_name_giver']) ?> &nbsp;|&nbsp; <i class="fas fa-hospital text-success"></i> <?= esc($t['ruangan_name']) ?></small>
                                                </td>
                                                <td>
                                                    <?php if($sub): ?>
                                                        <?php if($sub['file_tugas']): ?>
                                                            <a href="<?= base_url('uploads/pendidikan/tugasmhs/' . $sub['file_tugas']) ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fas fa-file-download"></i> Unduh Berkas</a>
                                                        <?php endif; ?>
                                                        <?php if($sub['catatan_mahasiswa']): ?>
                                                            <div class="mt-1 small text-muted">Catatan: <?= esc($sub['catatan_mahasiswa']) ?></div>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="text-muted small fst-italic">Belum mengumpulkan</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php $status = $sub ? ($sub['status'] ?? 'Menunggu Nilai') : 'Belum'; ?>
                                                    <span class="status-badge status-<?= str_replace(' ', '', $status) ?>"><?= $status ?></span>
                                                </td>
                                                <td class="fw-bold text-primary">
                                                    <?= $sub && $sub['nilai'] !== null ? $sub['nilai'] : '-' ?>
                                                </td>
                                                <td>
                                                    <?php if($sub): ?>
                                                        <button class="btn btn-sm btn-success rounded-pill px-3" onclick="openGradeModal(<?= $sub['id'] ?>, '<?= esc(htmlspecialchars($t['nama_tugas'], ENT_QUOTES)) ?>', '<?= $sub['nilai'] ?? '' ?>', '<?= esc(htmlspecialchars($sub['catatan_ci'] ?? '', ENT_QUOTES)) ?>')">Beri Nilai</button>
                                                    <?php else: ?>
                                                        <button class="btn btn-sm btn-secondary rounded-pill px-3" disabled>Beri Nilai</button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Validate Logbook -->
    <div class="modal fade" id="validateModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Validasi Logbook</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="formValidateLogbook">
                        <input type="hidden" id="val_logbook_id">
                        <div class="mb-3">
                            <label class="form-label text-muted small">Kegiatan</label>
                            <div id="val_kegiatan_title" class="fw-bold"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status Validasi</label>
                            <select class="form-select" id="val_status" required>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Revisi">Revisi</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Catatan CI</label>
                            <textarea class="form-control" id="val_catatan" rows="3" placeholder="Berikan saran/masukan (opsional)..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2" id="btnSubmitValidate">
                            Simpan Validasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Grade Tugas -->
    <div class="modal fade" id="gradeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Penilaian Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="formGradeTugas">
                        <input type="hidden" id="grade_submission_id">
                        <div class="mb-3">
                            <label class="form-label text-muted small">Tugas</label>
                            <div id="grade_tugas_title" class="fw-bold"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nilai (0-100)</label>
                            <input type="number" class="form-control form-control-lg text-center fw-bold text-primary" id="grade_nilai" min="0" max="100" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Catatan Evaluasi CI</label>
                            <textarea class="form-control" id="grade_catatan" rows="3" placeholder="Tulis catatan..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold py-2" id="btnSubmitGrade">
                            Simpan Nilai
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const baseUrl = '<?= rtrim(site_url(), '/') . '/' ?>';

        function openValidateModal(id, title, status, catatan) {
            $('#val_logbook_id').val(id);
            $('#val_kegiatan_title').text(title);
            $('#val_status').val(status || 'Disetujui');
            $('#val_catatan').val(catatan);
            new bootstrap.Modal(document.getElementById('validateModal')).show();
        }

        function openGradeModal(id, title, nilai, catatan) {
            $('#grade_submission_id').val(id);
            $('#grade_tugas_title').text(title);
            $('#grade_nilai').val(nilai);
            $('#grade_catatan').val(catatan);
            new bootstrap.Modal(document.getElementById('gradeModal')).show();
        }

        // Handle Logbook Validation
        $('#formValidateLogbook').on('submit', function(e) {
            e.preventDefault();
            const btn = $('#btnSubmitValidate');
            btn.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
            
            fetch(baseUrl + 'pendidikan/ci/logbook/validate/' + $('#val_logbook_id').val(), {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    status_validasi: $('#val_status').val(),
                    catatan_ci: $('#val_catatan').val()
                })
            }).then(r => r.json()).then(res => {
                if(res.success) window.location.reload();
                else { Swal.fire('Gagal', res.message, 'error'); btn.html('Simpan Validasi').prop('disabled', false); }
            });
        });

        // Handle Tugas Grading
        $('#formGradeTugas').on('submit', function(e) {
            e.preventDefault();
            const btn = $('#btnSubmitGrade');
            btn.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
            
            fetch(baseUrl + 'pendidikan/ci/task/grade/' + $('#grade_submission_id').val(), {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    nilai: $('#grade_nilai').val(),
                    catatan_ci: $('#grade_catatan').val()
                })
            }).then(r => r.json()).then(res => {
                if(res.success) window.location.reload();
                else { Swal.fire('Gagal', res.message, 'error'); btn.html('Simpan Nilai').prop('disabled', false); }
            });
        });
    </script>
</body>
</html>
