<?php
namespace App\Database\Seeds\Pelatihan;
use CodeIgniter\Database\Seeder;

class MateriPelatihanSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $materiByTraining = [
            1 => [
                ['urutan' => 1.1, 'judul' => 'Modul 1 - Pendahuluan K3', 'tipe' => 'video', 'deskripsi' => 'Pengantar dasar tentang bahaya di RS.', 'file_path' => 'https://youtube.com/watch?v=simulation1'],
                ['urutan' => 1.2, 'judul' => 'Modul 2 - Pencegahan Infeksi', 'tipe' => 'pdf', 'deskripsi' => 'Standard Precautions guidelines.', 'file_path' => 'uploads/materi_pelatihan/modul2.pdf'],
                ['urutan' => 1.3, 'judul' => 'Modul 3 - Etika Kerja', 'tipe' => 'pdf', 'deskripsi' => 'Panduan keselamatan dan kewaspadaan', 'file_path' => 'uploads/materi_pelatihan/etika_kerja.pdf'],
            ],
            2 => [
                ['urutan' => 1.1, 'judul' => 'Modul Kepemimpinan Dasar', 'tipe' => 'pdf', 'deskripsi' => 'Modul untuk Kepala Ruangan', 'file_path' => 'uploads/materi_pelatihan/modul_manajemen.pdf'],
                ['urutan' => 1.2, 'judul' => 'Modul Komunikasi Tim', 'tipe' => 'video', 'deskripsi' => 'Strategi komunikasi efektif untuk unit pelayanan', 'file_path' => 'https://youtube.com/watch?v=management2'],
            ],
            3 => [
                ['urutan' => 1.1, 'judul' => 'Modul Asuhan Anak', 'tipe' => 'pdf', 'deskripsi' => 'Materi dasar keperawatan anak', 'file_path' => 'uploads/materi_pelatihan/modul_anak.pdf'],
                ['urutan' => 1.2, 'judul' => 'Video Praktik Keperawatan', 'tipe' => 'video', 'deskripsi' => 'Simulasi praktik keperawatan anak', 'file_path' => 'https://youtube.com/watch?v=anak_praktik'],
            ],
            4 => [
                ['urutan' => 1.1, 'judul' => 'Modul Resusitasi Neonatus', 'tipe' => 'pdf', 'deskripsi' => 'Panduan resusitasi neonatus', 'file_path' => 'uploads/materi_pelatihan/modul_resusitasi.pdf'],
                ['urutan' => 1.2, 'judul' => 'Video Simulasi Tindakan', 'tipe' => 'video', 'deskripsi' => 'Simulasi tindakan emergensi neonatus', 'file_path' => 'https://youtube.com/watch?v=resusitasi'],
            ],
            5 => [
                ['urutan' => 1.1, 'judul' => 'Modul Farmasi Klinik', 'tipe' => 'pdf', 'deskripsi' => 'Panduan layanan farmasi klinik', 'file_path' => 'uploads/materi_pelatihan/modul_farmasi.pdf'],
                ['urutan' => 1.2, 'judul' => 'Video Layanan Terintegrasi', 'tipe' => 'video', 'deskripsi' => 'Contoh alur layanan terintegrasi', 'file_path' => 'https://youtube.com/watch?v=farmasi1'],
            ],
        ];

        foreach ($materiByTraining as $pelatihanId => $items) {
            foreach ($items as $item) {
                $data[] = [
                    'pelatihan_id' => $pelatihanId,
                    'urutan' => $item['urutan'],
                    'judul' => $item['judul'],
                    'tipe' => $item['tipe'],
                    'deskripsi' => $item['deskripsi'],
                    'file_path' => $item['file_path'],
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }
        }

        $this->db->table('materi_pelatihan')->insertBatch($data);
    }
}
