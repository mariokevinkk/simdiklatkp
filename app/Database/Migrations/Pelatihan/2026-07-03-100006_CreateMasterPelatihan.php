<?php

namespace App\Database\Migrations\Pelatihan;

use CodeIgniter\Database\Migration;

class CreateMasterPelatihan extends Migration
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
  'nama' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
  ],
  'tema' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'program' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '50',
  ],
  'kategori' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '100',
  ],
  'kategori_skp_id' => 
  [
    'type' => 'INT',
    'unsigned' => true,
    'null' => true,
  ],
  'skp' => 
  [
    'type' => 'DECIMAL',
    'constraint' => '5,2',
    'default' => '0.00',
  ],
  'jpl' => 
  [
    'type' => 'INT',
    'default' => '0',
  ],
  'biaya' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'Gratis',
      1 => 'Berbayar',
    ],
    'default' => 'Gratis',
  ],
  'no_rekening' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '50',
    'null' => true,
  ],
  'biaya_nominal' => 
  [
    'type' => 'DECIMAL',
    'constraint' => '15,2',
    'null' => true,
  ],
  'level' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'Pemula',
      1 => 'Menengah',
      2 => 'Lanjut',
    ],
    'default' => 'Pemula',
  ],
  'cakupan' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'Lokal',
      1 => 'Nasional',
      2 => 'Internasional',
    ],
    'default' => 'Lokal',
  ],
  'mekanisme' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'Terbuka',
      1 => 'Tertutup',
    ],
    'default' => 'Terbuka',
  ],
  'target_khusus_profesi' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'target_khusus_unit' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'metode' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      0 => 'Online',
      1 => 'Offline / Clasical',
      2 => 'Blended / Hybrid',
      3 => 'Offline',
      4 => 'Blended',
    ],
    'default' => 'Online',
  ],
  'narasumber' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'penyelenggara' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'kontak' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '50',
    'null' => true,
  ],
  'reg_buka_tgl' => 
  [
    'type' => 'DATE',
    'null' => true,
  ],
  'reg_buka_jam' => 
  [
    'type' => 'TIME',
    'null' => true,
  ],
  'reg_tutup_tgl' => 
  [
    'type' => 'DATE',
    'null' => true,
  ],
  'reg_tutup_jam' => 
  [
    'type' => 'TIME',
    'null' => true,
  ],
  'jadwal_mulai' => 
  [
    'type' => 'DATE',
    'null' => true,
  ],
  'jam_mulai' => 
  [
    'type' => 'TIME',
    'null' => true,
  ],
  'jadwal_selesai' => 
  [
    'type' => 'DATE',
    'null' => true,
  ],
  'jam_selesai' => 
  [
    'type' => 'TIME',
    'null' => true,
  ],
  'kuota' => 
  [
    'type' => 'INT',
    'default' => '0',
  ],
  'target_profesi' => 
  [
    'type' => 'TEXT',
    'null' => true,
  ],
  'pengumuman' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'tujuan' => 
  [
    'type' => 'TEXT',
    'null' => true,
  ],
  'deskripsi' => 
  [
    'type' => 'TEXT',
    'null' => true,
  ],
  'kompetensi' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '500',
    'null' => true,
  ],
  'status' => 
  [
    'type' => 'ENUM',
    'constraint' => 
    [
      'Draft',
      'Aktif',
      'Batal',
      'Selesai'
    ],
    'null' => true,
    'default' => 'Draft',
  ],
  'cert_published' => 
  [
    'type' => 'TINYINT',
    'constraint' => '1',
    'null' => true,
    'default' => '0',
  ],
  'gambar_pelatihan' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '255',
    'null' => true,
  ],
  'avg_rating' => 
  [
    'type' => 'DECIMAL',
    'constraint' => '3,2',
    'default' => '0.00',
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
  'nama_bank' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '100',
    'null' => true,
  ],
  'atas_nama' => 
  [
    'type' => 'VARCHAR',
    'constraint' => '150',
    'null' => true,
  ],
]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('master_pelatihan');
    }

    public function down()
    {
        $this->forge->dropTable('master_pelatihan',true);
    }
}
