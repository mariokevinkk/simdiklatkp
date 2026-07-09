<?php

namespace App\Database\Seeds\Pelatihan;

use CodeIgniter\Database\Seeder;

class SertifikatPelatihanSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // 1. Seed Pejabat TTD
        $pejabatData = [
            [
                'id'           => 1,
                'an_pejabat'   => 'a.n Menteri Kesehatan',
                'jabatan'      => 'Direktur Jenderal SDM Kesehatan',
                'nama_pejabat' => 'Grasiana Moghu F. Bio',
                'nip_pejabat'  => '197805122002122003',
                'ttd_image'    => 'ttd_kemenkes_dummy.png',

                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'id'           => 2,
                'an_pejabat'   => 'Direktur',
                'jabatan'      => 'RSUD Kota Yogyakarta',
                'nama_pejabat' => 'Dr. H. Ariyudi Yunantoro',
                'nip_pejabat'  => '196901241999031003',
                'ttd_image'    => 'ttd_direktur_dummy.png',

                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]
        ];

        $db->table('pejabat_ttd_pelatihan')->ignore(true)->insertBatch($pejabatData);

        // 2. Seed template sertif_terbit for training ID 1
        $templateData = [
            [
                'id'               => 1,
                'pelatihan_id'     => 1,
                'no_sertifikat'    => 'KT.03.02/F/0001/SER/2026',
                'background_color' => '#fefaf0',
                'logo_header'      => 'logo_kemenkes_rsud.png',
                'pejabat_id_1'     => 1,
                'pejabat_id_2'     => 2,
                'status'           => 'diterbitkan',
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ]
        ];

        $db->table('sertif_terbit_pelatihan')->ignore(true)->insertBatch($templateData);

        // 3. Seed user certificates of various types
        $certData = [
            [
                'user_id'           => '3471000033330003', // Siti Aminah (Peserta)
                'user_nama'         => 'Siti Aminah, S.Kep',
                'user_profesi'      => 'Perawat',
                'judul'             => 'Pelatihan Basic Trauma Cardiac Life Support (BTCLS)',
                'ranah'             => 'Pembelajaran',
                'kategori_kegiatan' => 'Peserta Pelatihan',
                'skp'               => 32.00,
                'tgl_mulai'         => '2026-02-10',
                'tgl_selesai'       => '2026-02-14',
                'penerbit'          => 'RSUD Kota Yogyakarta',
                'jenis_dokumen'     => 'rsud',
                'verifikasi'        => 'approved',
                'alasan_penolakan'  => null,
                'tgl_upload'        => date('Y-m-d H:i:s'),
                'tgl_verifikasi'    => date('Y-m-d H:i:s'),
                'pelatihan_id'      => 1,
                'file_path'         => 'uploads/pelatihan/sertifikat/internal_btcls.pdf',
                'no_sertifikat'     => 'KT.03.02/F/0001/SER/2026',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'           => '3471000033330003', // Siti Aminah (Peserta)
                'user_nama'         => 'Siti Aminah, S.Kep',
                'user_profesi'      => 'Perawat',
                'judul'             => 'Seminar Keperawatan Mandiri Gawat Darurat',
                'ranah'             => 'Pembelajaran',
                'kategori_kegiatan' => 'Peserta Seminar',
                'skp'               => 4.00,
                'tgl_mulai'         => '2026-03-05',
                'tgl_selesai'       => '2026-03-05',
                'penerbit'          => 'PPNI Yogyakarta',
                'jenis_dokumen'     => 'mandiri',
                'verifikasi'        => 'approved',
                'alasan_penolakan'  => null,
                'tgl_upload'        => date('Y-m-d H:i:s'),
                'tgl_verifikasi'    => date('Y-m-d H:i:s'),
                'pelatihan_id'      => null,
                'file_path'         => 'uploads/pelatihan/sertifikat/mandiri_seminar.pdf',
                'no_sertifikat'     => 'PPNI-YOG-2026-9988',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'           => '3471000033330003', // Siti Aminah (Peserta)
                'user_nama'         => 'Siti Aminah, S.Kep',
                'user_profesi'      => 'Perawat',
                'judul'             => 'Surat Tugas Pelayanan Kesehatan Daerah Bencana Merapi',
                'ranah'             => 'Pengabdian',
                'kategori_kegiatan' => 'Tim Relawan Kesehatan',
                'skp'               => 10.00,
                'tgl_mulai'         => '2026-04-01',
                'tgl_selesai'       => '2026-04-07',
                'penerbit'          => 'Dinas Kesehatan Kota Yogyakarta',
                'jenis_dokumen'     => 'surat_tugas',
                'verifikasi'        => 'pending',
                'alasan_penolakan'  => null,
                'tgl_upload'        => date('Y-m-d H:i:s'),
                'tgl_verifikasi'    => null,
                'pelatihan_id'      => null,
                'file_path'         => 'uploads/pelatihan/sertifikat/surat_tugas_merapi.pdf',
                'no_sertifikat'     => '800/ST/IV/2026',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'           => '3471000033330003', // Siti Aminah (Peserta)
                'user_nama'         => 'Siti Aminah, S.Kep',
                'user_profesi'      => 'Perawat',
                'judul'             => 'Seminar Internasional Asuhan Keperawatan Modern',
                'ranah'             => 'Pembelajaran',
                'kategori_kegiatan' => 'Peserta Seminar',
                'skp'               => 8.00,
                'tgl_mulai'         => '2026-05-12',
                'tgl_selesai'       => '2026-05-13',
                'penerbit'          => 'International Nurse Association',
                'jenis_dokumen'     => 'mandiri',
                'verifikasi'        => 'rejected',
                'alasan_penolakan'  => 'Berkas sertifikat tidak terlihat jelas dan logo buram.',
                'tgl_upload'        => date('Y-m-d H:i:s'),
                'tgl_verifikasi'    => date('Y-m-d H:i:s'),
                'pelatihan_id'      => null,
                'file_path'         => 'uploads/pelatihan/sertifikat/mandiri_seminar_rejected.pdf',
                'no_sertifikat'     => 'INA-2026-0009',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]
        ];

        $db->table('sertifikat_pelatihan')->truncate();
        $db->table('sertifikat_pelatihan')->insertBatch($certData);

        // 4. Update Siti Aminah's JPL in users table initially
        $userModel = new \App\Models\Pelatihan\UserPelatihanModel();
        $userModel->recalculateJpl('3471000033330003');
    }
}
