<?php

namespace App\Models;

use CodeIgniter\Model;

class StaseRuanganCiModel extends Model
{
    protected $table            = 'stase_ruangan_ci_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'stase_id',
        'ruangan_id',
        'ci_id',
        'mahasiswa_ids',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
