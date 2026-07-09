<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDokumenLainToPengajuan extends Migration
{
    public function up()
    {
        $fields = [
            'file_dokumen_pendukung' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'file_dokumen_penilaian' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ];
        $this->forge->addColumn('pengajuan_praktik_pendidikan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pengajuan_praktik_pendidikan', ['file_dokumen_pendukung', 'file_dokumen_penilaian']);
    }
}
