<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixInvoiceAndNominal extends Migration
{
    public function up()
    {
        $this->forge->addColumn('mahasiswa_pendidikan', [
            'invoice_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'file_bukti_bayar',
            ],
            'nominal' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
                'default'    => 0.00,
                'after'      => 'invoice_file',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('mahasiswa_pendidikan', 'invoice_file');
        $this->forge->dropColumn('mahasiswa_pendidikan', 'nominal');
    }
}
