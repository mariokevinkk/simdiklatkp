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
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
            color: #2c3e50;
        }
        .navbar-brand {
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .dashboard-header {
            background: linear-gradient(135deg, #040404ff 0%, #aa0404ff 100%);
            color: white;
            padding: 3rem 0;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
            margin-bottom: -40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .bg-icon-primary { background: rgba(52, 152, 219, 0.1); color: #3498db; }
        .bg-icon-success { background: rgba(46, 204, 113, 0.1); color: #2ecc71; }
        .bg-icon-warning { background: rgba(241, 196, 15, 0.1); color: #f1c40f; }
        
        .stase-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
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
        .stase-header h5 {
            margin: 0;
            font-weight: 700;
        }
        .room-item {
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f8f9fa;
            transition: background 0.2s;
            text-decoration: none;
            color: inherit;
        }
        .room-item:last-child {
            border-bottom: none;
        }
        .room-item:hover {
            background: #f8f9fa;
            color: #3498db;
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
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
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
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand text-danger" href="#">
                <i class="fas fa-stethoscope me-2"></i> SIM DIKLAT CI
            </a>
            <div class="d-flex align-items-center">
                <span class="text-muted fw-medium me-3">Halo, <?= esc($ci_name) ?></span>
                <a href="<?= site_url('pendidikan/login') ?>" class="btn btn-light rounded-pill px-4 fw-bold text-danger">Keluar</a>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="container">
            <h2 class="fw-bold mb-1">Dashboard Clinical Instructor</h2>
            <p class="text-white-50 mb-0">Kelola stase, ruangan, dan mahasiswa bimbingan Anda dengan mudah.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container" style="position: relative; z-index: 10; padding-top: 2rem;">
        
        <!-- Stats Row -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-icon-primary">
                        <i class="fas fa-route"></i>
                    </div>
                    <p class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Total Stase</p>
                    <h3 class="fw-bold mb-0"><?= count($stases) ?></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-icon-success">
                        <i class="fas fa-map-pin"></i>
                    </div>
                    <p class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Ruangan Aktif</p>
                    <h3 class="fw-bold mb-0"><?= esc($total_rooms) ?></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-icon-warning">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="text-muted fw-bold text-uppercase mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Total Mahasiswa</p>
                    <h3 class="fw-bold mb-0"><?= esc($total_mahasiswa) ?></h3>
                </div>
            </div>
        </div>

        <!-- Stase List -->
        <h4 class="fw-bold mb-4"><i class="fas fa-list-check me-2 text-danger"></i> Stase & Ruangan Anda</h4>
        
        <?php if(empty($stases)): ?>
            <div class="empty-state">
                <i class="fas fa-folder-open empty-icon"></i>
                <h4 class="fw-bold text-dark">Belum Ada Stase Ditugaskan</h4>
                <p class="text-muted mb-0">Anda belum ditempatkan di stase atau ruangan manapun. Hubungi Admin Diklat untuk pengaturan lebih lanjut.</p>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach($stases as $stase): ?>
                    <div class="col-lg-6">
                        <div class="stase-card">
                            <div class="stase-header">
                                <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                                    <i class="fas fa-route fa-lg"></i>
                                </div>
                                <div>
                                    <h5><?= esc($stase['nama_stase']) ?></h5>
                                    <small class="text-muted fw-medium"><?= count($stase['rooms']) ?> ruangan terdaftar</small>
                                </div>
                            </div>
                            <div class="stase-body">
                                <?php foreach($stase['rooms'] as $room): ?>
                                    <a href="<?= site_url('pendidikan/ci/room/' . $stase['stase_id'] . '/' . $room['ruangan_id']) ?>" class="room-item">
                                        <div class="d-flex align-items-center gap-3">
                                            <i class="fas fa-map-pin text-muted"></i>
                                            <div>
                                                <div class="fw-bold"><?= esc($room['nama_unit']) ?></div>
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

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
