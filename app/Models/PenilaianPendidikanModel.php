<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianPendidikanModel extends Model
{
    protected $table            = 'penilaian_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'penempatan_id',
        'aspek_penilaian',
        'nilai_angka',
        'catatan',
        'tanggal_penilaian'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'created_at';
}
