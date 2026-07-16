<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDetailsToInstitusiPendidikan extends Migration
{
    public function up()
    {
        $fields = [];
        if (!$this->db->fieldExists('jenis_institusi', 'institusi_pendidikan')) {
            $fields['jenis_institusi'] = ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true, 'after' => 'nama_institusi'];
        }
        if (!$this->db->fieldExists('jabatan_pj', 'institusi_pendidikan')) {
            $fields['jabatan_pj'] = ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'nama_kontak'];
        }
        if (!$this->db->fieldExists('hp_pj', 'institusi_pendidikan')) {
            $fields['hp_pj'] = ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true, 'after' => 'jabatan_pj'];
        }
        if (!$this->db->fieldExists('email_pj', 'institusi_pendidikan')) {
            $fields['email_pj'] = ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'hp_pj'];
        }
        if (!$this->db->fieldExists('file_lainnya', 'institusi_pendidikan')) {
            $fields['file_lainnya'] = ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'tgl_selesai_mou'];
        }

        if (!empty($fields)) {
            $this->forge->addColumn('institusi_pendidikan', $fields);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('institusi_pendidikan', ['jenis_institusi', 'jabatan_pj', 'hp_pj', 'email_pj', 'file_lainnya']);
    }
}
