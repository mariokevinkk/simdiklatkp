<?= $this->extend('riset/peneliti/layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <div class="card border-0 shadow-lg mx-auto bg-white" style="max-width: 800px; border-radius: 0;">
        <div id="printableArea" class="card-body py-4 px-5 bg-white text-dark">
            <!-- Kop Surat -->
            <div class="position-relative d-flex justify-content-center align-items-center mb-3 border-bottom border-3 border-dark pb-2">
                <div style="position: absolute; left: 0;">
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

            <!-- Isi Surat -->
            <div class="text-center mb-3">
                <h5 class="fw-bold text-decoration-underline mb-0">SURAT IZIN PENELITIAN</h5>
                <p class="mb-0">No. <?= !empty($nomor_surat) ? esc($nomor_surat) : '-' ?></p>
            </div>

            <div class="mb-3" style="line-height: 1.35; text-align: justify; font-size: 14px;">
                <p class="mb-2">Dengan ini Direktur RSUD Kota Yogyakarta memberikan izin kepada :</p>
                
                <table class="table table-borderless table-sm mb-3 ms-4" style="font-size: 14px;">
                    <tr>
                        <td width="180" class="py-1">Nama</td>
                        <td width="20" class="py-1">:</td>
                        <td class="fw-bold py-1"><?= $nama_peneliti ?? 'Khansa Rohadatul Rizky' ?></td>
                    </tr>
                    <tr>
                        <td class="py-1">NIM</td>
                        <td class="py-1">:</td>
                        <td class="py-1"><?= $nim ?? 'P07137123040' ?></td>
                    </tr>
                    <tr>
                        <td class="py-1">Program Studi</td>
                        <td class="py-1">:</td>
                        <td class="py-1"><?= $prodi ?? 'D3 Rekam Medis Dan Informasi Kesehatan' ?></td>
                    </tr>
                    <tr>
                        <td class="py-1">Institusi</td>
                        <td class="py-1">:</td>
                        <td class="py-1"><?= $institusi ?? 'Politeknik Kesehatan Kementerian Kesehatan Yogyakarta' ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 align-top">Keperluan</td>
                        <td class="py-1 align-top">:</td>
                        <td class="py-1 align-top">
                            Melakukan Penelitian Di RSUD Kota Yogyakarta Dengan Judul:<br>
                            <span class="fw-bold">"<?= $judul_riset ?? 'Analisis Tingkat Kepuasan Pengguna Rekam Medis Elektronik Di Instalasi Bedah Sentral RSUD Kota Yogyakarta' ?>"</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1">Waktu</td>
                        <td class="py-1">:</td>
                        <td class="py-1"><?= $waktu_mulai ?? '13 Mei 2026' ?> s/d <?= $waktu_selesai ?? '13 Agustus 2026' ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 align-top">Dengan ketentuan</td>
                        <td class="py-1 align-top">:</td>
                        <td class="py-1 align-top">
                            <ol class="ps-3 mb-0" style="list-style-type: decimal;">
                                <li class="mb-1">Wajib mengikuti tata tertib yang berlaku</li>
                                <li>Setelah selesai agar mengirimkan laporan hasil penelitian dalam bentuk softcopy ke E-mail KEPK RSUD Kota Yogyakarta: (kepk.rsudkotayk@gmail.com)</li>
                            </ol>
                        </td>
                    </tr>
                </table>

                <p class="mb-3">Kepada semua pihak agar dapat memberikan bantuan seperlunya.</p>

                <p>Demikian surat izin ini kami buat untuk dapat dipergunakan sebagaimana mestinya.</p>
            </div>

            <!-- Tanda Tangan -->
            <div class="row mt-2">
                <div class="col-7"></div>
                <div class="col-5 text-start">
                    <?php
                        $bulanIndo = [
                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
                            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
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
            margin:       12,
            filename:     'Surat_Izin_Penelitian_<?= str_replace(' ', '_', $nama_peneliti ?? '') ?>.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, useCORS: true, scrollY: 0 },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };
        html2pdf().set(opt).from(element).save();
    }
</script>

<?= $this->endSection() ?>
