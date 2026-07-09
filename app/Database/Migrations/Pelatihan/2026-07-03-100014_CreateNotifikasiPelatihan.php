<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateNotifikasiPelatihan extends Migration
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
  'title' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'message' => 
  [
    'type' => 'TEXT',
    'null' => true,
  ],
  'type' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '50',
    'default' => 'info',
  ],
  'is_read' => 
  [
    'type' => 'TINYINT',
    'constraint' => '1',
    'default' => '0',
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
        $this->forge->createTable('notifikasi_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('notifikasi_pelatihan',true);
    }
}
