<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAlasanPenolakanToMahasiswaPendidikan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('mahasiswa_pendidikan', [
            'alasan_penolakan' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'file_bukti_bayar'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('mahasiswa_pendidikan', 'alasan_penolakan');
    }
}
