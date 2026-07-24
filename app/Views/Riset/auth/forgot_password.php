<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Lupa Password' ?> - SIM DIKLAT RSUD Yogyakarta</title>
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="<?= base_url('assets/img/logo_rs.jpg') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-red: #e53935;
            --jakarta: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            font-family: var(--jakarta);
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://img-kd.kalbe.co.id/wGqDuQeO_pgL96fkCEHD5AyfMnw=/fit-in/615x480/filters:quality(90)/oneonco-prd/faskes/34711003_RSUD_Kota_Yogyakarta.webp') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 2;
        }

        .card-header-riset {
            background: #fff;
            padding: 45px 30px 20px;
            text-align: center;
            position: relative;
        }

        .card-header-riset h4 {
            color: #1a1a1a;
            font-weight: 800;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
            font-size: 22px;
        }

        .card-header-riset p {
            color: #666;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 0;
            line-height: 1.5;
        }

        .card-body-riset {
            padding: 20px 40px 45px;
        }

        .form-label-riset {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 8px;
            display: block;
            letter-spacing: 1px;
        }

        .form-control-riset {
            background: #fdfdfd;
            border: 1.5px solid #eee;
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 14px;
            color: #333;
            transition: 0.3s;
        }

        .form-control-riset:focus {
            background: #fff;
            border-color: var(--primary-red);
            box-shadow: 0 0 0 4px rgba(229, 57, 53, 0.05);
        }

        .btn-login-riset {
            background: var(--primary-red);
            color: white;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 15px;
            box-shadow: 0 8px 20px rgba(229, 57, 53, 0.2);
            transition: 0.3s;
        }

        .btn-login-riset:hover {
            background: #c62828;
            transform: translateY(-2px);
            color: #fff;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #666;
        }

        .register-link a {
            color: var(--primary-red);
            text-decoration: none;
            font-weight: 700;
        }

        /* Decorative Elements */
        .bg-circle {
            position: fixed;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(229, 57, 53, 0.04) 0%, rgba(229, 57, 53, 0) 70%);
            z-index: 1;
            border-radius: 50%;
        }

        .circle-top {
            top: -200px;
            right: -200px;
        }

        .circle-bottom {
            bottom: -200px;
            left: -200px;
        }
    </style>
</head>

<body>

    <div class="bg-circle circle-top"></div>
    <div class="bg-circle circle-bottom"></div>

    <div class="login-card mx-3 mx-sm-0">
        <div class="card-header-riset">
            <i class="fas fa-key text-danger mb-3" style="font-size: 32px;"></i>
            <h4>Lupa Password?</h4>
            <p>Masukkan email yang terdaftar pada akun Anda. Kami akan mengirimkan password baru untuk Anda gunakan login.</p>
        </div>
        <div class="card-body-riset">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success border-0 small rounded-4 mb-4 py-3" style="background: rgba(40, 167, 69, 0.05); color: #28a745;">
                    <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger border-0 small rounded-4 mb-4 py-3" style="background: rgba(229, 57, 53, 0.05); color: var(--primary-red);">
                    <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('riset/lupa-password/submit') ?>" method="post">
                <div class="mb-4">
                    <label class="form-label-riset">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-riset" placeholder="nama@email.com" value="<?= old('email') ?>" required>
                </div>

                <button type="submit" class="btn btn-login-riset"><i class="fas fa-paper-plane me-2"></i> Kirim Password Baru</button>

                <div class="text-center mt-4">
                    <a href="<?= base_url('riset/login') ?>" class="text-decoration-none small fw-bold" style="color: #666; font-size: 13px;">
                        <i class="fas fa-long-arrow-alt-left me-2"></i> Kembali ke Halaman Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="position-fixed bottom-0 w-100 text-center pb-4 text-muted small opacity-50" style="z-index: 0;">
        &copy; 2026 RSUD Kota Yogyakarta. All rights reserved.
    </div>

</body>

</html>
