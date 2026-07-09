<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateSertifikatPelatihan extends Migration
{
    public function up()
    {
        $this->forge->addField([
  'id' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'auto_increment' => true,
  ],
  'user_id' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '16',
  ],
  'user_nama' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'user_profesi' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '100',
    'null' => true,
  ],
  'judul' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
  ],
  'ranah' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '100',
    'null' => true,
  ],
  'kategori_kegiatan' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '100',
    'null' => true,
  ],
  'skp' => 
  [
    'type' => 'DECIMAL',
    'constraint' => '10,2',
    'default' => '0.00',
  ],
  'tgl_mulai' => 
  [
    'type' => 'DATE',
    'null' => true,
  ],
  'tgl_selesai' => 
  [
    'type' => 'DATE',
    'null' => true,
  ],
  'penerbit' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'jenis_dokumen' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '100',
    'default' => 'mandiri',
  ],
  'verifikasi' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '50',
    'default' => 'pending',
  ],
  'alasan_penolakan' => 
  [
    'type' => 'TEXT',
    'null' => true,
  ],
  'tgl_upload' => 
  [
    'type' => 'DATETIME',
    'null' => true,
  ],
  'tgl_verifikasi' => 
  [
    'type' => 'DATETIME',
    'null' => true,
  ],
  'pelatihan_id' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'null' => true,
  ],
  'file_path' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'surat_tugas_path' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'no_sertifikat' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'created_at' => 
  [
    'type' => 'DATETIME',
    'null' => true,
  ],
  'updated_at' => 
  [
    'type' => 'DATETIME',
    'null' => true,
  ],
]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sertifikat_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('sertifikat_pelatihan',true);
    }
}
