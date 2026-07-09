<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusMahasiswaPendidikan extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `mahasiswa_pendidikan` ADD `status` ENUM('Menunggu','Disetujui','Ditolak','Lulus') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Menunggu' AFTER `file_sk`");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `mahasiswa_pendidikan` DROP `status`");
    }
}
