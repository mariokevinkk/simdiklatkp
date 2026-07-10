<div class="sidebar shadow-sm" id="sidebarMenu">
    <div class="d-flex flex-column h-100">
        <div class="p-3 mb-2">
            <div class="d-flex align-items-center p-2 bg-light rounded-3">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('name') ?? 'M') ?>&background=c62828&color=fff" class="rounded-circle me-2" width="40">
                <div class="overflow-hidden">
                    <h6 class="mb-0 text-dark fw-bold small text-truncate"><?= (session()->get('role') == 'mahasiswa') ? session()->get('name') : 'Andi Pratama' ?></h6>
                    <span class="text-muted" style="font-size: 10px;">Mahasiswa (Peserta)</span>
                </div>
            </div>
        </div>

        <nav class="nav flex-column flex-grow-1">
            <div class="px-3 mb-2 mt-2">
                <label class="text-uppercase fw-bold text-muted" style="font-size: 10px; letter-spacing: 1px;">Menu Utama</label>
            </div>
            
            <a class="nav-link <?= ($active_menu ?? '') == 'dashboard' ? 'active' : '' ?>" href="<?= base_url('pendidikan/mahasiswa/dashboard') ?>">
                <i class="fas fa-home"></i> Dashboard
            </a>

            <a class="nav-link <?= ($active_menu ?? '') == 'stase' ? 'active' : '' ?>" href="<?= base_url('pendidikan/mahasiswa/stase') ?>">
                <i class="fas fa-layer-group"></i> Rotasi Stase
            </a>
            
            <a class="nav-link <?= ($active_menu ?? '') == 'profil' ? 'active' : '' ?>" href="<?= base_url('pendidikan/mahasiswa/profil') ?>">
                <i class="fas fa-user"></i> Profil & Dokumen
            </a>
            


            <div class="px-3 mb-2 mt-4">
                <label class="text-uppercase fw-bold text-muted" style="font-size: 10px; letter-spacing: 1px;">Akademik</label>
            </div>

            <?php $isPaid = (($mahasiswa['payment_status'] ?? session()->get('payment_status')) === 'Lunas'); ?>
            <?php if ($isPaid) : ?>
                <a class="nav-link <?= ($active_menu ?? '') == 'penilaian' ? 'active' : '' ?>" href="<?= base_url('pendidikan/mahasiswa/penilaian') ?>">
                    <i class="fas fa-star text-warning animate-pulse"></i> Penilaian Stase
                </a>
            <?php else : ?>
                <a class="nav-link text-muted opacity-60" href="#" onclick="alert('Akses lembar penilaian terkunci! Selesaikan administrasi pembayaran stase terlebih dahulu.')" style="cursor: not-allowed;">
                    <i class="fas fa-lock text-danger me-2"></i> Penilaian Stase <span class="badge bg-danger ms-auto" style="font-size: 8px; padding: 2px 4px;">Lock</span>
                </a>
            <?php endif; ?>

            <a class="nav-link <?= ($active_menu ?? '') == 'sertifikat' ? 'active' : '' ?>" href="<?= base_url('pendidikan/mahasiswa/sertifikat') ?>">
                <i class="fas fa-certificate"></i> Sertifikat Diklat
            </a>
        </nav>

        <div class="p-3 mt-auto border-top">
            <a href="<?= base_url('pendidikan/logout') ?>" class="btn btn-outline-danger w-100 btn-sm fw-bold">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
        </div>
    </div>
</div>

<div class="main-content">
