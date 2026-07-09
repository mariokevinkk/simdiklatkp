<?= $this->extend('pelatihan/layout/peserta_layout') ?>

<?= $this->section('content') ?>

<style>
    :root {
        --primary-red: #c62828;
        --accent-yellow: #ffb300;
        --teal-kemenkes: #00bfa5;
        --soft-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .notif-card {
        background: white;
        border-radius: 20px;
        box-shadow: var(--soft-shadow);
        border: 1px solid #edf2f7;
        overflow: hidden;
    }

    .notif-item {
        padding: 25px;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.2s ease;
        position: relative;
    }

    .notif-item:last-child {
        border-bottom: none;
    }

    .notif-item:hover {
        background-color: #f8fafc;
    }

    .notif-item.unread {
        background-color: #fff9f9;
    }

    .notif-item.unread::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background-color: var(--primary-red);
    }

    .notif-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .bg-success-light { background-color: #dcfce7; color: #15803d; }
    .bg-info-light { background-color: #e0f2fe; color: #0369a1; }
    .bg-warning-light { background-color: #fef9c3; color: #854d0e; }
    .bg-danger-light { background-color: #fee2e2; color: #b91c1c; }

</style>

<div class="container pt-1 pb-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1">Notifikasi</h3>
                    <p class="text-muted small mb-0">Informasi terbaru mengenai aktivitas pelatihan Anda.</p>
                </div>
                <div class="input-group rounded-pill shadow-sm overflow-hidden" style="max-width: 420px; background: white;">
                    <span class="input-group-text bg-white border-0"><i class="fas fa-search text-danger"></i></span>
                    <input id="notificationSearch" type="text" class="form-control border-0" placeholder="Cari notifikasi...">
                </div>
                <button class="btn btn-light rounded-pill px-4 fw-bold small" onclick="markAllRead()"><i class="fas fa-check-double me-2"></i> Tandai Semua Terbaca</button>
            </div>

            <div class="notif-card">
                <?php if (empty($notifikasi)) : ?>
                    <div class="p-5 text-center">
                        <div class="bg-light d-inline-flex p-4 rounded-circle mb-3">
                            <i class="fas fa-bell-slash fa-3x text-muted opacity-50"></i>
                        </div>
                        <h5 class="fw-bold text-muted">Belum ada notifikasi</h5>
                        <p class="text-muted small">Kami akan memberitahu Anda jika ada aktivitas terbaru.</p>
                    </div>
                <?php else : ?>
                    <?php foreach ($notifikasi as $n) : ?>
                        <?php 
                            $icon = 'fa-bell';
                            $colorClass = 'bg-info-light';
                            
                            $type = strtolower($n['type'] ?? 'info');
                            if ($type == 'success') {
                                $icon = 'fa-check-circle';
                                $colorClass = 'bg-success-light';
                            } elseif ($type == 'error' || $type == 'danger') {
                                $icon = 'fa-times-circle';
                                $colorClass = 'bg-danger-light';
                            } elseif ($type == 'warning') {
                                $icon = 'fa-wallet';
                                $colorClass = 'bg-warning-light';
                            }
                        ?>
                        <div class="notif-item <?= ($n['is_read'] == 0) ? 'unread' : '' ?>" style="<?= ($n['is_read'] == 0) ? 'cursor: pointer;' : '' ?>" <?= ($n['is_read'] == 0) ? 'onclick="markRead(' . $n['id'] . ', this)"' : '' ?>>
                            <div class="d-flex gap-3">
                                <div class="notif-icon <?= $colorClass ?>">
                                    <i class="fas <?= $icon ?> fa-lg"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h6 class="fw-bold mb-0 pe-4"><?= esc($n['title']) ?></h6>
                                        <small class="text-muted text-nowrap"><?= isset($n['created_at']) ? date('d M Y, H:i', strtotime($n['created_at'])) . ' WIB' : 'Baru saja' ?></small>
                                    </div>
                                    <p class="text-muted small mb-0"><?= $n['message'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="text-center mt-5">
                <button class="btn btn-outline-secondary rounded-pill px-5 fw-bold small">Muat Lebih Banyak</button>
            </div>
        </div>
    </div>
</div>

<script>
function markRead(id, element) {
    $.post('<?= base_url("pelatihan/peserta/notifikasi/read/") ?>' + id, function(response) {
        if(response.success) {
            $(element).removeClass('unread');
            $(element).removeAttr('onclick');
            $(element).css('cursor', 'default');
            
            // Update badge count in header if exists
            var badge = $('.badge.bg-danger.rounded-pill');
            if(badge.length > 0) {
                var current = parseInt(badge.text());
                if(current > 1) {
                    badge.text(current - 1);
                } else {
                    badge.remove();
                    $('.top-0.start-100').remove(); // Remove the dot
                }
            }
        }
    });
}

function markAllRead() {
    $.post('<?= base_url("pelatihan/peserta/notifikasi/read_all") ?>', function(response) {
        if(response.success) {
            $('.notif-item.unread').removeClass('unread').removeAttr('onclick').css('cursor', 'default');
            $('.badge.bg-danger.rounded-pill').remove();
            $('.top-0.start-100').remove();
        }
    });
}

$('#notificationSearch').on('input', function() {
    const query = $(this).val().toLowerCase();
    $('.notif-item').each(function() {
        const text = $(this).text().toLowerCase();
        $(this).toggle(text.includes(query));
    });
});
</script>

<?= $this->endSection() ?>
