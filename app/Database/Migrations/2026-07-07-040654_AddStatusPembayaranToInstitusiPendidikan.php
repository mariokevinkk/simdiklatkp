<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusPembayaranToInstitusiPendidikan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('institusi_pendidikan', [
            'status_pembayaran' => [
                'type'       => 'ENUM',
                'constraint' => ['unpaid', 'pending_verification', 'paid', 'rejected'],
                'default'    => 'unpaid',
                'after'      => 'status_verifikasi',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('institusi_pendidikan', 'status_pembayaran');
    }
}
