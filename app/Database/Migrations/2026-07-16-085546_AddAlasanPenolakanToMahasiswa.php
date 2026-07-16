<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAlasanPenolakanToMahasiswa extends Migration
{
    public function up()
    {
        if (!$this->db->fieldExists('alasan_penolakan', 'mahasiswa_pendidikan')) {
            $this->forge->addColumn('mahasiswa_pendidikan', [
                'alasan_penolakan' => [
                    'type' => 'TEXT',
                    'null' => true,
                    'after' => 'catatan_revisi'
                ],
            ]);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('mahasiswa_pendidikan', 'alasan_penolakan');
    }
}
