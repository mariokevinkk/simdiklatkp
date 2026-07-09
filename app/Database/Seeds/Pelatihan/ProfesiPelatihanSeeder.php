<?php

namespace App\Database\Seeds\Pelatihan;

use CodeIgniter\Database\Seeder;

class ProfesiPelatihanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_profesi' => 'Dokter Umum', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_profesi' => 'Dokter Spesialis', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_profesi' => 'Perawat', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_profesi' => 'Bidan', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_profesi' => 'Apoteker', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_profesi' => 'Ahli Gizi', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_profesi' => 'Radiografer', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_profesi' => 'Fisioterapis', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_profesi' => 'Teknisi Laboratorium', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_profesi' => 'Administrasi Rumah Sakit', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_profesi' => 'Kepala Ruangan', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_profesi' => 'Analis Kesehatan', 'created_at' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('profesi_pelatihan')->insertBatch($data);
    }
}
