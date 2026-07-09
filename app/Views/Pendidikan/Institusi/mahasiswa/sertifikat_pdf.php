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
            background: #fff;
            color: #333;
        }
        .container {
            border: 12px solid #004d40;
            padding: 8px;
            /* No explicit height, let content dictate, but ensure it fits */
        }
        .inner-border {
            border: 3px solid #d4af37;
            padding: 20px 40px 10px 40px;
            text-align: center;
        }
        .header {
            margin-bottom: 25px;
        }
        .title {
            font-size: 38px;
            font-weight: bold;
            color: #004d40;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 4px;
        }
        .subtitle {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }
        .presented-to {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .name {
            font-size: 32px;
            font-weight: bold;
            color: #000;
            margin-bottom: 10px;
            border-bottom: 2px solid #d4af37;
            display: inline-block;
            padding-bottom: 5px;
        }
        .nim {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }
        .description {
            font-size: 16px;
            line-height: 1.5;
            margin: 0 40px 20px 40px;
        }
        .grade-box {
            background-color: #f8f9fa;
            border: 2px solid #004d40;
            display: inline-block;
            padding: 10px 30px;
            margin-bottom: 20px;
        }
        .grade-title {
            font-size: 14px;
            font-weight: bold;
            color: #666;
            margin-bottom: 5px;
        }
        .grade-value {
            font-size: 26px;
            font-weight: bold;
            color: #004d40;
        }
        .signature-section {
            width: 100%;
            margin-top: 10px;
        }
        .signature-box {
            width: 35%;
            float: right;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 50px;
            padding-top: 8px;
            font-size: 14px;
            font-weight: bold;
        }
        .date {
            font-style: italic;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="inner-border">
            <div class="header">
                <div class="title">SERTIFIKAT KELULUSAN</div>
                <div class="subtitle">Diberikan Sebagai Bukti Penyelesaian Pendidikan Praktik</div>
            </div>

            <div class="presented-to">Sertifikat ini diberikan dengan bangga kepada:</div>
            
            <div class="name"><?= esc($mahasiswa['nama_lengkap']) ?></div>
            <div class="nim">NIM: <?= esc($mahasiswa['nim']) ?></div>

            <div class="description">
                Telah menyelesaikan seluruh rangkaian program pendidikan praktik dan uji kompetensi di fasilitas pelayanan kesehatan dengan memenuhi standar dan kriteria kelulusan yang telah ditetapkan.
            </div>

            <div class="grade-box">
                <div class="grade-title">NILAI AKHIR</div>
                <div class="grade-value"><?= esc($mahasiswa['nilai_akhir']) ?></div>
            </div>

            <div class="signature-section">
                <div class="signature-box">
                    <div class="date">Ditetapkan pada, <?= date('d F Y') ?></div>
                    <div class="signature-line">
                        Direktur Pendidikan & Pelatihan<br>
                        (Tanda Tangan)
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
</body>
</html>
