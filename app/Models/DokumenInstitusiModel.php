<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenInstitusiModel extends Model
{
    protected $table            = 'dokumen_institusi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'institusi_id',
        'judul',
        'nama_file',
        'original_name',
        'tipe_file',
        'ukuran_file',
        'status',
        'keterangan',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
