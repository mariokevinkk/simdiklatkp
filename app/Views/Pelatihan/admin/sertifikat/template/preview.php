<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Sertifikat JPL') ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= get_system_favicon() ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        @page { size: A4 landscape; margin: 0; }
        body { margin: 0; padding: 0; background-color: #e2e8f0; font-family: 'Montserrat', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .certificate-page { width: 297mm; height: 210mm; background-color: <?= esc($template['background_color'] ?? '#fefaf2') ?>; position: relative; box-sizing: border-box; padding: 12mm; box-shadow: 0 1rem 3rem rgba(0,0,0,0.15); display: flex; justify-content: center; align-items: center; overflow: hidden; page-break-after: always; }
        .certificate-border { width: 100%; height: 100%; border: 4px double #b5945b; box-sizing: border-box; padding: 8mm; position: relative; display: flex; flex-direction: column; justify-content: space-between; align-items: center; z-index: 2; }
        .corner-element { position: absolute; width: 15mm; height: 15mm; border-color: #b5945b; border-style: solid; border-width: 0; }
        .corner-top-left { top: 4mm; left: 4mm; border-top-width: 4px; border-left-width: 4px; }
        .corner-top-right { top: 4mm; right: 4mm; border-top-width: 4px; border-right-width: 4px; }
        .corner-bottom-left { bottom: 4mm; left: 4mm; border-bottom-width: 4px; border-left-width: 4px; }
        .corner-bottom-right { bottom: 4mm; right: 4mm; border-bottom-width: 4px; border-right-width: 4px; }
        .watermark { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 110mm; height: 110mm; opacity: 0.04; background-image: url('<?= get_system_logo() ?>'); background-size: contain; background-position: center; background-repeat: no-repeat; pointer-events: none; z-index: 1; }
        .certificate-content { width: 100%; z-index: 2; text-align: center; display: flex; flex-direction: column; justify-content: space-between; height: 100%; }
        
        .cert-header { margin-bottom: 2mm; display: flex; flex-direction: column; align-items: center; }
        .logo-row { display: flex; align-items: center; justify-content: center; gap: 6mm; margin-bottom: 3mm; }
        .logo-img-header { height: 15mm; width: auto; object-fit: contain; }
        
        .cert-title { font-family: 'Playfair Display', serif; font-size: 1.85rem; color: #1e293b; margin: 0; font-weight: 700; text-decoration: underline; text-decoration-color: #b5945b; text-underline-offset: 4px; }
        .cert-number { font-family: 'Playfair Display', serif; font-size: 0.95rem; color: #475569; margin-top: 1mm; font-weight: 500; letter-spacing: 0.5px; }

        .cert-recipient-label { font-size: 0.9rem; color: #64748b; margin-top: 4mm; text-transform: capitalize; font-weight: 500; }
        .cert-recipient-name { font-family: 'Playfair Display', serif; font-size: 2.2rem; font-weight: 700; color: #0f172a; margin: 2mm 0; letter-spacing: 0.5px; }
        .cert-participation-label { font-size: 0.85rem; color: #64748b; margin-top: 1mm; font-weight: 500; }
        .cert-activity { font-size: 1.25rem; font-weight: 600; color: #0f172a; margin: 2mm auto; max-width: 220mm; line-height: 1.35; }
        .cert-activity-title { font-family: 'Playfair Display', serif; font-size: 1.45rem; font-weight: 700; color: #0f172a; display: block; margin-top: 1mm; }
        .cert-subheading { font-size: 0.75rem; color: #475569; font-style: italic; margin-top: 1mm; font-weight: 500; }

        .cert-role-label { font-size: 0.95rem; font-weight: 600; color: #475569; margin-top: 4mm; text-transform: capitalize; }
        .cert-hours-jpl { font-size: 0.95rem; font-weight: 700; color: #ce2127; margin-top: 2mm; letter-spacing: 0.2px; }

        .cert-footer { width: 100%; margin-top: 5mm; display: flex; justify-content: space-around; align-items: flex-end; position: relative; }
        .sig-block { text-align: center; width: 75mm; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; position: relative; }
        .sig-label-an { font-size: 0.7rem; color: #64748b; text-transform: lowercase; margin-bottom: 0.5mm; font-weight: 500; }
        .sig-label-jabatan { font-size: 0.75rem; color: #1e293b; font-weight: 600; line-height: 1.2; height: 7mm; display: flex; align-items: center; justify-content: center; z-index: 10; }
        
        .sig-space { height: 16mm; display: flex; align-items: center; justify-content: center; position: relative; width: 100%; margin-top: 2mm; margin-bottom: 2mm; }
        .sig-png { position: absolute; max-height: 22mm; width: auto; max-width: 100%; object-fit: contain; mix-blend-mode: multiply; z-index: 1; pointer-events: none; }
        
        .sig-name { font-size: 0.8rem; font-weight: 700; color: #0f172a; text-decoration: underline; margin-bottom: 0.5mm; z-index: 10; position: relative; }
        .sig-nip { font-size: 0.7rem; color: #475569; font-weight: 500; z-index: 10; position: relative; }

        .qr-section { position: absolute; bottom: 0; left: 2mm; display: flex; flex-direction: column; align-items: center; gap: 1mm; z-index: 10; }
        .qr-code-img { width: 20mm; height: 20mm; border: 1px solid #b5945b; padding: 1px; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .qr-label { font-size: 0.55rem; color: #64748b; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; }

        .action-bar { position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; background: rgba(15, 23, 42, 0.95); padding: 10px 24px; border-radius: 50px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); display: flex; gap: 15px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); }
        .action-btn { background: transparent; color: white; border: none; font-weight: 700; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; gap: 8px; padding: 6px 14px; border-radius: 30px; transition: 0.2s; }
        .action-btn:hover { background: rgba(255, 255, 255, 0.15); }
        .action-btn.btn-print { background: #ce2127; }
        .action-btn.btn-print:hover { background: #b51c22; }

        @media print {
            .action-bar { display: none !important; }
            body { background-color: white; min-height: auto; }
            .certificate-page { box-shadow: none; margin: 0; padding: 12mm; width: 297mm; height: 210mm; }
        }
    </style>
</head>
<body>

    <div class="action-bar" id="actionBar">
        <button class="action-btn btn-print" onclick="downloadPDF()">
            <i class="fas fa-file-pdf"></i> UNDUH PDF
        </button>
        <button class="action-btn" onclick="window.close()">
            <i class="fas fa-times"></i> TUTUP
        </button>
    </div>

    <div id="pdf-content">
    <?php 
    // Fallback if no users exist
    if (empty($users)) {
        $users = [['nama_lengkap' => 'NAMA PESERTA', 'nik' => '']];
    }
    
    foreach ($users as $user): 
        // Resolving display variables
        if (isset($cert)) {
            // External Certificate Preview
            $recipientName = $user['nama_lengkap'] ?? $cert['user_nama'];
            $activityTitle = $cert['judul'];
            $noSertifikatDisplay = $cert['no_sertifikat'] ?? '-';
            $jplDisplay = number_format($cert['skp'], 0);
            $bgColor = '#ffffff';
            $logoImg = get_system_logo();
            $penerbit = $cert['penerbit'] ?? 'Lembaga Eksternal';
            $qrVerifyText = 'VERIFIED_EXTERNAL_' . $noSertifikatDisplay;
            $isExternal = true;
            
            $months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $monthIdx = (int)date('n', strtotime($cert['tanggal_selesai'] ?? date('Y-m-d')));
            $tanggalTerbit = date('d', strtotime($cert['tanggal_selesai'] ?? date('Y-m-d'))) . ' ' . $months[$monthIdx] . ' ' . date('Y', strtotime($cert['tanggal_selesai'] ?? date('Y-m-d')));
        } else {
            // Internal RSUD Template Preview
            $recipientName = $user['nama_lengkap'] ?? 'NAMA PESERTA';
            $activityTitle = $pelatihan['nama'] ?? '-';
            
            // Format number specific to the user
            $noSertifikatDisplay = $no_sertifikat ?? '-';
            if(isset($pelatihan['id']) && isset($user['nik']) && $recipientName !== 'NAMA PESERTA') {
                $pesertaData = \Config\Database::connect()->table('peserta_pelatihan')
                                ->where('pelatihan_id', $pelatihan['id'])
                                ->where('user_id', $user['nik'])
                                ->get()->getRowArray();
                if ($pesertaData) {
                    $noSertifikatDisplay = str_replace('{id}', str_pad($pesertaData['id'], 4, '0', STR_PAD_LEFT), $noSertifikatDisplay);
                }
            }

            $jplDisplay = $pelatihan['jpl'] ?? 0;
            $bgColor = $template['background_color'] ?? '#fefaf2';
            $logoImg = get_system_logo();
            if (!empty($template['logo_header'])) {
                if (strpos($template['logo_header'], 'assets/') === 0) {
                    $logoImg = base_url($template['logo_header']);
                } else {
                    $checkPath = FCPATH . 'uploads/pelatihan/' . $template['logo_header'];
                    if (file_exists($checkPath)) {
                        $logoImg = base_url('uploads/pelatihan/' . $template['logo_header']);
                    }
                }
            }
            $penerbit = 'RSUD Kota Yogyakarta';
            $isExternal = false;
            
            // Generate Tanggal Terbit from training end date
            $tglSelesai = $pelatihan['tanggal_selesai'] ?? date('Y-m-d');
            $months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            $monthIdx = (int)date('n', strtotime($tglSelesai));
            $tanggalTerbit = date('d', strtotime($tglSelesai)) . ' ' . $months[$monthIdx] . ' ' . date('Y', strtotime($tglSelesai));

            // Resolve Signers
            $an_1 = $template['an_1'] ?? '';
            $jab_1 = $template['jab_1'] ?? '';
            $nama_1 = $template['nama_1'] ?? '';
            $nip_1 = $template['nip_1'] ?? '';
            $ttd_1 = $template['ttd_1'] ?? '';
            $qr_1 = $template['qr_1'] ?? 'VERIFIED_SIGNATURE_1';

            $an_2 = $template['an_2'] ?? '';
            $jab_2 = $template['jab_2'] ?? '';
            $nama_2 = $template['nama_2'] ?? '';
            $nip_2 = $template['nip_2'] ?? '';
            $ttd_2 = $template['ttd_2'] ?? '';
            $qr_2 = $template['qr_2'] ?? '';
        }
    ?>

    <div class="certificate-page" style="background-color: <?= esc($bgColor) ?>;">
        <div class="certificate-border">
            <div class="corner-element corner-top-left"></div>
            <div class="corner-element corner-top-right"></div>
            <div class="corner-element corner-bottom-left"></div>
            <div class="corner-element corner-bottom-right"></div>

            <div class="certificate-content">
                <div class="cert-header">
                    <div class="logo-row">
                        <img src="<?= esc($logoImg) ?>" class="logo-img-header" style="height: 18mm;">
                    </div>
                    
                    <h2 class="cert-title" style="margin-top: 2mm; text-transform: uppercase; font-size: 1.8rem; text-decoration: none; color: #0f172a; margin-bottom: 0;"><?= esc($pelatihan['program'] ?? 'SERTIFIKAT') ?></h2>
                    <div style="font-family: 'Montserrat', sans-serif; font-size: 0.8rem; font-weight: 600; color: #64748b; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 1mm;">KATEGORI: <?= esc($pelatihan['kategori'] ?? 'UMUM') ?> &nbsp;|&nbsp; TINGKAT <?= esc($pelatihan['cakupan'] ?? 'LOKAL') ?></div>
                    <div class="cert-number" style="font-weight: 600; font-size: 0.95rem; color: #b5945b; margin-top: 1mm;">Nomor: <?= esc($noSertifikatDisplay) ?></div>
                </div>

                <div style="margin-top: 2mm; margin-bottom: 2mm;">
                    <div class="cert-recipient-label" style="font-size: 0.9rem; margin-bottom: 0;">Diberikan kepada:</div>
                    <div class="cert-recipient-name" style="font-size: 2.6rem; margin: 1mm 0; border-bottom: 1px solid #cbd5e1; display: inline-block; padding: 0 10mm; font-weight: 700; color: #1e293b;"><?= esc($recipientName) ?></div>
                    
                    <div class="cert-participation-label" style="font-size: 0.9rem; margin-top: 1mm;">Atas partisipasinya sebagai Peserta pada kegiatan:</div>
                    <div class="cert-activity-title" style="margin-top: 1mm; text-align: center; color: #0f172a; font-size: 1.4rem; max-width: 240mm; margin-left: auto; margin-right: auto; line-height: 1.3;">"<?= esc($activityTitle) ?>"</div>
                    
                    <?php 
                        // Format dates
                        $tglMulai = $pelatihan['jadwal_mulai'] ?? date('Y-m-d');
                        $tglSelesai = $pelatihan['jadwal_selesai'] ?? date('Y-m-d');
                        $strTgl = tanggal_indo($tglMulai) . ' s/d ' . tanggal_indo($tglSelesai);
                    ?>
                    <div style="font-size: 0.85rem; font-weight: 600; color: #475569; margin-top: 1mm;">Diselenggarakan pada tanggal <?= esc($strTgl) ?> dengan beban <?= esc($jplDisplay) ?> JPL</div>
                    
                    <?php if(!empty($pelatihan['kompetensi'])): ?>
                    <div style="margin-top: 2mm; font-size: 0.8rem; color: #334155; font-style: italic; max-width: 230mm; margin-left: auto; margin-right: auto; line-height: 1.3;">
                        <span style="font-weight: 600; color: #b5945b;">Kompetensi:</span> <?= esc($pelatihan['kompetensi']) ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="cert-footer" style="margin-top: auto; padding-top: 2mm; position: relative;">
                    <div style="width: 100%; text-align: right; padding-right: 15mm; font-size: 0.8rem; font-weight: 500; color: #475569; position: absolute; top: 0; right: 0;">
                        Yogyakarta, <?= esc($tanggalTerbit) ?>
                    </div>
                    
                    <div style="display: flex; width: 100%; justify-content: space-around; margin-top: 4mm;">
                        <?php if(!$isExternal && !empty($nama_1)): ?>
                            <div class="sig-block" style="width: 80mm;">
                                <?php if(!empty($an_1)): ?>
                                    <div class="sig-label-an" style="font-size: 0.75rem; margin-bottom: 0;"><?= esc($an_1) ?></div>
                                <?php endif; ?>
                                <div class="sig-label-jabatan" style="font-size: 0.8rem; height: auto; margin-bottom: 1mm;"><?= esc($jab_1) ?></div>
                                <div class="sig-space" style="height: 18mm;">
                                    <?php if(!empty($ttd_1) && file_exists(FCPATH . 'uploads/pelatihan/' . $ttd_1)): ?>
                                        <img src="<?= base_url('uploads/pelatihan/' . $ttd_1) ?>" alt="TTD" class="sig-png" style="max-height: 18mm;">
                                    <?php endif; ?>
                                </div>
                                <div class="sig-name" style="font-size: 0.95rem; margin-top: 1mm; font-weight: 700; color: #0f172a; text-decoration: underline;"><?= esc($nama_1) ?></div>
                                <div class="sig-nip" style="font-size: 0.75rem; color: #475569;">NIP. <?= esc($nip_1) ?></div>
                            </div>
                        <?php endif; ?>

                        <?php if(!$isExternal && !empty($nama_2)): ?>
                            <div class="sig-block" style="width: 80mm;">
                                <?php if(!empty($an_2)): ?>
                                    <div class="sig-label-an" style="font-size: 0.75rem; margin-bottom: 0;"><?= esc($an_2) ?></div>
                                <?php endif; ?>
                                <div class="sig-label-jabatan" style="font-size: 0.8rem; height: auto; margin-bottom: 1mm;"><?= esc($jab_2) ?></div>
                                <div class="sig-space" style="height: 18mm;">
                                    <?php if(!empty($ttd_2) && file_exists(FCPATH . 'uploads/pelatihan/' . $ttd_2)): ?>
                                        <img src="<?= base_url('uploads/pelatihan/' . $ttd_2) ?>" alt="TTD" class="sig-png" style="max-height: 18mm;">
                                    <?php endif; ?>
                                </div>
                                <div class="sig-name" style="font-size: 0.95rem; margin-top: 1mm; font-weight: 700; color: #0f172a; text-decoration: underline;"><?= esc($nama_2) ?></div>
                                <div class="sig-nip" style="font-size: 0.75rem; color: #475569;">NIP. <?= esc($nip_2) ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php endforeach; ?>
    </div>

    <script>
        function downloadPDF() {
            const element = document.getElementById('pdf-content');
            const actionBar = document.getElementById('actionBar');
            actionBar.style.display = 'none'; // hide buttons during capture
            
            const opt = {
                margin:       0,
                filename:     'sertifikat_<?= esc($isExternal ? ($cert['id'] ?? 'ext') : ($pelatihan['id'] ?? 'batch')) ?>.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true, letterRendering: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape' }
            };

            // Workaround for html2pdf to process multiple pages properly using the page-break-after css
            html2pdf().set(opt).from(element).save().then(() => {
                actionBar.style.display = 'flex'; // show buttons again
            });
        }

        // Auto download if query parameter auto=1 is present
        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('auto') === '1') {
                // small delay to ensure rendering is complete
                setTimeout(() => {
                    downloadPDF();
                }, 1000);
            }
        });
    </script>
</body>
</html>