<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateKuesionerMasterPelatihan extends Migration
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
  'kategori_id' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'null' => true,
  ],
  'pertanyaan' => 
  [
    'type' => 'TEXT',
  ],
]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kuesioner_master_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('kuesioner_master_pelatihan',true);
    }
}
