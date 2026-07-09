<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateSertifTerbitPelatihan extends Migration
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
  'no_sertifikat' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
    'null' => true,
  ],
  'background_color' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '30',
    'default' => '#ffffff',
  ],
  'logo_header' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'pejabat_id_1' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'null' => true,
  ],
  'pejabat_id_2' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'null' => true,
  ],
  'status' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '50',
    'default' => 'draft',
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
  'custom_an_1' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
    'null' => true,
  ],
  'custom_jabatan_1' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
    'null' => true,
  ],
  'custom_nama_1' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
    'null' => true,
  ],
  'custom_nip_1' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '50',
    'null' => true,
  ],
  'custom_qr_1' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'custom_an_2' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
    'null' => true,
  ],
  'custom_jabatan_2' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
    'null' => true,
  ],
  'custom_nama_2' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
    'null' => true,
  ],
  'custom_nip_2' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '50',
    'null' => true,
  ],
  'custom_qr_2' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sertif_terbit_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('sertif_terbit_pelatihan', true);
    }
}
