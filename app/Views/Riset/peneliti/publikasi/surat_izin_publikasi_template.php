<?php

/**
 * @var string $nama_peneliti
 * @var string $nim
 * @var string $institusi
 * @var string $judul_riset
 * @var string $nama_publikasi
 * @var string $jenis_jurnal
 * @var string $kategori
 * @var string $issn
 * @var string $scope
 * @var string $alamat_web
 * @var string $waktu_penelitian
 */

$nama_peneliti   = $nama_peneliti ?? '-';
$nim             = $nim ?? '-';
$institusi       = $institusi ?? '-';
$judul_riset     = $judul_riset ?? '-';
$nama_publikasi  = $nama_publikasi ?? '-';
$jenis_jurnal    = $jenis_jurnal ?? '-';
$kategori        = $kategori ?? '-';
$issn            = $issn ?? '-';
$scope           = $scope ?? '-';
$alamat_web      = $alamat_web ?? '-';
$waktu_penelitian = $waktu_penelitian ?? '-';
?>
<?= $this->extend('riset/peneliti/layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <!-- Main Certificate/Letter Card -->
    <div class="card border-0 shadow-lg mx-auto" style="max-width: 800px; border-radius: 0; font-family: 'Times New Roman', Times, serif; background: #fff; border: 1px solid #e0e0e0;">
        <div id="printableArea" class="card-body py-4 px-5">

            <!-- Kop Surat -->
            <div class="position-relative d-flex justify-content-center align-items-center mb-4 border-bottom border-3 border-dark pb-3">
                <div style="position: absolute; left: 5px;">
                    <?php if (isset($pengaturan['logo_kop']) && !empty($pengaturan['logo_kop'])): ?>
                        <img src="<?= base_url('uploads/riset/pengaturan/' . $pengaturan['logo_kop']) ?>" alt="Logo" style="height: 115px;">
                    <?php else: ?>
                        <img src="<?= base_url('assets/img/logo surat izin.png') ?>" alt="Logo" style="height: 115px;">
                    <?php endif; ?>
                </div>
                <div class="text-center w-100">
                    <h6 class="mb-0 text-dark">PEMERINTAH KOTA YOGYAKARTA</h6>
                    <h6 class="mb-0 text-dark">DINAS KESEHATAN</h6>
                    <h5 class="fw-bold mb-1 text-dark">RUMAH SAKIT UMUM DAERAH</h5>
                    <p class="mb-0 mt-1 text-dark" style="font-size: 13px;">Jl. Wirosaban 1, Yogyakarta, Daerah Istimewa Yogyakarta 55162</p>
                    <p class="mb-0 text-dark" style="font-size: 13px;">Telepon (0274) 371195, 386692</p>
                    <p class="mb-0 text-dark" style="font-size: 13px;">Laman rumahsakitjogja.jogjakota.go.id; Pos-el rsud@jogjakota.go.id</p>
                </div>
            </div>

            <div class="text-center mb-3">
                <h5 class="fw-bold text-decoration-underline mb-0 text-dark" style="letter-spacing: 1.5px;">SURAT IZIN PUBLIKASI PENELITIAN</h5>
                <p class="mb-0 fw-bold text-dark">No. <?= !empty($nomor_surat) ? esc($nomor_surat) : '-' ?></p>
            </div>

            <!-- Isi Surat -->
            <div class="content mb-3" style="font-size: 14px; text-align: justify; color: #000; line-height: 1.35;">
                <p class="mb-2">Dengan ini Direktur RSUD Kota Yogyakarta memberikan izin publikasi hasil penelitian kepada :</p>

                <table class="table table-borderless ms-3 mb-3" style="font-size: 14px; color: #000;">
                    <tr>
                        <td width="200" class="py-1 px-1">Nama</td>
                        <td width="20" class="py-1 px-1">:</td>
                        <td class="fw-bold py-1 px-1"><?= esc($nama_peneliti) ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 px-1">NIM/NIDN</td>
                        <td class="py-1 px-1">:</td>
                        <td class="py-1 px-1 fw-bold"><?= esc($nim) ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 px-1">Institusi</td>
                        <td class="py-1 px-1">:</td>
                        <td class="py-1 px-1 fw-bold"><?= esc($institusi) ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 px-1" style="vertical-align: top;">Judul Penelitian</td>
                        <td class="py-1 px-1" style="vertical-align: top;">:</td>
                        <td class="fw-bold py-1 px-1" style="line-height: 1.5; text-align: justify;"><?= esc($judul_riset) ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 px-1">Waktu Penelitian</td>
                        <td class="py-1 px-1">:</td>
                        <td class="py-1 px-1 fw-bold"><?= esc($waktu_penelitian) ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="py-2 px-1">Untuk dipublikasi pada :</td>
                    </tr>
                    <tr>
                        <td class="py-1 px-1">Jenis jurnal</td>
                        <td class="py-1 px-1">:</td>
                        <td class="py-1 px-1 fw-bold"><?= esc($jenis_jurnal) ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 px-1">Kategori</td>
                        <td class="py-1 px-1">:</td>
                        <td class="py-1 px-1 fw-bold"><?= esc($kategori) ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 px-1">Nama Publikasi</td>
                        <td class="py-1 px-1">:</td>
                        <td class="py-1 px-1 fw-bold"><?= esc($nama_publikasi) ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 px-1">ISSN</td>
                        <td class="py-1 px-1">:</td>
                        <td class="py-1 px-1 fw-bold"><?= esc($issn) ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 px-1">Scope/bidang</td>
                        <td class="py-1 px-1">:</td>
                        <td class="py-1 px-1 fw-bold"><?= esc($scope) ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 px-1">Alamat Web</td>
                        <td class="py-1 px-1">:</td>
                        <td class="py-1 px-1 text-decoration-underline fw-bold"><?= esc($alamat_web) ?></td>
                    </tr>
                </table>

                <p class="mt-2 mb-2">Demikian surat izin ini kami buat untuk dapat dipergunakan sebagaimana mestinya.</p>
            </div>

            <!-- Tanda Tangan -->
            <div class="row mt-2 text-dark">
                <div class="col-7"></div>
                <div class="col-5 text-start">
                    <?php
                    $bulanIndo = [
                        1 => 'Januari',
                        2 => 'Februari',
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                        7 => 'Juli',
                        8 => 'Agustus',
                        9 => 'September',
                        10 => 'Oktober',
                        11 => 'November',
                        12 => 'Desember'
                    ];
                    $tanggal = date('d') . ' ' . $bulanIndo[(int)date('m')] . ' ' . date('Y');
                    ?>
                    <p class="mb-0">Yogyakarta, <?= $tanggal ?></p>
                    <p class="mb-0"><?= isset($pengaturan['jabatan']) && !empty($pengaturan['jabatan']) ? esc($pengaturan['jabatan']) : 'Direktur' ?>,</p>

                    <div class="position-relative d-block text-center" style="margin-top: -15px; margin-bottom: -30px; margin-left: -60px;">
                        <?php if (isset($pengaturan['ttd_image']) && !empty($pengaturan['ttd_image'])): ?>
                            <img src="<?= base_url('uploads/riset/pengaturan/' . $pengaturan['ttd_image']) ?>" alt="Tanda Tangan" style="height: 120px; object-fit: contain;">
                        <?php else: ?>
                            <img src="<?= base_url('assets/img/stempel_qr.png') ?>" alt="QR Code" style="height: 95px;" class="mb-0 mt-3">
                        <?php endif; ?>
                    </div>

                    <p class="fw-bold mb-0 text-decoration-underline"><?= isset($pengaturan['nama_pejabat']) && !empty($pengaturan['nama_pejabat']) ? esc($pengaturan['nama_pejabat']) : 'dr. Ariyudi Yunita, MMR' ?></p>
                    <p class="mb-0"><?= isset($pengaturan['pangkat']) && !empty($pengaturan['pangkat']) ? esc($pengaturan['pangkat']) : 'Pembina Utama Muda (IV/c)' ?></p>
                    <p class="small mb-0">NIP. <?= isset($pengaturan['nip_pejabat']) && !empty($pengaturan['nip_pejabat']) ? esc($pengaturan['nip_pejabat']) : '196706262002122003' ?></p>
                </div>
            </div>

        </div>
    </div>
    <div class="text-center mt-4 no-print">
        <a href="<?= base_url('riset/peneliti/status') ?>" class="btn btn-outline-dark px-4 py-2 rounded-pill fw-bold me-2">
            Kembali
        </a>
        <button onclick="downloadPDF()" class="btn btn-danger px-4 py-2 rounded-pill fw-bold shadow-sm">
            Download PDF
        </button>
    </div>
</div>

<!-- Print Styles -->
<style>
    @media print {
        @page {
            size: A4;
            margin: 2cm;
        }

        .no-print {
            display: none !important;
        }

        body {
            background-color: white !important;
        }

        .card {
            box-shadow: none !important;
            border: none !important;
        }

        .container {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function downloadPDF() {
        var element = document.getElementById('printableArea');
        var opt = {
            margin: 12,
            filename: 'Surat_Izin_Publikasi_<?= str_replace(' ', '_', $nama_peneliti ?? '') ?>.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2,
                useCORS: true,
                scrollY: 0
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        };
        html2pdf().set(opt).from(element).save();
    }
</script>

<?= $this->endSection() ?>