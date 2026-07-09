<?php
namespace App\Database\Seeds\Pelatihan;
use CodeIgniter\Database\Seeder;

class KategoriEvaluasiPelatihanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'nama_kategori' => 'Fasilitator'],
            ['id' => 2, 'nama_kategori' => 'Materi'],
            ['id' => 3, 'nama_kategori' => 'Modul'],
            ['id' => 4, 'nama_kategori' => 'Fasilitas'],
            ['id' => 5, 'nama_kategori' => 'Panitia']
        ];
        $this->db->table('kategori_evaluasi_pelatihan')->ignore(true)->insertBatch($data);
    }
}
