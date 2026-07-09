<?php

namespace App\Models;

use CodeIgniter\Model;

class LogbookPendidikanModel extends Model
{
    protected $table            = 'logbook_pendidikan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'penempatan_id',
        'tanggal_kegiatan',
        'judul_kegiatan',
        'deskripsi_kegiatan',
        'file_lampiran',
        'status_validasi',
        'catatan_ci'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
