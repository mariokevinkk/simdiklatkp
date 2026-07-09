<?php

namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class ProfesiPelatihanModel extends Model
{
    protected $table            = 'profesi_pelatihan';
    protected $primaryKey       = 'id_profesi';
    protected $allowedFields    = ['nama_profesi', 'kategori_target', 'target_jpl'];
}
