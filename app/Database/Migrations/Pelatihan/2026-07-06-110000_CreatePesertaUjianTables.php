<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreatePesertaUjianTables extends Migration
{
    public function up()
    {
        // Table: peserta_ujian_pelatihan
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'peserta_pelat_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'tipe_ujian' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'score' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => '0.00',
            ],
            'status_lulus' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('peserta_pelat_id', 'peserta_pelatihan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('peserta_ujian_pelatihan');

        // Table: peserta_jawaban_ujian_pelatihan
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'peserta_ujian_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'soal_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'jawaban_peserta' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'is_correct' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('peserta_ujian_id', 'peserta_ujian_pelatihan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('peserta_jawaban_ujian_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('peserta_jawaban_ujian_pelatihan',true);
        $this->forge->dropTable('peserta_ujian_pelatihan',true);
    }
}
