<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreatePesertaPresensiPelatihan extends Migration
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
  'sesi_id' => 
  [
    'type' => 'INT',
    'unsigned' => true,
  ],
  'status_hadir' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'Hadir',
      1 => 'Izin',
      2 => 'Alfa',
    ],
    'default' => 'Hadir',
  ],
  'waktu_absen' => 
  [
    'type' => 'DATETIME',
    'null' => true,
  ],
]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('peserta_presensi_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('peserta_presensi_pelatihan',true);
    }
}
