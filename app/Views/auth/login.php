<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NusaLMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="auth-container">

<div class="auth-card shadow-lg">
    <div class="text-center mb-4">
        <div class="bg-primary-custom rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
            <i class="fas fa-graduation-cap text-white fa-2x"></i>
        </div>
        <h3 class="fw-bold">NusaLMS</h3>
        <p class="text-muted">Masuk ke akun pembelajaran Anda</p>
    </div>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger border-0 small py-2 mb-3">
            <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 small py-2 mb-3">
            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('auth/login') ?>" method="POST">
        <div class="mb-3">
            <label class="form-label small fw-bold">Email Address</label>
            <div class="input-group">
                <span class="input-group-text border-end-0 bg-transparent text-muted"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="admin@gmail.com" required>
            </div>
        </div>
        <div class="mb-4">
            <div class="d-flex justify-content-between">
                <label class="form-label small fw-bold">Password</label>
                <a href="#" class="text-decoration-none small text-primary-custom">Lupa Password?</a>
            </div>
            <div class="input-group">
                <span class="input-group-text border-end-0 bg-transparent text-muted"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="admin123" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary-custom w-100 py-2 rounded-pill fw-bold mb-3">
            MASUK SEKARANG <i class="fas fa-arrow-right ms-2"></i>
        </button>
        <div class="text-center">
            <p class="small text-muted mb-0">Belum punya akun? <a href="<?= base_url('register') ?>" class="text-primary-custom fw-bold text-decoration-none">Daftar Gratis</a></p>
        </div>
    </form>
    
    <div class="mt-4 pt-3 border-top">
        <div class="small text-center text-muted mb-2">Login Demo:</div>
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <span class="badge bg-light text-dark border p-2">admin@gmail.com / admin123</span>
            <span class="badge bg-light text-dark border p-2">nakes@gmail.com / 123456</span>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
