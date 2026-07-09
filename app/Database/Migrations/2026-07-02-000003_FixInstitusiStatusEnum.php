<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixInstitusiStatusEnum extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE institusi_pendidikan 
            MODIFY COLUMN status_verifikasi 
            ENUM('pending', 'approved', 'revision', 'rejected') 
            DEFAULT 'pending'");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE institusi_pendidikan 
            MODIFY COLUMN status_verifikasi 
            ENUM('pending', 'approved', 'revision', 'declined') 
            DEFAULT 'pending'");
    }
}
