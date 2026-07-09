<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanRisetModel extends Model
{
    protected $table            = 'pengajuan_riset';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_riset_id', 
        'jenis_pengajuan',
        'nama',
        'identitas',
        'prodi',
        'institusi',
        'judul',
        'waktu_mulai', 
        'waktu_selesai', 
        'status',
        'catatan_revisi',
        'catatan_penolakan',
        'nominal_bayar',
        'bukti_file',
        'nomor_surat'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
