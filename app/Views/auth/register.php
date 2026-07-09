<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NusaLMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        .step-indicator { display: flex; justify-content: space-between; margin-bottom: 30px; position: relative; }
        .step-indicator::before { content: ""; position: absolute; top: 15px; left: 0; right: 0; height: 2px; background: #e9ecef; z-index: 1; }
        .step-item { width: 30px; height: 30px; border-radius: 50%; background: #e9ecef; z-index: 2; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold; color: #adb5bd; }
        .step-item.active { background: var(--primary-color); color: white; }
        .step-content { display: none; }
        .step-content.active { display: block; }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4 border-0">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Pendaftaran Peserta</h3>
                    <p class="text-muted">Lengkapi data diri Anda untuk memulai pembelajaran</p>
                </div>

                <div class="step-indicator px-5">
                    <div class="step-item active" id="step1-indicator">1</div>
                    <div class="step-item" id="step2-indicator">2</div>
                    <div class="step-item" id="step3-indicator">3</div>
                </div>

                <form action="<?= base_url('auth/register') ?>" method="POST" id="regForm">
                    <!-- Step 1: Jenis User -->
                    <div class="step-content active" id="step1">
                        <h5 class="fw-bold mb-4">Pilih Jenis User</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="card h-100 p-4 text-center cursor-pointer border-2" id="typeNakes">
                                    <input type="radio" name="type" value="named" class="d-none" required>
                                    <i class="fas fa-user-md fa-3x text-primary-custom mb-3"></i>
                                    <div class="fw-bold">Tenaga Kesehatan</div>
                                    <small class="text-muted">Dokter, Perawat, Bidan, dsb.</small>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="card h-100 p-4 text-center cursor-pointer border-2" id="typeUmum">
                                    <input type="radio" name="type" value="non-named" class="d-none">
                                    <i class="fas fa-users fa-3x text-secondary-custom mb-3"></i>
                                    <div class="fw-bold">Lainnya</div>
                                    <small class="text-muted">Mahasiswa, Umum, Non-Nakes</small>
                                </label>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="button" class="btn btn-primary-custom px-4" onclick="nextStep(2)">Lanjut <i class="fas fa-arrow-right ms-2"></i></button>
                        </div>
                    </div>

                    <!-- Step 2: Data Diri -->
                    <div class="step-content" id="step2">
                        <h5 class="fw-bold mb-4">Data Diri & Instansi</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">NIK</label>
                                <input type="text" name="nik" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Instansi</label>
                                <input type="text" name="instansi" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Profesi / Jabatan</label>
                                <input type="text" name="profesi" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">No. HP</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-light px-4" onclick="nextStep(1)"><i class="fas fa-arrow-left me-2"></i> Kembali</button>
                            <button type="button" class="btn btn-primary-custom px-4" onclick="nextStep(3)">Lanjut <i class="fas fa-arrow-right ms-2"></i></button>
                        </div>
                    </div>

                    <!-- Step 3: Keamanan -->
                    <div class="step-content" id="step3">
                        <h5 class="fw-bold mb-4">Keamanan Akun</h5>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Konfirmasi Password</label>
                            <input type="password" class="form-control" required>
                        </div>
                        <div class="alert alert-info border-0 small">
                            <i class="fas fa-info-circle me-2"></i> Dengan mendaftar, Anda menyetujui syarat dan ketentuan penggunaan NusaLMS.
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-light px-4" onclick="nextStep(2)"><i class="fas fa-arrow-left me-2"></i> Kembali</button>
                            <button type="submit" class="btn btn-success px-5 fw-bold">DAFTAR SEKARANG <i class="fas fa-check-circle ms-2"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="text-center mt-3">
                <p class="small text-muted">Sudah punya akun? <a href="<?= base_url('login') ?>" class="text-primary-custom fw-bold text-decoration-none">Login di sini</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    function nextStep(step) {
        document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.step-item').forEach(el => el.classList.remove('active'));
        
        document.getElementById('step' + step).classList.add('active');
        for(let i=1; i<=step; i++) {
            document.getElementById('step' + i + '-indicator').classList.add('active');
        }
    }

    // Handle Radio Card styling
    document.querySelectorAll('input[name="type"]').forEach(input => {
        input.addEventListener('change', function() {
            document.querySelectorAll('label.card').forEach(c => c.classList.remove('border-primary'));
            if(this.checked) this.closest('label').classList.add('border-primary');
        });
    });
</script>
</body>
</html>
