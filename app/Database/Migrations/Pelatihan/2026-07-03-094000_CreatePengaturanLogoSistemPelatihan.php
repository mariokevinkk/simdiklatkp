<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreatePengaturanLogoSistemPelatihan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'logo_path' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'favicon_path' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pengaturan_logo_sistem_pelatihan');

        // Seed default row
        $db = \Config\Database::connect();
        $db->table('pengaturan_logo_sistem_pelatihan')->insert([
            'id' => 1,
            'logo_path' => 'assets/img/logo_rs.jpg',
            'favicon_path' => 'assets/img/logo_rs.jpg',
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('pengaturan_logo_sistem_pelatihan',true);
    }
}
