<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMouDatesToInstitusiPendidikan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('institusi_pendidikan', [
            'tgl_mulai_mou' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'file_permohonan',
            ],
            'tgl_selesai_mou' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'tgl_mulai_mou',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('institusi_pendidikan', 'tgl_mulai_mou');
        $this->forge->dropColumn('institusi_pendidikan', 'tgl_selesai_mou');
    }
}
