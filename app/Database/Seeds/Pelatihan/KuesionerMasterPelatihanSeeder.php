<?php
namespace App\Database\Seeds\Pelatihan;
use CodeIgniter\Database\Seeder;

class KuesionerMasterPelatihanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "pelatihan_id" => 1,
                "kategori_id"  => 1, // Fasilitator
                "pertanyaan"   => "Sejauh mana narasumber menguasai materi yang disampaikan?"
            ],
            [
                "pelatihan_id" => 1,
                "kategori_id"  => 2, // Materi
                "pertanyaan"   => "Apakah materi relevan dengan tupoksi Anda?"
            ],
            [
                "pelatihan_id" => 1,
                "kategori_id"  => 3, // Modul
                "pertanyaan"   => "Kualitas slide dan modul yang dibagikan?"
            ]
        ];
        $this->db->table("kuesioner_master_pelatihan")->insertBatch($data);
    }
}
