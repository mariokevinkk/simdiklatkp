<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreatePejabatTtdPelatihan extends Migration
{
    public function up()
    {
        $this->forge->addField([
  'id' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'auto_increment' => true,
  ],
  'an_pejabat' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
    'null' => true,
  ],
  'jabatan' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
  ],
  'nama_pejabat' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
  ],
  'nip_pejabat' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '30',
    'null' => true,
  ],
  'ttd_image' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'created_at' => 
  [
    'type' => 'DATETIME',
    'null' => true,
  ],
  'updated_at' => 
  [
    'type' => 'DATETIME',
    'null' => true,
  ],
]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pejabat_ttd_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('pejabat_ttd_pelatihan', true);
    }
}
