<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPendidikanTables extends Migration
{
    public function up()
    {
        // 1. Alter ci_pendidikan
        $this->forge->dropColumn('ci_pendidikan', ['ruangan_tugas', 'spesialisasi']);
        $this->forge->addColumn('ci_pendidikan', [
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'nama_lengkap',
            ]
        ]);


    }

    public function down()
    {

        // Reverse ci_pendidikan
        $this->forge->dropColumn('ci_pendidikan', 'email');
        $this->forge->addColumn('ci_pendidikan', [
            'ruangan_tugas' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'spesialisasi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ]
        ]);
    }
}
