<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class ForceMigrate extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'db:forcemigrate';
    protected $description = 'Forcefully run forge to add invoice fields.';

    public function run(array $params)
    {
        $forge = Database::forge();
        $forge->addColumn('mahasiswa_pendidikan', [
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
        CLI::write("Columns added.", 'green');
    }
}
