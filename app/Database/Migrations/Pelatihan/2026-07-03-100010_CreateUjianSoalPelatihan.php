<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateUjianSoalPelatihan extends Migration
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
  'ujian_id' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'null' => true,
  ],
  'tipe_soal' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'Pilihan Ganda',
      1 => 'Benar Salah',
    ],
    'default' => 'Pilihan Ganda',
  ],
  'pertanyaan' => 
  [
    'type' => 'TEXT',
  ],
  'file_path' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'opsi_a' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'opsi_b' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'opsi_c' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'opsi_d' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'jawaban_benar' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '1',
    'null' => true,
  ],
]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ujian_soal_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('ujian_soal_pelatihan',true);
    }
}
