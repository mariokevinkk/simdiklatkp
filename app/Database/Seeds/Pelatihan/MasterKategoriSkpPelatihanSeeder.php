<?php
namespace App\Database\Seeds\Pelatihan;
use CodeIgniter\Database\Seeder;

class MasterKategoriSkpPelatihanSeeder extends Seeder
{
    public function run()
    {
        // Check if table already has data to avoid duplicates
        $existing = $this->db->table('master_kategori_skp_pelatihan')->countAllResults();
        if ($existing > 0) {
            return;
        }

        $data = [
            // Pembelajaran
            ['ranah' => 'Pembelajaran', 'nama_kategori' => 'Peserta Seminar'],
            ['ranah' => 'Pembelajaran', 'nama_kategori' => 'Moderator Pada Seminar / Webinar'],
            ['ranah' => 'Pembelajaran', 'nama_kategori' => 'Peserta Konferensi/Simposium'],
            ['ranah' => 'Pembelajaran', 'nama_kategori' => 'Pembicara/Narasumber dalam kegiatan Konferensi/Simposium'],
            ['ranah' => 'Pembelajaran', 'nama_kategori' => 'Moderator Konferensi/Simposium'],
            ['ranah' => 'Pembelajaran', 'nama_kategori' => 'Pembicara/Narasumber dalam Kegiatan Seminar'],
            ['ranah' => 'Pembelajaran', 'nama_kategori' => 'Peserta Pelatihan/Workshop'],
            ['ranah' => 'Pembelajaran', 'nama_kategori' => 'Pembicara/Narasumber dalam kegiatan Pelatihan/Workshop'],
            // Pelayanan
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Program penanggulangan TBC'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Program pemeriksaan kesehatan gratis (PKG)'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Pemeriksaan/Diagnosis'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Pemeriksaan Laboratorium / penunjang lainnya'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Melakukan tindakan Intervensi keprofesian tertentu'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Pelayanan Administratif Keprofesian'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Pemberian Pelayanan Keprofesian tertentu'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Melakukan penapisan/pemeriksaan kesehatan (MCU)'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Membuat Ekspertise di bidang keprofesiannya'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Pembuatan Visum et Repertum/Surat keterangan medikolegal'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Kegiatan yang berhubungan dengan medikolegal/keterangan ahli'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Pengamatan Epidemiologi (Surveilance)'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Penanggulangan Kejadian Luar Biasa (KLB)/Wabah/Bencana'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Laporan kasus baik ilmiah maupun keprofesian'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Pendidikan lanjut tanpa gelar'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Penelitian'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Publikasi'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Mengikuti diskusi kasus internal'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Kegiatan Manajerial pelayanan kesehatan'],
            ['ranah' => 'Pelayanan', 'nama_kategori' => 'Kegiatan lain berkaitan dengan keprofesian'],
            // Pengabdian
            ['ranah' => 'Pengabdian', 'nama_kategori' => 'Program pengabdian penanggulangan TBC'],
            ['ranah' => 'Pengabdian', 'nama_kategori' => 'Program pengabdian pemeriksaan kesehatan gratis (PKG)'],
            ['ranah' => 'Pengabdian', 'nama_kategori' => 'Kegiatan pelayanan medis, pengobatan massal untuk masyarakat'],
            ['ranah' => 'Pengabdian', 'nama_kategori' => 'Penyuluhan kesehatan/edukasi medis keprofesian'],
            ['ranah' => 'Pengabdian', 'nama_kategori' => 'Penugasan (Khusus) pemerintah'],
            ['ranah' => 'Pengabdian', 'nama_kategori' => 'Keterlibatan dalam tim khusus (relawan bencana, tim haji dll)'],
            ['ranah' => 'Pengabdian', 'nama_kategori' => 'Terlibat dalam organisasi keilmuan atau organisasi masyarakat'],
            ['ranah' => 'Pengabdian', 'nama_kategori' => 'Penyuluhan melalui media Sosial'],
            ['ranah' => 'Pengabdian', 'nama_kategori' => 'Narasumber rubrik kesehatan/wawancara/edukasi di TV/Media massa'],
        ];
        $this->db->table('master_kategori_skp_pelatihan')->insertBatch($data);
    }
}
