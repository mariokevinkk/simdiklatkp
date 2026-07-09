<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateUnitKerjaPelatihan extends Migration
{
    public function up()
    {
        $this->forge->addField([
  'id_unit_kerja' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'auto_increment' => true,
  ],
  'nama_unit' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '100',
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
        $this->forge->addKey('id_unit_kerja', true);
        $this->forge->createTable('unit_kerja_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('unit_kerja_pelatihan',true);
    }
}
