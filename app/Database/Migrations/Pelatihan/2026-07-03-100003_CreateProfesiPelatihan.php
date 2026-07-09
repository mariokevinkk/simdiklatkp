<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateProfesiPelatihan extends Migration
{
    public function up()
    {
        $this->forge->addField([
  'id_profesi' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'auto_increment' => true,
  ],
  'nama_profesi' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '100',
  ],
  'kategori_target' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '20',
    'null' => true,
    'default' => 'Non-Named',
  ],
  'target_jpl' => 
  [
    'type' => 'INT',
    'null' => true,
    'default' => '20',
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
        $this->forge->addKey('id_profesi', true);
        $this->forge->createTable('profesi_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('profesi_pelatihan',true);
    }
}
