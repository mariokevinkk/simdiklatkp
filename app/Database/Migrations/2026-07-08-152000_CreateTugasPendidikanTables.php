<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTugasPendidikanTables extends Migration
{
    public function up()
    {
        // 1. tugas_pendidikan
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'stase_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'ruangan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'ci_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nama_tugas' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'deadline' => [
                'type' => 'DATETIME',
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
        $this->forge->addForeignKey('stase_id', 'stase_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('ci_id', 'ci_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tugas_pendidikan', true);

        // 2. pengumpulan_tugas_pendidikan
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tugas_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'mahasiswa_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'file_tugas' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'catatan_mahasiswa' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'nilai' => [
                'type' => 'INT',
                'null' => true,
            ],
            'catatan_ci' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Belum Dinilai', 'Selesai', 'Revisi'],
                'default'    => 'Belum Dinilai',
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
        $this->forge->addForeignKey('tugas_id', 'tugas_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('mahasiswa_id', 'mahasiswa_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pengumpulan_tugas_pendidikan', true);
    }

    public function down()
    {
        $this->forge->dropTable('pengumpulan_tugas_pendidikan', true);
        $this->forge->dropTable('tugas_pendidikan', true);
    }
}
