<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanSuratRisetModel extends Model
{
    protected $table            = 'pengaturan_surat_riset';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'logo_kop',
        'ttd_image',
        'nama_pejabat',
        'nip_pejabat',
        'jabatan',
        'pangkat',
        'nama_bank',
        'nomor_rekening',
        'nama_rekening'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
