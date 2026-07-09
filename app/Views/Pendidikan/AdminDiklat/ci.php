<?= $this->include('Pendidikan/AdminDiklat/layout/header') ?>
<?= $this->include('Pendidikan/AdminDiklat/layout/sidebar') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold text-dark">Manajemen Clinical Instructor</h5>
    <button class="btn btn-primary btn-sm" onclick="$('#addCiModal').modal('show')">
        <i class="fas fa-plus me-1"></i> Tambah CI
    </button>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card p-3">
            <small class="text-uppercase fw-bold text-muted">Total CI</small>
            <h4 class="fw-bold mb-0"><?= $totalCi ?? 0 ?></h4>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <small class="text-uppercase fw-bold text-muted">Ruangan Terisi</small>
            <h4 class="fw-bold mb-0"><?= $totalRuangan ?? 0 ?></h4>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <small class="text-uppercase fw-bold text-muted">Status Modul</small>
            <h4 class="fw-bold mb-0 text-success">Aktif</h4>
        </div>
    </div>
</div>

<div class="card p-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>NIP</th>
                    <th>Profesi</th>
                    <th>Ruangan</th>
                    <th>Kontak</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ciList)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($ciList as $ci): ?>
                    <tr>
                        <td><small class="text-muted"><?= $no++ ?></small></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-primary bg-opacity-10 rounded d-flex align-items-center justify-content-center" style="width:36px;height:36px;">
                                    <span class="fw-bold text-primary"><?= strtoupper(substr($ci['nama_lengkap'] ?? '-', 0, 1)) ?></span>
                                </div>
                                <span class="fw-semibold"><?= $ci['nama_lengkap'] ?? '-' ?></span>
                            </div>
                        </td>
                        <td><small><?= $ci['nip'] ?? '-' ?></small></td>
                        <td><span class="badge bg-primary bg-opacity-10 text-primary"><?= $ci['nama_profesi'] ?? $ci['profesi'] ?? '-' ?></span></td>
                        <td><small><i class="fas fa-map-pin text-muted me-1"></i><?= $ci['ruangan_tugas'] ?? '-' ?></small></td>
                        <td><small><?= $ci['nomor_telepon'] ?? $ci['contact'] ?? '-' ?></small></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary me-1" onclick="editCi(<?= htmlspecialchars(json_encode($ci)) ?>)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteCi(<?= $ci['id'] ?>, '<?= $ci['nama_lengkap'] ?? '' ?>')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fas fa-user-md fa-3x mb-3 d-block"></i>
                            Data CI tidak ditemukan
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add CI Modal -->
<div class="modal fade" id="addCiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h6 class="modal-title fw-bold"><i class="fas fa-user-plus me-2"></i>Tambah Clinical Instructor</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="addCiForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">NIP <span class="text-danger">*</span></label>
                        <input type="text" name="nip" class="form-control" required placeholder="198001012005011002">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" required placeholder="Ns. Siti Aminah, S.Kep">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Profesi</label>
                        <select name="id_profesi" class="form-control">
                            <option value="">-- Pilih Profesi --</option>
                            <?php if (!empty($profesiList)): ?>
                                <?php foreach ($profesiList as $p): ?>
                                <option value="<?= $p['id_profesi'] ?>"><?= $p['nama_profesi'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" class="form-control" placeholder="0812-3456-7890">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Email Login <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required placeholder="ci.nama@rsud.go.id">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required placeholder="Minimal 6 karakter">
                        <div class="form-text text-muted">CI akan login menggunakan email & password ini.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Ruangan</label>
                        <select name="id_unit_kerja" class="form-control">
                            <option value="">-- Pilih Ruangan --</option>
                            <?php if (!empty($unitKerjaList)): ?>
                                <?php foreach ($unitKerjaList as $u): ?>
                                <option value="<?= $u['id_unit_kerja'] ?>"><?= $u['nama_unit'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan CI</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit CI Modal -->
<div class="modal fade" id="editCiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h6 class="modal-title fw-bold"><i class="fas fa-edit me-2"></i>Edit Clinical Instructor</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editCiForm">
                <input type="hidden" name="id" id="editCiId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">NIP <span class="text-danger">*</span></label>
                        <input type="text" name="nip" id="editCiNip" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" id="editCiNama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Profesi</label>
                        <select name="id_profesi" id="editCiProfesi" class="form-control">
                            <option value="">-- Pilih Profesi --</option>
                            <?php if (!empty($profesiList)): ?>
                                <?php foreach ($profesiList as $p): ?>
                                <option value="<?= $p['id_profesi'] ?>"><?= $p['nama_profesi'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" id="editCiTelp" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Email Login</label>
                        <input type="email" name="email" id="editCiEmail" class="form-control" placeholder="ci.nama@rsud.go.id">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Ganti Password</label>
                        <input type="password" name="password" id="editCiPassword" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                        <div class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Ruangan</label>
                        <select name="id_unit_kerja" id="editCiUnit" class="form-control">
                            <option value="">-- Pilih Ruangan --</option>
                            <?php if (!empty($unitKerjaList)): ?>
                                <?php foreach ($unitKerjaList as $u): ?>
                                <option value="<?= $u['id_unit_kerja'] ?>"><?= $u['nama_unit'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$('#addCiForm').submit(function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    $.post('<?= base_url('pendidikan/admin/diklat/api/ci') ?>', data, function(res) {
        if (res.success || res.id) {
            location.reload();
        } else {
            alert(res.message || 'Gagal menyimpan CI');
        }
    }).fail(function(xhr) {
        alert('Gagal: ' + (xhr.responseJSON?.message || 'Server error'));
    });
});

function editCi(ci) {
    $('#editCiId').val(ci.id);
    $('#editCiNip').val(ci.nip || '');
    $('#editCiNama').val(ci.nama_lengkap || ci.name || '');
    $('#editCiProfesi').val(ci.id_profesi || '');
    $('#editCiTelp').val(ci.nomor_telepon || ci.contact || '');
    $('#editCiUnit').val(ci.id_unit_kerja || '');
    $('#editCiEmail').val(ci.email || '');
    $('#editCiPassword').val('');
    $('#editCiModal').modal('show');
}

$('#editCiForm').submit(function(e) {
    e.preventDefault();
    var id = $('#editCiId').val();
    var data = $(this).serialize();
    $.post('<?= base_url('pendidikan/admin/diklat/api/ci/update') ?>/' + id, data, function(res) {
        if (res.success) {
            location.reload();
        } else {
            alert(res.message || 'Gagal');
        }
    }).fail(function(xhr) {
        alert('Gagal: ' + (xhr.responseJSON?.message || 'Server error'));
    });
});

function deleteCi(id, name) {
    if (!confirm('Hapus CI "' + name + '"? Tindakan ini tidak dapat dibatalkan.')) return;
    $.get('<?= base_url('pendidikan/admin/diklat/api/ci/delete') ?>/' + id, function(res) {
        if (res.success) {
            location.reload();
        } else {
            alert(res.message || 'Gagal');
        }
    });
}
</script>

<?= $this->include('Pendidikan/AdminDiklat/layout/footer') ?>
