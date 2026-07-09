<?php
namespace App\Controllers\Pelatihan\Peserta;
use App\Controllers\BaseController;

class Training extends BaseController
{
    public function daftar($id)
    {
        $userId = $this->session->get('user_id'); // NIK
        if (!$userId) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        
        $item = $db->table('master_pelatihan')->where('id', $id)->get()->getRowArray();
        if (!$item) return redirect()->to('/pelatihan/peserta/pembelajaran');

        $now = date('Y-m-d H:i:s');
        $regBuka = $item['reg_buka_tgl'] . ' ' . ($item['reg_buka_jam'] ?: '00:00:00');
        $regTutup = $item['reg_tutup_tgl'] . ' ' . ($item['reg_tutup_jam'] ?: '23:59:59');
        if ($now < $regBuka || $now > $regTutup) {
            return redirect()->to('/pelatihan/peserta/detail_pelatihan/'.$id)->with('error', 'Pendaftaran sedang ditutup.');
        }

        $statusPeserta = 'Daftar';
        $statusPembayaran = 'Gratis';
        $statusAkses = 'Terbuka';

        if ($item['biaya_nominal'] > 0) {
            $statusPembayaran = 'Pending';
        }

        if ($item['mekanisme'] == 'Tertutup') {
            $statusAkses = 'Pending';
        }

        // Check if already registered
        $exists = $db->table('peserta_pelatihan')
            ->where('user_id', $userId)
            ->where('pelatihan_id', $id)
            ->get()->getRowArray();

        if ($exists) {
            $db->table('peserta_pelatihan')->where('id', $exists['id'])->update([
                'status_peserta' => $statusPeserta,
                'status_pembayaran' => $statusPembayaran,
                'status_akses' => $statusAkses,
                'waktu_daftar' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            $db->table('peserta_pelatihan')->insert([
                'user_id' => $userId,
                'pelatihan_id' => $id,
                'status_peserta' => $statusPeserta,
                'waktu_daftar' => date('Y-m-d H:i:s'),
                'status_pembayaran' => $statusPembayaran,
                'status_akses' => $statusAkses,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if ($statusPembayaran == 'Gratis' && $statusAkses == 'Terbuka') {
                $now = date('Y-m-d H:i:s');
                $jadwalMulai = $item['jadwal_mulai'] . ' ' . ($item['jam_mulai'] ?: '00:00:00');
                if ($now >= $jadwalMulai) {
                    $msg = 'Pendaftaran pelatihan telah berhasil. Pelatihan langsung bisa diakses, silakan menuju menu Diklat Saya dan klik Mulai Belajar.';
                } else {
                    $tglMulai = date('d M Y', strtotime($item['jadwal_mulai']));
                    $msg = 'Pendaftaran pelatihan telah berhasil. Pelatihan akan dapat diakses mulai tanggal ' . $tglMulai . '.';
                }

                $db->table('notifikasi_pelatihan')->insert([
                    'user_id' => $userId,
                    'title' => 'Pendaftaran Berhasil: ' . $item['nama'],
                    'message' => $msg,
                    'type' => 'success',
                    'is_read' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        if ($statusPembayaran == 'Pending' || $statusAkses == 'Pending') {
            $msg = 'Pendaftaran dikirim. Mohon menunggu verifikasi admin untuk pembayaran/akses.';
        } else {
            $msg = 'Pendaftaran Berhasil! Anda sudah bisa mengakses ruang belajar.';
        }

        return redirect()->to('/pelatihan/peserta/detail_pelatihan/'.$id)->with('success', $msg);
    }

    public function upload_bukti_bayar($id)
    {
        $userId = $this->session->get('user_id');
        if (!$userId) return redirect()->to('/login');

        $db = \Config\Database::connect();
        
        $file = $this->request->getFile('bukti_bayar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!is_dir(ROOTPATH . 'public/uploads/pelatihan/bukti_bayar')) {
                mkdir(ROOTPATH . 'public/uploads/pelatihan/bukti_bayar', 0777, true);
            }
            
            $user = $db->table('users_pelatihan')->where('nik', $userId)->get()->getRowArray();
            $pelatihan = $db->table('master_pelatihan')->where('id', $id)->get()->getRowArray();
            $namaPelatihan = preg_replace('/[^A-Za-z0-9]/', '_', $pelatihan['nama'] ?? 'Pelatihan');
            $namaUser = preg_replace('/[^A-Za-z0-9]/', '_', $user['nama_lengkap'] ?? 'User');
            
            $newName = "BuktiBayar_{$namaPelatihan}_{$namaUser}_" . date('Ymd_His') . "." . $file->getExtension();
            $file->move(ROOTPATH . 'public/uploads/pelatihan/bukti_bayar', $newName);

            $db->table('peserta_pelatihan')
                ->where('user_id', $userId)
                ->where('pelatihan_id', $id)
                ->update([
                    'bukti_bayar' => 'bukti_bayar/' . $newName,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            return redirect()->to('/pelatihan/peserta/detail_pelatihan/'.$id)->with('success', 'Bukti pembayaran berhasil diunggah.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah bukti pembayaran.');
    }

    public function belajar($id)
    {
        $userId = $this->session->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $item = $db->table('master_pelatihan')->where('id', $id)->get()->getRowArray();
        if (!$item) return redirect()->to('/pelatihan/peserta/pembelajaran');

        $now = date('Y-m-d H:i:s');
        $nowTs = strtotime($now);
        $jadwalMulai = $item['jadwal_mulai'] . ' ' . ($item['jam_mulai'] ?: '00:00:00');
        $jadwalSelesai = $item['jadwal_selesai'] . ' ' . ($item['jam_selesai'] ?: '23:59:59');
        if ($now < $jadwalMulai || $now > $jadwalSelesai) {
            return redirect()->to('/pelatihan/peserta/detail_pelatihan/'.$id)->with('error', 'Masa pelatihan belum dimulai atau sudah berakhir.');
        }

        $reg = $db->table('peserta_pelatihan')
            ->where('user_id', $userId)
            ->where('pelatihan_id', $id)
            ->get()->getRowArray();

        $isPayApproved = $reg && in_array($reg['status_pembayaran'], ['Verified', 'Gratis']);
        $isAccessApproved = $reg && in_array($reg['status_akses'], ['Approved', 'Terbuka']);

        if (!$reg || !$isPayApproved || !$isAccessApproved) {
            return redirect()->to('/pelatihan/peserta/detail_pelatihan/'.$id)->with('error', 'Akses ditolak. Mohon tunggu verifikasi admin.');
        }

        $progress = $this->session->get('progress') ?? [];
        $pg = null;
        foreach ($progress as $p) {
            if ($p['user_id'] == $userId && $p['pelatihan_id'] == $id) {
                $pg = $p;
                break;
            }
        }

        $pesertaRecord = $db->table('peserta_pelatihan')->where('user_id', $userId)->where('pelatihan_id', $id)->get()->getRowArray();
        
        $preTestAttempted = false;
        $postTestAttempts = 0;
        $preTestScore = 0;
        $postTestScore = 0;
        $postTestStatus = 'Tidak Lulus';

        if ($pesertaRecord) {
            $ptAttempt = $db->table('peserta_ujian_pelatihan')->where('peserta_pelat_id', $pesertaRecord['id'])->where('tipe_ujian', 'pre_test')->get()->getRowArray();
            if ($ptAttempt) {
                $preTestAttempted = true;
                $preTestScore = $ptAttempt['score'];
            }
            $postTestAttempts = $db->table('peserta_ujian_pelatihan')->where('peserta_pelat_id', $pesertaRecord['id'])->where('tipe_ujian', 'post_test')->countAllResults();
            
            $ptLastAttempt = $db->table('peserta_ujian_pelatihan')
                ->where('peserta_pelat_id', $pesertaRecord['id'])
                ->where('tipe_ujian', 'post_test')
                ->orderBy('created_at', 'DESC')
                ->get()->getRowArray();
            if ($ptLastAttempt) {
                $postTestScore = $ptLastAttempt['score'];
                $postTestStatus = $ptLastAttempt['status_lulus'];
            }
        }

        $konten = [];
        $stepCounter = 1;
        
        $preTestQuestions = [];
        $preTest = $db->table('ujian_pelatihan')->where('pelatihan_id', $id)->where('tipe_evaluasi', 'Pre-test')->get()->getRowArray();
        if ($preTest) {
            $preTestQuestions = $db->table('ujian_soal_pelatihan')->where('ujian_id', $preTest['id'])->get()->getResultArray();
            $konten[] = ['id' => $stepCounter++, 'tipe' => 'pre_test', 'judul' => 'Pre-Test', 'soal' => count($preTestQuestions), 'ujian_id' => $preTest['id']];
        }

        $sesi = $db->table('sesi_interaktif_pelatihan')
            ->where('pelatihan_id', $id)
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu', 'ASC')
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();
            
        $presensiList = [];
        if ($pesertaRecord) {
            $pData = $db->table('peserta_presensi_pelatihan')->where('peserta_pelat_id', $pesertaRecord['id'])->get()->getResultArray();
            foreach($pData as $pd) {
                $presensiList[$pd['sesi_id']] = $pd['waktu_absen'];
            }
        }
        
        foreach ($sesi as $s) {
            $sessionOpenAt = !empty($s['tanggal']) && !empty($s['waktu']) ? strtotime($s['tanggal'] . ' ' . $s['waktu']) : null;
            $sessionCloseAt = !empty($s['tanggal']) && !empty($s['jam_tutup']) ? strtotime($s['tanggal'] . ' ' . $s['jam_tutup']) : (!empty($s['tanggal']) ? strtotime($s['tanggal'] . ' 23:59:59') : $sessionOpenAt);
            $sessionAvailable = $sessionOpenAt === null || ($nowTs >= $sessionOpenAt && ($sessionCloseAt === null || $nowTs <= $sessionCloseAt));

            if (strtolower($s['tipe_sesi'] ?? '') == 'offline') {
                $konten[] = [
                    'id' => $stepCounter++,
                    'tipe' => 'presensi',
                    'judul' => 'Sesi Tatap Muka: ' . $s['nama_sesi'],
                    'sesi_id' => $s['id'],
                    'waktu' => $s['waktu'] ?? '',
                    'jam_tutup' => $s['jam_tutup'] ?? '',
                    'tanggal' => $s['tanggal'] ?? '',
                    'tempat' => $s['tempat'] ?? '',
                    'alamat' => $s['alamat'] ?? '',
                    'lokasi_ruang' => $s['lokasi_ruang'] ?? '',
                    'maps_url' => $s['maps_url'] ?? '',
                    'available' => $sessionAvailable,
                    'open_at' => $sessionOpenAt ? date('Y-m-d H:i:s', $sessionOpenAt) : null,
                    'close_at' => $sessionCloseAt ? date('Y-m-d H:i:s', $sessionCloseAt) : null,
                    'is_attended' => isset($presensiList[$s['id']]),
                    'attended_at' => isset($presensiList[$s['id']]) ? $presensiList[$s['id']] : null
                ];
            } else {
                $konten[] = [
                    'id' => $stepCounter++,
                    'tipe' => 'sesi',
                    'judul' => 'Sesi Online/Hybrid: ' . $s['nama_sesi'],
                    'sesi_id' => $s['id'],
                    'meeting_link' => $s['meeting_link'] ?? '',
                    'waktu' => $s['waktu'] ?? '',
                    'jam_tutup' => $s['jam_tutup'] ?? '',
                    'tanggal' => $s['tanggal'] ?? '',
                    'available' => $sessionAvailable,
                    'open_at' => $sessionOpenAt ? date('Y-m-d H:i:s', $sessionOpenAt) : null,
                    'close_at' => $sessionCloseAt ? date('Y-m-d H:i:s', $sessionCloseAt) : null,
                    'tipe_sesi' => $s['tipe_sesi'] ?? '',
                    'is_attended' => isset($presensiList[$s['id']]),
                    'attended_at' => isset($presensiList[$s['id']]) ? $presensiList[$s['id']] : null
                ];
            }
            
            $sessionOpenAt = !empty($s['tanggal']) && !empty($s['waktu']) ? strtotime($s['tanggal'] . ' ' . $s['waktu']) : null;
            $sessionCloseAt = !empty($s['tanggal']) && !empty($s['jam_tutup']) ? strtotime($s['tanggal'] . ' ' . $s['jam_tutup']) : $sessionOpenAt;
            $sessionAvailable = $sessionOpenAt === null || ($nowTs >= $sessionOpenAt && ($sessionCloseAt === null || $nowTs <= $sessionCloseAt));

            $materi = $db->table('materi_pelatihan')->where('sesi_id', $s['id'])->orderBy('segmen', 'ASC')->orderBy('urutan', 'ASC')->get()->getResultArray();
            $groupedMateri = [];
            foreach ($materi as $m) {
                $seg = $m['segmen'] ?: 1;
                $groupedMateri[$seg][] = $m;
            }
            
            foreach ($groupedMateri as $seg => $materiList) {
                $konten[] = [
                    'id' => $stepCounter++, 
                    'tipe' => 'materi_segmen', 
                    'judul' => 'Materi Sesi ' . $s['nama_sesi'] . ' (Segmen ' . $seg . ')',
                    'sesi_id' => $s['id'],
                    'segmen' => $seg,
                    'materi_list' => $materiList,
                    'available' => $sessionAvailable,
                    'open_at' => $sessionOpenAt ? date('Y-m-d H:i:s', $sessionOpenAt) : null,
                    'close_at' => $sessionCloseAt ? date('Y-m-d H:i:s', $sessionCloseAt) : null,
                    'tipe_sesi' => $s['tipe_sesi'] ?? ''
                ];
            }
        }
        $postTestQuestions = [];
        $postTest = $db->table('ujian_pelatihan')->where('pelatihan_id', $id)->where('tipe_evaluasi', 'Post-test')->get()->getRowArray();
        if ($postTest) {
            $postTestQuestions = $db->table('ujian_soal_pelatihan')->where('ujian_id', $postTest['id'])->get()->getResultArray();
            $konten[] = ['id' => $stepCounter++, 'tipe' => 'post_test', 'judul' => 'Post-Test', 'soal' => count($postTestQuestions), 'ujian_id' => $postTest['id']];
        }
        
        $evalIndex = $stepCounter++;
        $certIndex = $stepCounter++;
        $konten[] = ['id' => $evalIndex, 'tipe' => 'evaluasi', 'judul' => 'Evaluasi Pelatihan'];
        $konten[] = ['id' => $certIndex, 'tipe' => 'sertifikat', 'judul' => 'Sertifikat Kelulusan'];

        $this->session->set('total_steps_'.$id, $stepCounter - 1);
        $this->session->set('eval_step_'.$id, $evalIndex);
        $this->session->set('cert_step_'.$id, $certIndex);

        $completed_steps = $pg ? ($pg['completed_steps'] ?? []) : [];
        $active_step_id = $this->request->getGet('step') ?? 1;
        
        $filtered_active = array_filter($konten, fn($k) => $k['id'] == $active_step_id);
        
        $user = $db->table('users_pelatihan')->where('nik', $userId)->get()->getRowArray();

        $evalQuestionsRaw = $db->table('kuesioner_master_pelatihan')
            ->select('kuesioner_master_pelatihan.*, kategori_evaluasi_pelatihan.nama_kategori as kategori')
            ->join('kategori_evaluasi_pelatihan', 'kategori_evaluasi_pelatihan.id = kuesioner_master_pelatihan.kategori_id', 'left')
            ->where('pelatihan_id', $id)
            ->get()->getResultArray();
        $evalQuestions = [];
        foreach ($evalQuestionsRaw as $eq) {
            $evalQuestions[$eq['kategori']][] = $eq;
        }

        $sesiList = $db->table('sesi_interaktif_pelatihan')
            ->where('pelatihan_id', $id)
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu', 'ASC')
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();

        $sertifikat = $db->table('sertifikat_pelatihan')
            ->where('user_id', $userId)
            ->where('pelatihan_id', $id)
            ->where('jenis_dokumen', 'rsud')
            ->get()->getRowArray();

        $data = [
            'title' => 'Ruang Belajar',
            'p' => $item,
            'konten' => $konten,
            'completed_steps' => $completed_steps,
            'active_step' => reset($filtered_active),
            'active_id' => $active_step_id,
            'pg' => $pg,
            'user' => $user,
            'evalIndex' => $evalIndex,
            'certIndex' => $certIndex,
            'postTestIndex' => $postTest ? ($evalIndex - 1) : null,
            'preTestQuestions' => $preTestQuestions,
            'postTestQuestions' => $postTestQuestions,
            'evalQuestions' => $evalQuestions,
            'sesiList' => $sesiList,
            'sertifikat' => $sertifikat,
            'pre_test_attempted' => $preTestAttempted,
            'pre_test_score' => $preTestScore,
            'post_test_attempts' => $postTestAttempts,
            'post_test_score' => $postTestScore,
            'post_test_status' => $postTestStatus,
            'max_post_test_attempts' => 3
        ];
        return view('pelatihan/peserta/pelatihan/belajar', $data);
    }

    public function tandai_selesai($id, $step_id)
    {
        $userId = $this->session->get('user_id');
        $progress = $this->session->get('progress') ?? [];
        $score = $this->request->getGet('score');
        $totalSteps = $this->session->get('total_steps_'.$id) ?? 7; 

        $is_post_test = $this->request->getGet('is_post_test');
        $db = \Config\Database::connect();

        // Cari atau inisialisasi progress user untuk pelatihan ini
        $found = false;
        $userProgressIndex = -1;
        foreach ($progress as $index => &$p) {
            if ($p['user_id'] == $userId && $p['pelatihan_id'] == $id) {
                $found = true;
                $userProgressIndex = $index;
                break;
            }
        }
        
        if (!$found) {
            $progress[] = [
                'user_id' => $userId, 
                'pelatihan_id' => $id, 
                'progress' => (1 / $totalSteps) * 100,
                'status' => 'sedang', 
                'completed_steps' => [], 
                'scores' => [],
                'post_test_attempts' => 0
            ];
            $userProgressIndex = count($progress) - 1;
        }

        $p = &$progress[$userProgressIndex];
        if (!isset($p['post_test_attempts'])) $p['post_test_attempts'] = 0;

        // Logika evaluasi Post-Test
        if ($is_post_test == '1' && $score !== null) {
            $ujian = $db->table('ujian_pelatihan')->where('pelatihan_id', $id)->where('tipe_evaluasi', 'Post-test')->get()->getRowArray();
            $kkm = $ujian ? ($ujian['kkm'] ?? 70) : 70;
            
            // Cek jumlah percobaan dari database untuk konsistensi
            $pesertaRecord = $db->table('peserta_pelatihan')->where('user_id', $userId)->where('pelatihan_id', $id)->get()->getRowArray();
            $attempts = 0;
            if ($pesertaRecord) {
                $attempts = $db->table('peserta_ujian_pelatihan')
                    ->where('peserta_pelat_id', $pesertaRecord['id'])
                    ->where('tipe_ujian', 'post_test')
                    ->countAllResults();
            }
            $p['post_test_attempts'] = $attempts;
            
            if ($score < $kkm) {
                $this->session->set('progress', $progress);
                if ($attempts >= 3) {
                    // Gagal 3x, update database ke Tidak Lulus
                    if ($pesertaRecord) {
                        $db->table('peserta_pelatihan')
                           ->where('id', $pesertaRecord['id'])
                           ->update(['status_peserta' => 'Tidak Lulus', 'updated_at' => date('Y-m-d H:i:s')]);
                    }
                    
                    return redirect()->to('/pelatihan/peserta/pembelajaran_saya')->with('error', 'Maaf, Anda gagal dalam Post-Test sebanyak 3 kali. Pelatihan dibatalkan dan status Anda Tidak Lulus.');
                } else {
                    return redirect()->to('/pelatihan/peserta/belajar/'.$id.'?step='.$step_id.'&error=score_low&last_score='.$score.'&attempts='.$attempts);
                }
            }
        }

        // Tandai step selesai jika belum ada di array
        if (!in_array($step_id, $p['completed_steps'])) {
            $p['completed_steps'][] = (int)$step_id;
            $p['progress'] = (count($p['completed_steps']) / $totalSteps) * 100;
        }
        
        if ($score !== null) $p['scores'][$step_id] = $score;

        $this->session->set('progress', $progress);

        $sesi_id = $this->request->getGet('sesi_id');
        if ($sesi_id) {
            $db = \Config\Database::connect();
            $pesertaRecord = $db->table('peserta_pelatihan')->where('user_id', $userId)->where('pelatihan_id', $id)->get()->getRowArray();
            if ($pesertaRecord) {
                $existPresensi = $db->table('peserta_presensi_pelatihan')
                                    ->where('peserta_pelat_id', $pesertaRecord['id'])
                                    ->where('sesi_id', $sesi_id)
                                    ->get()->getRowArray();
                if (!$existPresensi) {
                    $db->table('peserta_presensi_pelatihan')->insert([
                        'peserta_pelat_id' => $pesertaRecord['id'],
                        'sesi_id' => $sesi_id,
                        'status_hadir' => 'Hadir',
                        'waktu_absen' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }

        $is_ujian = $this->request->getGet('is_ujian');
        if ($is_ujian == '1') {
            return redirect()->to('/pelatihan/peserta/belajar/'.$id.'?step='.$step_id.'&success=1');
        }

        return redirect()->to('/pelatihan/peserta/belajar/'.$id.'?step='.($step_id + 1));
    }
    public function submit_kuis($id)
    {
        $userId = $this->session->get('user_id');
        $step_id = $this->request->getPost('step_id');
        $tipe_ujian = $this->request->getPost('tipe_ujian'); // 'pre_test' or 'post_test'
        $answersJson = $this->request->getPost('answers');
        
        $answers = json_decode($answersJson, true) ?? [];
        $totalQuestions = count($answers);
        $correctCount = 0;

        $db = \Config\Database::connect();
        
        // Cek data peserta
        $pesertaRecord = $db->table('peserta_pelatihan')
            ->where('user_id', $userId)
            ->where('pelatihan_id', $id)
            ->get()->getRowArray();
            
        if (!$pesertaRecord) {
            return redirect()->to('/pelatihan/peserta/belajar/'.$id)->with('error', 'Data peserta tidak ditemukan.');
        }

        $attempts = $db->table('peserta_ujian_pelatihan')
            ->where('peserta_pelat_id', $pesertaRecord['id'])
            ->where('tipe_ujian', $tipe_ujian)
            ->countAllResults();

        if ($tipe_ujian == 'pre_test' && $attempts >= 1) {
            return redirect()->to('/pelatihan/peserta/belajar/'.$id.'?step='.$step_id)->with('error', 'Pre-Test hanya dapat dikerjakan 1 kali.');
        }

        if ($tipe_ujian == 'post_test' && $attempts >= 3) {
            return redirect()->to('/pelatihan/peserta/belajar/'.$id.'?step='.$step_id)->with('error', 'Post-Test hanya dapat dikerjakan 3 kali.');
        }

        // Ambil soal untuk mencocokkan jawaban
        $soalList = [];
        $db_tipe_evaluasi = ($tipe_ujian == 'pre_test') ? 'Pre-test' : 'Post-test';
        $ujian = $db->table('ujian_pelatihan')
            ->where('pelatihan_id', $id)
            ->where('tipe_evaluasi', $db_tipe_evaluasi)
            ->get()->getRowArray();
            
        if ($ujian) {
            $soals = $db->table('ujian_soal_pelatihan')->where('ujian_id', $ujian['id'])->get()->getResultArray();
            foreach ($soals as $s) {
                $soalList[$s['id']] = strtolower(trim($s['jawaban_benar']));
            }
        }

        $logJawaban = [];
        foreach ($answers as $ans) {
            $sId = $ans['soal_id'];
            $j = strtolower(trim($ans['jawaban'] ?? ''));
            $isCorrect = (isset($soalList[$sId]) && $soalList[$sId] === $j) ? 1 : 0;
            if ($isCorrect) $correctCount++;
            
            $logJawaban[] = [
                'soal_id' => $sId,
                'jawaban_peserta' => strtoupper($j),
                'is_correct' => $isCorrect
            ];
        }

        $score = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100, 2) : 0;
        
        // Simpan Hasil Ujian
        $ujianIdInserted = null;
        $kkm = $ujian ? ($ujian['kkm'] ?? 70) : 70;
        
        $statusLulus = ($score >= $kkm) ? 'Lulus' : 'Tidak Lulus';

        $db->table('peserta_ujian_pelatihan')->insert([
            'peserta_pelat_id' => $pesertaRecord['id'],
            'tipe_ujian' => $tipe_ujian,
            'score' => $score,
            'status_lulus' => $statusLulus,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $ujianIdInserted = $db->insertID();

        // Simpan Log Jawaban
        if ($ujianIdInserted && !empty($logJawaban)) {
            foreach ($logJawaban as &$lj) {
                $lj['peserta_ujian_id'] = $ujianIdInserted;
            }
            $db->table('peserta_jawaban_ujian_pelatihan')->insertBatch($logJawaban);
        }

        // Lanjut ke tandai_selesai (menggunakan querystring untuk update status progres dll)
        $isPostTestNum = ($tipe_ujian == 'post_test') ? 1 : 0;
        return redirect()->to('/pelatihan/peserta/tandai_selesai/'.$id.'/'.$step_id.'?score='.$score.'&is_post_test='.$isPostTestNum.'&is_ujian=1');
    }


    public function submit_evaluasi($id)
    {
        $userId = $this->session->get('user_id');
        $progress = $this->session->get('progress') ?? [];
        $evalIndex = $this->session->get('eval_step_'.$id) ?? 6;
        $certIndex = $this->session->get('cert_step_'.$id) ?? 7;

        foreach ($progress as &$p) {
            if ($p['user_id'] == $userId && $p['pelatihan_id'] == $id) {
                $p['status'] = 'selesai';
                $p['progress'] = 100;
                if (!isset($p['completed_steps'])) $p['completed_steps'] = [];
                if (!in_array($evalIndex, $p['completed_steps'])) $p['completed_steps'][] = $evalIndex;
                if (!in_array($certIndex, $p['completed_steps'])) $p['completed_steps'][] = $certIndex;
                break;
            }
        }
        $this->session->set('progress', $progress);

        $db = \Config\Database::connect();
        
        $pesertaRecord = $db->table('peserta_pelatihan')
           ->where('user_id', $userId)
           ->where('pelatihan_id', $id)
           ->get()->getRowArray();
           
        if ($pesertaRecord) {
            $pesertaPelatId = $pesertaRecord['id'];
            
            // Insert Ratings Normal
            $ratings = $this->request->getPost('rating');
            $batchData = [];
            if ($ratings && is_array($ratings)) {
                foreach ($ratings as $kuesionerId => $nilai) {
                    $batchData[] = [
                        'peserta_pelat_id' => $pesertaPelatId,
                        'kuesioner_id' => $kuesionerId,
                        'sesi_id' => null,
                        'nilai_rating' => $nilai
                    ];
                }
            }

            // Insert Ratings Fasilitator (per sesi)
            $ratingsFasil = $this->request->getPost('rating_fasilitator');
            if ($ratingsFasil && is_array($ratingsFasil)) {
                foreach ($ratingsFasil as $sesiId => $fasilRatings) {
                    foreach ($fasilRatings as $kuesionerId => $nilai) {
                        $batchData[] = [
                            'peserta_pelat_id' => $pesertaPelatId,
                            'kuesioner_id' => $kuesionerId,
                            'sesi_id' => $sesiId,
                            'nilai_rating' => $nilai
                        ];
                    }
                }
            }

            if (!empty($batchData)) {
                $db->table('peserta_kuesioner_rating_pelatihan')->insertBatch($batchData);
            }
            
            // Insert Saran
            $ratingUmum = $this->request->getPost('rating_umum') ?? 5;
            $saran = $this->request->getPost('saran') ?? '';
            
            $db->table('peserta_kuesioner_saran_pelatihan')->insert([
                'peserta_pelat_id' => $pesertaPelatId,
                'rating_umum' => $ratingUmum,
                'saran_masukan' => $saran,
                'waktu_submit' => date('Y-m-d H:i:s')
            ]);
            
            // Update Status Kelulusan
            $ujianPost = $db->table('peserta_ujian_pelatihan')
                ->where('peserta_pelat_id', $pesertaPelatId)
                ->where('tipe_ujian', 'post_test')
                ->orderBy('created_at', 'DESC')
                ->get()->getRowArray();
                
            if ($ujianPost && $ujianPost['status_lulus'] == 'Lulus') {
                $db->table('peserta_pelatihan')
                   ->where('id', $pesertaPelatId)
                   ->update([
                       'status_peserta' => 'Lulus',
                       'updated_at' => date('Y-m-d H:i:s')
                   ]);
            }
        }

        return redirect()->to('/pelatihan/peserta/belajar/'.$id.'?step='.$certIndex)->with('success', 'Pelatihan Selesai! Anda telah resmi Lulus pelatihan ini. Terimakasih atas evaluasi Anda.');
    }

    public function approve_and_start($id)
    {
        $userId = $this->session->get('user_id');
        if (!$userId) return redirect()->to('/login');

        $db = \Config\Database::connect();
        $db->table('peserta_pelatihan')
           ->where('user_id', $userId)
           ->where('pelatihan_id', $id)
           ->update([
               'status_pembayaran' => 'Verified',
               'status_akses' => 'Approved'
           ]);

        return redirect()->to('/pelatihan/peserta/belajar/'.$id)->with('success', 'Akses berhasil disetujui.');
    }

    public function reset_simulasi($id = null)
    {
        $userId = $this->session->get('user_id');
        $db = \Config\Database::connect();
        
        if ($id) {
            $db->table('peserta_pelatihan')->where('user_id', $userId)->where('pelatihan_id', $id)->delete();
            $progress = array_values(array_filter($this->session->get('progress') ?? [], fn($p) => $p['pelatihan_id'] != $id));
            $this->session->set('progress', $progress);
        } else {
            $db->table('peserta_pelatihan')->where('user_id', $userId)->delete();
            $this->session->remove('progress');
        }
        return redirect()->back()->with('success', 'Reset berhasil.');
    }
}
