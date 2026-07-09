<?php
namespace App\Database\Seeds\Pelatihan;
use CodeIgniter\Database\Seeder;

class PesertaPelatihanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => '3471000033330003',
                'pelatihan_id' => 1,
                'status_peserta' => 'Daftar',
                'bukti_bayar' => null,
                'status_pembayaran' => 'Gratis',
                'status_akses' => 'Terbuka',
                'waktu_daftar' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => '3471000033330003',
                'pelatihan_id' => 2,
                'status_peserta' => 'Daftar',
                'bukti_bayar' => 'bukti_siti_manajemen.png',
                'status_pembayaran' => 'Pending',
                'status_akses' => 'Pending',
                'waktu_daftar' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => '3471000033330003',
                'pelatihan_id' => 3,
                'status_peserta' => 'Daftar',
                'bukti_bayar' => 'bukti_siti_anak.png',
                'status_pembayaran' => 'Pending',
                'status_akses' => 'Terbuka',
                'waktu_daftar' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => '3471000044440004',
                'pelatihan_id' => 1,
                'status_peserta' => 'Daftar',
                'bukti_bayar' => null,
                'status_pembayaran' => 'Gratis',
                'status_akses' => 'Terbuka',
                'waktu_daftar' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => '3471000055550005',
                'pelatihan_id' => 4,
                'status_peserta' => 'Daftar',
                'bukti_bayar' => null,
                'status_pembayaran' => 'Gratis',
                'status_akses' => 'Pending',
                'waktu_daftar' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => '3471000066660006',
                'pelatihan_id' => 5,
                'status_peserta' => 'Daftar',
                'bukti_bayar' => 'bukti_ayu_farmasi.png',
                'status_pembayaran' => 'Verified',
                'status_akses' => 'Approved',
                'waktu_daftar' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => '3471000077770007',
                'pelatihan_id' => 2,
                'status_peserta' => 'Daftar',
                'bukti_bayar' => 'bukti_teguh_manajemen.png',
                'status_pembayaran' => 'Verified',
                'status_akses' => 'Approved',
                'waktu_daftar' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => '3471000088880008',
                'pelatihan_id' => 3,
                'status_peserta' => 'Daftar',
                'bukti_bayar' => null,
                'status_pembayaran' => 'Gratis',
                'status_akses' => 'Terbuka',
                'waktu_daftar' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => 'NONAME-001',
                'pelatihan_id' => 2,
                'status_peserta' => 'Daftar',
                'bukti_bayar' => null,
                'status_pembayaran' => 'Gratis',
                'status_akses' => 'Terbuka',
                'waktu_daftar' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('peserta_pelatihan')->insertBatch($data);
    }
}
