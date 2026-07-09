<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InstitusiPendidikanSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Pastikan roles sudah ada
        $roles = [
            ['nama_role' => 'Admin Diklat'],
            ['nama_role' => 'Institusi'],
            ['nama_role' => 'Mahasiswa'],
            ['nama_role' => 'CI'],
        ];
        $this->db->table('roles_pendidikan')->truncate();
        $this->db->table('roles_pendidikan')->insertBatch($roles);

        // Buat users untuk institusi
        $users = [
            [
                'role_id'    => 2,
                'email'      => 'diklat@ui.ac.id',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'is_active'  => 1,
                'created_at' => '2024-03-20 08:00:00',
                'updated_at' => '2024-03-20 08:00:00',
            ],
            [
                'role_id'    => 2,
                'email'      => 'admin@poltekkes-jkt.ac.id',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'is_active'  => 1,
                'created_at' => '2024-03-15 09:00:00',
                'updated_at' => '2024-03-15 09:00:00',
            ],
            [
                'role_id'    => 2,
                'email'      => 'diklat@ugm.ac.id',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'is_active'  => 1,
                'created_at' => '2024-03-10 10:00:00',
                'updated_at' => '2024-03-10 10:00:00',
            ],
            [
                'role_id'    => 2,
                'email'      => 'info@stikes-mk.ac.id',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'is_active'  => 1,
                'created_at' => '2024-03-18 11:00:00',
                'updated_at' => '2024-03-18 11:00:00',
            ],
            [
                'role_id'    => 2,
                'email'      => 'diklat@unair.ac.id',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'is_active'  => 1,
                'created_at' => '2024-04-01 08:00:00',
                'updated_at' => '2024-04-01 08:00:00',
            ],
            [
                'role_id'    => 2,
                'email'      => 'diklat@undip.ac.id',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'is_active'  => 1,
                'created_at' => '2024-04-02 09:00:00',
                'updated_at' => '2024-04-02 09:00:00',
            ],
            [
                'role_id'    => 2,
                'email'      => 'info@stikesborromeus.ac.id',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'is_active'  => 1,
                'created_at' => '2024-03-25 10:00:00',
                'updated_at' => '2024-03-25 10:00:00',
            ],
        ];
        $this->db->table('users_pendidikan')->truncate();
        $this->db->table('users_pendidikan')->insertBatch($users);

        // Buat data institusi dengan berbagai status
        $institusi = [
            [
                'user_id'           => 1,
                'nama_institusi'    => 'Universitas Indonesia',
                'alamat'            => 'Jl. Margonda Raya, Depok',
                'no_telp'           => '021-789456',
                'nama_kontak'       => 'Dr. Andi Pratama',
                'file_mou'          => 'sample_mou.pdf',
                'file_permohonan'   => 'sample_izin.pdf',
                'status_verifikasi' => 'approved',
                'catatan_revisi'    => null,
                'alasan_penolakan'  => null,
                'created_at'        => '2024-03-20 08:00:00',
                'updated_at'        => '2024-03-20 08:00:00',
            ],
            [
                'user_id'           => 2,
                'nama_institusi'    => 'Poltekkes Kemenkes Jakarta',
                'alamat'            => 'Jl. Hang Jebat, Jakarta Selatan',
                'no_telp'           => '021-123456',
                'nama_kontak'       => 'Siti Sarah, M.Kes',
                'file_mou'          => 'sample_mou.pdf',
                'file_permohonan'   => 'sample_izin.pdf',
                'status_verifikasi' => 'approved',
                'catatan_revisi'    => null,
                'alasan_penolakan'  => null,
                'created_at'        => '2024-03-15 09:00:00',
                'updated_at'        => '2024-03-15 09:00:00',
            ],
            [
                'user_id'           => 3,
                'nama_institusi'    => 'Universitas Gadjah Mada',
                'alamat'            => 'Bulaksumur, Yogyakarta',
                'no_telp'           => '0274-567890',
                'nama_kontak'       => 'Bambang S.',
                'file_mou'          => 'sample_mou.pdf',
                'file_permohonan'   => 'sample_izin.pdf',
                'status_verifikasi' => 'approved',
                'catatan_revisi'    => null,
                'alasan_penolakan'  => null,
                'created_at'        => '2024-03-10 10:00:00',
                'updated_at'        => '2024-03-10 10:00:00',
            ],
            [
                'user_id'           => 4,
                'nama_institusi'    => 'STIKES Mitra Keluarga',
                'alamat'            => 'Bekasi Timur',
                'no_telp'           => '021-998877',
                'nama_kontak'       => 'Dr. Maria',
                'file_mou'          => null,
                'file_permohonan'   => null,
                'status_verifikasi' => 'approved',
                'catatan_revisi'    => null,
                'alasan_penolakan'  => null,
                'created_at'        => '2024-03-18 11:00:00',
                'updated_at'        => '2024-03-18 11:00:00',
            ],
            [
                'user_id'           => 5,
                'nama_institusi'    => 'Universitas Airlangga',
                'alamat'            => 'Jl. Mulyorejo, Surabaya',
                'no_telp'           => '031-123456',
                'nama_kontak'       => 'Prof. Budi',
                'file_mou'          => 'sample_mou.pdf',
                'file_permohonan'   => 'sample_izin.pdf',
                'status_verifikasi' => 'pending',
                'catatan_revisi'    => null,
                'alasan_penolakan'  => null,
                'created_at'        => '2024-04-01 08:00:00',
                'updated_at'        => '2024-04-01 08:00:00',
            ],
            [
                'user_id'           => 6,
                'nama_institusi'    => 'Universitas Diponegoro',
                'alamat'            => 'Tembalang, Semarang',
                'no_telp'           => '024-123456',
                'nama_kontak'       => 'Dr. Siti',
                'file_mou'          => 'sample_mou.pdf',
                'file_permohonan'   => 'sample_izin.pdf',
                'status_verifikasi' => 'pending',
                'catatan_revisi'    => null,
                'alasan_penolakan'  => null,
                'created_at'        => '2024-04-02 09:00:00',
                'updated_at'        => '2024-04-02 09:00:00',
            ],
            [
                'user_id'           => 7,
                'nama_institusi'    => 'STIKES Borromeus',
                'alamat'            => 'Jl. Surya Kencana, Bandung',
                'no_telp'           => '022-112233',
                'nama_kontak'       => 'Sr. Maria',
                'file_mou'          => 'sample_mou.pdf',
                'file_permohonan'   => null,
                'status_verifikasi' => 'revision',
                'catatan_revisi'    => 'Tanda tangan di halaman 3 tidak terbaca dengan jelas.',
                'alasan_penolakan'  => null,
                'created_at'        => '2024-03-25 10:00:00',
                'updated_at'        => '2024-03-25 10:00:00',
            ],
        ];
        $this->db->table('institusi_pendidikan')->truncate();
        $this->db->table('institusi_pendidikan')->insertBatch($institusi);

        // Buat sample dokumen untuk beberapa institusi
        $dokumen = [
            [
                'institusi_id'  => 1,
                'judul'         => 'MoU Kerjasama',
                'nama_file'     => 'sample_mou.pdf',
                'original_name' => 'MoU_UI_2024.pdf',
                'tipe_file'     => 'application/pdf',
                'ukuran_file'   => 102400,
                'status'        => 'verified',
                'created_at'    => '2024-03-20 08:30:00',
                'updated_at'    => '2024-03-20 08:30:00',
            ],
            [
                'institusi_id'  => 1,
                'judul'         => 'Izin Operasional',
                'nama_file'     => 'sample_izin.pdf',
                'original_name' => 'Izin_Operasional_UI.pdf',
                'tipe_file'     => 'application/pdf',
                'ukuran_file'   => 204800,
                'status'        => 'verified',
                'created_at'    => '2024-03-20 09:00:00',
                'updated_at'    => '2024-03-20 09:00:00',
            ],
            [
                'institusi_id'  => 5,
                'judul'         => 'MoU Kerjasama',
                'nama_file'     => 'sample_mou.pdf',
                'original_name' => 'MoU_Unair_2024.pdf',
                'tipe_file'     => 'application/pdf',
                'ukuran_file'   => 153600,
                'status'        => 'pending',
                'created_at'    => '2024-04-01 08:30:00',
                'updated_at'    => '2024-04-01 08:30:00',
            ],
            [
                'institusi_id'  => 5,
                'judul'         => 'Akreditasi Kampus',
                'nama_file'     => 'sample_izin.pdf',
                'original_name' => 'Akreditasi_Unair.pdf',
                'tipe_file'     => 'application/pdf',
                'ukuran_file'   => 307200,
                'status'        => 'pending',
                'created_at'    => '2024-04-01 09:00:00',
                'updated_at'    => '2024-04-01 09:00:00',
            ],
            [
                'institusi_id'  => 6,
                'judul'         => 'MoU Kerjasama',
                'nama_file'     => 'sample_mou.pdf',
                'original_name' => 'MoU_Undip_2024.pdf',
                'tipe_file'     => 'application/pdf',
                'ukuran_file'   => 128000,
                'status'        => 'pending',
                'created_at'    => '2024-04-02 09:30:00',
                'updated_at'    => '2024-04-02 09:30:00',
            ],
            [
                'institusi_id'  => 7,
                'judul'         => 'MoU Kerjasama',
                'nama_file'     => 'sample_mou.pdf',
                'original_name' => 'MoU_STIKES_Borromeus.pdf',
                'tipe_file'     => 'application/pdf',
                'ukuran_file'   => 90000,
                'status'        => 'revision',
                'created_at'    => '2024-03-25 10:30:00',
                'updated_at'    => '2024-03-25 10:30:00',
            ],
        ];
        $this->db->table('dokumen_institusi')->truncate();
        $this->db->table('dokumen_institusi')->insertBatch($dokumen);

        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }
}
