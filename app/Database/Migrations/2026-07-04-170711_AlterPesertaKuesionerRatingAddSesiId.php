<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPesertaKuesionerRatingAddSesiId extends Migration
{
    public function up()
    {
        $this->forge->addColumn('peserta_kuesioner_rating_pelatihan', [
            'sesi_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
                'after' => 'kuesioner_id'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('peserta_kuesioner_rating_pelatihan', 'sesi_id');
    }
}
