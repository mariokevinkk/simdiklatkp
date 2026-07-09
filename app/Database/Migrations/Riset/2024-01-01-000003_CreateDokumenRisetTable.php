<?php
namespace App\Database\Migrations\Riset;

use CodeIgniter\Database\Migration;

class CreateDokumenRisetTable extends Migration
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
            'pengajuan_riset_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jenis_dokumen' => [
                'type'       => 'VARCHAR',
                'constraint' => '100', // e.g., 'proposal', 'surat_pengantar', 'laporan_akhir'
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status_dokumen' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'valid', 'invalid'],
                'default'    => 'pending',
            ],
            'catatan' => [
                'type'       => 'TEXT',
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
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pengajuan_riset_id', 'pengajuan_riset', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dokumen_riset');
    }

    public function down()
    {
        $this->forge->dropTable('dokumen_riset');
    }
}
