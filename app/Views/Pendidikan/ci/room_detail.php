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
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #ffffffff; color: #0f0f0fff; }
        .dashboard-header {
            background: linear-gradient(135deg, #000000ff 0%, #500505ff 100%);
            color: white; padding: 2rem 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-custom {
            background: white; border-radius: 15px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand text-danger fw-bold" href="<?= site_url('pendidikan/ci/dashboard') ?>">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
            </a>
            <div class="d-flex align-items-center">
                <span class="text-muted fw-medium">Halo, <?= esc($ci_name) ?></span>
            </div>
        </div>
    </nav>

    <div class="dashboard-header mb-4">
        <div class="container">
            <h3 class="fw-bold mb-1">Ruangan: <?= esc($ruangan['nama_unit']) ?></h3>
            <p class="text-white-50 mb-0">Stase: <?= esc($stase['nama_stase']) ?></p>
        </div>
    </div>

    <div class="container">
        
        <!-- Action Buttons -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0"><i class="fas fa-users text-danger me-2"></i> Daftar Mahasiswa</h4>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-danger shadow-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                    <i class="fas fa-plus me-2"></i> Buat Tugas Baru
                </button>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary shadow-sm rounded-pill px-4 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-download me-2"></i> Download Rekap
                    </button>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="<?= site_url('pendidikan/ci/task/download/' . $stase['id'] . '/' . $ruangan['id_unit_kerja']) ?>"><i class="fas fa-tasks me-2 text-primary"></i> Rekap Tugas & Nilai</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card card-custom">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="tableMahasiswa">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>Institusi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($students as $index => $mhs): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="fw-bold"><?= esc($mhs['nama_lengkap']) ?></td>
                                <td><?= esc($mhs['nim']) ?></td>
                                <td><?= esc($mhs['nama_institusi'] ?? '-') ?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('pendidikan/ci/student/' . $stase['id'] . '/' . $ruangan['id_unit_kerja'] . '/' . $mhs['id']) ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Template Logbook Institusi -->
        <h4 class="fw-bold mb-4 mt-5"><i class="fas fa-university text-success me-2"></i> Template Logbook Institusi</h4>
        <div class="card card-custom mb-5">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tableInstitusi">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Institusi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($logbookInstitusi as $namaInstitusi => $file): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-bold"><?= esc($namaInstitusi) ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('uploads/dokumen_pengajuan/' . $file) ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                        <i class="fas fa-download ms-1"></i> Download Template
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Task List Summary -->
        <h4 class="fw-bold mb-4 mt-5"><i class="fas fa-tasks text-warning me-2"></i> Tugas yang Diberikan</h4>
        <div class="card card-custom">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="tableTugas">
                        <thead class="table-light">
                            <tr>
                                <th>Tugas</th>
                                <th>Deadline</th>
                                <th>Dibuat Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tasks as $tugas): ?>
                            <tr>
                                <td class="fw-bold">
                                    <?= esc($tugas['nama_tugas']) ?><br>
                                    <small class="text-muted fw-normal"><?= esc(word_limiter($tugas['deskripsi'], 10)) ?></small>
                                </td>
                                <td><span class="badge bg-danger rounded-pill"><i class="fas fa-clock me-1"></i> <?= date('d M Y H:i', strtotime($tugas['deadline'])) ?></span></td>
                                <td><?= date('d M Y', strtotime($tugas['created_at'])) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Create Task -->
    <div class="modal fade" id="createTaskModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Buat Tugas Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="formCreateTask">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Tugas</label>
                            <input type="text" class="form-control" name="nama_tugas" required placeholder="Contoh: Analisis Kasus ICU">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi (Opsional)</label>
                            <textarea class="form-control" name="deskripsi" rows="3" placeholder="Jelaskan detail tugas..."></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Batas Waktu (Deadline)</label>
                            <input type="datetime-local" class="form-control" name="deadline" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2" id="btnSubmitTask">
                            Simpan Tugas
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#tableMahasiswa').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json' }
            });
            $('#tableTugas').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json' },
                order: [[2, 'desc']] // Order by created_at desc
            });
            $('#tableInstitusi').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json' },
                paging: false,
                info: false,
                searching: false
            });
            // Handle Create Task
            $('#formCreateTask').on('submit', function(e) {
                e.preventDefault();
                const btn = $('#btnSubmitTask');
                const originalText = btn.html();
                
                btn.html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);

                const data = {
                    nama_tugas: $('input[name="nama_tugas"]').val(),
                    deskripsi: $('textarea[name="deskripsi"]').val(),
                    deadline: $('input[name="deadline"]').val(),
                    stase_id: <?= $stase['id'] ?>,
                    ruangan_id: <?= $ruangan['id_unit_kerja'] ?>
                };

                fetch('<?= site_url('pendidikan/ci/task/create') ?>', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: { 
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                })
                .then(r => r.json())
                .then(res => {
                    if(res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire('Gagal', res.message || 'Terjadi kesalahan', 'error');
                        btn.html(originalText).prop('disabled', false);
                    }
                })
                .catch(err => {
                    Swal.fire('Error', 'Gagal terhubung ke server', 'error');
                    btn.html(originalText).prop('disabled', false);
                });
            });
        });
    </script>
</body>
</html>
