<?php

namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class PengaturanLogoPelatihanModel extends Model
{
    protected $table            = 'pengaturan_logo_sistem_pelatihan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['logo_path', 'favicon_path', 'updated_at'];
    protected $useTimestamps    = false;
}
