<?php

namespace App\Database\Seeds\Pelatihan;

use CodeIgniter\Database\Seeder;

class UsersPelatihanSeeder extends Seeder
{
    public function run()
    {
        $defaultPassword = password_hash('rahasia123', PASSWORD_BCRYPT);

        $data = [
            [
                'nik'           => '3471000011110001',
                'nama_lengkap'  => 'Admin Utama Diklat RSUD',
                'email'         => 'admin.diklat@rsud.com',
                'no_wa'         => '081111111111',
                'jenis_peserta' => 'named',
                'role'          => 'admin',
                'id_unit_kerja' => 6,
                'id_profesi'    => null,
                'password'      => $defaultPassword,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nik'           => '3471000022220002',
                'nama_lengkap'  => 'dr. Budi Santoso (Koord. Pengabdian)',
                'email'         => 'pengabdian@rsud.com',
                'no_wa'         => '082222222222',
                'jenis_peserta' => 'named',
                'role'          => 'admin_pengabdian',
                'id_unit_kerja' => 3,
                'id_profesi'    => 2,
                'password'      => $defaultPassword,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nik'           => '3471000033330003',
                'nama_lengkap'  => 'Siti Aminah, S.Kep',
                'email'         => 'siti.perawat@rsud.com',
                'no_wa'         => '083333333333',
                'jenis_peserta' => 'named',
                'role'          => 'peserta',
                'id_unit_kerja' => 1,
                'id_profesi'    => 3,
                'password'      => $defaultPassword,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nik'           => '3471000044440004',
                'nama_lengkap'  => 'Dewi Ratnasari, S.Tr.Kes',
                'email'         => 'dewi.rad@rsud.com',
                'no_wa'         => '084444444444',
                'jenis_peserta' => 'named',
                'role'          => 'peserta',
                'id_unit_kerja' => 7,
                'id_profesi'    => 7,
                'password'      => $defaultPassword,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nik'           => '3471000055550005',
                'nama_lengkap'  => 'Rizki Pratama, Amd.Kep',
                'email'         => 'rizki.igd@rsud.com',
                'no_wa'         => '085555555555',
                'jenis_peserta' => 'named',
                'role'          => 'peserta',
                'id_unit_kerja' => 1,
                'id_profesi'    => 3,
                'password'      => $defaultPassword,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nik'           => '3471000066660006',
                'nama_lengkap'  => 'Ayu Lestari, S.Si',
                'email'         => 'ayu.lab@rsud.com',
                'no_wa'         => '086666666666',
                'jenis_peserta' => 'named',
                'role'          => 'peserta',
                'id_unit_kerja' => 8,
                'id_profesi'    => 9,
                'password'      => $defaultPassword,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nik'           => '3471000077770007',
                'nama_lengkap'  => 'Teguh Wibowo, S.Farm',
                'email'         => 'teguh.farmasi@rsud.com',
                'no_wa'         => '087777777777',
                'jenis_peserta' => 'named',
                'role'          => 'peserta',
                'id_unit_kerja' => 5,
                'id_profesi'    => 5,
                'password'      => $defaultPassword,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nik'           => '3471000088880008',
                'nama_lengkap'  => 'Maya Indah, S.Gz',
                'email'         => 'maya.gizi@rsud.com',
                'no_wa'         => '088888888888',
                'jenis_peserta' => 'named',
                'role'          => 'peserta',
                'id_unit_kerja' => 4,
                'id_profesi'    => 6,
                'password'      => $defaultPassword,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nik'           => '3471000099990009',
                'nama_lengkap'  => 'Anita Putri, S.Kep',
                'email'         => 'anita.keperawatan@rsud.com',
                'no_wa'         => '089999999999',
                'jenis_peserta' => 'named',
                'role'          => 'peserta',
                'id_unit_kerja' => 12,
                'id_profesi'    => 3,
                'password'      => $defaultPassword,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nik'           => 'NONAME-001',
                'nama_lengkap'  => 'Slot Peserta Eksternal 1',
                'email'         => 'peserta1.dummy@test.com',
                'no_wa'         => '-',
                'jenis_peserta' => 'non_named',
                'role'          => 'peserta',
                'id_unit_kerja' => null,
                'id_profesi'    => null,
                'password'      => $defaultPassword,
                'created_at'    => date('Y-m-d H:i:s'),
            ]
        ];
        $this->db->table('users_pelatihan')->insertBatch($data);
    }
}
