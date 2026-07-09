<?php
namespace App\Database\Seeds\Pelatihan;
use CodeIgniter\Database\Seeder;

class SesiInteraktifPelatihanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'pelatihan_id' => 1,
                'tipe_sesi' => 'online',
                'nama_sesi' => 'Live Q&A K3 RS',
                'tanggal' => date('Y-m-d', strtotime('+7 days')),
                'waktu' => '08:00:00',
                'jam_tutup' => '10:00:00',
                'lokasi_ruang' => null,
                'tempat' => null,
                'alamat' => null,
                'maps_url' => null,
                'meeting_link' => 'https://zoom.us/j/123456789',
                'meeting_pass' => 'K3RS123'
            ],
            [
                'pelatihan_id' => 1,
                'tipe_sesi' => 'offline',
                'nama_sesi' => 'Sesi Tatap Muka K3',
                'tanggal' => date('Y-m-d', strtotime('+9 days')),
                'waktu' => '09:00:00',
                'jam_tutup' => '12:00:00',
                'lokasi_ruang' => 'Aula Serbaguna Lt. 4',
                'tempat' => 'Balai Diklat Kesehatan',
                'alamat' => 'Jl. Kesehatan No. 1',
                'maps_url' => 'https://maps.google.com/xyz',
                'meeting_link' => null,
                'meeting_pass' => null
            ],
            [
                'pelatihan_id' => 2,
                'tipe_sesi' => 'offline',
                'nama_sesi' => 'Sesi Pagi (Pembukaan)',
                'tanggal' => date('Y-m-d', strtotime('+8 days')),
                'waktu' => '08:00:00',
                'jam_tutup' => '10:00:00',
                'lokasi_ruang' => 'Aula Serbaguna Lt. 4',
                'tempat' => 'Balai Diklat Kesehatan',
                'alamat' => 'Jl. Kesehatan No. 1',
                'maps_url' => 'https://maps.google.com/xyz',
                'meeting_link' => null,
                'meeting_pass' => null
            ],
            [
                'pelatihan_id' => 3,
                'tipe_sesi' => 'online',
                'nama_sesi' => 'Diskusi Anak dan Keluarga',
                'tanggal' => date('Y-m-d', strtotime('+10 days')),
                'waktu' => '10:00:00',
                'jam_tutup' => '12:00:00',
                'lokasi_ruang' => null,
                'tempat' => null,
                'alamat' => null,
                'maps_url' => null,
                'meeting_link' => 'https://zoom.us/j/987654321',
                'meeting_pass' => 'ANAK123'
            ],
            [
                'pelatihan_id' => 4,
                'tipe_sesi' => 'offline',
                'nama_sesi' => 'Praktik Hands-On Neonatus',
                'tanggal' => date('Y-m-d', strtotime('+10 days')),
                'waktu' => '08:30:00',
                'jam_tutup' => '12:30:00',
                'lokasi_ruang' => 'Ruangan Simulasi',
                'tempat' => 'RSUD Kelas A',
                'alamat' => 'Jl. Simulasi No. 5',
                'maps_url' => 'https://maps.google.com/simulasi',
                'meeting_link' => null,
                'meeting_pass' => null
            ],
            [
                'pelatihan_id' => 5,
                'tipe_sesi' => 'online',
                'nama_sesi' => 'Sesi Hybrid Farmasi',
                'tanggal' => date('Y-m-d', strtotime('+9 days')),
                'waktu' => '13:00:00',
                'jam_tutup' => '15:00:00',
                'lokasi_ruang' => 'Ruang Webinar',
                'tempat' => 'RSUD Kelas A',
                'alamat' => 'Jl. Webinar No. 2',
                'maps_url' => 'https://maps.google.com/webinar',
                'meeting_link' => 'https://zoom.us/j/55555555',
                'meeting_pass' => 'FARMASI'
            ]
        ];
        $this->db->table('sesi_interaktif_pelatihan')->insertBatch($data);
    }
}
