<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateSesiInteraktifPelatihan extends Migration
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
  'tipe_sesi' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'online',
      1 => 'offline',
    ],
    'default' => 'offline',
  ],
  'nama_sesi' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'tanggal' => 
  [
    'type' => 'DATE',
    'null' => true,
  ],
  'waktu' => 
  [
    'type' => 'TIME',
    'null' => true,
  ],
  'jam_tutup' => 
  [
    'type' => 'TIME',
    'null' => true,
  ],
  'lokasi_ruang' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'tempat' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'alamat' => 
  [
    'type' => 'TEXT',
    'null' => true,
  ],
  'maps_url' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'meeting_link' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'meeting_pass' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '50',
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
        $this->forge->createTable('sesi_interaktif_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('sesi_interaktif_pelatihan',true);
    }
}
