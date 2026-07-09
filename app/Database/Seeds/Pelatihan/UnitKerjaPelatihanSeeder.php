<?php

namespace App\Database\Seeds\Pelatihan;

use CodeIgniter\Database\Seeder;

class UnitKerjaPelatihanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_unit' => 'Instalasi Gawat Darurat (IGD)', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Intensive Care Unit (ICU)', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Poliklinik Penyakit Dalam', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Bangsal Anak', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Instalasi Farmasi', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Bagian Manajemen & Administrasi', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Instalasi Radiologi', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Laboratorium Patologi Klinik', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Klinik Bedah', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Unit Rehabilitasi Medik', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Ruang Rawat Inap VIP', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_unit' => 'Departemen Keperawatan', 'created_at' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('unit_kerja_pelatihan')->insertBatch($data);
    }
}
