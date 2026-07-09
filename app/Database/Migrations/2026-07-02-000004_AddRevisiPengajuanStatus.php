<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRevisiPengajuanStatus extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `pengajuan_praktik_pendidikan` CHANGE `status` `status` ENUM('Menunggu','Disetujui','Ditolak','Revisi','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Menunggu'");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `pengajuan_praktik_pendidikan` CHANGE `status` `status` ENUM('Menunggu','Disetujui','Ditolak','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Menunggu'");
    }
}
