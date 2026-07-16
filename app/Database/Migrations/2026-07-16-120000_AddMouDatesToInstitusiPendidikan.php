<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMouDatesToInstitusiPendidikan extends Migration
{
    public function up()
    {
        $fields = [];
        if (!$this->db->fieldExists('tgl_mulai_mou', 'institusi_pendidikan')) {
            $fields['tgl_mulai_mou'] = [
                'type' => 'DATE',
                'null' => true,
                'after' => 'file_permohonan',
            ];
        }
        if (!$this->db->fieldExists('tgl_selesai_mou', 'institusi_pendidikan')) {
            $fields['tgl_selesai_mou'] = [
                'type' => 'DATE',
                'null' => true,
                'after' => 'tgl_mulai_mou',
            ];
        }
        if (!empty($fields)) {
            $this->forge->addColumn('institusi_pendidikan', $fields);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('institusi_pendidikan', 'tgl_mulai_mou');
        $this->forge->dropColumn('institusi_pendidikan', 'tgl_selesai_mou');
    }
}
