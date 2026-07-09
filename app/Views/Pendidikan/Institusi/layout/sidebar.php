<div class="sidebar" id="sidebarMenu">
    <div class="d-flex flex-column">
        <div class="px-4 mb-4 mt-2">
            <p class="text-uppercase small fw-bold text-muted mb-2">Main Menu</p>
        </div>
        
        <nav class="nav flex-column">
            <a class="nav-link <?= (url_is('pendidikan/institusi/dashboard')) ? 'active' : '' ?>" href="<?= base_url('pendidikan/institusi/dashboard') ?>">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            
            <div class="px-4 mb-2 mt-4">
                <p class="text-uppercase small fw-bold text-muted mb-0">Layanan Mahasiswa</p>
            </div>
            
            <?php $isApproved = (session()->get('account_status') === 'approved'); ?>
            
            <a class="nav-link <?= (!$isApproved) ? 'text-muted pe-none' : '' ?> <?= (url_is('pendidikan/institusi/pengajuan/create')) ? 'active' : '' ?>" href="<?= $isApproved ? base_url('pendidikan/institusi/pengajuan/create') : '#' ?>">
                <i class="fas fa-file-medical"></i> Ajukan Mahasiswa <?= (!$isApproved) ? '<i class="fas fa-lock fa-xs ms-1"></i>' : '' ?>
            </a>
            
            <a class="nav-link <?= (url_is('pendidikan/institusi/pengajuan/status*')) ? 'active' : '' ?>" href="<?= $isApproved ? base_url('pendidikan/institusi/pengajuan/status') : '#' ?>">
                <i class="fas fa-clipboard-list"></i> Status Pengajuan <?= (!$isApproved) ? '<i class="fas fa-lock fa-xs ms-1"></i>' : '' ?>
            </a>

            <a class="nav-link <?= (!$isApproved) ? 'text-muted pe-none' : '' ?> <?= (url_is('pendidikan/institusi/mahasiswa') && !url_is('pendidikan/institusi/mahasiswa/lulus')) ? 'active' : '' ?>" href="<?= $isApproved ? base_url('pendidikan/institusi/mahasiswa') : '#' ?>">
                <i class="fas fa-user-friends"></i> Mahasiswa Aktif <?= (!$isApproved) ? '<i class="fas fa-lock fa-xs ms-1"></i>' : '' ?>
            </a>

            <a class="nav-link <?= (!$isApproved) ? 'text-muted pe-none' : '' ?> <?= (url_is('pendidikan/institusi/mahasiswa/lulus')) ? 'active' : '' ?>" href="<?= $isApproved ? base_url('pendidikan/institusi/mahasiswa/lulus') : '#' ?>">
                <i class="fas fa-user-graduate"></i> Mahasiswa Lulus <?= (!$isApproved) ? '<i class="fas fa-lock fa-xs ms-1"></i>' : '' ?>
            </a>
            
            <div class="px-4 mb-2 mt-4">
                <p class="text-uppercase small fw-bold text-muted mb-0">Sistem</p>
            </div>
            
            <a class="nav-link <?= (url_is('pendidikan/institusi/profil*')) ? 'active' : '' ?>" href="<?= base_url('pendidikan/institusi/profil') ?>">
                <i class="fas fa-user-cog"></i> Profil Institusi
            </a>

            <a class="nav-link" href="<?= base_url('pendidikan/logout') ?>">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </nav>
    </div>
</div>
<div class="main-content">
    <div class="container-fluid px-4">
