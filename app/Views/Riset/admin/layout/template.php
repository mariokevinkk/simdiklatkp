<?= $this->include('riset/admin/layout/header') ?>

<?= $this->include('riset/admin/layout/sidebar') ?>

<div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom border-light">
    <div class="d-flex align-items-center">
        <div>
            <h3 class="fw-bold text-dark mb-0" style="letter-spacing: -0.5px;"><?= $title ?? 'Dashboard' ?></h3>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="d-none d-sm-block">
        <ol class="breadcrumb mb-0 px-3 py-1 bg-white rounded-pill shadow-sm" style="font-size: 10px; font-weight: 600;">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Admin</a></li>
            <li class="breadcrumb-item active text-danger" aria-current="page"><?= $title ?? 'Dashboard' ?></li>
        </ol>
    </nav>
</div>

<?= $this->renderSection('content') ?>

<?= $this->include('riset/admin/layout/footer') ?>