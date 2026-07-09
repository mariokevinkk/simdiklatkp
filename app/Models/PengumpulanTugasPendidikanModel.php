<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumpulanTugasPendidikanModel extends Model
{
    protected $table            = 'pengumpulan_tugas_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tugas_id',
        'mahasiswa_id',
        'file_tugas',
        'catatan_mahasiswa',
        'nilai',
        'catatan_ci',
        'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
