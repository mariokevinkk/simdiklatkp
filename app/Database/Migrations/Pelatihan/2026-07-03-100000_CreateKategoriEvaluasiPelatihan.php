<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateKategoriEvaluasiPelatihan extends Migration
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
  'nama_kategori' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '100',
  ],
]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kategori_evaluasi_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_evaluasi_pelatihan',true);
    }
}
