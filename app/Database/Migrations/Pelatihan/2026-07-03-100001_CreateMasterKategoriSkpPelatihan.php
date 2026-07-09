<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateMasterKategoriSkpPelatihan extends Migration
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
  'ranah' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '100',
  ],
  'nama_kategori' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
  ],
]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('master_kategori_skp_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('master_kategori_skp_pelatihan',true);
    }
}
