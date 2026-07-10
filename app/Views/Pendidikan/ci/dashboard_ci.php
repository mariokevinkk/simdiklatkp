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

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
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
        
        .stase-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: none;
            margin-bottom: 1.5rem;
        }
        
        .stase-header {
            padding: 1.5rem;
            border-bottom: 1px solid #f1f2f6;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .room-item {
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f8f9fa;
            text-decoration: none;
            color: inherit;
        }
        
        .room-item:last-child {
            border-bottom: none;
        }
        
        .room-item:hover {
            background: rgba(198, 40, 40, 0.05);
            color: var(--primary-red);
        }
        
        .room-badge {
            background: #f1f2f6;
            color: #2c3e50;
            font-weight: 700;
            padding: 0.4rem 0.8rem;
            border-radius: 10px;
            font-size: 0.85rem;
        }
        
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .empty-icon {
            font-size: 4rem;
            color: #dfe4ea;
            margin-bottom: 1.5rem;
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
                <a class="nav-link active" href="<?= site_url('pendidikan/ci/dashboard') ?>">
                    <i class="fas fa-th-large"></i> Dashboard
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
            
            <div class="row">
                <div class="col-12 mb-4">
                    <h4 class="fw-bold">Selamat Datang, <?= esc($ci_name) ?></h4>
                    <p class="text-muted">Pantau status stase, ruangan, dan mahasiswa bimbingan Anda.</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-white" style="border-bottom: 4px solid var(--primary-red);">
                        <div class="card-body py-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="text-uppercase small text-muted mb-2">Total Stase</h6>
                                    <h2 class="mb-0 fw-bold text-dark"><?= count($stases) ?></h2>
                                </div>
                                <i class="fas fa-route fa-2x" style="color: var(--primary-red); opacity: 0.5;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-white" style="border-bottom: 4px solid #4caf50;">
                        <div class="card-body py-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="text-uppercase small text-muted mb-2">Ruangan Aktif</h6>
                                    <h2 class="mb-0 fw-bold text-dark"><?= esc($total_rooms) ?></h2>
                                </div>
                                <i class="fas fa-map-pin fa-2x text-success" style="opacity: 0.5;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-white" style="border-bottom: 4px solid #ff9800;">
                        <div class="card-body py-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="text-uppercase small text-muted mb-2">Total Mahasiswa</h6>
                                    <h2 class="mb-0 fw-bold text-dark"><?= esc($total_mahasiswa) ?></h2>
                                </div>
                                <i class="fas fa-users fa-2x text-warning" style="opacity: 0.5;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="fw-bold mb-3 mt-2"><i class="fas fa-list-check me-2" style="color: var(--primary-red);"></i> Stase & Ruangan Anda</h5>
            
            <?php if(empty($stases)): ?>
                <div class="empty-state">
                    <i class="fas fa-folder-open empty-icon"></i>
                    <h5 class="fw-bold text-dark">Belum Ada Stase Ditugaskan</h5>
                    <p class="text-muted mb-0">Anda belum ditempatkan di stase atau ruangan manapun. Hubungi Admin Diklat untuk pengaturan lebih lanjut.</p>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($stases as $stase): ?>
                        <div class="col-lg-6">
                            <div class="stase-card">
                                <div class="stase-header">
                                    <div class="p-2 rounded-3" style="background-color: rgba(198, 40, 40, 0.1); color: var(--primary-red);">
                                        <i class="fas fa-route fa-lg"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold"><?= esc($stase['nama_stase']) ?></h6>
                                        <small class="text-muted fw-medium"><?= count($stase['rooms']) ?> ruangan terdaftar</small>
                                    </div>
                                </div>
                                <div class="stase-body">
                                    <?php foreach($stase['rooms'] as $room): ?>
                                        <a href="<?= site_url('pendidikan/ci/room/' . $stase['stase_id'] . '/' . $room['ruangan_id']) ?>" class="room-item">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="fas fa-map-pin text-muted"></i>
                                                <div>
                                                    <div class="fw-bold text-dark"><?= esc($room['nama_unit']) ?></div>
                                                    <small class="text-muted">Klik untuk melihat detail ruangan</small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="room-badge"><?= esc($room['mahasiswa_count']) ?> Mahasiswa</span>
                                                <i class="fas fa-chevron-right text-muted"></i>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Mobile toggle
            $('.navbar-toggler').on('click', function() {
                $('#sidebarMenu').toggleClass('show');
            });
        });
    </script>
</body>
</html>
