<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNilaiAkhirToMahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addColumn('mahasiswa_pendidikan', [
            'nilai_akhir' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'null' => true,
                'default' => null,
                'after' => 'status'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('mahasiswa_pendidikan', 'nilai_akhir');
    }
}
