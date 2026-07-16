<?php
$path = FCPATH . 'assets/img/logo_rs_jogja.jpg';
$type = pathinfo($path, PATHINFO_EXTENSION);
$logoData = file_get_contents($path);
$logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($logoData);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Kelulusan</title>
    <style>
        @page { margin: 0; size: A4 landscape; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 30px;
            background: #fdfdfd;
            color: #333;
        }
        .container {
            border: 15px solid #004d40;
            padding: 10px;
            height: 660px; /* Force full page height approx */
        }
        .inner-border {
            border: 4px solid #d4af37;
            height: 625px; 
            text-align: center;
            position: relative;
            background: #fff;
            padding: 30px 40px 10px 40px;
            box-sizing: border-box;
        }
        .logo {
            width: 90px;
            margin-bottom: 15px;
        }
        .header {
            margin-bottom: 25px;
        }
        .title {
            font-size: 42px;
            font-weight: bold;
            color: #004d40;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 5px;
        }
        .subtitle {
            font-size: 16px;
            color: #666;
            letter-spacing: 1px;
            margin-bottom: 30px;
        }
        .presented-to {
            font-size: 16px;
            margin-bottom: 15px;
            font-style: italic;
        }
        .name {
            font-size: 36px;
            font-weight: bold;
            color: #000;
            margin-bottom: 5px;
            font-family: 'Georgia', serif;
            letter-spacing: 2px;
        }
        .name-line {
            width: 60%;
            height: 2px;
            background-color: #d4af37;
            margin: 0 auto 10px auto;
        }
        .nim {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }
        .description {
            font-size: 16px;
            line-height: 1.6;
            margin: 0 80px 25px 80px;
            color: #444;
        }
        .grade-box {
            background-color: #f8f9fa;
            border: 2px solid #004d40;
            display: inline-block;
            padding: 12px 40px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .grade-title {
            font-size: 13px;
            font-weight: bold;
            color: #666;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .grade-value {
            font-size: 30px;
            font-weight: bold;
            color: #004d40;
        }
        .signature-section {
            width: 100%;
            position: absolute;
            bottom: 30px;
            left: 0;
        }
        .signature-box {
            width: 40%;
            float: right;
            text-align: center;
            margin-right: 40px;
        }
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 70px;
            padding-top: 8px;
            font-size: 15px;
            font-weight: bold;
            color: #333;
        }
        .date {
            font-size: 15px;
            margin-bottom: 10px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="inner-border">
            <img src="<?= $logoBase64 ?>" class="logo" alt="Logo RSUD">
            
            <div class="header">
                <div class="title">Sertifikat Kelulusan</div>
                <div class="subtitle">Diberikan Sebagai Bukti Penyelesaian Pendidikan Praktik</div>
            </div>

            <div class="presented-to">Dengan bangga diberikan kepada:</div>
            
            <div class="name"><?= esc($mahasiswa['nama_lengkap']) ?></div>
            <div class="name-line"></div>
            <div class="nim">NIM: <?= esc($mahasiswa['nim']) ?></div>

            <div class="description">
                Telah berhasil menyelesaikan seluruh rangkaian program pendidikan praktik dan uji kompetensi di fasilitas pelayanan kesehatan dengan memenuhi standar kriteria kelulusan yang telah ditetapkan secara memuaskan.
            </div>

            <div class="grade-box">
                <div class="grade-title">Nilai Akhir</div>
                <div class="grade-value"><?= esc($mahasiswa['nilai_akhir']) ?></div>
            </div>

            <div class="signature-section">
                <div class="signature-box">
                    <div class="date">Yogyakarta, <?= date('d F Y') ?></div>
                    <div class="signature-line">
                        Direktur Pendidikan & Pelatihan<br>
                        RSUD Kota Yogyakarta
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
