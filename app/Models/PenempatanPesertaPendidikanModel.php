<?php

namespace App\Models;

use CodeIgniter\Model;

class PenempatanPesertaPendidikanModel extends Model
{
    protected $table            = 'penempatan_peserta_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pengajuan_id',
        'mahasiswa_id',
        'stase_id',
        'status_aktif'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'created_at';
}
