<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProfesiToMahasiswaPendidikan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('mahasiswa_pendidikan', [
            'id_profesi' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'institusi_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('mahasiswa_pendidikan', 'id_profesi');
    }
}
