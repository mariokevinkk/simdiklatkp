<?php

namespace App\Models;

use CodeIgniter\Model;

class CiPendidikanModel extends Model
{
    protected $table            = 'ci_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'nip',
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'id_profesi',
        'id_unit_kerja',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
