<?php
namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class MasterKategoriSkpPelatihanModel extends Model
{
    protected $table            = 'master_kategori_skp_pelatihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ranah', 'nama_kategori'];

    // Dates
    protected $useTimestamps = false;
}