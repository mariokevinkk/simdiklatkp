<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateStasePendidikanCiRuangan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'stase_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'ruangan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'ci_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'mahasiswa_ids' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('stase_id', 'stase_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('ci_id', 'ci_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('stase_ruangan_ci_pendidikan');
    }

    public function down()
    {
        $this->forge->dropTable('stase_ruangan_ci_pendidikan');
    }
}
