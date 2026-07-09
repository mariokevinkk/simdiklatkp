<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProfesiUnitKerjaCiPendidikan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('ci_pendidikan', [
            'id_profesi' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'spesialisasi',
            ],
            'id_unit_kerja' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id_profesi',
            ],
        ]);
    }

    public function down()
    {
        try {
            $this->forge->dropForeignKey('ci_pendidikan', 'fk_ci_pendidikan_profesi');
        } catch (\Exception $e) {
            // ignore if not exists
        }

        try {
            $this->forge->dropForeignKey('ci_pendidikan', 'fk_ci_pendidikan_unit_kerja');
        } catch (\Exception $e) {
            // ignore if not exists
        }

        $this->forge->dropColumn('ci_pendidikan', 'id_profesi');
        $this->forge->dropColumn('ci_pendidikan', 'id_unit_kerja');
    }
}
