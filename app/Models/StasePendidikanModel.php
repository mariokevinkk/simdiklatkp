<?php

namespace App\Models;

use CodeIgniter\Model;

class StasePendidikanModel extends Model
{
    protected $table            = 'stase_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_stase',
        'profesi_id',
        'ruangan',
        'ci_id',
        'tanggal_mulai',
        'tanggal_akhir',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
