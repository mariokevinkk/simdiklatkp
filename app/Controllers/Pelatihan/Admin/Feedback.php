<?php
namespace App\Controllers\Pelatihan\Admin;
use App\Controllers\BaseController;

class Feedback extends BaseController
{
    public function index()
    {
        return redirect()->to('/pelatihan/admin/monitoring_peserta');
    }

    public function detail($id)
    {
        $masterModel = new \App\Models\Pelatihan\MasterPelatihanModel();
        $p = $masterModel->find($id);
        
        if (empty($p)) return redirect()->to('/pelatihan/admin/monitoring_peserta');

        $pesertaModel = new \App\Models\Pelatihan\PesertaPelatihanModel();
        $pesertaList = $pesertaModel->select('peserta_pelatihan.*, users_pelatihan.nama_lengkap as nama')
            ->join('users_pelatihan', 'users_pelatihan.nik = peserta_pelatihan.user_id')
            ->where('peserta_pelatihan.pelatihan_id', $id)
            ->findAll();

        $feedbacks = [];
        $totalRating = 0;
        $count = 0;
        
        $db = \Config\Database::connect();
        foreach ($pesertaList as $pl) {
            $saran = $db->table('peserta_kuesioner_saran_pelatihan')
                        ->where('peserta_pelat_id', $pl['id'])
                        ->get()->getRowArray();
                        
            if ($saran) {
                $rating = $saran['rating_umum'];
                $komentar = $saran['saran_masukan'];
                
                // Fetch post-test score
                $postTest = $db->table('peserta_ujian_pelatihan')
                               ->select('score as nilai_score')
                               ->where('peserta_pelat_id', $pl['id'])
                               ->where('tipe_ujian', 'post_test')
                               ->orderBy('created_at', 'DESC')
                               ->get()->getRowArray();
                $skorPostTest = $postTest ? $postTest['nilai_score'] : null;

                // Fetch detailed answers
                $jawaban = $db->table('peserta_kuesioner_rating_pelatihan')
                              ->select('kuesioner_master_pelatihan.pertanyaan, kategori_evaluasi_pelatihan.nama_kategori as kategori, peserta_kuesioner_rating_pelatihan.nilai_rating, sesi_interaktif_pelatihan.nama_sesi')
                              ->join('kuesioner_master_pelatihan', 'kuesioner_master_pelatihan.id = peserta_kuesioner_rating_pelatihan.kuesioner_id')
                              ->join('kategori_evaluasi_pelatihan', 'kategori_evaluasi_pelatihan.id = kuesioner_master_pelatihan.kategori_id', 'left')
                              ->join('sesi_interaktif_pelatihan', 'sesi_interaktif_pelatihan.id = peserta_kuesioner_rating_pelatihan.sesi_id', 'left')
                              ->where('peserta_kuesioner_rating_pelatihan.peserta_pelat_id', $pl['id'])
                              ->get()->getResultArray();

                // Group jawaban by category
                $jawabanDetail = [];
                foreach ($jawaban as $j) {
                    $kat = $j['kategori'];
                    if (!isset($jawabanDetail[$kat])) $jawabanDetail[$kat] = [];
                    $jawabanDetail[$kat][] = $j;
                }

                $feedbacks[] = [
                    'nama' => $pl['nama'],
                    'rating' => $rating,
                    'komentar' => $komentar,
                    'skor_post_test' => $skorPostTest,
                    'jawaban_detail' => $jawabanDetail
                ];
                $totalRating += $rating;
                $count++;
            }
        }

        if ($count == 0) {
            $avg = 0;
        } else {
            $avg = round($totalRating / $count, 1);
        }

        // Fetch detailed question ratings
        $questionStats = [];
        $questions = $db->table('kuesioner_master_pelatihan')
            ->select('kuesioner_master_pelatihan.*, kategori_evaluasi_pelatihan.nama_kategori as kategori')
            ->join('kategori_evaluasi_pelatihan', 'kategori_evaluasi_pelatihan.id = kuesioner_master_pelatihan.kategori_id', 'left')
            ->where('pelatihan_id', $id)
            ->get()->getResultArray();
        
        if (!empty($questions)) {
            foreach ($questions as $q) {
                // Calculate average rating for this question based on peserta of this pelatihan
                $ratingStat = $db->table('peserta_kuesioner_rating_pelatihan')
                    ->selectAvg('nilai_rating')
                    ->selectCount('id', 'total_votes')
                    ->where('kuesioner_id', $q['id'])
                    ->get()->getRowArray();
                
                $q['avg_rating'] = $ratingStat['nilai_rating'] ? round($ratingStat['nilai_rating'], 1) : 0;
                $q['total_votes'] = $ratingStat['total_votes'] ?: 0;
                
                $questionStats[$q['kategori']][] = $q;
            }
        }

        $data = [
            'title' => 'Detail Feedback: ' . $p['nama'],
            'p' => $p,
            'avg' => $avg,
            'feedbacks' => $feedbacks,
            'questionStats' => $questionStats
        ];
        return view('pelatihan/admin/feedback/detail', $data);
    }
}
