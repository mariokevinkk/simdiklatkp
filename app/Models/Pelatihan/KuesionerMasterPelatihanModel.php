<?php
namespace App\Models\Pelatihan;

use CodeIgniter\Model;

class KuesionerMasterPelatihanModel extends Model
{
    protected $table            = 'kuesioner_master_pelatihan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pelatihan_id', 'kategori_id', 'pertanyaan'];

    // Dates
    protected $useTimestamps = false;
}