<?php

namespace App\Controllers\Pendidikan\Ci;

class StudentController extends BaseCiController
{
    public function detail($staseId, $ruanganId, $mahasiswaId)
    {
        $this->verifyCiAccess($staseId, $ruanganId);

        $stase = $this->db->table('stase_pendidikan')->where('id', $staseId)->get()->getRowArray();
        $ruangan = $this->db->table('unit_kerja_pelatihan')->where('id_unit_kerja', $ruanganId)->get()->getRowArray();

        $student = $this->db->table('mahasiswa_pendidikan')
            ->select('mahasiswa_pendidikan.*, institusi_pendidikan.nama_institusi')
            ->join('institusi_pendidikan', 'institusi_pendidikan.id = mahasiswa_pendidikan.institusi_id', 'left')
            ->where('mahasiswa_pendidikan.id', $mahasiswaId)
            ->get()->getRowArray();

        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Mahasiswa tidak ditemukan.');
        }

        // Get logbooks
        $penempatan = $this->db->table('penempatan_peserta_pendidikan')
            ->where('mahasiswa_id', $mahasiswaId)
            ->where('stase_id', $staseId)
            ->get()->getRowArray();

        $logbooks = [];
        if ($penempatan) {
            $logbooks = $this->db->table('logbook_pendidikan')
                ->where('penempatan_id', $penempatan['id'])
                ->where('stase_id', $staseId)
                ->where('ruangan_id', $ruanganId)
                ->orderBy('tanggal_kegiatan', 'DESC')
                ->get()->getResultArray();
        }

        // Get tasks & submissions
        $tasks = $this->db->table('tugas_pendidikan')
            ->select('tugas_pendidikan.*, ci_pendidikan.nama_lengkap as ci_name_giver, unit_kerja_pelatihan.nama_unit as ruangan_name')
            ->join('ci_pendidikan', 'ci_pendidikan.id = tugas_pendidikan.ci_id', 'left')
            ->join('unit_kerja_pelatihan', 'unit_kerja_pelatihan.id_unit_kerja = tugas_pendidikan.ruangan_id', 'left')
            ->where('tugas_pendidikan.stase_id', $staseId)
            ->where('tugas_pendidikan.ruangan_id', $ruanganId)
            ->where('tugas_pendidikan.ci_id', $this->ciId)
            ->orderBy('tugas_pendidikan.created_at', 'DESC')
            ->get()->getResultArray();

        foreach ($tasks as &$t) {
            $sub = $this->db->table('pengumpulan_tugas_pendidikan')
                ->where('tugas_id', $t['id'])
                ->where('mahasiswa_id', $mahasiswaId)
                ->get()->getRowArray();
            $t['submission'] = $sub;
        }

        $data = [
            'title' => 'Detail Mahasiswa - ' . $student['nama_lengkap'],
            'ci_name' => $this->ciName,
            'stase' => $stase,
            'ruangan' => $ruangan,
            'student' => $student,
            'logbooks' => $logbooks,
            'tasks' => $tasks
        ];

        return view('Pendidikan/ci/student_detail', $data);
    }
}
