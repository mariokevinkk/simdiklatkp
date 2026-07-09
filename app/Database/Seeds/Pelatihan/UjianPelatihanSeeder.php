<?php
namespace App\Database\Seeds\Pelatihan;
use CodeIgniter\Database\Seeder;

class UjianPelatihanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "pelatihan_id"  => 1,
                "tipe_evaluasi" => "Pre-Test",
                "kkm"           => 0
            ],
            [
                "pelatihan_id"  => 1,
                "tipe_evaluasi" => "Post-Test",
                "kkm"           => 80
            ],
            [
                "pelatihan_id"  => 2,
                "tipe_evaluasi" => "Post-Test",
                "kkm"           => 70
            ]
        ];
        $this->db->table("ujian_pelatihan")->insertBatch($data);

        // Seed soal evaluasi
        $soalData = [
            [
                "ujian_id"       => 1,
                
                "tipe_soal"         => "Pilihan Ganda",
                "pertanyaan"        => "Apa yang dimaksud dengan Pelatihan Kepemimpinan?",
                "opsi_a"            => "Pelatihan fisik",
                "opsi_b"            => "Pelatihan untuk meningkatkan skill memimpin",
                "opsi_c"            => "Pelatihan memasak",
                "opsi_d"            => "Pelatihan bahasa",
                "jawaban_benar"     => "B"
            ],
            [
                "ujian_id"       => 2,
                
                "tipe_soal"         => "Pilihan Ganda",
                "pertanyaan"        => "Apa yang dimaksud dengan Pelatihan Kepemimpinan?",
                "opsi_a"            => "Pelatihan fisik",
                "opsi_b"            => "Pelatihan untuk meningkatkan skill memimpin",
                "opsi_c"            => "Pelatihan memasak",
                "opsi_d"            => "Pelatihan bahasa",
                "jawaban_benar"     => "B"
            ],
            [
                "ujian_id"       => 3,
                
                "tipe_soal"         => "Benar Salah",
                "pertanyaan"        => "Budaya kerja unggul tidak terlalu penting di perusahaan.",
                "opsi_a"            => "Benar",
                "opsi_b"            => "Salah",
                "opsi_c"            => null,
                "opsi_d"            => null,
                "jawaban_benar"     => "B"
            ]
        ];
        $this->db->table("ujian_soal_pelatihan")->insertBatch($soalData);
    }
}
