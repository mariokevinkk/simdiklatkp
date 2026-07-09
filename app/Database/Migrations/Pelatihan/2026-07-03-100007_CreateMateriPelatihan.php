<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateMateriPelatihan extends Migration
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
  'sesi_id' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'null' => true,
  ],
  'segmen' => 
  [
    'type' => 'INT',
    'null' => true,
    'default' => '1',
  ],
  'urutan' => 
  [
    'type' => 'DECIMAL',
    'constraint' => '4,1',
    'default' => '1.0',
  ],
  'judul' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
  ],
  'tipe' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'video',
      1 => 'pdf',
      2 => 'artikel',
      3 => 'zoom',
      4 => 'offline',
    ],
    'default' => 'pdf',
  ],
  'deskripsi' => 
  [
    'type' => 'TEXT',
    'null' => true,
  ],
  'file_path' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
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
        $this->forge->createTable('materi_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('materi_pelatihan',true);
    }
}
