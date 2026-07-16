<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStaseAndRuanganToLogbookPendidikan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('logbook_pendidikan', [
            'stase_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'penempatan_id'
            ],
            'ruangan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'stase_id'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('logbook_pendidikan', ['stase_id', 'ruangan_id']);
    }
}
