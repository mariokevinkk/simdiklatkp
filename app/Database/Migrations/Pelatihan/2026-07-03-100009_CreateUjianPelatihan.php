<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateUjianPelatihan extends Migration
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
  'pelatihan_id' => 
  [
    'type' => 'INT',
    'unsigned' => true,
  ],
  'tipe_evaluasi' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'Pre-Test',
      1 => 'Post-Test',
      2 => 'Kuis',
    ],
    'default' => 'Kuis',
  ],
  'kkm' => 
  [
    'type' => 'INT',
    'default' => '0',
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
        $this->forge->createTable('ujian_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('ujian_pelatihan',true);
    }
}
