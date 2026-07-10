<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <!-- No Cache Meta Tags -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="<?= base_url('assets/img/logo_rs.jpg') ?>">

    <style>
        :root {
            --primary-red: #c62828;
            --dark-bg: #1a1a1a;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-dark {
            background-color: var(--dark-bg) !important;
            border-bottom: 3px solid var(--primary-red);
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            padding-top: 70px;
            z-index: 100;
            transition: left 0.3s ease;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding-top: 90px;
            padding-bottom: 40px;
            min-height: 100vh;
        }

        .nav-link {
            padding: 12px 20px;
            color: #555;
            font-weight: 500;
            border-left: 4px solid transparent;
            transition: all 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-red);
            background-color: rgba(198, 40, 40, 0.05);
            border-left-color: var(--primary-red);
        }

        .nav-link i {
            width: 25px;
            margin-right: 10px;
        }

        .card-custom {
            background: white; 
            border-radius: 12px; 
            border: none; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        /* Mobile Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                left: calc(var(--sidebar-width) * -1);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.show {
                left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= base_url('assets/img/logo_rs.jpg') ?>" alt="Logo" width="40" class="me-2">
                <span class="fw-bold">SIM DIKLAT <span style="color: var(--primary-red);">RSUD</span></span>
            </a>
            <button class="navbar-toggler" type="button" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> <?= esc($ci_name) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= site_url('pendidikan/login') ?>"><i
                                        class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebarMenu">
        <div class="d-flex flex-column">
            <div class="px-4 mb-4 mt-2">
                <p class="text-uppercase small fw-bold text-muted mb-2">Main Menu</p>
            </div>
            
            <nav class="nav flex-column">
                <a class="nav-link" href="<?= site_url('pendidikan/ci/dashboard') ?>">
                    <i class="fas fa-arrow-left"></i> Kembali Dashboard
                </a>
                
                <div class="px-4 mb-2 mt-4">
                    <p class="text-uppercase small fw-bold text-muted mb-0">Sistem</p>
                </div>
                
                <a class="nav-link" href="<?= site_url('pendidikan/logout') ?>">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid px-4">
            
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="fw-bold mb-1">Ruangan: <?= esc($ruangan['nama_unit']) ?></h3>
                    <p class="text-muted mb-0">Stase: <?= esc($stase['nama_stase']) ?></p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <h5 class="fw-bold mb-0"><i class="fas fa-users me-2" style="color: var(--primary-red);"></i> Daftar Mahasiswa</h5>
                <div class="d-flex gap-2">
                    <button type="button" class="btn text-white shadow-sm rounded-pill px-4" style="background-color: var(--primary-red); border-color: var(--primary-red);" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                        <i class="fas fa-plus me-2"></i> Buat Tugas Baru
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary shadow-sm rounded-pill px-4 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-download me-2"></i> Download Rekap
                        </button>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="<?= site_url('pendidikan/ci/task/download/' . $stase['id'] . '/' . $ruangan['id_unit_kerja']) ?>"><i class="fas fa-tasks me-2" style="color: var(--primary-red);"></i> Rekap Tugas & Nilai</a></li>
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
                                        <a href="<?= site_url('pendidikan/ci/student/' . $stase['id'] . '/' . $ruangan['id_unit_kerja'] . '/' . $mhs['id']) ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3">
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
            <h5 class="fw-bold mb-4 mt-5"><i class="fas fa-university text-success me-2"></i> Template Logbook Institusi</h5>
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
            <h5 class="fw-bold mb-4 mt-5"><i class="fas fa-tasks text-warning me-2"></i> Tugas yang Diberikan</h5>
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
    </div>

    <!-- Modal Create Task -->
    <div class="modal fade" id="createTaskModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
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
                        <button type="submit" class="btn text-white w-100 rounded-pill fw-bold py-2" style="background-color: var(--primary-red); border-color: var(--primary-red);" id="btnSubmitTask">
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
            // Mobile toggle
            $('.navbar-toggler').on('click', function() {
                $('#sidebarMenu').toggleClass('show');
            });

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
