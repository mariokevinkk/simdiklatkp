<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModulPendidikan extends Migration
{
    public function up()
    {
        // 1. roles_pendidikan
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_role'   => ['type' => 'VARCHAR', 'constraint' => 50],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('roles_pendidikan', true);

        // 2. users_pendidikan
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'role_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'email'       => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'password'    => ['type' => 'VARCHAR', 'constraint' => 255],
            'is_active'   => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('role_id', 'roles_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('users_pendidikan', true);

        // 3. institusi_pendidikan
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_institusi'    => ['type' => 'VARCHAR', 'constraint' => 150],
            'alamat'            => ['type' => 'TEXT', 'null' => true],
            'no_telp'           => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'nama_kontak'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'file_mou'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_permohonan'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status_verifikasi' => ['type' => 'ENUM', 'constraint' => ['pending', 'approved', 'revision', 'rejected'], 'default' => 'pending'],
            'catatan_revisi'    => ['type' => 'TEXT', 'null' => true],
            'alasan_penolakan'  => ['type' => 'TEXT', 'null' => true],
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
            'updated_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('institusi_pendidikan', true);

        // 4. ci_pendidikan
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nip'            => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'nama_lengkap'   => ['type' => 'VARCHAR', 'constraint' => 150],
            'ruangan_tugas'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'spesialisasi'   => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ci_pendidikan', true);

        // 5. mahasiswa_pendidikan
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'institusi_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nim'            => ['type' => 'VARCHAR', 'constraint' => 50],
            'nama_lengkap'   => ['type' => 'VARCHAR', 'constraint' => 150],
            'jenis_kelamin'  => ['type' => 'ENUM', 'constraint' => ['L', 'P']],
            'jenjang'        => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'program_studi'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'tanggal_lahir'  => ['type' => 'DATE', 'null' => true],
            'semester'       => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'no_hp'          => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'email'          => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'file_foto'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_ijazah'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_sk'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('institusi_id', 'institusi_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mahasiswa_pendidikan', true);

        // 6. pengajuan_praktik_pendidikan
        $this->forge->addField([
            'id'                   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'institusi_id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_program'         => ['type' => 'VARCHAR', 'constraint' => 150],
            'tanggal_mulai'        => ['type' => 'DATE'],
            'tanggal_selesai'      => ['type' => 'DATE'],
            'jumlah_peserta'       => ['type' => 'INT', 'constraint' => 11],
            'file_proposal'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_surat_pengantar' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_logbook'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_panduan'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_daftar_mhs'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_kompetensi'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_sk_pembimbing'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_bukti_bayar'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'               => ['type' => 'ENUM', 'constraint' => ['Menunggu', 'Disetujui', 'Ditolak', 'Selesai'], 'default' => 'Menunggu'],
            'catatan_admin'        => ['type' => 'TEXT', 'null' => true],
            'created_at'           => ['type' => 'DATETIME', 'null' => true],
            'updated_at'           => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('institusi_id', 'institusi_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pengajuan_praktik_pendidikan', true);

        // 6.5 stase_pendidikan
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_stase'  => ['type' => 'VARCHAR', 'constraint' => 150],
            'ruangan'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'ci_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('ci_id', 'ci_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('stase_pendidikan', true);

        // 7. penempatan_peserta_pendidikan
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'pengajuan_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'mahasiswa_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'stase_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'status_aktif'   => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pengajuan_id', 'pengajuan_praktik_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('mahasiswa_id', 'mahasiswa_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('stase_id', 'stase_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penempatan_peserta_pendidikan', true);

        // 8. logbook_pendidikan
        $this->forge->addField([
            'id'                 => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'penempatan_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tanggal_kegiatan'   => ['type' => 'DATE'],
            'judul_kegiatan'     => ['type' => 'VARCHAR', 'constraint' => 150],
            'deskripsi_kegiatan' => ['type' => 'TEXT'],
            'file_lampiran'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status_validasi'    => ['type' => 'ENUM', 'constraint' => ['Pending', 'Disetujui', 'Revisi'], 'default' => 'Pending'],
            'catatan_ci'         => ['type' => 'TEXT', 'null' => true],
            'created_at'         => ['type' => 'DATETIME', 'null' => true],
            'updated_at'         => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('penempatan_id', 'penempatan_peserta_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('logbook_pendidikan', true);

        // 9. penilaian_pendidikan
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'penempatan_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'aspek_penilaian'   => ['type' => 'VARCHAR', 'constraint' => 150],
            'nilai_angka'       => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'catatan'           => ['type' => 'TEXT', 'null' => true],
            'tanggal_penilaian' => ['type' => 'DATE'],
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('penempatan_id', 'penempatan_peserta_pendidikan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penilaian_pendidikan', true);
    }

    public function down()
    {
        // Drop tables in reverse order of creation to avoid foreign key constraint errors
        $this->forge->dropTable('penilaian_pendidikan', true);
        $this->forge->dropTable('logbook_pendidikan', true);
        $this->forge->dropTable('penempatan_peserta_pendidikan', true);
        $this->forge->dropTable('stase_pendidikan', true);
        $this->forge->dropTable('pengajuan_praktik_pendidikan', true);
        $this->forge->dropTable('mahasiswa_pendidikan', true);
        $this->forge->dropTable('ci_pendidikan', true);
        $this->forge->dropTable('institusi_pendidikan', true);
        $this->forge->dropTable('users_pendidikan', true);
        $this->forge->dropTable('roles_pendidikan', true);
    }
}
