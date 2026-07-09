<?php

namespace App\Controllers\Pendidikan\Ci;

class RoomController extends BaseCiController
{
    public function detail($staseId, $ruanganId)
    {
        $mapping = $this->verifyCiAccess($staseId, $ruanganId);

        $stase = $this->db->table('stase_pendidikan')->where('id', $staseId)->get()->getRowArray();
        $ruangan = $this->db->table('unit_kerja_pelatihan')->where('id_unit_kerja', $ruanganId)->get()->getRowArray();

        $mhsIds = json_decode((string)($mapping['mahasiswa_ids'] ?? ''), true) ?: [];
        $students = [];

        if (!empty($mhsIds)) {
            $students = $this->db->table('mahasiswa_pendidikan mp')
                ->select('mp.id, mp.nim, mp.nama_lengkap, i.nama_institusi, p.file_logbook')
                ->join('penempatan_peserta_pendidikan ppp', 'ppp.mahasiswa_id = mp.id', 'left')
                ->join('pengajuan_praktik_pendidikan p', 'ppp.pengajuan_id = p.id', 'left')
                ->join('institusi_pendidikan i', 'mp.institusi_id = i.id', 'left')
                ->whereIn('mp.id', $mhsIds)
                ->get()->getResultArray();
        }

        // Extract unique institution logbooks
        $logbookInstitusi = [];
        foreach ($students as $s) {
            if (!empty($s['file_logbook']) && !isset($logbookInstitusi[$s['nama_institusi']])) {
                $logbookInstitusi[$s['nama_institusi']] = $s['file_logbook'];
            }
        }

        // Get tasks for this room to show count or simple list if needed
        $tasks = $this->db->table('tugas_pendidikan')
            ->where('stase_id', $staseId)
            ->where('ruangan_id', $ruanganId)
            ->where('ci_id', $this->ciId)
            ->orderBy('created_at', 'DESC')
            ->get()->getResultArray();

        $data = [
            'title' => 'Detail Ruangan - ' . $ruangan['nama_unit'],
            'ci_name' => $this->ciName,
            'stase' => $stase,
            'ruangan' => $ruangan,
            'students' => $students,
            'tasks' => $tasks,
            'logbookInstitusi' => $logbookInstitusi
        ];

        return view('Pendidikan/ci/room_detail', $data);
    }
}
