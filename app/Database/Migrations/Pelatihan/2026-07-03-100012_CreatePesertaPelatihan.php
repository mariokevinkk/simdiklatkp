<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreatePesertaPelatihan extends Migration
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
  'user_id' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '16',
  ],
  'pelatihan_id' => 
  [
    'type' => 'INT',
    'unsigned' => true,
  ],
  'status_peserta' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'Daftar',
      1 => 'Lulus',
      2 => 'Gagal',
    ],
    'default' => 'Daftar',
  ],
  'bukti_bayar' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'status_pembayaran' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'Gratis',
      1 => 'Pending',
      2 => 'Verified',
      3 => 'Rejected',
    ],
    'null' => true,
    'default' => 'Gratis',
  ],
  'status_akses' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'Terbuka',
      1 => 'Pending',
      2 => 'Approved',
      3 => 'Rejected',
    ],
    'null' => true,
    'default' => 'Terbuka',
  ],
  'waktu_daftar' => 
  [
    'type' => 'DATETIME',
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
        $this->forge->createTable('peserta_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('peserta_pelatihan',true);
    }
}
