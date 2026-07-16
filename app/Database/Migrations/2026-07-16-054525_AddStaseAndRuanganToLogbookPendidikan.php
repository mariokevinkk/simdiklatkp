<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStaseAndRuanganToLogbookPendidikan extends Migration
{
    public function up()
    {
        $fields = [];
        if (!$this->db->fieldExists('stase_id', 'logbook_pendidikan')) {
            $fields['stase_id'] = [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'penempatan_id'
            ];
        }
        if (!$this->db->fieldExists('ruangan_id', 'logbook_pendidikan')) {
            $fields['ruangan_id'] = [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'stase_id'
            ];
        }
        if (!empty($fields)) {
            $this->forge->addColumn('logbook_pendidikan', $fields);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('logbook_pendidikan', ['stase_id', 'ruangan_id']);
    }
}
