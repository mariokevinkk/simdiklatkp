<?php
/**
 * @var array $daftar
 */
?>
<?= $this->extend('Riset/admin/layout/template') ?>

<?php
$pendingList = array_filter($daftar, function($p) { return strtolower($p['status']) !== 'selesai'; });
$arsipList = array_filter($daftar, function($p) { return strtolower($p['status']) === 'selesai'; });
?>

<?= $this->section('content') ?>

<!-- Tabs Navigation -->
<ul class="nav nav-pills mb-4 d-flex gap-3" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active rounded-pill fw-bold px-4 py-2 d-flex align-items-center border shadow-sm" id="proses-tab" data-bs-toggle="pill" data-bs-target="#proses" type="button" role="tab" style="font-size: 13px;">
            <i class="fas fa-inbox me-2"></i> Perlu Diproses 
            <span class="badge bg-danger rounded-circle ms-2" style="font-size: 10px; border: 1px solid rgba(255,255,255,0.5);"><?= count($pendingList) ?></span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-pill fw-bold px-4 py-2 d-flex align-items-center bg-white border shadow-sm text-dark" id="arsip-tab" data-bs-toggle="pill" data-bs-target="#arsip" type="button" role="tab" style="font-size: 13px;">
            <i class="fas fa-archive text-secondary me-2" id="arsip-icon"></i> Katalog Arsip Publik
        </button>
    </li>
</ul>

<div class="tab-content" id="publikasiTabContent">
    <!-- TAB 1: PERLU DIPROSES -->
    <div class="tab-pane fade show active" id="proses" role="tabpanel" tabindex="0">
        <div class="card shadow-sm border-0 rounded-4 bg-white">
            <div class="card-header bg-transparent border-bottom border-light py-3 px-4 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-dark" style="font-size: 15px;">Daftar Validasi Laporan & Publikasi</h6>
                <div class="input-group" style="width: 320px;">
                    <input type="text" id="searchInputProses" class="form-control" placeholder="Cari peneliti atau judul..." style="font-size: 12px; border-color: #eee; border-radius: 8px 0 0 8px;">
                    <button class="btn btn-danger" type="button" style="border-radius: 0 8px 8px 0; font-size: 12px;"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 border-white" id="tableProses">
                        <thead class="bg-light bg-opacity-50">
                            <tr style="font-size: 11px; letter-spacing: 0.5px;" class="text-muted text-uppercase fw-bold">
                                <th class="ps-4 border-0" width="50">No</th>
                                <th class="border-0">Peneliti</th>
                                <th class="border-0 text-nowrap">Kategori</th>
                                <th class="border-0">Judul Penelitian</th>
                                <th class="text-center border-0 text-nowrap">Tanggal</th>
                                <th class="text-center border-0 text-nowrap">Status</th>
                                <th class="pe-4 text-center border-0 text-nowrap" width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pendingList)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted border-light" style="font-size: 13px;">Belum ada pengajuan Publikasi yang perlu diproses.</td>
                            </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($pendingList as $p): ?>
                                <tr>
                                    <td class="ps-4 border-light" style="font-size: 13px;"><?= $no++ ?></td>
                                    <td class="border-light">
                                        <div class="fw-bold text-dark" style="font-size: 13px;"><?= $p['nama'] ?></div>
                                        <div class="text-muted" style="font-size: 11px;"><?= $p['institusi'] ?></div>
                                    </td>
                                    <td class="border-light">
                                        <span class="badge bg-white text-<?= $p['tujuan_laporan'] == 'izin' ? 'danger' : 'secondary' ?> border border-<?= $p['tujuan_laporan'] == 'izin' ? 'danger' : 'secondary' ?> rounded-pill fw-medium" style="font-size: 11px; padding: 6px 12px;">
                                            <?= $p['tujuan_laporan'] == 'izin' ? 'Izin Publikasi' : 'Hanya Upload' ?>
                                        </span>
                                    </td>
                                    <td class="border-light">
                                        <div class="text-truncate" style="max-width: 280px; font-size: 13px; color: #444;"><?= (strlen($p['judul']) > 40) ? substr($p['judul'], 0, 40) . '...' : $p['judul'] ?></div>
                                    </td>
                                    <td class="text-center border-light" style="font-size: 12px; color: #666;"><?= date('d/m/Y', strtotime($p['created_at'])) ?></td>
                                    <td class="text-center border-light text-nowrap">
                                        <?php 
                                            $statusBadge = '';
                                            $statusIcon = '';
                                            if ($p['status'] == 'dalam review') {
                                                $statusBadge = 'text-warning border-warning';
                                                $statusIcon = 'fa-clock';
                                            } elseif ($p['status'] == 'menunggu_pembayaran') {
                                                $statusBadge = 'text-info border-info';
                                                $statusIcon = 'fa-file-invoice-dollar';
                                            } elseif ($p['status'] == 'direvisi') {
                                                $statusBadge = 'text-secondary border-secondary';
                                                $statusIcon = 'fa-undo';
                                            } else {
                                                $statusBadge = 'text-secondary border-secondary';
                                                $statusIcon = 'fa-info-circle';
                                            }
                                        ?>
                                        <span class="badge bg-white border rounded-pill fw-medium <?= $statusBadge ?>" style="font-size: 11px; padding: 6px 12px;">
                                            <i class="fas <?= $statusIcon ?> me-1"></i> <?= ucwords(str_replace('_', ' ', $p['status'])) ?>
                                        </span>
                                    </td>
                                    <td class="pe-4 text-center border-light text-nowrap">
                                        <a href="<?= base_url('riset/admin/publikasi/detail/' . $p['id']) ?>" class="btn btn-sm btn-outline-danger rounded-pill shadow-sm fw-bold px-3 py-1" style="font-size: 11px;">
                                            <i class="fas fa-search me-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-transparent py-3 px-4 border-top border-light d-flex justify-content-between align-items-center">
                <div class="text-muted" style="font-size: 12px;">
                    Menampilkan <?= count($pendingList) ?> data pengajuan tertunda.
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 2: KATALOG ARSIP PUBLIK -->
    <div class="tab-pane fade" id="arsip" role="tabpanel" tabindex="0">
        
        <div class="alert alert-secondary border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center" style="background-color: #f8f9fa;">
            <div class="me-3 bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                <i class="fas fa-book-reader" style="font-size: 18px;"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark mb-1" style="font-size: 14px;">E-Library / Katalog Riset Selesai</h6>
                <p class="text-muted mb-0" style="font-size: 12px;">Gunakan fitur ini untuk mencari dan mengunduh (PDF) laporan penelitian atau artikel jurnal saat ada pengunjung publik yang datang ke RSUD.</p>
            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-4 bg-white">
            <div class="card-header bg-transparent border-bottom border-light py-3 px-4 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-dark" style="font-size: 15px;">Daftar Arsip Tersedia</h6>
                <div class="input-group" style="width: 350px;">
                    <input type="text" id="searchInputArsip" class="form-control" placeholder="Cari judul artikel, peneliti, atau kategori..." style="font-size: 12px; border-color: #eee; border-radius: 8px 0 0 8px;">
                    <button class="btn btn-dark" type="button" style="border-radius: 0 8px 8px 0; font-size: 12px;"><i class="fas fa-search"></i> Cari Arsip</button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 border-white" id="tableArsip">
                        <thead class="bg-light bg-opacity-50">
                            <tr style="font-size: 11px; letter-spacing: 0.5px;" class="text-muted text-uppercase fw-bold">
                                <th class="ps-4 border-0">Peneliti & Jurnal</th>
                                <th class="border-0">Judul Artikel / Laporan</th>
                                <th class="text-center border-0 text-nowrap">Tgl Publikasi</th>
                                <th class="text-center border-0 text-nowrap">Status</th>
                                <th class="pe-4 text-center border-0 text-nowrap" width="180">Tindakan Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($arsipList)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted border-light" style="font-size: 13px;">Belum ada arsip publikasi yang selesai.</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($arsipList as $a): ?>
                                <tr>
                                    <td class="ps-4 border-light">
                                        <div class="fw-bold text-dark" style="font-size: 13px;"><?= $a['nama'] ?></div>
                                        <div class="text-muted" style="font-size: 11px;"><i class="fas fa-newspaper me-1"></i> <?= $a['institusi'] ?></div>
                                    </td>
                                    <td class="border-light">
                                        <div class="fw-bold text-danger" style="font-size: 13px;"><?= (strlen($a['judul']) > 40) ? substr($a['judul'], 0, 40) . '...' : $a['judul'] ?></div>
                                        <div class="text-muted" style="font-size: 11px;">Kategori: <?= $a['tujuan_laporan'] == 'izin' ? 'Izin Publikasi Resmi' : 'Laporan Mandiri (Hanya Upload)' ?></div>
                                    </td>
                                    <td class="text-center border-light" style="font-size: 12px; color: #666;"><?= date('d/m/Y', strtotime($a['updated_at'])) ?></td>
                                    <td class="text-center border-light text-nowrap">
                                        <span class="badge bg-white text-danger border border-danger rounded-pill fw-bold" style="font-size: 11px; padding: 6px 12px;">
                                            <i class="fas fa-globe me-1"></i> Publik (Selesai)
                                        </span>
                                    </td>
                                    <td class="pe-4 text-center border-light text-nowrap">
                                        <a href="<?= base_url('riset/admin/publikasi/detail/' . $a['id']) ?>" class="btn btn-sm btn-light border rounded-pill text-dark fw-bold px-3 py-1 me-1" title="Lihat Detail" style="font-size: 11px;">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('riset/admin/publikasi/buka_arsip/' . $a['id']) ?>" target="_blank" class="btn btn-sm btn-danger rounded-pill shadow-sm fw-bold px-3 py-1" style="font-size: 11px;">
                                            <i class="fas fa-file-pdf me-1"></i> Buka
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-transparent py-3 px-4 border-top border-light d-flex justify-content-between align-items-center">
                <div class="text-muted" style="font-size: 12px;">
                    Menampilkan <?= count($arsipList) ?> arsip publikasi.
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0 gap-1" style="font-size: 12px;">
                        <li class="page-item disabled">
                            <a class="page-link text-muted bg-light border-0 rounded-3 px-3 fw-medium" href="#" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link bg-danger text-white border-0 rounded-3 fw-bold shadow-sm" href="#">1</a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link text-muted bg-light border-0 rounded-3 px-3 fw-medium" href="#" tabindex="-1" aria-disabled="true">Selanjutnya <i class="fas fa-angle-right ms-1"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling for Pills */
    .nav-pills .nav-link {
        color: #555;
        transition: all 0.2s ease-in-out;
    }
    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
    }
    .nav-pills .nav-link.active {
        background-color: #e53935 !important;
        color: white !important;
        box-shadow: 0 4px 10px rgba(229, 57, 53, 0.2);
    }
    .nav-pills .nav-link.active .fa-archive, .nav-pills .nav-link.active #arsip-icon {
        color: white !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Make sure icon color changes to white when active
    const arsipTab = document.getElementById('arsip-tab');
    const arsipIcon = document.getElementById('arsip-icon');
    
    arsipTab.addEventListener('shown.bs.tab', function (event) {
        arsipIcon.classList.remove('text-secondary');
        arsipIcon.classList.add('text-white');
    });
    
    arsipTab.addEventListener('hidden.bs.tab', function (event) {
        arsipIcon.classList.remove('text-white');
        arsipIcon.classList.add('text-secondary');
    });

    // Real-time table filtering logic
    function setupFilter(inputId, tableId) {
        const input = document.getElementById(inputId);
        const table = document.getElementById(tableId);
        
        if (input && table) {
            input.addEventListener('keyup', function() {
                const filter = this.value.toLowerCase();
                const rows = table.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    // Skip 'no data' row if present
                    if (row.cells.length === 1 || row.cells[0].colSpan > 1) return;
                    
                    const text = row.textContent.toLowerCase();
                    if (text.includes(filter)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    }

    setupFilter('searchInputProses', 'tableProses');
    setupFilter('searchInputArsip', 'tableArsip');
});
</script>

<?= $this->endSection() ?>
