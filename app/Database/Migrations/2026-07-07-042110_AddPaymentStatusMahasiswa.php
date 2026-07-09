<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPaymentStatusMahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addColumn('mahasiswa_pendidikan', [
            'payment_status' => [
                'type' => 'ENUM',
                'constraint' => ['Belum Invoice', 'Belum Bayar', 'Menunggu Verifikasi', 'Lunas'],
                'default' => 'Belum Invoice',
                'after' => 'status'
            ],
            'file_bukti_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'payment_status'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('mahasiswa_pendidikan', 'payment_status');
        $this->forge->dropColumn('mahasiswa_pendidikan', 'file_bukti_bayar');
    }
}
