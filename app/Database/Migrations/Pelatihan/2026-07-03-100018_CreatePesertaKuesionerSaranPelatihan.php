<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreatePesertaKuesionerSaranPelatihan extends Migration
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
  'peserta_pelat_id' => 
  [
    'type' => 'INT',
    'unsigned' => true,
  ],
  'rating_umum' => 
  [
    'type' => 'INT',
    'default' => '5',
  ],
  'saran_masukan' => 
  [
    'type' => 'TEXT',
    'null' => true,
  ],
  'waktu_submit' => 
  [
    'type' => 'DATETIME',
    'null' => true,
  ],
]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('peserta_kuesioner_saran_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('peserta_kuesioner_saran_pelatihan',true);
    }
}
