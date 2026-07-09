<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserPendidikanSeeder extends Seeder
{
    public function run()
    {
        // Matikan pengecekan Foreign Key agar bisa melakukan Truncate
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // 1. Mengisi Data Roles (Hak Akses)
        $rolesData = [
            ['nama_role' => 'Admin Diklat'],
            ['nama_role' => 'Institusi'],
            ['nama_role' => 'Mahasiswa'],
            ['nama_role' => 'CI'],
            ['nama_role' => 'Super Admin'] // ID 5
        ];
        // Kosongkan tabel agar tidak duplikat jika dijalankan ulang
        $this->db->table('roles_pendidikan')->truncate(); 
        $this->db->table('roles_pendidikan')->insertBatch($rolesData);

        // 2. Mengisi Data Akun Login (users)
        $usersData = [
            [
                'role_id'    => 1, // Admin Diklat
                'email'      => 'admin.diklat@rs.com',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id'    => 2, // Institusi
                'email'      => 'kampus@univ.ac.id',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id'    => 3, // Mahasiswa
                'email'      => 'budi.mahasiswa@univ.ac.id',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id'    => 4, // CI (Clinical Instructor)
                'email'      => 'siti.ci@rs.com',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'role_id'    => 5, // Super Admin
                'email'      => 'superadmin@admin.com',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
              
        ];
        // Mematikan pengecekan Foreign Key sementara untuk Truncate
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');
        $this->db->table('users_pendidikan')->truncate();
        $this->db->table('users_pendidikan')->insertBatch($usersData);

        // 3. Mengisi Profil Institusi (Milik User ID 2)
        $this->db->table('institusi_pendidikan')->truncate();
        $institusiData = [
            'user_id'           => 2,
            'nama_institusi'    => 'Universitas Kesehatan Baktiku',
            'alamat'            => 'Jl. Pendidikan No. 123, Kota',
            'no_telp'           => '021-9876543',
            'nama_kontak'       => 'Bpk. Dosen Koordinator',
            'file_mou'          => 'mou_dummy.pdf',
            'file_permohonan'   => 'permohonan_dummy.pdf',
            'status_verifikasi' => 'approved', // Untuk testing, set default ke approved
            'catatan_revisi'    => null,
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ];
        $this->db->table('institusi_pendidikan')->insert($institusiData);
        $institusiId = $this->db->insertID();

        // 4. Mengisi Profil Mahasiswa (Milik User ID 3)
        $this->db->table('mahasiswa_pendidikan')->truncate();
        $mahasiswaData = [
            'user_id'        => 3,
            'institusi_id'   => $institusiId, // Berelasi dengan kampus di atas
            'nim'            => 'NIM2023001',
            'nama_lengkap'   => 'Budi Mahasiswa',
            'jenis_kelamin'  => 'L',
            'jenjang'        => 'S1',
            'program_studi'  => 'Ilmu Keperawatan',
            'created_at'     => date('Y-m-d H:i:s'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];
        $this->db->table('mahasiswa_pendidikan')->insert($mahasiswaData);

        // 5. Mengisi Profil CI / Pembimbing (Milik User ID 4)
        $this->db->table('ci_pendidikan')->truncate();
        $ciData = [
            'user_id'        => 4,
            'nip'            => '198001012005011002',
            'nama_lengkap'   => 'Ns. Siti Pembimbing, S.Kep',
            'email'          => 'siti.ci@rs.com',
            'created_at'     => date('Y-m-d H:i:s'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];
        $this->db->table('ci_pendidikan')->insert($ciData);
        
        // 6. Mengisi Master Data Stase (Berelasi dengan CI ID 4)
        $this->db->table('stase_pendidikan')->truncate();
        $staseData = [
            'nama_stase' => 'Keperawatan Kritis',
            'ruangan'    => 'Ruang ICU',
            'ci_id'      => 4, // Ns. Siti Pembimbing
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('stase_pendidikan')->insert($staseData);
        
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }
}
