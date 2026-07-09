<?php
namespace App\Database\Migrations\Riset;

use CodeIgniter\Database\Migration;

class CreatePengajuanRisetTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_riset_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true, // Make it null true temporarily if no auth yet
            ],
            'jenis_pengajuan' => [
                'type'       => 'ENUM',
                'constraint' => ['studi_pendahuluan', 'penelitian', 'publikasi'],
                'default'    => 'penelitian',
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'identitas' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'institusi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'judul' => [
                'type'       => 'TEXT',
            ],
            'waktu_mulai' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'waktu_selesai' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'dalam review',
            ],
            'catatan_revisi' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'catatan_penolakan' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'nominal_bayar' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'bukti_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'nomor_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('pengajuan_riset');
    }

    public function down()
    {
        $this->forge->dropTable('pengajuan_riset');
    }
}
