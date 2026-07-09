<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNomorTeleponCiPendidikan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ci_pendidikan', [
            'nomor_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'nip',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('ci_pendidikan', 'nomor_telepon');
    }
}
