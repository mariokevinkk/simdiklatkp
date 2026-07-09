<?php

namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class PejabatTtdPelatihanModel extends Model
{
    protected $table            = 'pejabat_ttd_pelatihan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['an_pejabat', 'jabatan', 'nama_pejabat', 'nip_pejabat', 'ttd_image'];
    protected $useTimestamps    = true;
}
