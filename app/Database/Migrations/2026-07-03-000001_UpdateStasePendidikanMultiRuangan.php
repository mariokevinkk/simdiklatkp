<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateStasePendidikanMultiRuangan extends Migration
{
    public function up()
    {
        // Add new columns to stase_pendidikan (keep ruangan column as-is)
        $this->forge->addColumn('stase_pendidikan', [
            'profesi_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'nama_stase',
            ],
            'tanggal_mulai' => [
                'type'    => 'DATE',
                'null'    => true,
                'after'   => 'ruangan',
            ],
            'tanggal_akhir' => [
                'type'    => 'DATE',
                'null'    => true,
                'after'   => 'tanggal_mulai',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('stase_pendidikan', 'profesi_id');
        $this->forge->dropColumn('stase_pendidikan', 'tanggal_mulai');
        $this->forge->dropColumn('stase_pendidikan', 'tanggal_akhir');
    }
}
