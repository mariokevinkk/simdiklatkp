<?php

namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class UnitKerjaPelatihanModel extends Model
{
    protected $table            = 'unit_kerja_pelatihan';
    protected $primaryKey       = 'id_unit_kerja';
    protected $allowedFields    = ['nama_unit'];
}
