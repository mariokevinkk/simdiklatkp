<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakePengajuanIdNullable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('penempatan_peserta_pendidikan', [
            'pengajuan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
        ]);

        $this->forge->modifyColumn('stase_pendidikan', [
            'ci_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        try {
            $this->forge->modifyColumn('penempatan_peserta_pendidikan', [
                'pengajuan_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                    'null'       => false,
                ],
            ]);
        } catch (\Exception $e) {}

        try {
            $this->forge->modifyColumn('stase_pendidikan', [
                'ci_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                    'null'       => false,
                ],
            ]);
        } catch (\Exception $e) {}
    }
}
