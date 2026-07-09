<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenRisetModel extends Model
{
    protected $table            = 'dokumen_riset';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pengajuan_riset_id',
        'jenis_dokumen',
        'file_path',
        'status_dokumen',
        'catatan'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
