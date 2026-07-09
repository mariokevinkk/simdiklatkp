<?= $this->extend('pelatihan/layout/admin_layout') ?>
<?php 
/** 
 * @var array $p 
 * @var array $peserta 
 */ 
?>

<?= $this->section('content') ?>
<div class="mb-4">
    <a href="<?= base_url('pelatihan/admin/monitoring_peserta') ?>" class="btn btn-white btn-sm rounded-pill px-3 fw-bold border shadow-sm mb-3">
        <i class="fas fa-arrow-left me-2 text-danger"></i> KEMBALI
    </a>
    <div class="bg-white p-4 rounded-lg shadow-sm border-start border-danger border-5">
        <h4 class="fw-bold mb-1 text-uppercase"><?= $p['nama'] ?></h4>
        <div class="text-muted small">HASIL EVALUASI UJIAN PESERTA</div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-lg overflow-hidden bg-white">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted small fw-bold">
                <tr>
                    <th class="ps-4 py-3">PESERTA</th>
                    <th class="text-center">NILAI PRE-TEST</th>
                    <th class="text-center">NILAI POST-TEST</th>
                    <th class="text-center">STATUS</th>
                    <th class="pe-4 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peserta as $ps) : ?>
                <tr>
                    <td class="ps-4 py-3">
                        <div class="fw-bold small text-dark"><?= $ps['nama'] ?></div>
                        <div class="text-muted" style="font-size: 0.6rem;">NIP: <?= $ps['nip'] ?></div>
                    </td>
                    <td class="text-center">
                        <div class="h5 fw-bold mb-0 text-dark"><?= $ps['nilai_pre'] ?></div>
                    </td>
                    <td class="text-center">
                        <div class="h5 fw-bold mb-0 <?= $ps['status'] == 'LULUS' ? 'text-success' : 'text-danger' ?>"><?= $ps['nilai_post'] ?></div>
                        <small class="text-muted fw-bold">Passing: KKM</small>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-<?= $ps['status'] == 'LULUS' ? 'success' : 'danger' ?> rounded-pill px-3 fw-bold">
                            <?= $ps['status'] ?>
                        </span>
                    </td>
                    <td class="pe-4 text-center">
                        <button class="btn btn-white btn-sm rounded-pill px-3 fw-bold shadow-sm border" onclick="openLogModal(<?= $ps['peserta_pelat_id'] ?>, '<?= esc($ps['nama']) ?>')">LOG JAWABAN</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Log Jawaban -->
<div class="modal fade" id="modalLogJawaban" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
            <div class="modal-header bg-light border-0 px-4 py-3">
                <div>
                    <h5 class="modal-title fw-bold text-dark"><i class="fas fa-list-check text-danger me-2"></i> Log Jawaban Ujian</h5>
                    <div class="text-muted small" id="logPesertaName">Nama Peserta</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-4" id="logContent">
                <div class="text-center py-5">
                    <div class="spinner-border text-danger" role="status"></div>
                    <div class="mt-2 text-muted small fw-bold">Memuat data...</div>
                </div>
            </div>
            <div class="modal-footer bg-light border-0 px-4 py-3">
                <button type="button" class="btn btn-dark rounded-pill px-4 fw-bold" data-bs-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>

<script>
function openLogModal(pesertaId, nama) {
    document.getElementById('logPesertaName').innerText = nama;
    const modal = new bootstrap.Modal(document.getElementById('modalLogJawaban'));
    modal.show();
    
    document.getElementById('logContent').innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-danger" role="status"></div>
            <div class="mt-2 text-muted small fw-bold">Memuat data...</div>
        </div>
    `;
    
    fetch(`<?= base_url('pelatihan/admin/grading/log_jawaban') ?>/${pesertaId}`)
        .then(res => res.json())
        .then(data => {
            let html = '';
            ['pre_test', 'post_test'].forEach(tipe => {
                if (data[tipe]) {
                    const label = tipe === 'pre_test' ? 'PRE-TEST' : 'POST-TEST';
                    html += `
                        <div class="mb-4">
                            <h6 class="fw-bold bg-dark text-white p-2 rounded">${label} - Nilai: ${data[tipe].score}</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead class="bg-light text-center small">
                                        <tr>
                                            <th>Pertanyaan</th>
                                            <th>Kunci Jawaban</th>
                                            <th>Jawaban Peserta</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="small">
                    `;
                    data[tipe].jawaban.forEach(j => {
                        const status = j.is_correct == 1 
                            ? '<span class="badge bg-success"><i class="fas fa-check"></i> Benar</span>' 
                            : '<span class="badge bg-danger"><i class="fas fa-times"></i> Salah</span>';
                        html += `
                            <tr>
                                <td>${j.pertanyaan}</td>
                                <td class="text-center fw-bold text-success">${j.jawaban_benar.toUpperCase()}</td>
                                <td class="text-center fw-bold">${j.jawaban_peserta}</td>
                                <td class="text-center">${status}</td>
                            </tr>
                        `;
                    });
                    html += `</tbody></table></div></div>`;
                }
            });
            if (html === '') {
                html = '<div class="alert alert-warning text-center">Belum ada riwayat pengerjaan kuis.</div>';
            }
            document.getElementById('logContent').innerHTML = html;
        })
        .catch(err => {
            document.getElementById('logContent').innerHTML = '<div class="alert alert-danger">Gagal mengambil data log jawaban.</div>';
        });
}
</script>

<?= $this->endSection() ?>
