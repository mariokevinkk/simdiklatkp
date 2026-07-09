<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RisetSeeder extends Seeder
{
    public function run()
    {
        // Buat akun Admin Riset default
        $this->db->table('users_riset')->insert([
            'nama'       => 'Admin Riset',
            'email'      => 'admin@riset.com',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'role'       => 'admin',
            'institusi'  => 'RSUD Kota Yogyakarta',
            'no_telp'    => '0274-123456',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Buat akun Peneliti default untuk testing
        $this->db->table('users_riset')->insert([
            'nama'       => 'Peneliti Demo',
            'email'      => 'peneliti@riset.com',
            'password'   => password_hash('peneliti123', PASSWORD_DEFAULT),
            'role'       => 'peneliti',
            'institusi'  => 'Universitas Kristen Duta Wacana',
            'no_telp'    => '0812-3456-7890',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
