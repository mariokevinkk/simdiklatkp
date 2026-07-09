<?php

namespace App\Controllers\Pendidikan\Ci;

use App\Controllers\BaseController;
use Config\Database;

class DashboardController extends BaseCiController
{
    public function index()
    {
        // 3. Ambil data mapping stase & ruangan untuk CI ini
        $mappings = $this->db->table('stase_ruangan_ci_pendidikan')
            ->select('stase_ruangan_ci_pendidikan.*, stase_pendidikan.nama_stase, unit_kerja_pelatihan.nama_unit')
            ->join('stase_pendidikan', 'stase_pendidikan.id = stase_ruangan_ci_pendidikan.stase_id')
            ->join('unit_kerja_pelatihan', 'unit_kerja_pelatihan.id_unit_kerja = stase_ruangan_ci_pendidikan.ruangan_id')
            ->where('stase_ruangan_ci_pendidikan.ci_id', $this->ciId)
            ->get()
            ->getResultArray();

        // 4. Kelompokkan berdasarkan Stase
        $stases = [];
        $totalMahasiswa = 0;
        
        foreach ($mappings as $map) {
            $staseId = $map['stase_id'];
            $mhsIds  = json_decode((string)($map['mahasiswa_ids'] ?? ''), true) ?: [];
            
            if (!isset($stases[$staseId])) {
                $stases[$staseId] = [
                    'stase_id'   => (int)$staseId,
                    'nama_stase' => $map['nama_stase'],
                    'rooms'      => [],
                ];
            }

            $count = count($mhsIds);
            $totalMahasiswa += $count;

            $stases[$staseId]['rooms'][] = [
                'ruangan_id'      => (int)$map['ruangan_id'],
                'nama_unit'       => $map['nama_unit'],
                'mahasiswa_count' => $count,
                'mahasiswa_ids'   => $mhsIds
            ];
        }

        $data = [
            'title' => 'Dashboard CI',
            'ci_name' => $this->ciName,
            'stases' => array_values($stases),
            'total_rooms' => count($mappings),
            'total_mahasiswa' => $totalMahasiswa
        ];

        return view('Pendidikan/ci/dashboard_ci', $data);
    }
}
