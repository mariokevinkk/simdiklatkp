<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasPendidikanModel extends Model
{
    protected $table            = 'tugas_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'stase_id',
        'ruangan_id',
        'ci_id',
        'nama_tugas',
        'deskripsi',
        'deadline'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
