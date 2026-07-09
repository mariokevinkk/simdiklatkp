<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateUsersPelatihan extends Migration
{
    public function up()
    {
        $this->forge->addField([
  'nik' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '16',
  ],
  'nama_lengkap' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
  ],
  'email' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
  ],
  'no_wa' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '20',
  ],
  'jenis_peserta' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'named',
      1 => 'non_named',
    ],
    'default' => 'named',
  ],
  'role' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'admin',
      1 => 'admin_pengabdian',
      2 => 'peserta',
    ],
    'default' => 'peserta',
  ],
  'status' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'aktif',
      1 => 'nonaktif',
    ],
    'default' => 'aktif',
  ],
  'id_unit_kerja' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'null' => true,
  ],
  'id_profesi' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'null' => true,
  ],

  'capaian_jpl' => 
  [
    'type' => 'INT',
    'null' => true,
    'default' => '0',
  ],
  'password' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
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
        $this->forge->addKey('nik', true);
        $this->forge->createTable('users_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('users_pelatihan',true);
    }
}
